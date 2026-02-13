<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminHeaderFooterController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::headerFooter();
        $siteIdentity = SiteSetting::getValue('site_identity', [
            'site_name' => SiteSetting::siteName(),
        ]);

        return view('admin.header-footer.edit', compact('settings', 'siteIdentity'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:100'],
            'apply_now_label' => ['nullable', 'string', 'max:100'],
            'apply_now_url' => ['nullable', 'string', 'max:255'],
            'consultation_label' => ['nullable', 'string', 'max:100'],
            'consultation_url' => ['nullable', 'string', 'max:255'],
            'copyright_text' => ['nullable', 'string', 'max:255'],
            'about_links' => ['nullable', 'string'],
            'main_links' => ['nullable', 'string'],
            'user_links' => ['nullable', 'string'],
            'footer_links' => ['nullable', 'string'],
        ]);

        $payload = [
            'apply_now_label' => $validated['apply_now_label'] ?? 'Apply now',
            'apply_now_url' => $validated['apply_now_url'] ?? '#',
            'consultation_label' => $validated['consultation_label'] ?? 'Free Consultation',
            'consultation_url' => $validated['consultation_url'] ?? '#',
            'copyright_text' => $validated['copyright_text'] ?? '',
            'about_links' => $this->parseJsonLinks($validated['about_links'] ?? '[]'),
            'main_links' => $this->parseJsonLinks($validated['main_links'] ?? '[]'),
            'user_links' => $this->parseJsonLinks($validated['user_links'] ?? '[]'),
            'footer_links' => $this->parseJsonLinks($validated['footer_links'] ?? '[]'),
        ];

        SiteSetting::setValue('header_footer', $payload);
        SiteSetting::setValue('site_identity', [
            'site_name' => $validated['site_name'] ?? SiteSetting::siteName(),
        ]);

        return redirect()->route('admin.header-footer.edit')->with('success', 'Header and footer updated successfully.');
    }

    private function parseJsonLinks(string $json): array
    {
        $decoded = json_decode($json, true);

        if (!is_array($decoded)) {
            return [];
        }

        return collect($decoded)
            ->filter(fn ($item) => is_array($item))
            ->map(function ($item) {
                return [
                    'label' => trim((string) ($item['label'] ?? '')),
                    'url' => trim((string) ($item['url'] ?? '#')),
                ];
            })
            ->filter(fn ($item) => $item['label'] !== '')
            ->values()
            ->all();
    }
}
