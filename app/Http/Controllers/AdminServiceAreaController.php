<?php

namespace App\Http\Controllers;

use App\Models\ServiceArea;
use App\Services\ServiceAreaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceAreaController extends Controller
{
    public function index()
    {
        $areas = ServiceArea::query()
            ->orderByDesc('is_active')
            ->orderBy('sort_order')
            ->orderBy('label')
            ->paginate(20);

        return view('admin.service-areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.service-areas.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->ensureUniqueSlug($data['slug'] ?: $data['label']);

        ServiceArea::create($data);
        ServiceAreaService::flushCache();

        return redirect()
            ->route('admin.service-areas.index')
            ->with('success', 'Service area created successfully.');
    }

    public function edit(ServiceArea $serviceArea)
    {
        return view('admin.service-areas.edit', compact('serviceArea'));
    }

    public function update(Request $request, ServiceArea $serviceArea)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->ensureUniqueSlug($data['slug'] ?: $data['label'], $serviceArea->id);

        $serviceArea->update($data);
        ServiceAreaService::flushCache();

        return redirect()
            ->route('admin.service-areas.index')
            ->with('success', 'Service area updated successfully.');
    }

    public function destroy(ServiceArea $serviceArea)
    {
        $serviceArea->delete();
        ServiceAreaService::flushCache();

        return redirect()
            ->route('admin.service-areas.index')
            ->with('success', 'Service area deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:120'],
            'type' => ['required', 'string', 'max:30'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'seo_label' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if (trim((string) ($validated['seo_label'] ?? '')) === '') {
            $validated['seo_label'] = $validated['label'];
        }

        return $validated;
    }

    private function ensureUniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($base);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'area';
        $candidate = $baseSlug;
        $suffix = 2;

        while (ServiceArea::query()
            ->where('slug', $candidate)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $candidate = $baseSlug . '-' . $suffix;
            $suffix++;
        }

        return $candidate;
    }
}
