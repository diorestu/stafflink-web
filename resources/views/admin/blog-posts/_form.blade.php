@php
    $blogPost = $blogPost ?? null;
    $publishedAtValue = old('published_at', optional($blogPost?->published_at)->format('Y-m-d\\TH:i'));
    $contentValue = old('content', $blogPost?->content);
@endphp

<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
        <input type="text" name="title" id="title" value="{{ old('title', $blogPost?->title) }}" required
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. How to Build a High-Performing Offshore Team">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $blogPost?->slug) }}"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="auto-generated-if-empty">
        @error('slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Author Name</label>
        <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $blogPost?->author_name) }}"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. StaffLink Editorial Team">
        @error('author_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
        <textarea name="excerpt" id="excerpt" rows="3"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="Short summary shown in blog cards">{{ old('excerpt', $blogPost?->excerpt) }}</textarea>
        @error('excerpt')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content-editor" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
        <input type="hidden" name="content" id="content" value="{{ $contentValue }}">
        <div class="quill-shell">
            <div id="content-editor" class="min-h-[320px] bg-white"></div>
        </div>
        @error('content')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
        <input type="file" id="featured_image" name="featured_image" accept="image/*"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
        @error('featured_image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @if ($blogPost?->featured_image_path)
            <div class="mt-3">
                <p class="text-xs text-gray-500 mb-2">Current image</p>
                <img src="{{ \Illuminate\Support\Facades\Storage::url($blogPost->featured_image_path) }}" alt="{{ $blogPost->title }}"
                    class="h-20 w-20 rounded-lg object-cover border border-gray-200" draggable="false" />
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
            <select name="status" id="status" required
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                <option value="draft" {{ old('status', $blogPost?->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $blogPost?->status) === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Publish At</label>
            <input type="datetime-local" name="published_at" id="published_at" value="{{ $publishedAtValue }}"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
            @error('published_at')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

@once
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        .quill-shell {
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background: #fff;
        }

        .quill-shell:focus-within {
            border-color: #287854;
            box-shadow: 0 0 0 2px rgba(40, 120, 84, 0.15);
        }

        .quill-shell .ql-toolbar.ql-snow {
            border: 0;
            border-bottom: 1px solid #e5e7eb;
            background: #f8faf9;
            padding: 10px 12px;
        }

        .quill-shell .ql-container.ql-snow {
            border: 0;
            font-family: var(--font-body);
        }

        .quill-shell .ql-editor {
            min-height: 260px;
            font-size: 15px;
            line-height: 1.65;
            padding: 14px 16px;
        }

        .quill-shell .ql-toolbar button:hover .ql-stroke,
        .quill-shell .ql-toolbar button.ql-active .ql-stroke,
        .quill-shell .ql-toolbar .ql-picker-label:hover .ql-stroke,
        .quill-shell .ql-toolbar .ql-picker-label.ql-active .ql-stroke {
            stroke: #287854;
        }

        .quill-shell .ql-toolbar button:hover .ql-fill,
        .quill-shell .ql-toolbar button.ql-active .ql-fill,
        .quill-shell .ql-toolbar .ql-picker-label:hover .ql-fill,
        .quill-shell .ql-toolbar .ql-picker-label.ql-active .ql-fill {
            fill: #287854;
        }

        .quill-shell .ql-toolbar .ql-picker {
            color: #374151;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
@endonce

<script>
    (() => {
        const editorEl = document.getElementById('content-editor');
        const inputEl = document.getElementById('content');

        if (!editorEl || !inputEl || typeof Quill === 'undefined') {
            return;
        }

        if (editorEl.dataset.initialized === 'true') {
            return;
        }
        editorEl.dataset.initialized = 'true';

        const quill = new Quill(editorEl, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    [{ align: [] }],
                    ['blockquote', 'link'],
                    ['clean'],
                ],
            },
        });

        if (inputEl.value) {
            quill.clipboard.dangerouslyPasteHTML(inputEl.value);
        }

        const syncContent = () => {
            const html = quill.root.innerHTML;
            inputEl.value = html === '<p><br></p>' ? '' : html;
        };

        quill.on('text-change', syncContent);

        const form = editorEl.closest('form');
        if (form) {
            form.addEventListener('submit', syncContent);
        }
    })();
</script>
