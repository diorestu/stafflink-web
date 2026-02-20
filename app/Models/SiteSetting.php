<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Throwable;

class SiteSetting extends Model
{
    private const SETTINGS_CACHE_KEY = 'site_settings:all';

    private const SETTINGS_CACHE_MINUTES = 10;

    private static ?bool $hasSettingsTable = null;

    private static ?array $runtimeSettings = null;

    private static ?array $runtimeHeaderFooter = null;

    private static ?string $runtimeSiteName = null;

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $settings = static::allSettings();

        if (!array_key_exists($key, $settings)) {
            return $default;
        }

        return $settings[$key];
    }

    public static function setValue(string $key, mixed $value): void
    {
        if (!static::hasSettingsTable()) {
            return;
        }

        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        static::flushSettingsCache();
    }

    public static function headerFooterDefaults(): array
    {
        return [
            'about_links' => [
                ['label' => 'Who We Are', 'url' => route('who-we-are')],
                ['label' => 'What We Offer', 'url' => route('what-we-offer')],
                ['label' => 'Our People, Your Dream Team', 'url' => route('our-people-your-dream-team')],
                ['label' => 'Our Purpose & Business Principles', 'url' => route('our-purpose-business-principles')],
                ['label' => 'Blog', 'url' => route('blog')],
            ],
            'main_links' => [
                ['label' => 'Contact Us', 'url' => route('contact')],
                ['label' => 'Jobs', 'url' => route('jobs.index')],
            ],
            'user_links' => [
                ['label' => 'Admin Login', 'url' => route('admin.login')],
                ['label' => 'Apply Now', 'url' => route('applications.create')],
            ],
            'footer_links' => [
                ['label' => 'Terms & Condition', 'url' => '#'],
                ['label' => 'Privacy Policy', 'url' => '#'],
            ],
            'apply_now_label' => 'Apply now',
            'apply_now_url' => route('applications.create'),
            'consultation_label' => 'Free Consultation',
            'consultation_url' => route('appointments.create'),
            'copyright_text' => '© 2026 StaffLink. All rights reserved.',
        ];
    }

    public static function headerFooter(): array
    {
        if (static::$runtimeHeaderFooter !== null) {
            return static::$runtimeHeaderFooter;
        }

        $defaults = static::headerFooterDefaults();
        $stored = static::getValue('header_footer', []);

        if (!is_array($stored)) {
            static::$runtimeHeaderFooter = $defaults;

            return static::$runtimeHeaderFooter;
        }

        $merged = array_replace_recursive($defaults, $stored);

        // Backward compatibility: replace legacy placeholder user links with route-backed defaults.
        $userLinks = $merged['user_links'] ?? [];
        $hasOnlyPlaceholders = is_array($userLinks)
            && count($userLinks) > 0
            && collect($userLinks)->every(fn ($item) => ($item['url'] ?? '#') === '#');

        if ($hasOnlyPlaceholders) {
            $merged['user_links'] = $defaults['user_links'];
        }

        static::$runtimeHeaderFooter = $merged;

        return static::$runtimeHeaderFooter;
    }

    public static function siteName(): string
    {
        if (static::$runtimeSiteName !== null) {
            return static::$runtimeSiteName;
        }

        $stored = static::getValue('site_identity', []);

        if (is_array($stored) && !empty($stored['site_name'])) {
            static::$runtimeSiteName = (string) $stored['site_name'];

            return static::$runtimeSiteName;
        }

        static::$runtimeSiteName = (string) config('app.name', 'StaffLink');

        return static::$runtimeSiteName;
    }

    private static function hasSettingsTable(): bool
    {
        if (static::$hasSettingsTable !== null) {
            return static::$hasSettingsTable;
        }

        try {
            static::$hasSettingsTable = Schema::hasTable('site_settings');
        } catch (Throwable) {
            static::$hasSettingsTable = false;
        }

        return static::$hasSettingsTable;
    }

    private static function allSettings(): array
    {
        if (static::$runtimeSettings !== null) {
            return static::$runtimeSettings;
        }

        if (!static::hasSettingsTable()) {
            static::$runtimeSettings = [];

            return static::$runtimeSettings;
        }

        static::$runtimeSettings = Cache::remember(
            static::SETTINGS_CACHE_KEY,
            now()->addMinutes(static::SETTINGS_CACHE_MINUTES),
            function (): array {
                return static::query()
                    ->get(['key', 'value'])
                    ->mapWithKeys(fn (SiteSetting $setting) => [$setting->key => $setting->value])
                    ->all();
            }
        );

        return static::$runtimeSettings;
    }

    private static function flushSettingsCache(): void
    {
        Cache::forget(static::SETTINGS_CACHE_KEY);
        static::$runtimeSettings = null;
        static::$runtimeHeaderFooter = null;
        static::$runtimeSiteName = null;
    }
}
