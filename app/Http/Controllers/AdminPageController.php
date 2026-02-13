<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'excerpt' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'ai_prompt' => ['nullable', 'string', 'max:1000'],
            'use_ai' => ['nullable', 'boolean'],
        ]);

        $data = $this->buildPagePayload($input, null);
        $page = Page::create($data);

        return redirect()
            ->route('admin.pages.builder', $page)
            ->with('success', 'Page created. You can now edit content in builder mode.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $input = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'excerpt' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'ai_prompt' => ['nullable', 'string', 'max:1000'],
            'use_ai' => ['nullable', 'boolean'],
        ]);

        $data = $this->buildPagePayload($input, $page->id);
        $page->update($data);

        return redirect()
            ->route('admin.pages.edit', $page)
            ->with('success', 'Page details updated.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    public function builder(Page $page)
    {
        return view('admin.pages.builder', compact('page'));
    }

    public function saveBuilder(Request $request, Page $page)
    {
        $validated = $request->validate([
            'content_html' => ['nullable', 'string'],
            'content_css' => ['nullable', 'string'],
            'builder_data' => ['nullable', 'string'],
        ]);

        $builderData = null;
        if (!empty($validated['builder_data'])) {
            $decoded = json_decode($validated['builder_data'], true);
            if (is_array($decoded)) {
                $builderData = $decoded;
            }
        }

        $page->update([
            'content_html' => $validated['content_html'] ?? null,
            'content_css' => $validated['content_css'] ?? null,
            'builder_data' => $builderData,
        ]);

        return redirect()
            ->route('admin.pages.builder', $page)
            ->with('success', 'Builder content saved.');
    }

    private function buildPagePayload(array $input, ?int $currentPageId): array
    {
        $completed = [];

        $shouldUseAi = (bool) ($input['use_ai'] ?? true);
        if ($shouldUseAi) {
            $completed = $this->completeWithAi($input);
        }

        $title = trim((string) ($input['title'] ?: ($completed['title'] ?? '')));
        $title = $title !== '' ? $title : 'Untitled Page';

        $baseSlug = trim((string) ($input['slug'] ?: ($completed['slug'] ?? '')));
        $baseSlug = $baseSlug !== '' ? $baseSlug : Str::slug($title);
        $slug = $this->ensureUniqueSlug($baseSlug, $currentPageId);

        $status = $input['status'];
        $publishedAt = $status === 'published' ? now() : null;

        return [
            'title' => $title,
            'slug' => $slug,
            'status' => $status,
            'excerpt' => $input['excerpt'] ?: ($completed['excerpt'] ?? null),
            'meta_description' => $input['meta_description'] ?: ($completed['meta_description'] ?? null),
            'published_at' => $publishedAt,
        ];
    }

    private function ensureUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = Str::slug($slug);
        $slug = $slug !== '' ? $slug : 'page';
        $candidate = $slug;
        $index = 2;

        while (
            Page::query()
                ->where('slug', $candidate)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $candidate = $slug . '-' . $index;
            $index++;
        }

        return $candidate;
    }

    private function completeWithAi(array $input): array
    {
        $prompt = trim((string) ($input['ai_prompt'] ?? ''));
        $draftTitle = trim((string) ($input['title'] ?? ''));

        if ($prompt === '' && $draftTitle === '') {
            return [];
        }

        $apiKey = (string) config('services.openai.api_key');
        if ($apiKey === '') {
            return $this->fallbackCompletion($prompt, $draftTitle);
        }

        try {
            $response = Http::withToken($apiKey)
                ->timeout(20)
                ->post('https://api.openai.com/v1/responses', [
                    'model' => config('services.openai.model', 'gpt-4.1-mini'),
                    'input' => [
                        [
                            'role' => 'system',
                            'content' => [
                                ['type' => 'input_text', 'text' => 'Return only JSON with keys: title, slug, excerpt, meta_description. Keep excerpt and meta_description concise.'],
                            ],
                        ],
                        [
                            'role' => 'user',
                            'content' => [
                                ['type' => 'input_text', 'text' => 'Draft title: ' . $draftTitle],
                                ['type' => 'input_text', 'text' => 'Page brief: ' . $prompt],
                            ],
                        ],
                    ],
                    'text' => [
                        'format' => [
                            'type' => 'json_schema',
                            'name' => 'page_completion',
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'title' => ['type' => 'string'],
                                    'slug' => ['type' => 'string'],
                                    'excerpt' => ['type' => 'string'],
                                    'meta_description' => ['type' => 'string'],
                                ],
                                'required' => ['title', 'slug', 'excerpt', 'meta_description'],
                                'additionalProperties' => false,
                            ],
                        ],
                    ],
                ]);

            $json = $response->json();
            $content = data_get($json, 'output.0.content.0.text');
            if (!is_string($content) || $content === '') {
                return $this->fallbackCompletion($prompt, $draftTitle);
            }

            $parsed = json_decode($content, true);
            if (!is_array($parsed)) {
                return $this->fallbackCompletion($prompt, $draftTitle);
            }

            return [
                'title' => trim((string) ($parsed['title'] ?? '')),
                'slug' => Str::slug((string) ($parsed['slug'] ?? '')),
                'excerpt' => trim((string) ($parsed['excerpt'] ?? '')),
                'meta_description' => trim((string) ($parsed['meta_description'] ?? '')),
            ];
        } catch (\Throwable $e) {
            Log::warning('AI page completion failed', ['message' => $e->getMessage()]);

            return $this->fallbackCompletion($prompt, $draftTitle);
        }
    }

    private function fallbackCompletion(string $prompt, string $title): array
    {
        $baseTitle = $title !== '' ? $title : Str::title(Str::of($prompt)->limit(60, ''));
        $baseTitle = trim($baseTitle) !== '' ? trim($baseTitle) : 'Untitled Page';

        $summary = trim(Str::of($prompt)->squish()->limit(160, '')->toString());

        return [
            'title' => $baseTitle,
            'slug' => Str::slug($baseTitle),
            'excerpt' => $summary,
            'meta_description' => $summary,
        ];
    }
}
