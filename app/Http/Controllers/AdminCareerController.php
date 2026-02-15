<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCareerController extends Controller
{
    public function index()
    {
        $careers = Career::query()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        $categories = CareerCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.careers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'career_category_id' => 'required|exists:career_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:4096',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'minimum_salary' => 'nullable|integer|min:0|required_with:maximum_salary',
            'maximum_salary' => 'nullable|integer|min:0|gte:minimum_salary|required_with:minimum_salary',
            'status' => 'required|in:draft,published',
        ]);

        $minimumSalary = isset($validated['minimum_salary']) ? (int) $validated['minimum_salary'] : null;
        $maximumSalary = isset($validated['maximum_salary']) ? (int) $validated['maximum_salary'] : null;
        $validated['minimum_salary'] = $minimumSalary;
        $validated['maximum_salary'] = $maximumSalary;
        $validated['salary_range'] = $this->formatSalaryRange($minimumSalary, $maximumSalary);
        $validated['location'] = $this->composeLocation($validated['state'], $validated['country']);
        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('careers', 'public');
        }

        if ($request->status === 'published' && !$request->published_at) {
            $validated['published_at'] = now();
        }

        Career::create($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career created successfully.');
    }

    public function edit(Career $career)
    {
        $categories = CareerCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.careers.edit', compact('career', 'categories'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'career_category_id' => 'required|exists:career_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:4096',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract',
            'minimum_salary' => 'nullable|integer|min:0|required_with:maximum_salary',
            'maximum_salary' => 'nullable|integer|min:0|gte:minimum_salary|required_with:minimum_salary',
            'status' => 'required|in:draft,published',
        ]);

        $minimumSalary = isset($validated['minimum_salary']) ? (int) $validated['minimum_salary'] : null;
        $maximumSalary = isset($validated['maximum_salary']) ? (int) $validated['maximum_salary'] : null;
        $validated['minimum_salary'] = $minimumSalary;
        $validated['maximum_salary'] = $maximumSalary;
        $validated['salary_range'] = $this->formatSalaryRange($minimumSalary, $maximumSalary);
        $validated['location'] = $this->composeLocation($validated['state'], $validated['country']);
        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            if ($career->thumbnail_path) {
                Storage::disk('public')->delete($career->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('careers', 'public');
        }

        if ($request->status === 'published' && !$career->published_at) {
            $validated['published_at'] = now();
        }

        $career->update($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career updated successfully.');
    }

    public function destroy(Career $career)
    {
        if ($career->thumbnail_path) {
            Storage::disk('public')->delete($career->thumbnail_path);
        }

        $career->delete();

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career deleted successfully.');
    }

    private function composeLocation(?string $state, ?string $country): ?string
    {
        $parts = array_values(array_filter([
            trim((string) $state),
            trim((string) $country),
        ]));

        return count($parts) > 0 ? implode(', ', $parts) : null;
    }

    private function formatSalaryRange(?int $minimumSalary, ?int $maximumSalary): ?string
    {
        if ($minimumSalary === null && $maximumSalary === null) {
            return null;
        }

        if ($maximumSalary === null) {
            $maximumSalary = $minimumSalary;
        }

        if ($minimumSalary === null) {
            $minimumSalary = $maximumSalary;
        }

        return 'IDR ' . number_format($minimumSalary) . ' - ' . number_format($maximumSalary);
    }
}
