<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class GlobalStaffingController extends Controller
{
    public function show(string $country)
    {
        $slug = Str::slug($country);

        $aliases = [
            'usa' => 'america',
            'us' => 'america',
            'united-states' => 'america',
            'united-states-of-america' => 'america',
        ];

        $key = $aliases[$slug] ?? $slug;

        $profiles = [
            'australia' => [
                'name' => 'Australia',
                'adjective' => 'Australian',
                'owner_label' => 'Aussie',
                'time_zones' => 'AEST and AWST',
            ],
            'america' => [
                'name' => 'America',
                'adjective' => 'American',
                'owner_label' => 'American',
                'time_zones' => 'EST, CST, MST, and PST',
            ],
            'indonesia' => [
                'name' => 'Indonesia',
                'adjective' => 'Indonesian',
                'owner_label' => 'Indonesian',
                'time_zones' => 'WIB, WITA, and WIT',
            ],
        ];

        $profile = $profiles[$key] ?? [
            'name' => Str::headline($slug),
            'adjective' => Str::headline($slug),
            'owner_label' => Str::headline($slug),
            'time_zones' => 'your local business time zones',
        ];

        return view('australia', [
            'countrySlug' => $key,
            'countryName' => $profile['name'],
            'countryAdjective' => $profile['adjective'],
            'countryOwnerLabel' => $profile['owner_label'],
            'primaryTimeZones' => $profile['time_zones'],
        ]);
    }
}

