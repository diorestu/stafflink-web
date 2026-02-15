<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'minimum_salary' => 'nullable|integer|min:0|required_with:maximum_salary',
            'maximum_salary' => 'nullable|integer|min:0|gte:minimum_salary|required_with:minimum_salary',
            'status' => 'required|in:draft,published',
        ]);

        $minimumSalary = isset($validated['minimum_salary']) ? (int) $validated['minimum_salary'] : null;
        $maximumSalary = isset($validated['maximum_salary']) ? (int) $validated['maximum_salary'] : null;
        $validated['minimum_salary'] = $minimumSalary;
        $validated['maximum_salary'] = $maximumSalary;
        $validated['salary_range'] = $this->formatSalaryRange($minimumSalary, $maximumSalary);
        $validated['location'] = $this->composeLocation($validated['state'], $validated['country']);

        if ($request->status === 'published' && !$request->published_at) {
            $validated['published_at'] = now();
        }

        Job::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'minimum_salary' => 'nullable|integer|min:0|required_with:maximum_salary',
            'maximum_salary' => 'nullable|integer|min:0|gte:minimum_salary|required_with:minimum_salary',
            'status' => 'required|in:draft,published',
        ]);

        $minimumSalary = isset($validated['minimum_salary']) ? (int) $validated['minimum_salary'] : null;
        $maximumSalary = isset($validated['maximum_salary']) ? (int) $validated['maximum_salary'] : null;
        $validated['minimum_salary'] = $minimumSalary;
        $validated['maximum_salary'] = $maximumSalary;
        $validated['salary_range'] = $this->formatSalaryRange($minimumSalary, $maximumSalary);
        $validated['location'] = $this->composeLocation($validated['state'], $validated['country']);

        if ($request->status === 'published' && !$job->published_at) {
            $validated['published_at'] = now();
        }

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'job_ids' => ['required', 'array', 'min:1'],
            'job_ids.*' => ['integer', Rule::exists('career_jobs', 'id')],
        ]);

        $deleted = Job::query()
            ->whereIn('id', $validated['job_ids'])
            ->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', "{$deleted} job(s) deleted successfully.");
    }

    public function generateDescription(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'in:full-time,part-time,contract'],
            'country' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
        ]);

        $apiKey = (string) config('services.ai_agent.api_key');
        $baseUrl = rtrim((string) config('services.ai_agent.base_url'), '/');
        $model = (string) config('services.ai_agent.model', 'gpt-4o-mini');

        if ($apiKey === '' || $baseUrl === '') {
            return response()->json([
                'message' => 'AI agent credentials are not configured.',
            ], 500);
        }

        $jobType = str_replace('-', ' ', (string) ($validated['type'] ?? 'full-time'));
        $location = $this->composeLocation($validated['state'] ?? null, $validated['country'] ?? null);

        $userPrompt = "Create a professional job description for this role:\n" .
            "Title: {$validated['title']}\n" .
            "Job type: {$jobType}\n" .
            "Location: " . ($location ?: 'Not specified') . "\n\n" .
            "Use plain text with sections: Overview, Key Responsibilities, Requirements, Nice to Have, and Benefits.";

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(30)
                ->post("{$baseUrl}/chat/completions", [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are an expert HR copywriter. Return only the final job description in plain text.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $userPrompt,
                        ],
                    ],
                    'max_tokens' => 800,
                    'temperature' => 0.7,
                ])
                ->throw();

            $description = trim((string) data_get($response->json(), 'choices.0.message.content', ''));

            if ($description === '') {
                return response()->json([
                    'message' => 'AI returned an empty description.',
                ], 502);
            }

            return response()->json([
                'description' => $description,
            ]);
        } catch (\Throwable $e) {
            Log::warning('AI job description generation failed', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Failed to generate job description.',
            ], 502);
        }
    }

    private function composeLocation(?string $state, ?string $country): ?string
    {
        $parts = array_values(array_filter([
            trim((string) $state),
            trim((string) $country),
        ]));

        return count($parts) > 0 ? implode(', ', $parts) : null;
    }

    private function formatSalaryRange(?int $minimumSalary, ?int $maximumSalary): ?string
    {
        if ($minimumSalary === null && $maximumSalary === null) {
            return null;
        }

        if ($maximumSalary === null) {
            $maximumSalary = $minimumSalary;
        }

        if ($minimumSalary === null) {
            $minimumSalary = $maximumSalary;
        }

        return 'IDR ' . number_format($minimumSalary) . ' - ' . number_format($maximumSalary);
    }
}
