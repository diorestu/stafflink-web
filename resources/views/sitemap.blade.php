<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $wording = $wording ?? [];
        $servicesHeading = $wording['services_heading'] ?? 'Service Links';
        $areasHeading = $wording['areas_heading'] ?? 'Service per Area';
    @endphp
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Sitemap',
        'seoDescription' => 'Find all StaffLink service pages, categories, roles, and area-specific service links.',
        'seoKeywords' => 'sitemap, service links, service area pages',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
@include('partials.gtm-noscript')
<div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
    <x-site-header />

    <main class="px-6 pb-24 pt-12 lg:px-10">
        <section class="mx-auto max-w-7xl rounded-[30px] bg-[#1f5f46] p-10 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-aos="fade-up">
            <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">{{ $wording['badge'] ?? 'Sitemap' }}</p>
            <h1 class="mt-4 text-4xl font-semibold">{{ $wording['title'] ?? 'Explore All Service Links' }}</h1>
            <p class="mt-4 max-w-3xl text-sm text-white/90">{{ $wording['subtitle'] ?? 'Quick access to all services, categories, roles, and service pages by area.' }}</p>
        </section>

        <section class="mx-auto mt-8 grid max-w-7xl gap-6 lg:grid-cols-2">
            <article class="rounded-[24px] bg-white p-7 shadow-[0_16px_40px_rgba(31,95,70,0.1)]" data-aos="fade-up">
                <h2 class="text-2xl font-semibold text-[#1b1b18]">{{ $servicesHeading }}</h2>
                <ul class="mt-5 list-disc space-y-2 pl-5 text-sm text-[#2e2e2e]">
                    <li><a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('airport-services.nanny-concierge') }}">Airport Services - Nanny Concierge</a></li>
                    <li><a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('blog') }}">Blog</a></li>
                    <li><a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('jobs.index') }}">Jobs</a></li>
                </ul>

                @if ($categories->isNotEmpty())
                    <h3 class="mt-6 text-lg font-semibold text-[#1b1b18]">Sector Services</h3>
                    <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-[#2e2e2e]">
                        @foreach ($categories as $category)
                            <li>
                                <a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('services.sectors.show', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if ($roles->isNotEmpty())
                    <h3 class="mt-6 text-lg font-semibold text-[#1b1b18]">Role Services</h3>
                    <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-[#2e2e2e]">
                        @foreach ($roles as $role)
                            <li>
                                <a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('services.roles.show', $role['slug']) }}">
                                    {{ $role['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </article>

            <article class="rounded-[24px] bg-white p-7 shadow-[0_16px_40px_rgba(31,95,70,0.1)]" data-aos="fade-up" data-aos-delay="80">
                <h2 class="text-2xl font-semibold text-[#1b1b18]">{{ $areasHeading }}</h2>

                @if ($areas->isEmpty())
                    <p class="mt-4 text-sm text-[#6b6b66]">Belum ada area aktif. Silakan tambahkan dari admin Service Areas.</p>
                @else
                    <div class="mt-5 space-y-5">
                        @foreach ($areas as $area)
                            <div class="rounded-xl border border-[#dfe8e3] p-4">
                                <p class="text-sm font-semibold text-[#1b1b18]">{{ $area['label'] }}</p>
                                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-[#2e2e2e]">
                                    <li><a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('services.areas.show', $area['slug']) }}">General services in {{ $area['seo_label'] ?? $area['label'] }}</a></li>
                                    <li><a class="text-[#287854] hover:text-[#1f5f46]" href="{{ route('airport-services.nanny-concierge.area', $area['slug']) }}">Nanny concierge in {{ $area['seo_label'] ?? $area['label'] }}</a></li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endif
            </article>
        </section>
    </main>

    <x-site-footer />
</div>
</body>
</html>
