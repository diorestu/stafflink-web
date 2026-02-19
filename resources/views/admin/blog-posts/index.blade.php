@extends('admin.layout')

@section('page-title', 'Blog Management')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Blog Posts</h3>
            <a href="{{ route('admin.blog-posts.create') }}"
                class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Blog Post
            </a>
        </div>

        @if ($posts->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published At</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-3">
                                        @if ($post->featured_image_path)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->featured_image_path) }}"
                                                alt="{{ $post->title }}" class="h-12 w-12 rounded object-cover border border-gray-200" draggable="false">
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $post->title }}</p>
                                            <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 90) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $post->slug }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $post->published_at?->format('Y-m-d H:i') ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                        @if ($post->status === 'published' && $post->published_at)
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#2b89b5] hover:bg-[#ebf4fa]" title="View">
                                                <iconify-icon icon="mdi:open-in-new" width="18" height="18"></iconify-icon>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.blog-posts.edit', $post) }}"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]" title="Edit">
                                            <iconify-icon icon="mdi:pencil-outline" width="18" height="18"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Delete this blog post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-red-600 hover:bg-red-50"
                                                title="Delete">
                                                <iconify-icon icon="mdi:trash-can-outline" width="18" height="18"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($posts->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $posts->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No blog posts yet</h3>
                <p class="text-gray-500 mb-4">Create your first post to publish it on the blog page.</p>
                <a href="{{ route('admin.blog-posts.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    Add Blog Post
                </a>
            </div>
        @endif
    </div>
@endsection
