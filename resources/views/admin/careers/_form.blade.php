@php
    $career = $career ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label for="career_category_id" class="block text-sm font-medium text-gray-700 mb-2">Service Category *</label>
        <select name="career_category_id" id="career_category_id" required
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (string) old('career_category_id', $career?->career_category_id) === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('career_category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Service Title *</label>
        <input type="text" name="title" id="title" value="{{ old('title', $career?->title) }}" required
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. Senior Executive Assistant">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
        <textarea name="description" id="description" rows="6" required
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="Describe this career role">{{ old('description', $career?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Service Thumbnail</label>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
        @error('thumbnail')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @if ($career?->thumbnail_path)
            <div class="mt-3">
                <p class="text-xs text-gray-500 mb-2">Current thumbnail</p>
                <img src="{{ \Illuminate\Support\Facades\Storage::url($career->thumbnail_path) }}" alt="{{ $career->title }}"
                    class="h-20 w-20 rounded-lg object-cover border border-gray-200" draggable="false" />
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
            <input type="text" name="country" id="country" value="{{ old('country', $career?->country) }}" required
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                placeholder="e.g. Indonesia">
            @error('country')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State *</label>
            <input type="text" name="state" id="state" value="{{ old('state', $career?->state) }}" required
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                placeholder="e.g. Bali">
            @error('state')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
            <select name="type" id="type" required
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                <option value="full-time" {{ old('type', $career?->type) === 'full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="part-time" {{ old('type', $career?->type) === 'part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="contract" {{ old('type', $career?->type) === 'contract' ? 'selected' : '' }}>Contract</option>
            </select>
            @error('type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
            <select name="status" id="status" required
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                <option value="draft" {{ old('status', $career?->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $career?->status) === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="minimum_salary" class="block text-sm font-medium text-gray-700 mb-2">Minimum Salary</label>
            <input type="number" name="minimum_salary" id="minimum_salary" min="0" value="{{ old('minimum_salary', $career?->minimum_salary) }}"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                placeholder="e.g. 5000000">
            @error('minimum_salary')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="maximum_salary" class="block text-sm font-medium text-gray-700 mb-2">Maximum Salary</label>
            <input type="number" name="maximum_salary" id="maximum_salary" min="0" value="{{ old('maximum_salary', $career?->maximum_salary) }}"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                placeholder="e.g. 10000000">
            @error('maximum_salary')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
