<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class LocationSyncService
{
    public function sync(bool $useCache = true): array
    {
        $countries = $this->fetchCountries($useCache);
        $syncedCountryIds = [];
        $countryCount = 0;
        $stateCount = 0;

        foreach ($countries as $countryData) {
            $name = trim((string) ($countryData['name'] ?? ''));
            $iso2 = strtoupper(trim((string) ($countryData['iso2'] ?? '')));

            if ($name === '' || $iso2 === '') {
                continue;
            }

            $country = Country::query()->updateOrCreate(
                ['name' => $name],
                [
                    'phonecode' => isset($countryData['phonecode']) ? (string) $countryData['phonecode'] : null,
                    'currency' => isset($countryData['currency']) ? (string) $countryData['currency'] : null,
                ]
            );

            $syncedCountryIds[] = $country->id;
            $countryCount++;

            $states = $this->fetchStates($iso2, $useCache);
            $stateNames = $states
                ->map(fn (array $state) => trim((string) ($state['name'] ?? '')))
                ->filter()
                ->unique()
                ->values();

            State::query()->where('country_id', $country->id)->delete();

            if ($stateNames->isNotEmpty()) {
                State::query()->insert(
                    $stateNames
                        ->map(fn (string $stateName) => [
                            'country_id' => $country->id,
                            'name' => $stateName,
                        ])
                        ->all()
                );
            }

            $stateCount += $stateNames->count();
        }

        if (count($syncedCountryIds) > 0) {
            Country::query()
                ->whereNotIn('id', $syncedCountryIds)
                ->delete();
        }

        return [
            'countries' => $countryCount,
            'states' => $stateCount,
        ];
    }

    private function fetchCountries(bool $useCache): Collection
    {
        $data = $this->fromApi('countries', 'csc:countries', 86400, $useCache);

        return collect($data)->filter(fn ($item) => is_array($item))->values();
    }

    private function fetchStates(string $countryIso2, bool $useCache): Collection
    {
        $countryIso2 = strtoupper(trim($countryIso2));
        $data = $this->fromApi("countries/{$countryIso2}/states", "csc:states:{$countryIso2}", 86400, $useCache);

        return collect($data)->filter(fn ($item) => is_array($item))->values();
    }

    private function fromApi(string $path, string $cacheKey, int $ttlSeconds, bool $useCache): array
    {
        if ($useCache) {
            return Cache::remember($cacheKey, $ttlSeconds, fn () => $this->requestApi($path));
        }

        return $this->requestApi($path);
    }

    private function requestApi(string $path): array
    {
        $apiKey = (string) config('services.country_state_city.api_key');
        $baseUrl = rtrim((string) config('services.country_state_city.base_url'), '/');

        if ($apiKey === '' || $baseUrl === '') {
            throw new RuntimeException('CountryStateCity API credentials are not configured.');
        }

        $response = Http::acceptJson()
            ->withHeaders(['X-CSCAPI-KEY' => $apiKey])
            ->timeout(30)
            ->get("{$baseUrl}/{$path}")
            ->throw();

        $json = $response->json();

        return is_array($json) ? $json : [];
    }
}

