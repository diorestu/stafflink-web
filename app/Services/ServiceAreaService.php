<?php

namespace App\Services;

use App\Models\Career;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ServiceAreaService
{
    private const CACHE_KEY = 'service_areas:all';

    private const CACHE_MINUTES = 15;

    private const STATIC_AREAS = [
        'Canggu',
        'Seminyak',
        'Kuta',
        'Jimbaran',
        'Uluwatu',
        'Denpasar',
        'Tabanan',
        'Ubud',
        'Bedugul',
        'Ungasan',
    ];

    public function allAreas(): Collection
    {
        $cached = Cache::remember(
            self::CACHE_KEY,
            now()->addMinutes(self::CACHE_MINUTES),
            fn (): array => $this->buildAreas()->all()
        );

        return collect($cached)->values();
    }

    private function buildAreas(): Collection
    {
        $staticAreas = collect(self::STATIC_AREAS)
            ->map(function (string $area): array {
                return [
                    'slug' => Str::slug($area),
                    'label' => $area,
                    'type' => 'state',
                    'state' => $area,
                    'country' => null,
                    'seo_label' => $area,
                ];
            });

        $rows = Career::query()
            ->where('status', 'published')
            ->get(['state', 'country']);

        $countryAreas = $rows
            ->pluck('country')
            ->map(fn ($country) => trim((string) $country))
            ->filter()
            ->unique()
            ->values()
            ->map(function (string $country): array {
                return [
                    'slug' => Str::slug($country),
                    'label' => $country,
                    'type' => 'country',
                    'state' => null,
                    'country' => $country,
                    'seo_label' => $country,
                ];
            });

        $stateAreas = $rows
            ->filter(fn ($row) => trim((string) $row->state) !== '')
            ->map(function ($row): array {
                $state = trim((string) $row->state);
                $country = trim((string) $row->country);
                $hasCountry = $country !== '';
                $label = $hasCountry ? "{$state}, {$country}" : $state;
                $slugBase = $hasCountry ? "{$state} {$country}" : $state;

                return [
                    'slug' => Str::slug($slugBase),
                    'label' => $label,
                    'type' => 'state',
                    'state' => $state,
                    'country' => $hasCountry ? $country : null,
                    'seo_label' => $label,
                ];
            })
            ->unique('slug')
            ->values();

        return $staticAreas
            ->concat(
                $countryAreas
                    ->concat($stateAreas)
                    ->sortBy('label', SORT_NATURAL | SORT_FLAG_CASE)
                    ->values()
            )
            ->unique('slug')
            ->values();
    }

    public function topAreas(int $limit = 12): Collection
    {
        return $this->allAreas()->take($limit)->values();
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->allAreas()->first(fn (array $area) => $area['slug'] === $slug);
    }

    public function applyFilter(Builder $query, array $area): Builder
    {
        if (($area['type'] ?? '') === 'country' && !empty($area['country'])) {
            return $query->where('country', $area['country']);
        }

        if (($area['type'] ?? '') === 'state' && !empty($area['state'])) {
            $query->where('state', $area['state']);
            if (!empty($area['country'])) {
                $query->where('country', $area['country']);
            }
        }

        return $query;
    }
}
