<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ServiceDetailController extends Controller
{
    public function sector(string $slug)
    {
        $category = CareerCategory::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedCareers = Career::query()
            ->where('career_category_id', $category->id)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->get();

        $highlights = $relatedCareers
            ->pluck('title')
            ->filter()
            ->unique()
            ->take(6)
            ->values();

        $subtitle = trim((string) $category->description) !== ''
            ? $category->description
            : 'Staff Link helps families and employers find trusted childcare talent tailored to this sector.';

        return view('service-detail', [
            'pageType' => 'Sector',
            'pageTitle' => $category->name,
            'subtitle' => $subtitle,
            'highlights' => $highlights,
            'highlightsLabel' => 'Popular roles in this sector',
            'relatedCareers' => $relatedCareers,
        ]);
    }

    public function role(string $slug)
    {
        $roles = Career::query()
            ->whereNotNull('title')
            ->where('title', '!=', '')
            ->orderBy('title')
            ->pluck('title')
            ->unique()
            ->values();

        $roleTitle = $roles->first(fn (string $title) => Str::slug($title) === $slug);

        abort_if($roleTitle === null, 404);

        $relatedCareers = Career::query()
            ->with('category')
            ->where('status', 'published')
            ->where('title', $roleTitle)
            ->orderByDesc('published_at')
            ->get();

        $highlights = $this->roleSectors($relatedCareers);
        $summary = $relatedCareers
            ->pluck('description')
            ->map(fn ($text) => trim(strip_tags((string) $text)))
            ->first(fn (string $text) => $text !== '');

        $subtitle = $summary !== null
            ? Str::limit($summary, 220)
            : 'Discover role-specific childcare opportunities and support services designed around this position.';

        $roleStats = [
            'Openings' => $relatedCareers->count(),
            'Sectors' => $highlights->count(),
            'Locations' => $relatedCareers->pluck('location_display')->filter()->unique()->count(),
        ];

        return view('service-detail', [
            'pageType' => 'Role',
            'pageTitle' => $roleTitle,
            'subtitle' => $subtitle,
            'highlights' => $highlights,
            'highlightsLabel' => 'Sectors hiring this role',
            'relatedCareers' => $relatedCareers,
            'roleStats' => $roleStats,
        ]);
    }

    private function roleSectors(Collection $relatedCareers): Collection
    {
        return $relatedCareers
            ->pluck('category.name')
            ->filter()
            ->unique()
            ->take(6)
            ->values();
    }
}
