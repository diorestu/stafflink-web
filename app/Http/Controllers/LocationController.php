<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Services\LocationSyncService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function countriesFromDatabase(): JsonResponse
    {
        $countries = Country::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get()
            ->map(fn (Country $country) => [
                'id' => $country->id,
                'name' => $country->name,
            ])
            ->values();

        return response()->json($countries);
    }

    public function statesFromDatabase(Request $request): JsonResponse
    {
        $countryName = trim((string) $request->query('country'));
        if ($countryName === '') {
            return response()->json(['message' => 'Country is required.'], 422);
        }

        $country = Country::query()
            ->where('name', $countryName)
            ->first();

        if (!$country) {
            return response()->json([]);
        }

        $states = State::query()
            ->where('country_id', $country->id)
            ->orderBy('name')
            ->get(['name'])
            ->map(fn (State $state) => ['name' => $state->name])
            ->values();

        return response()->json($states);
    }

    public function sync(LocationSyncService $locationSyncService): JsonResponse
    {
        try {
            $result = $locationSyncService->sync();

            return response()->json([
                'message' => 'Locations synced successfully.',
                'countries_synced' => $result['countries'],
                'states_synced' => $result['states'],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage() ?: 'Failed to sync locations.',
            ], 502);
        }
    }

    public function countries(): JsonResponse
    {
        $response = $this->fromApi('countries', 'csc:countries', 86400);
        if ($response instanceof JsonResponse) {
            return $response;
        }

        $countries = collect($response)
            ->map(fn (array $country) => [
                'name' => $country['name'] ?? null,
                'iso2' => $country['iso2'] ?? null,
            ])
            ->filter(fn (array $country) => filled($country['name']) && filled($country['iso2']))
            ->sortBy('name')
            ->values();

        return response()->json($countries);
    }

    public function states(string $countryIso2): JsonResponse
    {
        $countryIso2 = strtoupper(trim($countryIso2));

        if ($countryIso2 === '') {
            return response()->json(['message' => 'Country code is required.'], 422);
        }

        $response = $this->fromApi("countries/{$countryIso2}/states", "csc:states:{$countryIso2}", 86400);
        if ($response instanceof JsonResponse) {
            return $response;
        }

        $states = collect($response)
            ->map(fn (array $state) => ['name' => $state['name'] ?? null])
            ->filter(fn (array $state) => filled($state['name']))
            ->sortBy('name')
            ->values();

        return response()->json($states);
    }

    private function fromApi(string $path, string $cacheKey, int $ttlSeconds): array|JsonResponse
    {
        $apiKey = (string) config('services.country_state_city.api_key');
        $baseUrl = rtrim((string) config('services.country_state_city.base_url'), '/');

        if ($apiKey === '' || $baseUrl === '') {
            return response()->json(['message' => 'CountryStateCity API credentials are not configured.'], 500);
        }

        try {
            return Cache::remember($cacheKey, $ttlSeconds, function () use ($apiKey, $baseUrl, $path) {
                $response = Http::acceptJson()
                    ->withHeaders(['X-CSCAPI-KEY' => $apiKey])
                    ->timeout(20)
                    ->get("{$baseUrl}/{$path}")
                    ->throw();

                return $response->json();
            });
        } catch (\Throwable) {
            return response()->json(['message' => 'Unable to fetch location data.'], 502);
        }
    }
}
