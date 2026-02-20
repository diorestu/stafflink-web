@php
    $faq = $faq ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question *</label>
        <input type="text" id="question" name="question" required
            value="{{ old('question', $faq?->question) }}"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. How quickly can StaffLink provide candidates?">
        @error('question')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Answer *</label>
        <textarea id="answer" name="answer" rows="6" required
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="Provide a clear, concise answer suitable for users and search engines.">{{ old('answer', $faq?->answer) }}</textarea>
        @error('answer')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" min="0"
                value="{{ old('sort_order', $faq?->sort_order ?? 0) }}"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
            @error('sort_order')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select id="is_active" name="is_active"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                <option value="1" {{ old('is_active', $faq?->is_active ?? true) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !old('is_active', $faq?->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('is_active')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
