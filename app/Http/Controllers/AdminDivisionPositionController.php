<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Position;
use App\Models\Responsibility;
use App\Models\SubDivision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminDivisionPositionController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.roles-responsibilities.index');
    }

    public function divisionsIndex(Request $request)
    {
        $divisionsSearch = trim((string) $request->query('divisions_search', ''));
        $subDivisionsSearch = trim((string) $request->query('sub_divisions_search', ''));

        $divisionsQuery = Division::query()
            ->withCount(['positions', 'subDivisions']);

        if ($divisionsSearch !== '') {
            $divisionsQuery->where('name', 'like', "%{$divisionsSearch}%");
        }

        $divisions = $divisionsQuery
            ->orderBy('name')
            ->paginate(5, ['*'], 'divisions_page');

        $subDivisionsQuery = SubDivision::query()
            ->with('division');

        if ($subDivisionsSearch !== '') {
            $subDivisionsQuery->where(function ($query) use ($subDivisionsSearch) {
                $query->where('name', 'like', "%{$subDivisionsSearch}%")
                    ->orWhereHas('division', fn ($divisionQuery) => $divisionQuery->where('name', 'like', "%{$subDivisionsSearch}%"));
            });
        }

        $subDivisions = $subDivisionsQuery
            ->orderBy('division_id')
            ->orderBy('name')
            ->paginate(5, ['*'], 'sub_divisions_page');

        return view('admin.divisions.index', compact('divisions', 'subDivisions', 'divisionsSearch', 'subDivisionsSearch'));
    }

    public function rolesResponsibilitiesIndex()
    {
        $divisions = Division::query()
            ->withCount('positions')
            ->orderBy('name')
            ->get();

        $subDivisions = SubDivision::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $subDivisionsByDivision = $subDivisions
            ->groupBy('division_id')
            ->map(fn ($items) => $items->map(fn ($item) => [
                'id' => (int) $item->id,
                'name' => (string) $item->name,
            ])->values())
            ->toArray();

        $positions = Position::query()
            ->with(['division', 'subDivision'])
            ->orderBy('name')
            ->get();

        $responsibilities = Responsibility::query()
            ->with(['position.division'])
            ->orderBy('position_id')
            ->orderBy('title_id')
            ->get();

        return view('admin.roles-responsibilities.index', compact('divisions', 'positions', 'responsibilities', 'subDivisionsByDivision'));
    }

    public function storeDivision(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:divisions,name'],
            'is_active' => ['required', 'boolean'],
        ]);

        Division::create($validated);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Division created successfully.');
    }

    public function storePosition(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'division_id' => ['required', 'integer', 'exists:divisions,id'],
            'sub_division_id' => ['nullable', 'integer', 'exists:sub_divisions,id'],
            'name' => [
                'required',
                'string',
                'max:190',
                Rule::unique('positions', 'name')->where(
                    fn ($q) => $q->where('division_id', $request->integer('division_id'))
                ),
            ],
        ]);

        if (! empty($validated['sub_division_id'])) {
            $subDivision = SubDivision::query()->findOrFail((int) $validated['sub_division_id']);
            if ((int) $subDivision->division_id !== (int) $validated['division_id']) {
                return redirect()->route('admin.roles-responsibilities.index')
                    ->with('error', 'Selected sub-division does not belong to the selected division.')
                    ->withInput();
            }
        }

        Position::create([
            ...$validated,
            'is_active' => true,
        ]);

        return redirect()->route('admin.roles-responsibilities.index')
            ->with('success', 'Position created successfully.');
    }

    public function storeSubDivision(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'division_id' => ['required', 'integer', 'exists:divisions,id'],
            'name' => [
                'required',
                'string',
                'max:120',
                Rule::unique('sub_divisions', 'name')->where(
                    fn ($q) => $q->where('division_id', $request->integer('division_id'))
                ),
            ],
            'is_active' => ['required', 'boolean'],
        ]);

        SubDivision::create($validated);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Sub-division created successfully.');
    }

    public function storeResponsibility(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'title_id' => ['required', 'string', 'max:255'],
            'description_id' => ['nullable', 'string', 'max:2000'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string', 'max:2000'],
        ]);

        Responsibility::create([
            'position_id' => (int) $validated['position_id'],
            'title_id' => trim((string) $validated['title_id']),
            'description_id' => trim((string) ($validated['description_id'] ?? '')),
            'title_en' => trim((string) $validated['title_en']),
            'description_en' => trim((string) ($validated['description_en'] ?? '')),
            'is_active' => true,
        ]);

        return redirect()->route('admin.roles-responsibilities.index')
            ->with('success', 'Responsibility created successfully.');
    }

    public function destroyDivision(Division $division): RedirectResponse
    {
        if ($division->positions()->exists()) {
            return redirect()->route('admin.divisions.index')
                ->with('error', 'Division cannot be deleted because it still has positions.');
        }

        if ($division->subDivisions()->exists()) {
            return redirect()->route('admin.divisions.index')
                ->with('error', 'Division cannot be deleted because it still has sub-divisions.');
        }

        $division->delete();

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Division deleted successfully.');
    }

    public function destroyPosition(Position $position): RedirectResponse
    {
        $position->delete();

        return redirect()->route('admin.roles-responsibilities.index')
            ->with('success', 'Position deleted successfully.');
    }

    public function destroySubDivision(SubDivision $subDivision): RedirectResponse
    {
        $subDivision->delete();

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Sub-division deleted successfully.');
    }

    public function destroyResponsibility(Responsibility $responsibility): RedirectResponse
    {
        $responsibility->delete();

        return redirect()->route('admin.roles-responsibilities.index')
            ->with('success', 'Responsibility deleted successfully.');
    }
}
