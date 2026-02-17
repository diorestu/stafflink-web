<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminBlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::query()
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_posts,slug'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['slug'] = $this->resolveSlug($validated['slug'] ?? null, $validated['title']);
        $validated['published_at'] = $this->resolvePublishedAt(
            $validated['status'],
            $validated['published_at'] ?? null
        );

        unset($validated['featured_image']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image_path'] = $request->file('featured_image')->store('blog-posts', 'public');
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blog_posts', 'slug')->ignore($blogPost->id)],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['slug'] = $this->resolveSlug($validated['slug'] ?? null, $validated['title'], $blogPost->id);
        $validated['published_at'] = $this->resolvePublishedAt(
            $validated['status'],
            $validated['published_at'] ?? null,
            $blogPost->published_at
        );

        unset($validated['featured_image']);

        if ($request->hasFile('featured_image')) {
            if ($blogPost->featured_image_path) {
                Storage::disk('public')->delete($blogPost->featured_image_path);
            }
            $validated['featured_image_path'] = $request->file('featured_image')->store('blog-posts', 'public');
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->featured_image_path) {
            Storage::disk('public')->delete($blogPost->featured_image_path);
        }

        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function resolveSlug(?string $slugInput, string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug(trim((string) ($slugInput ?: $title)));
        if ($slug === '') {
            $slug = Str::slug($title . '-' . Str::random(4));
        }

        $candidate = $slug;
        $index = 2;

        while (
            BlogPost::query()
                ->where('slug', $candidate)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $candidate = $slug . '-' . $index;
            $index++;
        }

        return $candidate;
    }

    private function resolvePublishedAt(string $status, ?string $publishedAtInput, $existingPublishedAt = null)
    {
        if ($status !== 'published') {
            return null;
        }

        if ($publishedAtInput) {
            return $publishedAtInput;
        }

        return $existingPublishedAt ?: now();
    }
}
