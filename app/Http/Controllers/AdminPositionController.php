<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPositionController extends Controller
{
    public function index()
    {
        $positions = Position::query()
            ->with('division')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        $divisions = Division::query()->where('is_active', true)->orderBy('name')->get();

        return view('admin.positions.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => ['required', 'exists:divisions,id'],
            'name' => ['required', 'string', 'max:190'],
            'is_active' => ['required', 'boolean'],
        ]);

        $request->validate([
            'name' => [
                Rule::unique('positions', 'name')->where(fn ($q) => $q->where('division_id', $validated['division_id'])),
            ],
        ]);

        Position::create($validated);

        return redirect()->route('admin.positions.index')->with('success', 'Position created successfully.');
    }

    public function edit(Position $position)
    {
        $divisions = Division::query()->where('is_active', true)->orderBy('name')->get();

        return view('admin.positions.edit', compact('position', 'divisions'));
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'division_id' => ['required', 'exists:divisions,id'],
            'name' => ['required', 'string', 'max:190'],
            'is_active' => ['required', 'boolean'],
        ]);

        $request->validate([
            'name' => [
                Rule::unique('positions', 'name')
                    ->where(fn ($q) => $q->where('division_id', $validated['division_id']))
                    ->ignore($position->id),
            ],
        ]);

        $position->update($validated);

        return redirect()->route('admin.positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('admin.positions.index')->with('success', 'Position deleted successfully.');
    }
}
