<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PageSection;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected array $sectionLabels = [
        'hero' => 'Hero Banner',
        'overview' => 'Overview',
        'solutions' => 'Solutions',
        'staffing' => 'Careers to Services',
        'industries' => 'Industries',
        'cta' => 'Call to Action',
    ];

    public function dashboard()
    {
        $sections = PageSection::all();
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);
        $weeklyAppointments = Appointment::query()
            ->whereBetween('starts_at', [$startOfWeek, $endOfWeek])
            ->orderBy('starts_at')
            ->get();

        return view('admin.dashboard', [
            'sections' => $sections,
            'labels' => $this->sectionLabels,
            'weeklyAppointments' => $weeklyAppointments,
        ]);
    }

    public function index()
    {
        $sections = PageSection::query()->latest()->paginate(10);

        return view('admin.sections.index', compact('sections'));
    }

    public function edit(string $section)
    {
        $pageSection = PageSection::where('section', $section)->firstOrFail();

        return view('admin.edit', [
            'pageSection' => $pageSection,
            'label' => $this->sectionLabels[$section] ?? ucfirst($section),
        ]);
    }

    public function update(Request $request, string $section)
    {
        $pageSection = PageSection::where('section', $section)->firstOrFail();

        $content = $request->input('content', []);

        // Clean up empty values in nested arrays
        $content = $this->cleanContent($content);

        $pageSection->update(['content' => $content]);

        return redirect()
            ->route('admin.sections.edit', $section)
            ->with('success', 'Section updated successfully.');
    }

    private function cleanContent(array $data): array
    {
        $cleaned = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Re-index numeric arrays (in case items were removed)
                $inner = $this->cleanContent($value);
                if ($this->isNumericArray($value)) {
                    $inner = array_values($inner);
                }
                $cleaned[$key] = $inner;
            } else {
                $cleaned[$key] = $value;
            }
        }

        return $cleaned;
    }

    private function isNumericArray(array $arr): bool
    {
        return array_keys($arr) === range(0, count($arr) - 1)
            || array_keys($arr) === array_map('strval', range(0, count($arr) - 1));
    }
}
