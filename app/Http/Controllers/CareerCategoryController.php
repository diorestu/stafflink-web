<?php

namespace App\Http\Controllers;

use App\Models\CareerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CareerCategoryController extends Controller
{
    public function index()
    {
        $categories = CareerCategory::query()
            ->withCount('careers')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.career-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.career-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:career_categories,name'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:career_categories,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['slug'] = $this->resolveSlug($validated['slug'] ?? null, $validated['name']);
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        unset($validated['image']);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('career-categories', 'public');
        }

        CareerCategory::create($validated);

        return redirect()
            ->route('admin.career-categories.index')
            ->with('success', 'Career category created successfully.');
    }

    public function edit(CareerCategory $careerCategory)
    {
        return view('admin.career-categories.edit', compact('careerCategory'));
    }

    public function update(Request $request, CareerCategory $careerCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('career_categories', 'name')->ignore($careerCategory->id)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('career_categories', 'slug')->ignore($careerCategory->id)],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['slug'] = $this->resolveSlug($validated['slug'] ?? null, $validated['name']);
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        unset($validated['image']);

        if ($request->hasFile('image')) {
            if ($careerCategory->image_path) {
                Storage::disk('public')->delete($careerCategory->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('career-categories', 'public');
        }

        $careerCategory->update($validated);

        return redirect()
            ->route('admin.career-categories.index')
            ->with('success', 'Career category updated successfully.');
    }

    public function destroy(CareerCategory $careerCategory)
    {
        if ($careerCategory->image_path) {
            Storage::disk('public')->delete($careerCategory->image_path);
        }

        $careerCategory->delete();

        return redirect()
            ->route('admin.career-categories.index')
            ->with('success', 'Career category deleted successfully.');
    }

    private function resolveSlug(?string $slugInput, string $name): string
    {
        $candidate = Str::slug(trim((string) ($slugInput ?: $name)));

        return $candidate !== '' ? $candidate : Str::slug($name . '-' . Str::random(4));
    }
}
