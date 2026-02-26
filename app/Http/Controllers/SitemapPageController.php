<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerCategory;
use App\Services\ServiceAreaService;
use App\Support\PageWording;
use Illuminate\Support\Str;

class SitemapPageController extends Controller
{
    public function __invoke(ServiceAreaService $serviceAreaService)
    {
        $categories = CareerCategory::query()
            ->where('is_active', true)
            ->whereHas('careers', fn ($query) => $query->where('status', 'published'))
            ->orderBy('name')
            ->get(['name', 'slug']);

        $roleSlugs = Career::query()
            ->where('status', 'published')
            ->whereNotNull('title')
            ->where('title', '!=', '')
            ->pluck('title')
            ->unique()
            ->sort()
            ->values()
            ->map(fn (string $title): array => [
                'title' => $title,
                'slug' => Str::slug($title),
            ]);

        $areas = $serviceAreaService->allAreas();
        $wording = PageWording::for('sitemap');

        return view('sitemap', [
            'categories' => $categories,
            'roles' => $roleSlugs,
            'areas' => $areas,
            'wording' => $wording,
        ]);
    }
}
