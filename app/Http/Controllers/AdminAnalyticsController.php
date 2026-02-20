<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Throwable;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        $propertyId = (string) config('analytics.property_id', '');
        $credentialsPath = (string) config('analytics.service_account_credentials_json', '');

        $setupReady = $propertyId !== '' && $credentialsPath !== '' && is_file($credentialsPath);
        if (!$setupReady) {
            return view('admin.analytics.index', [
                'setupReady' => false,
                'setupError' => null,
                'summary' => null,
                'daily' => collect(),
                'topPages' => collect(),
                'topCountries' => collect(),
                'topReferrers' => collect(),
            ]);
        }

        try {
            $payload = Cache::remember('admin:analytics:dashboard:v1', now()->addMinutes(10), function (): array {
                $period = Period::days(30);
                $daily = Analytics::fetchTotalVisitorsAndPageViews($period);
                $topPages = Analytics::fetchMostVisitedPages($period, 10);
                $topCountries = Analytics::fetchTopCountries($period, 10);
                $topReferrers = Analytics::fetchTopReferrers($period, 10);

                return [
                    'daily' => $daily,
                    'topPages' => $topPages,
                    'topCountries' => $topCountries,
                    'topReferrers' => $topReferrers,
                    'summary' => [
                        'active_users' => (int) $daily->sum('activeUsers'),
                        'page_views' => (int) $daily->sum('screenPageViews'),
                        'avg_daily_users' => $daily->count() > 0 ? (int) round($daily->avg('activeUsers')) : 0,
                        'avg_daily_page_views' => $daily->count() > 0 ? (int) round($daily->avg('screenPageViews')) : 0,
                    ],
                ];
            });

            return view('admin.analytics.index', [
                'setupReady' => true,
                'setupError' => null,
                'summary' => $payload['summary'],
                'daily' => $payload['daily'],
                'topPages' => $payload['topPages'],
                'topCountries' => $payload['topCountries'],
                'topReferrers' => $payload['topReferrers'],
            ]);
        } catch (Throwable $e) {
            report($e);

            return view('admin.analytics.index', [
                'setupReady' => true,
                'setupError' => $e->getMessage(),
                'summary' => null,
                'daily' => collect(),
                'topPages' => collect(),
                'topCountries' => collect(),
                'topReferrers' => collect(),
            ]);
        }
    }
}

