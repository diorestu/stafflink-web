<?php

namespace App\Support;

use App\Models\SiteSetting;

class RolePageWording
{
    public static function defaults(): array
    {
        return [
            'real-estate-sales-support-assistants' => [
                'mode' => 'custom',
                'hero_badge' => 'Real Estate Sales Support Assistants in Bali',
                'hero_title' => 'Real Estate Sales Support Assistants in Bali',
                'hero_subtitle' => 'In property, sales performance determines revenue. Leads followed up. Viewings scheduled. Deals closed. At Staff Link, our Real Estate Sales Support Assistants in Bali strengthen your sales operations so your agents focus on negotiations while structured support protects and accelerates revenue.',
                'primary_cta_label' => 'Book a Consultation with Us',
                'primary_cta_url' => route('appointments.create'),
                'secondary_cta_label' => 'Contact Us',
                'secondary_cta_url' => route('contact'),
                'sections' => [
                    [
                        'layout' => 'cards',
                        'title' => 'Real Estate Sales Support Assistants - Operational Efficiency in Bali',
                        'items' => [
                            [
                                'title' => 'Real Estate Sales Support Assistants - Client Database Management in Bali',
                                'body' => 'Keep buyer and seller records organized, current, and actionable so your agency can respond faster and work every lead with consistency.',
                            ],
                            [
                                'title' => 'Real Estate Sales Support Assistants - Appointment and Viewing Coordination in Bali',
                                'body' => 'Support daily sales flow through structured scheduling, viewing coordination, and reliable follow-up that helps agents stay focused on closing.',
                            ],
                            [
                                'title' => 'Real Estate Sales Support Assistants - Sales Administration and Documentation in Bali',
                                'body' => 'Maintain disciplined sales admin, document handling, and process tracking so transactions remain controlled from inquiry to completion.',
                            ],
                        ],
                    ],
                    [
                        'layout' => 'text',
                        'title' => 'Real Estate Sales Support Assistants - Service Consultation in Bali',
                        'paragraphs' => [
                            'Contact Staff Link directly to discuss your sales targets, inquiry volume, and team structure.',
                            'At Staff Link, we evaluate your workflow before recommending the right Real Estate Sales Support Assistants in Bali to strengthen your pipeline and support consistent deal conversions.',
                        ],
                    ],
                    [
                        'layout' => 'text',
                        'title' => 'Real Estate Sales Support Assistants - Ongoing Sales Performance in Bali',
                        'paragraphs' => [
                            'As transaction volume increases, sales support must remain structured and reliable.',
                            'At Staff Link, our Real Estate Sales Support Assistants in Bali adapt to your reporting standards and internal processes to ensure operational discipline and sustained revenue growth.',
                        ],
                    ],
                    [
                        'layout' => 'text',
                        'title' => 'Real Estate Sales Support Assistants - Revenue Stability in Bali',
                        'paragraphs' => [
                            'With Staff Link overseeing placement and performance, your Real Estate Sales Support Assistants in Bali maintain organized pipelines, responsive communication, and controlled documentation so your business benefits from stronger closing ratios and measurable sales performance.',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function all(): array
    {
        $stored = SiteSetting::getValue('role_page_wordings', []);

        if (!is_array($stored)) {
            $stored = [];
        }

        return array_replace_recursive(static::defaults(), $stored);
    }

    public static function for(string $slug): array
    {
        $all = static::all();

        return is_array($all[$slug] ?? null) ? $all[$slug] : [];
    }

    public static function update(string $slug, array $data): void
    {
        $all = static::all();
        $all[$slug] = array_replace($all[$slug] ?? [], $data);

        SiteSetting::setValue('role_page_wordings', $all);
    }

    public static function mode(string $slug): string
    {
        $config = static::for($slug);
        $mode = (string) ($config['mode'] ?? 'template');

        return in_array($mode, ['template', 'custom'], true) ? $mode : 'template';
    }

    public static function setMode(string $slug, string $mode): void
    {
        $resolvedMode = in_array($mode, ['template', 'custom'], true) ? $mode : 'template';
        static::update($slug, ['mode' => $resolvedMode]);
    }

    public static function hasCustomContent(string $slug): bool
    {
        $config = static::for($slug);
        unset($config['mode']);

        return !empty($config);
    }

    public static function renameSlug(string $fromSlug, string $toSlug): void
    {
        if ($fromSlug === $toSlug || $fromSlug === '' || $toSlug === '') {
            return;
        }

        $all = static::all();
        if (!array_key_exists($fromSlug, $all) || array_key_exists($toSlug, $all)) {
            return;
        }

        $all[$toSlug] = $all[$fromSlug];
        unset($all[$fromSlug]);

        SiteSetting::setValue('role_page_wordings', $all);
    }
}
