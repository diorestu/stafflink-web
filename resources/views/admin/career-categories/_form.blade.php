@php
    $category = $category ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
        <input type="text" id="name" name="name" required
            value="{{ old('name', $category?->name) }}"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. Administration">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
        <input type="text" id="slug" name="slug"
            value="{{ old('slug', $category?->slug) }}"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="auto-generated if left blank">
        @error('slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea id="description" name="description" rows="4"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="Short category summary for front-end cards">{{ old('description', $category?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>
        <input type="file" id="image" name="image" accept="image/*"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @if ($category?->image_path)
            <div class="mt-3">
                <p class="text-xs text-gray-500 mb-2">Current image</p>
                <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image_path) }}" alt="{{ filled($category->name) ? $category->name : 'Category image' }}"
                    class="h-20 w-20 rounded-lg object-cover border border-gray-200" draggable="false" />
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" min="0"
                value="{{ old('sort_order', $category?->sort_order ?? 0) }}"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
            @error('sort_order')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select id="is_active" name="is_active"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                <option value="1" {{ old('is_active', $category?->is_active ?? true) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !old('is_active', $category?->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('is_active')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
