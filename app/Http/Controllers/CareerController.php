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
        $location = trim((string) request('location', ''));
        $salaryRange = trim((string) request('salary_range', ''));

        if ($search !== '') {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if (in_array($type, ['full-time', 'part-time', 'contract'], true)) {
            $query->where('type', $type);
        }

        if ($location !== '') {
            $query->where('location', $location);
        }

        if ($salaryRange !== '') {
            $query->where('salary_range', $salaryRange);
        }

        $locationOptions = Job::query()
            ->where('status', 'published')
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

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

        return view('jobs', compact('jobs', 'locationOptions', 'salaryRangeOptions'));
    }
}
