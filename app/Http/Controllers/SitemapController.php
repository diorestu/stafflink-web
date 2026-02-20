<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Career;
use App\Models\CareerCategory;
use App\Models\Page;
use App\Services\ServiceAreaService;
use DOMDocument;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function __invoke(ServiceAreaService $serviceAreaService): Response
    {
        $urls = collect();

        $staticRoutes = [
            '/',
            '/contact',
            '/who-we-are',
            '/what-we-offer',
            '/our-people-your-dream-team',
            '/our-purpose-business-principles',
            '/airport-services/nanny-concierge',
            '/blog',
            '/jobs',
            '/appointment',
            '/apply-now',
        ];

        foreach ($staticRoutes as $path) {
            $urls->push([
                'loc' => url($path),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => $path === '/' ? '1.0' : '0.8',
            ]);
        }

        Page::query()
            ->where('status', 'published')
            ->get(['slug', 'updated_at'])
            ->each(function (Page $page) use ($urls): void {
                $urls->push([
                    'loc' => route('pages.show', $page->slug),
                    'lastmod' => optional($page->updated_at)->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ]);
            });

        BlogPost::query()
            ->published()
            ->get(['slug', 'updated_at'])
            ->each(function (BlogPost $post) use ($urls): void {
                $urls->push([
                    'loc' => route('blog.show', $post->slug),
                    'lastmod' => optional($post->updated_at)->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ]);
            });

        $publishedCareers = Career::query()
            ->where('status', 'published')
            ->get(['title', 'career_category_id', 'state', 'country', 'updated_at']);

        $categoryById = CareerCategory::query()
            ->where('is_active', true)
            ->get(['id', 'slug', 'updated_at'])
            ->keyBy('id');

        $roleSlugs = $publishedCareers
            ->pluck('title')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->mapWithKeys(fn (string $title) => [$title => Str::slug($title)]);

        $publishedCategoryIds = $publishedCareers
            ->pluck('career_category_id')
            ->filter()
            ->unique()
            ->values();

        $publishedCategoryIds->each(function ($categoryId) use ($categoryById, $urls): void {
            $category = $categoryById->get($categoryId);
            if (!$category || trim((string) $category->slug) === '') {
                return;
            }

            $urls->push([
                'loc' => route('services.sectors.show', $category->slug),
                'lastmod' => optional($category->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]);
        });

        $roleSlugs->values()->each(function (string $roleSlug) use ($urls): void {
            $urls->push([
                'loc' => route('services.roles.show', $roleSlug),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]);
        });

        $areas = $serviceAreaService->allAreas();
        $areaSlugSet = $areas->pluck('slug')->filter()->unique()->values();

        $areaSlugSet->each(function (string $areaSlug) use ($urls): void {
            $urls->push([
                'loc' => route('services.areas.show', $areaSlug),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]);

            $urls->push([
                'loc' => route('airport-services.nanny-concierge.area', $areaSlug),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ]);
        });

        $sectorAreaCombos = collect();
        $roleAreaCombos = collect();

        $publishedCareers->each(function (Career $career) use ($areas, $categoryById, $roleSlugs, $sectorAreaCombos, $roleAreaCombos): void {
            $areaSlugs = $this->areaSlugsForCareer($career, $areas);

            if ($areaSlugs->isEmpty()) {
                return;
            }

            $category = $categoryById->get($career->career_category_id);
            $categorySlug = trim((string) ($category?->slug ?? ''));
            $roleSlug = $roleSlugs->get((string) $career->title);

            foreach ($areaSlugs as $areaSlug) {
                if ($categorySlug !== '') {
                    $sectorAreaCombos->push($categorySlug . '|' . $areaSlug);
                }

                if (is_string($roleSlug) && $roleSlug !== '') {
                    $roleAreaCombos->push($roleSlug . '|' . $areaSlug);
                }
            }
        });

        $sectorAreaCombos
            ->unique()
            ->values()
            ->each(function (string $combo) use ($urls): void {
                [$slug, $areaSlug] = explode('|', $combo);

                $urls->push([
                    'loc' => route('services.sectors.areas.show', ['slug' => $slug, 'areaSlug' => $areaSlug]),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ]);
            });

        $roleAreaCombos
            ->unique()
            ->values()
            ->each(function (string $combo) use ($urls): void {
                [$slug, $areaSlug] = explode('|', $combo);

                $urls->push([
                    'loc' => route('services.roles.areas.show', ['slug' => $slug, 'areaSlug' => $areaSlug]),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ]);
            });

        $xml = $this->toXml($urls->unique('loc')->values());

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    private function areaSlugsForCareer(Career $career, Collection $areas): Collection
    {
        $country = trim((string) $career->country);
        $state = trim((string) $career->state);

        $slugs = collect();

        if ($country !== '') {
            $slugs->push(Str::slug($country));
        }

        if ($state !== '') {
            $stateSlug = Str::slug($country !== '' ? "{$state} {$country}" : $state);
            $slugs->push($stateSlug);
        }

        $available = $areas->pluck('slug')->filter()->unique();

        return $slugs
            ->filter(fn ($slug) => $available->contains($slug))
            ->unique()
            ->values();
    }

    private function toXml(Collection $urls): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $dom->appendChild($urlset);

        $urls->each(function (array $item) use ($dom, $urlset): void {
            $url = $dom->createElement('url');

            $url->appendChild($dom->createElement('loc', (string) $item['loc']));
            $url->appendChild($dom->createElement('lastmod', (string) $item['lastmod']));
            $url->appendChild($dom->createElement('changefreq', (string) $item['changefreq']));
            $url->appendChild($dom->createElement('priority', (string) $item['priority']));

            $urlset->appendChild($url);
        });

        return $dom->saveXML() ?: '';
    }
}
