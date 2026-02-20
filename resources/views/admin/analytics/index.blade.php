@extends('admin.layout')

@section('page-title', 'Analytics')

@section('content')
    @if (!$setupReady)
        <div class="rounded-lg border border-amber-200 bg-amber-50 p-5">
            <h3 class="text-base font-semibold text-amber-800">Google Analytics is not configured yet</h3>
            <p class="mt-2 text-sm text-amber-700">
                Set <code>ANALYTICS_PROPERTY_ID</code> and place your service account credentials JSON file at
                <code>storage/app/analytics/service-account-credentials.json</code>.
            </p>
        </div>
    @elseif($setupError)
        <div class="rounded-lg border border-red-200 bg-red-50 p-5">
            <h3 class="text-base font-semibold text-red-800">Unable to fetch analytics data</h3>
            <p class="mt-2 text-sm text-red-700">{{ $setupError }}</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
                <p class="text-xs uppercase text-gray-500">Active Users (30 days)</p>
                <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ number_format($summary['active_users']) }}</p>
            </div>
            <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
                <p class="text-xs uppercase text-gray-500">Page Views (30 days)</p>
                <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ number_format($summary['page_views']) }}</p>
            </div>
            <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
                <p class="text-xs uppercase text-gray-500">Avg Daily Users</p>
                <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ number_format($summary['avg_daily_users']) }}</p>
            </div>
            <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
                <p class="text-xs uppercase text-gray-500">Avg Daily Page Views</p>
                <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ number_format($summary['avg_daily_page_views']) }}</p>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="rounded-lg bg-white shadow">
                <div class="border-b px-5 py-4">
                    <h3 class="text-base font-semibold text-gray-800">Daily Traffic (Last 30 Days)</h3>
                </div>
                <div class="max-h-[420px] overflow-auto p-5">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-500">Date</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-500">Users</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-500">Page Views</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($daily as $row)
                                <tr>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ $row['date']->format('d M Y') }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ number_format($row['activeUsers']) }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ number_format($row['screenPageViews']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-lg bg-white shadow">
                    <div class="border-b px-5 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Top Pages</h3>
                    </div>
                    <div class="max-h-[200px] overflow-auto p-5">
                        <ul class="space-y-2">
                            @foreach ($topPages as $row)
                                <li class="flex items-start justify-between gap-3 text-sm">
                                    <div class="min-w-0">
                                        <p class="truncate font-medium text-gray-800">{{ $row['pageTitle'] ?: '(Untitled)' }}</p>
                                        <p class="truncate text-xs text-gray-500">{{ $row['fullPageUrl'] }}</p>
                                    </div>
                                    <span class="shrink-0 rounded-full bg-[#ecf6f1] px-2.5 py-1 text-xs font-semibold text-[#1f5f46]">
                                        {{ number_format($row['screenPageViews']) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="rounded-lg bg-white shadow">
                    <div class="border-b px-5 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Top Countries</h3>
                    </div>
                    <div class="max-h-[200px] overflow-auto p-5">
                        <ul class="space-y-2">
                            @foreach ($topCountries as $row)
                                <li class="flex items-center justify-between text-sm">
                                    <span class="text-gray-700">{{ $row['country'] ?: 'Unknown' }}</span>
                                    <span class="rounded-full bg-[#ecf6f1] px-2.5 py-1 text-xs font-semibold text-[#1f5f46]">
                                        {{ number_format($row['screenPageViews']) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="rounded-lg bg-white shadow">
                    <div class="border-b px-5 py-4">
                        <h3 class="text-base font-semibold text-gray-800">Top Referrers</h3>
                    </div>
                    <div class="max-h-[200px] overflow-auto p-5">
                        <ul class="space-y-2">
                            @foreach ($topReferrers as $row)
                                <li class="flex items-center justify-between gap-3 text-sm">
                                    <span class="truncate text-gray-700">{{ $row['pageReferrer'] ?: '(Direct)' }}</span>
                                    <span class="shrink-0 rounded-full bg-[#ecf6f1] px-2.5 py-1 text-xs font-semibold text-[#1f5f46]">
                                        {{ number_format($row['screenPageViews']) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

