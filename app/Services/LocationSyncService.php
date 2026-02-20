<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class LocationSyncService
{
    public function sync(bool $useCache = true): array
    {
        $countries = $this->resolveCountryDataset($useCache);
        $countryMetadata = $this->loadCountryMetadataSnapshot();
        $syncedCountryIds = [];
        $countryCount = 0;
        $stateCount = 0;

        foreach ($countries as $countryData) {
            $name = trim((string) ($countryData['name'] ?? ''));
            $iso2 = strtoupper(trim((string) ($countryData['iso2'] ?? '')));

            $hasStatesInPayload = isset($countryData['states']) && is_array($countryData['states']);
            if ($name === '' || ($iso2 === '' && !$hasStatesInPayload)) {
                continue;
            }

            $countryPayload = $this->buildCountryPayload($countryData, $countryMetadata);

            $country = Country::query()->updateOrCreate(['name' => $name], $countryPayload);

            $syncedCountryIds[] = $country->id;
            $countryCount++;

            $stateNames = $this->resolveStateNames($countryData, $iso2, $useCache);

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

    private function resolveCountryDataset(bool $useCache): Collection
    {
        try {
            return $this->fetchCountriesFromLocalSnapshot();
        } catch (Throwable $e) {
            Log::warning('Failed to load local country/state snapshot. Falling back to API.', [
                'error' => $e->getMessage(),
            ]);
        }

        return $this->fetchCountries($useCache);
    }

    private function fetchCountries(bool $useCache): Collection
    {
        $data = $this->fromApi('countries', 'csc:countries', 86400, $useCache);

        return collect($data)->filter(fn ($item) => is_array($item))->values();
    }

    private function fetchCountriesFromLocalSnapshot(): Collection
    {
        $snapshotPath = (string) config('services.country_state_city.snapshot_path', '');
        if ($snapshotPath === '' || !is_file($snapshotPath)) {
            throw new RuntimeException('Country/state snapshot file is not available.');
        }

        $json = file_get_contents($snapshotPath);
        if ($json === false) {
            throw new RuntimeException('Unable to read country/state snapshot file.');
        }

        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            throw new RuntimeException('Country/state snapshot contains invalid JSON.');
        }

        return collect($decoded)
            ->filter(fn ($item) => is_array($item) && filled($item['name'] ?? null))
            ->values();
    }

    private function loadCountryMetadataSnapshot(): Collection
    {
        $metadataPath = (string) config('services.country_state_city.metadata_snapshot_path', '');
        if ($metadataPath === '' || !is_file($metadataPath)) {
            return collect();
        }

        $json = file_get_contents($metadataPath);
        if ($json === false) {
            return collect();
        }

        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            return collect();
        }

        return collect($decoded)
            ->filter(fn ($item) => is_array($item) && filled($item['name'] ?? null))
            ->keyBy(fn (array $item) => $this->normalizeCountryName((string) $item['name']));
    }

    private function fetchStates(string $countryIso2, bool $useCache): Collection
    {
        $countryIso2 = strtoupper(trim($countryIso2));
        $data = $this->fromApi("countries/{$countryIso2}/states", "csc:states:{$countryIso2}", 86400, $useCache);

        return collect($data)->filter(fn ($item) => is_array($item))->values();
    }

    private function resolveStateNames(array $countryData, string $countryIso2, bool $useCache): Collection
    {
        if (isset($countryData['states']) && is_array($countryData['states'])) {
            return collect($countryData['states'])
                ->map(function (mixed $state): string {
                    if (is_array($state)) {
                        return trim((string) ($state['name'] ?? ''));
                    }

                    return trim((string) $state);
                })
                ->filter()
                ->unique()
                ->values();
        }

        if ($countryIso2 === '') {
            return collect();
        }

        return $this->fetchStates($countryIso2, $useCache)
            ->map(fn (array $state) => trim((string) ($state['name'] ?? '')))
            ->filter()
            ->unique()
            ->values();
    }

    private function buildCountryPayload(array $countryData, Collection $countryMetadata): array
    {
        $payload = [];
        $nameKey = $this->normalizeCountryName((string) ($countryData['name'] ?? ''));
        $meta = $countryMetadata->get($nameKey, []);
        $phonecode = trim((string) ($countryData['phonecode'] ?? ($meta['phonecode'] ?? '')));
        $currency = trim((string) ($countryData['currency'] ?? ($meta['currency'] ?? '')));

        if ($phonecode !== '') {
            $payload['phonecode'] = $phonecode;
        }

        if ($currency !== '') {
            $payload['currency'] = $currency;
        }

        return $payload;
    }

    private function normalizeCountryName(string $name): string
    {
        return strtolower(trim(preg_replace('/\s+/', ' ', $name)));
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
