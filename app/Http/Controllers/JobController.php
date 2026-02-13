<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
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
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'salary_range' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
        ]);

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
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'salary_range' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
        ]);

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
}
