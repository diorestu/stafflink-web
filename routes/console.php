<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Services\LocationSyncService;
use App\Services\MailTestService;

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

Artisan::command('mail:test {to? : Recipient email. Defaults to APPOINTMENT_NOTIFICATION_TO or MAIL_FROM_ADDRESS}', function (MailTestService $mailTestService) {
    $recipient = $this->argument('to');

    $this->info('Sending test email...');
    $result = $mailTestService->send(is_string($recipient) ? $recipient : null);

    if (!($result['ok'] ?? false)) {
        $this->error('Email test failed.');
        $this->line('Recipient: ' . (($result['recipient'] ?? '') !== '' ? $result['recipient'] : '-'));
        $this->line('Error: ' . (string) ($result['message'] ?? 'Unknown error.'));
        return 1;
    }

    $this->info((string) ($result['message'] ?? 'Email sent.'));
    $this->line('Mailer: ' . (string) config('mail.default'));
    $this->line('SMTP: ' . (string) config('mail.mailers.smtp.host') . ':' . (string) config('mail.mailers.smtp.port'));
    $this->line('Scheme: ' . (string) config('mail.mailers.smtp.scheme'));

    return 0;
})->purpose('Send a test email using current mail configuration.');

Artisan::command('seo:audit {--json= : Save report JSON to this path (default: storage/app/seo-audit-report.json)}', function () {
    $defaultJsonPath = storage_path('app/seo-audit-report.json');
    $jsonPath = (string) ($this->option('json') ?: $defaultJsonPath);

    $files = collect(File::allFiles(resource_path('views')))
        ->filter(function ($file) {
            $path = str_replace('\\', '/', $file->getPathname());
            if (!str_ends_with($path, '.blade.php')) {
                return false;
            }

            foreach (['/admin/', '/emails/', '/errors/', '/components/', '/partials/'] as $segment) {
                if (str_contains($path, $segment)) {
                    return false;
                }
            }

            return true;
        })
        ->values();

    $report = [];

    foreach ($files as $file) {
        $contents = File::get($file->getPathname());
        $relativePath = str_replace(resource_path('views').'/', '', str_replace('\\', '/', $file->getPathname()));
        $skipH1Check = $relativePath === 'pages/show.blade.php';

        preg_match_all('/<h1\\b/i', $contents, $h1Matches);
        $h1Count = count($h1Matches[0] ?? []);

        // Home page uses <x-hero />, and the component already contains the primary H1.
        if ($h1Count === 0 && str_contains($contents, '<x-hero')) {
            $h1Count = 1;
        }

        $hasSeoMeta = str_contains($contents, "partials.seo-meta");
        $issues = [];

        if (!$hasSeoMeta) {
            $issues[] = 'Missing seo-meta include';
        }
        if (!$skipH1Check) {
            if ($h1Count === 0) {
                $issues[] = 'No H1 found';
            }
            if ($h1Count > 1) {
                $issues[] = "Multiple H1 found ({$h1Count})";
            }
        }

        $report[] = [
            'file' => $relativePath,
            'has_seo_meta' => $hasSeoMeta,
            'h1_count' => $h1Count,
            'issues' => $issues,
        ];
    }

    $issuesCount = collect($report)->sum(fn ($row) => count($row['issues']));
    $this->info('SEO audit completed');
    $this->line('Files checked: '.count($report));
    $this->line('Total issues: '.$issuesCount);

    $problemRows = collect($report)->filter(fn ($row) => !empty($row['issues']))->values();

    if ($problemRows->isEmpty()) {
        $this->info('No issues found in scanned public views.');
    } else {
        $this->table(
            ['File', 'SEO Meta', 'H1 Count', 'Issues'],
            $problemRows->map(fn ($row) => [
                $row['file'],
                $row['has_seo_meta'] ? 'yes' : 'no',
                (string) $row['h1_count'],
                implode('; ', $row['issues']),
            ])->all()
        );
    }

    File::ensureDirectoryExists(dirname($jsonPath));
    File::put($jsonPath, json_encode([
        'generated_at' => now()->toAtomString(),
        'files_checked' => count($report),
        'issues_total' => $issuesCount,
        'results' => $report,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    $this->line('JSON report: '.$jsonPath);
    return 0;
})->purpose('Audit SEO essentials (seo-meta include and H1 count) for public blade views.');
