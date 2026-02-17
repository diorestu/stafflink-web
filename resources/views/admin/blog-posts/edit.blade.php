@extends('admin.layout')

@section('page-title', 'Edit Blog Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.blog-posts.index') }}" class="text-[#287854] hover:text-[#1f5f46] font-medium">
                ← Back to blog posts
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 md:p-8">
            <h3 class="text-xl font-semibold mb-6">Edit Blog Post</h3>
            <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @include('admin.blog-posts._form', ['blogPost' => $blogPost])

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('admin.blog-posts.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-[#287854] text-white rounded-lg hover:bg-[#1f5f46] font-medium">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
