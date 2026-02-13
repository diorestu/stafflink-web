@php
    $isEdit = isset($page);
@endphp

<form action="{{ $isEdit ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST" class="p-6 space-y-6">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $page->title ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. About Us">
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug URL</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. about-us">
        <p class="mt-1 text-xs text-gray-500">Page URL will be: /p/{slug}</p>
    </div>

    <div>
        <label for="ai_prompt" class="block text-sm font-medium text-gray-700 mb-2">AI Brief (optional)</label>
        <textarea name="ai_prompt" id="ai_prompt" rows="3"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="Describe what this page is about. AI can help complete title, slug, excerpt, and meta.">{{ old('ai_prompt') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">{{ old('excerpt', $page->excerpt ?? '') }}</textarea>
        </div>

        <div>
            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
            <textarea name="meta_description" id="meta_description" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
        </div>
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select name="status" id="status"
            class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
            <option value="draft" {{ old('status', $page->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status', $page->status ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
        </select>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
        <input type="checkbox" name="use_ai" value="1" {{ old('use_ai', '1') ? 'checked' : '' }}>
        <span>Use AI completion for empty fields</span>
    </label>

    <div class="flex items-center justify-between pt-6 border-t">
        <a href="{{ route('admin.pages.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
        <button type="submit" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2 rounded-lg font-medium">
            {{ $isEdit ? 'Update Page' : 'Create Page' }}
        </button>
    </div>
</form>
