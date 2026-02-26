@csrf

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Area Label</label>
        <input type="text" name="label" value="{{ old('label', $serviceArea->label ?? '') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2">
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Slug (optional)</label>
        <input type="text" name="slug" value="{{ old('slug', $serviceArea->slug ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2" placeholder="auto-generate-from-label">
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Type</label>
        <select name="type" class="w-full rounded-lg border border-gray-300 px-4 py-2">
            @php($selectedType = old('type', $serviceArea->type ?? 'state'))
            <option value="state" @selected($selectedType === 'state')>State</option>
            <option value="country" @selected($selectedType === 'country')>Country</option>
            <option value="custom" @selected($selectedType === 'custom')>Custom</option>
        </select>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Sort Order</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $serviceArea->sort_order ?? 0) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2">
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">State (optional)</label>
        <input type="text" name="state" value="{{ old('state', $serviceArea->state ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2">
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Country (optional)</label>
        <input type="text" name="country" value="{{ old('country', $serviceArea->country ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2">
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-gray-700">SEO Label</label>
        <input type="text" name="seo_label" value="{{ old('seo_label', $serviceArea->seo_label ?? '') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2" placeholder="Fallback ke Area Label">
    </div>

    <div class="md:col-span-2">
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $serviceArea->is_active ?? true))>
            <span class="text-sm text-gray-700">Active</span>
        </label>
    </div>
</div>

<div class="mt-8 flex justify-end gap-3">
    <a href="{{ route('admin.service-areas.index') }}" class="rounded-lg border border-gray-300 px-5 py-2 text-sm font-medium text-gray-700">Cancel</a>
    <button type="submit" class="rounded-lg bg-[#287854] px-5 py-2 text-sm font-medium text-white hover:bg-[#1f5f46]">Save</button>
</div>
