<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Services\LocationSyncService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('pages:sync-routes', function () {
    $routes = collect(Route::getRoutes())
        ->filter(function ($route) {
            $methods = $route->methods();
            $uri = trim($route->uri(), '/');

            if (!in_array('GET', $methods, true)) {
                return false;
            }

            if (Str::startsWith($uri, 'admin')) {
                return false;
            }

            if (Str::contains($uri, ['{', '}'])) {
                return false;
            }

            if (in_array($uri, ['up', 'storage', 'storage/{path}', 'p/{slug}'], true)) {
                return false;
            }

            return true;
        })
        ->values();

    $created = 0;
    $updated = 0;

    foreach ($routes as $route) {
        $rawUri = trim($route->uri(), '/');
        $uri = $rawUri === '' ? '/' : '/' . $rawUri;
        $slug = $rawUri === '' ? 'home' : Str::slug($rawUri);
        $title = $rawUri === '' ? 'Home' : Str::of($rawUri)->replace('-', ' ')->headline()->toString();

        $page = Page::where('slug', $slug)->first();

        if ($page) {
            $page->update([
                'title' => $page->title ?: $title,
                'excerpt' => $page->excerpt ?: "Auto-generated from route {$uri}",
                'meta_description' => $page->meta_description ?: "Page for route {$uri}",
            ]);
            $updated++;
            continue;
        }

        Page::create([
            'title' => $title,
            'slug' => $slug,
            'status' => 'draft',
            'excerpt' => "Auto-generated from route {$uri}",
            'meta_description' => "Page for route {$uri}",
            'content_html' => "<section style=\"padding:40px\"><h1>{$title}</h1><p>Start editing this page in the builder.</p></section>",
            'content_css' => '',
            'builder_data' => null,
        ]);
        $created++;
    }

    $this->info("Route sync completed. Created: {$created}, Updated: {$updated}");
})->purpose('Generate pages from public route list (excluding admin and dynamic routes).');

Artisan::command('locations:sync {--no-cache : Fetch latest data from API without cached responses}', function (LocationSyncService $locationSyncService) {
    $this->info('Syncing countries and states from CountryStateCity API...');

    try {
        $result = $locationSyncService->sync(!((bool) $this->option('no-cache')));

        $this->info("Done. Countries: {$result['countries']}, States: {$result['states']}");
    } catch (\Throwable $e) {
        $this->error('Sync failed: ' . $e->getMessage());
        return 1;
    }

    return 0;
})->purpose('Sync countries and states from CountryStateCity API into local database.');
