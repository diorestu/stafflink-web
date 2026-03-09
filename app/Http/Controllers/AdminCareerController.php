<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerCategory;
use App\Support\RolePageWording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCareerController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $sortBy = (string) $request->query('sort_by', 'sort_order');
        $sortDir = strtolower((string) $request->query('sort_dir', 'asc')) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['title', 'sort_order', 'created_at'];
        if (!in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'sort_order';
        }

        $careers = Career::query()
            ->with('category')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($sub) use ($search): void {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search): void {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy($sortBy, $sortDir)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.careers.index', [
            'careers' => $careers,
            'search' => $search,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir,
        ]);
    }

    public function create()
    {
        $categories = CareerCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.careers.create', [
            'categories' => $categories,
            'rolePageMode' => old('role_page_mode', 'template'),
            'rolePageCopyUrl' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'career_category_id' => 'required|exists:career_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|max:4096',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'type' => 'nullable|in:full-time,part-time,contract',
            'minimum_salary' => 'nullable|integer|min:0|required_with:maximum_salary',
            'maximum_salary' => 'nullable|integer|min:0|gte:minimum_salary|required_with:minimum_salary',
            'status' => 'nullable|in:draft,published',
            'role_page_mode' => 'nullable|in:template,custom',
        ]);

        $validated['country'] = $validated['country'] ?? null;
        $validated['state'] = $validated['state'] ?? null;
        $validated['type'] = $validated['type'] ?? 'full-time';
        $validated['status'] = $validated['status'] ?? 'published';
        $validated['sort_order'] = array_key_exists('sort_order', $validated)
            ? (int) $validated['sort_order']
            : ((int) Career::query()->max('sort_order') + 1);

        $minimumSalary = isset($validated['minimum_salary']) ? (int) $validated['minimum_salary'] : null;
        $maximumSalary = isset($validated['maximum_salary']) ? (int) $validated['maximum_salary'] : null;
        $validated['minimum_salary'] = $minimumSalary;
        $validated['maximum_salary'] = $maximumSalary;
        $validated['salary_range'] = $this->formatSalaryRange($minimumSalary, $maximumSalary);
        $validated['location'] = $this->composeLocation($validated['state'] ?? null, $validated['country'] ?? null);
        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('careers', 'public');
        }

        if (($validated['status'] ?? 'published') === 'published' && !$request->published_at) {
            $validated['published_at'] = now();
        }

        $rolePageMode = (string) ($validated['role_page_mode'] ?? 'template');
        $roleSlug = Str::slug((string) $validated['title']);
        unset($validated['role_page_mode']);

        Career::create($validated);
        RolePageWording::setMode($roleSlug, $rolePageMode);

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

        $roleSlug = Str::slug((string) $career->title);

        return view('admin.careers.edit', [
            'career' => $career,
            'categories' => $categories,
            'rolePageMode' => old('role_page_mode', RolePageWording::mode($roleSlug)),
            'rolePageCopyUrl' => route('admin.role-page-wording.edit', $roleSlug),
        ]);
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'career_category_id' => 'required|exists:career_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|max:4096',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'type' => 'nullable|in:full-time,part-time,contract',
            'minimum_salary' => 'nullable|integer|min:0|required_with:maximum_salary',
            'maximum_salary' => 'nullable|integer|min:0|gte:minimum_salary|required_with:minimum_salary',
            'status' => 'nullable|in:draft,published',
            'role_page_mode' => 'nullable|in:template,custom',
        ]);

        $validated['country'] = array_key_exists('country', $validated) ? ($validated['country'] ?: null) : $career->country;
        $validated['state'] = array_key_exists('state', $validated) ? ($validated['state'] ?: null) : $career->state;
        $validated['type'] = $validated['type'] ?? $career->type ?? 'full-time';
        $validated['status'] = $validated['status'] ?? $career->status ?? 'published';
        $validated['sort_order'] = array_key_exists('sort_order', $validated)
            ? (int) $validated['sort_order']
            : (int) ($career->sort_order ?? 0);

        $minimumSalary = array_key_exists('minimum_salary', $validated)
            ? (isset($validated['minimum_salary']) ? (int) $validated['minimum_salary'] : null)
            : $career->minimum_salary;
        $maximumSalary = array_key_exists('maximum_salary', $validated)
            ? (isset($validated['maximum_salary']) ? (int) $validated['maximum_salary'] : null)
            : $career->maximum_salary;
        $validated['minimum_salary'] = $minimumSalary;
        $validated['maximum_salary'] = $maximumSalary;
        $validated['salary_range'] = $this->formatSalaryRange($minimumSalary, $maximumSalary);
        $validated['location'] = $this->composeLocation($validated['state'] ?? null, $validated['country'] ?? null);
        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            if ($career->thumbnail_path) {
                Storage::disk('public')->delete($career->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('careers', 'public');
        }

        if (($validated['status'] ?? 'published') === 'published' && !$career->published_at) {
            $validated['published_at'] = now();
        }

        $oldRoleSlug = Str::slug((string) $career->title);
        $newRoleSlug = Str::slug((string) $validated['title']);
        $rolePageMode = (string) ($validated['role_page_mode'] ?? RolePageWording::mode($oldRoleSlug));
        unset($validated['role_page_mode']);

        $career->update($validated);
        RolePageWording::renameSlug($oldRoleSlug, $newRoleSlug);
        RolePageWording::setMode($newRoleSlug, $rolePageMode);

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
