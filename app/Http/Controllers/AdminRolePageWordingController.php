<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Support\RolePageWording;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminRolePageWordingController extends Controller
{
    public function index()
    {
        $storedWordings = RolePageWording::all();

        $roles = Career::query()
            ->whereNotNull('title')
            ->where('title', '!=', '')
            ->orderBy('title')
            ->pluck('title')
            ->unique()
            ->values()
            ->map(function (string $title) use ($storedWordings): array {
                $slug = Str::slug($title);

                return [
                    'title' => $title,
                    'slug' => $slug,
                    'has_copy' => !empty($storedWordings[$slug] ?? []),
                ];
            });

        return view('admin.role-page-wording.index', [
            'roles' => $roles,
        ]);
    }

    public function edit(string $slug)
    {
        $roleTitle = $this->findRoleTitle($slug);
        abort_if($roleTitle === null, 404);

        $copy = RolePageWording::for($slug);

        return view('admin.role-page-wording.edit', [
            'roleTitle' => $roleTitle,
            'roleSlug' => $slug,
            'copy' => $copy,
        ]);
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $roleTitle = $this->findRoleTitle($slug);
        abort_if($roleTitle === null, 404);

        $validated = $request->validate([
            'hero_badge' => ['nullable', 'string', 'max:190'],
            'hero_title' => ['nullable', 'string', 'max:190'],
            'hero_subtitle' => ['nullable', 'string', 'max:4000'],
            'primary_cta_label' => ['nullable', 'string', 'max:100'],
            'primary_cta_url' => ['nullable', 'string', 'max:255'],
            'secondary_cta_label' => ['nullable', 'string', 'max:100'],
            'secondary_cta_url' => ['nullable', 'string', 'max:255'],
            'sections' => ['nullable', 'array'],
            'sections.*.layout' => ['nullable', 'in:text,cards,split_image'],
            'sections.*.title' => ['nullable', 'string', 'max:255'],
            'sections.*.columns' => ['nullable', 'in:2,3,4'],
            'sections.*.paragraphs' => ['nullable', 'array'],
            'sections.*.paragraphs.*' => ['nullable', 'string', 'max:4000'],
            'sections.*.items' => ['nullable', 'array'],
            'sections.*.items.*.title' => ['nullable', 'string', 'max:255'],
            'sections.*.items.*.body' => ['nullable', 'string', 'max:4000'],
            'sections.*.image_path' => ['nullable', 'string', 'max:255'],
            'sections.*.image_position' => ['nullable', 'in:left,right'],
            'sections.*.image_alt' => ['nullable', 'string', 'max:255'],
            'sections.*.image_fit' => ['nullable', 'in:cover,contain'],
            'sections.*.image_height' => ['nullable', 'in:sm,md,lg'],
            'sections.*.remove_image' => ['nullable', 'in:0,1'],
            'section_images' => ['nullable', 'array'],
            'section_images.*' => ['nullable', 'image', 'max:4096'],
        ]);

        $existingImagePaths = collect(RolePageWording::for($slug)['sections'] ?? [])
            ->filter(fn ($section) => is_array($section))
            ->pluck('image_path')
            ->filter()
            ->values();

        $sections = collect($validated['sections'] ?? [])
            ->filter(fn ($section) => is_array($section))
            ->map(function (array $section, $sectionIndex) use ($request): array {
                $layout = (string) ($section['layout'] ?? 'text');
                $title = trim((string) ($section['title'] ?? ''));

                if ($layout === 'cards') {
                    $items = collect($section['items'] ?? [])
                        ->filter(fn ($item) => is_array($item))
                        ->map(fn (array $item): array => [
                            'title' => trim((string) ($item['title'] ?? '')),
                            'body' => trim((string) ($item['body'] ?? '')),
                        ])
                        ->filter(fn (array $item): bool => $item['title'] !== '' || $item['body'] !== '')
                        ->values()
                        ->all();

                    return [
                        'layout' => 'cards',
                        'title' => $title,
                        'columns' => (string) ($section['columns'] ?? '3'),
                        'items' => $items,
                    ];
                }

                if ($layout === 'split_image') {
                    $paragraphs = collect($section['paragraphs'] ?? [])
                        ->map(fn ($paragraph) => trim((string) $paragraph))
                        ->filter()
                        ->values()
                        ->all();

                    $imagePath = trim((string) ($section['image_path'] ?? ''));
                    $removeImage = (string) ($section['remove_image'] ?? '0') === '1';

                    if ($removeImage && $imagePath !== '') {
                        Storage::disk('public')->delete($imagePath);
                        $imagePath = '';
                    }

                    if ($request->hasFile("section_images.$sectionIndex")) {
                        if ($imagePath !== '') {
                            Storage::disk('public')->delete($imagePath);
                        }

                        $imagePath = $request->file("section_images.$sectionIndex")->store('role-page-copy', 'public');
                    }

                    return [
                        'layout' => 'split_image',
                        'title' => $title,
                        'paragraphs' => $paragraphs,
                        'image_path' => $imagePath,
                        'image_position' => (string) ($section['image_position'] ?? 'right'),
                        'image_alt' => trim((string) ($section['image_alt'] ?? '')),
                        'image_fit' => (string) ($section['image_fit'] ?? 'cover'),
                        'image_height' => (string) ($section['image_height'] ?? 'md'),
                    ];
                }

                $paragraphs = collect($section['paragraphs'] ?? [])
                    ->map(fn ($paragraph) => trim((string) $paragraph))
                    ->filter()
                    ->values()
                    ->all();

                return [
                    'layout' => 'text',
                    'title' => $title,
                    'paragraphs' => $paragraphs,
                ];
            })
            ->filter(function (array $section): bool {
                if (($section['layout'] ?? 'text') === 'cards') {
                    return $section['title'] !== '' || !empty($section['items']);
                }

                if (($section['layout'] ?? 'text') === 'split_image') {
                    return $section['title'] !== '' || !empty($section['paragraphs']) || !empty($section['image_path']);
                }

                return $section['title'] !== '' || !empty($section['paragraphs']);
            })
            ->values()
            ->all();

        $retainedImagePaths = collect($sections)
            ->pluck('image_path')
            ->filter()
            ->values();

        $existingImagePaths
            ->diff($retainedImagePaths)
            ->each(fn (string $path) => Storage::disk('public')->delete($path));

        $payload = [
            'hero_badge' => trim((string) ($validated['hero_badge'] ?? '')),
            'hero_title' => trim((string) ($validated['hero_title'] ?? '')),
            'hero_subtitle' => trim((string) ($validated['hero_subtitle'] ?? '')),
            'primary_cta_label' => trim((string) ($validated['primary_cta_label'] ?? '')),
            'primary_cta_url' => trim((string) ($validated['primary_cta_url'] ?? '')),
            'secondary_cta_label' => trim((string) ($validated['secondary_cta_label'] ?? '')),
            'secondary_cta_url' => trim((string) ($validated['secondary_cta_url'] ?? '')),
            'sections' => $sections,
        ];

        $payload = array_filter($payload, function ($value): bool {
            if (is_string($value)) {
                return $value !== '';
            }

            return !empty($value);
        });

        RolePageWording::update($slug, $payload);

        return redirect()
            ->route('admin.role-page-wording.edit', $slug)
            ->with('success', "Role page copy for {$roleTitle} updated successfully.");
    }

    private function findRoleTitle(string $slug): ?string
    {
        return Career::query()
            ->whereNotNull('title')
            ->where('title', '!=', '')
            ->pluck('title')
            ->unique()
            ->first(fn (string $title) => Str::slug($title) === $slug);
    }
}
