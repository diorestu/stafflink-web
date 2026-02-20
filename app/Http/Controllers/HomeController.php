<?php

namespace App\Http\Controllers;

use App\Models\CareerCategory;
use App\Models\Faq;
use App\Models\PageSection;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Cache::remember('home:sections:v1', now()->addMinutes(10), function () {
            return PageSection::all()->keyBy('section');
        });

        $careerCategories = Cache::remember('home:career_categories:v1', now()->addMinutes(10), function () {
            return CareerCategory::query()
                ->where('is_active', true)
                ->with([
                    'careers' => fn ($query) => $query
                        ->where('status', 'published')
                        ->orderByDesc('published_at')
                        ->orderByDesc('created_at'),
                ])
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();
        });

        $faqs = Cache::remember('home:faqs:v1', now()->addMinutes(10), function () {
            return Faq::query()
                ->active()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(['id', 'question', 'answer']);
        });

        return view('welcome', [
            'hero' => $sections->get('hero')?->content ?? [],
            'overview' => $sections->get('overview')?->content ?? [],
            'solutions' => $sections->get('solutions')?->content ?? [],
            'staffing' => $sections->get('staffing')?->content ?? [],
            'industries' => $sections->get('industries')?->content ?? [],
            'careerCategories' => $careerCategories,
            'faqs' => $faqs,
            'cta' => $sections->get('cta')?->content ?? [],
        ]);
    }
}
