<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $featuredPost = BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->first();

        $posts = BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('blog', compact('posts', 'featuredPost'));
    }

    public function show(BlogPost $blogPost)
    {
        $isPublished = BlogPost::query()
            ->published()
            ->whereKey($blogPost->id)
            ->exists();

        abort_unless($isPublished, 404);

        $relatedPosts = BlogPost::query()
            ->published()
            ->whereKeyNot($blogPost->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('blog-show', [
            'post' => $blogPost,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
