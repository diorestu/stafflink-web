<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminDivisionPositionController extends Controller
{
    public function index()
    {
        $divisions = Division::query()
            ->withCount('positions')
            ->orderBy('name')
            ->get();

        $positions = Position::query()
            ->with('division')
            ->orderBy('name')
            ->get();

        return view('admin.division-position.index', compact('divisions', 'positions'));
    }

    public function storeDivision(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:divisions,name'],
            'is_active' => ['required', 'boolean'],
        ]);

        Division::create($validated);

        return redirect()->route('admin.division-position.index')
            ->with('success', 'Division created successfully.');
    }

    public function storePosition(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'division_id' => ['required', 'integer', 'exists:divisions,id'],
            'name' => [
                'required',
                'string',
                'max:190',
                Rule::unique('positions', 'name')->where(
                    fn ($q) => $q->where('division_id', $request->integer('division_id'))
                ),
            ],
            'is_active' => ['required', 'boolean'],
        ]);

        Position::create($validated);

        return redirect()->route('admin.division-position.index')
            ->with('success', 'Position created successfully.');
    }

    public function destroyDivision(Division $division): RedirectResponse
    {
        if ($division->positions()->exists()) {
            return redirect()->route('admin.division-position.index')
                ->with('error', 'Division cannot be deleted because it still has positions.');
        }

        $division->delete();

        return redirect()->route('admin.division-position.index')
            ->with('success', 'Division deleted successfully.');
    }

    public function destroyPosition(Position $position): RedirectResponse
    {
        $position->delete();

        return redirect()->route('admin.division-position.index')
            ->with('success', 'Position deleted successfully.');
    }
}
