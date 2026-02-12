<?php

namespace App\Http\Controllers;

use App\Models\PageSection;

class HomeController extends Controller
{
    public function index()
    {
        $sections = PageSection::all()->keyBy('section');

        return view('welcome', [
            'hero' => $sections->get('hero')?->content ?? [],
            'overview' => $sections->get('overview')?->content ?? [],
            'solutions' => $sections->get('solutions')?->content ?? [],
            'staffing' => $sections->get('staffing')?->content ?? [],
            'industries' => $sections->get('industries')?->content ?? [],
            'cta' => $sections->get('cta')?->content ?? [],
        ]);
    }
}
