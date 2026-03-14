@php
    $position = $position ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label for="division_id" class="block text-sm font-medium text-gray-700 mb-2">Division *</label>
        <select id="division_id" name="division_id" required
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
            <option value="">Select division</option>
            @foreach ($divisions as $division)
                <option value="{{ $division->id }}" {{ (string) old('division_id', $position?->division_id) === (string) $division->id ? 'selected' : '' }}>
                    {{ $division->name }}
                </option>
            @endforeach
        </select>
        @error('division_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Position Name *</label>
        <input type="text" id="name" name="name" required
            value="{{ old('name', $position?->name) }}"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
            placeholder="e.g. HR and Finance Manager">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select id="is_active" name="is_active"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
            <option value="1" {{ old('is_active', $position?->is_active ?? true) ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !old('is_active', $position?->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('is_active')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
