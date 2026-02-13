<?php

namespace App\Http\Controllers;

use App\Models\Job;

class CareerController extends Controller
{
    public function index()
    {
        $query = Job::query()
            ->where('status', 'published');

        $search = trim((string) request('search', ''));
        $type = trim((string) request('type', ''));
        $country = trim((string) request('country', ''));
        $state = trim((string) request('state', ''));
        $salaryRange = trim((string) request('salary_range', ''));

        if ($search !== '') {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if (in_array($type, ['full-time', 'part-time', 'contract'], true)) {
            $query->where('type', $type);
        }

        if ($country !== '') {
            $query->where('country', $country);
        }

        if ($state !== '') {
            $query->where('state', $state);
        }

        if ($salaryRange !== '') {
            $query->where('salary_range', $salaryRange);
        }

        $countryOptions = Job::query()
            ->where('status', 'published')
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        $stateOptions = Job::query()
            ->where('status', 'published')
            ->whereNotNull('state')
            ->where('state', '!=', '')
            ->when($country !== '', fn ($q) => $q->where('country', $country))
            ->distinct()
            ->orderBy('state')
            ->pluck('state');

        $salaryRangeOptions = Job::query()
            ->where('status', 'published')
            ->whereNotNull('salary_range')
            ->where('salary_range', '!=', '')
            ->distinct()
            ->orderBy('salary_range')
            ->pluck('salary_range');

        $jobs = $query
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(8)
            ->withQueryString();

        if (request()->ajax()) {
            return response()->json([
                'html' => view('partials.job-cards', compact('jobs'))->render(),
                'next_page_url' => $jobs->nextPageUrl(),
                'has_more' => $jobs->hasMorePages(),
            ]);
        }

        return view('jobs', compact('jobs', 'countryOptions', 'stateOptions', 'salaryRangeOptions'));
    }
}
