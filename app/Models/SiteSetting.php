<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        if (!Schema::hasTable('site_settings')) {
            return $default;
        }

        $setting = static::query()->where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        if (!Schema::hasTable('site_settings')) {
            return;
        }

        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
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
        $defaults = static::headerFooterDefaults();
        $stored = static::getValue('header_footer', []);

        if (!is_array($stored)) {
            return $defaults;
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

        return $merged;
    }

    public static function siteName(): string
    {
        $stored = static::getValue('site_identity', []);

        if (is_array($stored) && !empty($stored['site_name'])) {
            return (string) $stored['site_name'];
        }

        return (string) config('app.name', 'StaffLink');
    }
}
