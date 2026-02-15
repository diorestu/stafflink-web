<?php

namespace App\Http\Controllers;

use App\Models\CareerCategory;
use App\Models\PageSection;

class HomeController extends Controller
{
    public function index()
    {
        $sections = PageSection::all()->keyBy('section');
        $careerCategories = CareerCategory::query()
            ->where('is_active', true)
            ->with([
                'careers' => fn ($query) => $query
                    ->orderByDesc('published_at')
                    ->orderByDesc('created_at'),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('welcome', [
            'hero' => $sections->get('hero')?->content ?? [],
            'overview' => $sections->get('overview')?->content ?? [],
            'solutions' => $sections->get('solutions')?->content ?? [],
            'staffing' => $sections->get('staffing')?->content ?? [],
            'industries' => $sections->get('industries')?->content ?? [],
            'careerCategories' => $careerCategories,
            'cta' => $sections->get('cta')?->content ?? [],
        ]);
    }
}
