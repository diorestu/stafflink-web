<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerCategory;
use App\Services\ServiceAreaService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ServiceDetailController extends Controller
{
    public function __construct(private ServiceAreaService $serviceAreaService)
    {
    }

    public function airportServices()
    {
        return view('nanny-concierge', [
            'seoArea' => null,
            'serviceAreas' => $this->serviceAreaService->topAreas(18),
        ]);
    }

    public function airportServicesArea(string $areaSlug)
    {
        $area = $this->resolveArea($areaSlug);

        return view('nanny-concierge', [
            'seoArea' => $area,
            'serviceAreas' => $this->serviceAreaService->topAreas(18),
        ]);
    }

    public function sector(string $slug)
    {
        return $this->renderSector($slug);
    }

    public function sectorArea(string $slug, string $areaSlug)
    {
        return $this->renderSector($slug, $areaSlug);
    }

    public function role(string $slug)
    {
        return $this->renderRole($slug);
    }

    public function roleArea(string $slug, string $areaSlug)
    {
        return $this->renderRole($slug, $areaSlug);
    }

    public function area(string $areaSlug)
    {
        $area = $this->resolveArea($areaSlug);

        $query = Career::query()
            ->with('category')
            ->where('status', 'published');

        $this->serviceAreaService->applyFilter($query, $area);

        $areaCareers = $query
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->get();

        $categories = $areaCareers
            ->pluck('category')
            ->filter()
            ->unique('id')
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();

        $roles = $areaCareers
            ->pluck('title')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('service-area', [
            'area' => $area,
            'categories' => $categories,
            'roles' => $roles,
            'relatedCareers' => $areaCareers->take(9)->values(),
            'serviceAreas' => $this->serviceAreaService->topAreas(18),
            'metaDescription' => "Explore childcare and staffing services in {$area['seo_label']} across sectors and roles.",
        ]);
    }

    private function renderSector(string $slug, ?string $areaSlug = null)
    {
        $category = CareerCategory::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $area = $this->resolveArea($areaSlug);

        $relatedQuery = Career::query()
            ->where('career_category_id', $category->id)
            ->where('status', 'published');

        if ($area !== null) {
            $this->serviceAreaService->applyFilter($relatedQuery, $area);
        }

        $relatedCareers = $relatedQuery
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->get();

        $highlights = $relatedCareers
            ->pluck('title')
            ->filter()
            ->unique()
            ->take(6)
            ->values();

        if ($highlights->isEmpty()) {
            $highlights = collect([$category->name]);
        }

        $subtitle = trim((string) $category->description) !== ''
            ? $category->description
            : 'Staff Link helps families and employers find trusted childcare talent tailored to this sector.';

        if ($area !== null) {
            $subtitle = "Browse {$category->name} opportunities in {$area['seo_label']}. {$subtitle}";
        }

        $pageTitle = $area !== null
            ? "{$category->name} in {$area['seo_label']}"
            : $category->name;

        $metaDescription = Str::limit(
            "Explore {$category->name} staffing services in " . ($area['seo_label'] ?? 'Indonesia') . ". " . $subtitle,
            155
        );

        return view('service-detail', [
            'pageType' => 'Sector',
            'pageTitle' => $pageTitle,
            'subtitle' => $subtitle,
            'highlights' => $highlights,
            'highlightsLabel' => 'Popular roles in this sector',
            'relatedCareers' => $relatedCareers,
            'currentArea' => $area,
            'serviceAreas' => $this->serviceAreaService->topAreas(18),
            'baseSlug' => $category->slug,
            'baseRouteName' => 'services.sectors.show',
            'areaRouteName' => 'services.sectors.areas.show',
            'metaDescription' => $metaDescription,
        ]);
    }

    private function renderRole(string $slug, ?string $areaSlug = null)
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

        $area = $this->resolveArea($areaSlug);

        $relatedQuery = Career::query()
            ->with('category')
            ->where('status', 'published')
            ->where('title', $roleTitle);

        if ($area !== null) {
            $this->serviceAreaService->applyFilter($relatedQuery, $area);
        }

        $relatedCareers = $relatedQuery
            ->orderByDesc('published_at')
            ->get();

        $highlights = $this->roleSectors($relatedCareers);
        if ($highlights->isEmpty() && $relatedCareers->isNotEmpty()) {
            $highlights = collect(['General Staffing']);
        }
        $summary = $relatedCareers
            ->pluck('description')
            ->map(fn ($text) => trim(strip_tags((string) $text)))
            ->first(fn (string $text) => $text !== '');

        $subtitle = $summary !== null
            ? Str::limit($summary, 220)
            : 'Discover role-specific childcare opportunities and support services designed around this position.';

        if ($area !== null) {
            $subtitle = "Find {$roleTitle} opportunities in {$area['seo_label']}. " . $subtitle;
        }

        $pageTitle = $area !== null
            ? "{$roleTitle} in {$area['seo_label']}"
            : $roleTitle;

        $roleStats = [
            'Openings' => $relatedCareers->count(),
            'Sectors' => $highlights->count(),
            'Locations' => $relatedCareers->pluck('location_display')->filter()->unique()->count(),
        ];

        $metaDescription = Str::limit(
            "Explore {$roleTitle} roles in " . ($area['seo_label'] ?? 'Indonesia') . " with tailored staffing support.",
            155
        );

        return view('service-detail', [
            'pageType' => 'Role',
            'pageTitle' => $pageTitle,
            'subtitle' => $subtitle,
            'highlights' => $highlights,
            'highlightsLabel' => 'Sectors hiring this role',
            'relatedCareers' => $relatedCareers,
            'roleStats' => $roleStats,
            'currentArea' => $area,
            'serviceAreas' => $this->serviceAreaService->topAreas(18),
            'baseSlug' => Str::slug($roleTitle),
            'baseRouteName' => 'services.roles.show',
            'areaRouteName' => 'services.roles.areas.show',
            'metaDescription' => $metaDescription,
        ]);
    }

    private function resolveArea(?string $areaSlug): ?array
    {
        if ($areaSlug === null) {
            return null;
        }

        $area = $this->serviceAreaService->findBySlug($areaSlug);
        abort_if($area === null, 404);

        return $area;
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
