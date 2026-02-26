<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $breadcrumbItems = [['name' => 'Home', 'url' => url('/')]];
        if (!empty($currentArea)) {
            $breadcrumbItems[] = ['name' => $pageType, 'url' => route($baseRouteName, $baseSlug)];
        }
        $breadcrumbItems[] = ['name' => $pageTitle, 'url' => request()->url()];

        $serviceSchema = [
            '@type' => 'Service',
            '@id' => request()->url().'#service',
            'name' => $pageTitle,
            'serviceType' => $pageType.' Staffing',
            'description' => $metaDescription ?? $subtitle,
            'provider' => ['@id' => url('/').'#organization'],
            'url' => request()->url(),
            'areaServed' => [
                '@type' => 'Place',
                'name' => $currentArea['seo_label'] ?? 'Bali',
            ],
        ];
    @endphp
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | '.$pageType.': '.$pageTitle,
        'seoDescription' => $metaDescription ?? 'Explore staffing services, sectors, and roles available through StaffLink Solutions.',
        'seoKeywords' => 'service sectors, service roles, staffing area pages, recruitment services',
        'seoBreadcrumbItems' => $breadcrumbItems,
        'seoStructuredDataNodes' => [$serviceSchema],
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-8 pb-28 pt-14 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-12">
                @include('partials.breadcrumbs', ['breadcrumbItems' => $breadcrumbItems])
                <div class="rounded-[30px] bg-[#1f5f46] p-10 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)] lg:p-12"
                    data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">{{ $pageType }}</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-tight md:text-5xl">{{ $pageTitle }}</h1>
                    <p class="mt-5 max-w-3xl text-sm leading-relaxed text-white/85">{{ $subtitle }}</p>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}"
                            class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#e7f2ec]">
                            Contact specialist
                        </a>
                        <a href="{{ route('appointments.create') }}"
                            class="inline-flex rounded-full border border-white px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#1f5f46]">
                            Book consultation
                        </a>
                    </div>
                </div>

                @if (($pageType ?? '') !== 'Role' && ($serviceAreas ?? collect())->isNotEmpty())
                    <section class="rounded-[28px] bg-white p-6 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Browse by area</p>
                            @if (!empty($currentArea))
                                <a href="{{ route($baseRouteName, $baseSlug) }}" class="inline-flex rounded-full border border-[#dfe8e3] bg-white px-4 py-2 text-xs font-semibold text-[#3f4b45] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7]">
                                    View all areas
                                </a>
                            @endif
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2.5">
                            @foreach ($serviceAreas as $areaItem)
                                <a href="{{ route($areaRouteName, ['slug' => $baseSlug, 'areaSlug' => $areaItem['slug']]) }}" class="inline-flex rounded-full border px-4 py-2 text-xs font-semibold transition {{ ($currentArea['slug'] ?? null) === $areaItem['slug'] ? 'border-[#287854] bg-[#ecf7f1] text-[#1f5f46]' : 'border-[#dfe8e3] bg-white text-[#3f4b45] hover:border-[#bcd7c8] hover:bg-[#f4faf7]' }}">
                                    {{ $areaItem['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                @if (($pageType ?? '') !== 'Role')
                    <section class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">{{ $highlightsLabel }}</p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            @forelse ($highlights as $item)
                                <span
                                    class="inline-flex rounded-full border border-[#dfe8e3] bg-[#f7faf8] px-4 py-2 text-sm font-semibold text-[#1f5f46]">
                                    {{ $item }}
                                </span>
                            @empty
                                <p class="text-sm text-[#6b6b66]">No highlights available yet.</p>
                            @endforelse
                        </div>
                    </section>
                @endif

                @if (($pageType ?? '') === 'Role')
                    @php
                        $featureImage = $relatedCareers
                            ->first(fn ($career) => !empty($career->thumbnail_path))
                            ?->thumbnail_path;
                    @endphp
                    @include('partials.role-services')

                    <section class="space-y-6 rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <div class="grid gap-8 lg:grid-cols-[1.25fr_1fr] lg:items-stretch">
                            <div class="overflow-hidden rounded-2xl border border-[#dfe8e3] bg-[#f7faf8]">
                                <img src="{{ $featureImage ? \Illuminate\Support\Facades\Storage::url($featureImage) : asset('images/img_hero.webp') }}" alt="Service support"
                                    class="h-full w-full object-cover" loading="lazy" draggable="false" />
                            </div>
                            <div class="space-y-8">
                                <article class="flex items-start gap-4">
                                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 border-[#b28b2e] text-[#b28b2e]">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path d="M4 19h16" />
                                            <path d="M7 16V5h10v11" />
                                            <path d="M9 8h6" />
                                            <path d="M9 11h6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-3xl font-semibold text-[#1b1b18]">Choose Your Service</h3>
                                        <p class="mt-3 text-lg leading-relaxed text-[#6b6b66]">
                                            Contact us directly to discuss your needs and schedule a service. We tailor every booking to ensure you receive the best experience, with a personalized touch. Simply call, WhatsApp, or message us to arrange a time that suits you.
                                        </p>
                                    </div>
                                </article>

                                <article class="flex items-start gap-4">
                                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 border-[#b28b2e] text-[#b28b2e]">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path d="M6 12a4 4 0 0 1 4-4h4a4 4 0 1 1 0 8H10a4 4 0 0 1-4-4z" />
                                            <path d="M9 12h6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-3xl font-semibold text-[#1b1b18]">Manage Everything With Ease</h3>
                                        <p class="mt-3 text-lg leading-relaxed text-[#6b6b66]">
                                            Need to reschedule or make a special request? Just reach out! We are here to personally assist you with any changes or additional services - no automated systems, just real support from our team.
                                        </p>
                                    </div>
                                </article>

                                <article class="flex items-start gap-4">
                                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 border-[#b28b2e] text-[#b28b2e]">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path d="M12 7v10" />
                                            <path d="M7 12h10" />
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-3xl font-semibold text-[#1b1b18]">Sit Back and Relax</h3>
                                        <p class="mt-3 text-lg leading-relaxed text-[#6b6b66]">
                                            Need to reschedule or make a special request? Just reach out! We are here to personally assist you with any changes or additional services - no automated systems, just real support from our team.
                                        </p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </section>
                @endif

                @if (($pageType ?? '') !== 'Role')
                    <section class="space-y-5" data-aos="fade-up">
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Open opportunities</p>
                                <h2 class="mt-2 text-3xl font-semibold text-[#1b1b18]">Explore matching opportunities</h2>
                            </div>
                            <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-[#287854] hover:text-[#1f5f46]">
                                View all jobs
                            </a>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @forelse ($relatedCareers as $career)
                                <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_36px_rgba(31,95,70,0.08)]">
                                    <div class="flex items-start justify-between gap-3">
                                        <h3 class="text-lg font-semibold text-[#1b1b18]">{{ $career->title }}</h3>
                                        <span
                                            class="shrink-0 rounded-full border border-[#b5d6c5] bg-[#ecf7f1] px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-[#1f5f46]">
                                            {{ ucwords(str_replace('-', ' ', $career->type)) }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">
                                        {{ $career->location_display ?: 'Location to be discussed' }}
                                    </p>
                                    @if (trim((string) $career->description) !== '')
                                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">
                                            {{ \Illuminate\Support\Str::limit(strip_tags((string) $career->description), 140) }}
                                        </p>
                                    @endif
                                    @if ($career->category)
                                        <p class="mt-2 text-xs uppercase tracking-[0.2em] text-[#287854]">
                                            {{ $career->category->name }}
                                        </p>
                                    @endif
                                    <a href="{{ route('appointments.create') }}"
                                        class="mt-5 inline-flex rounded-full border border-[#287854] px-4 py-2 text-xs font-semibold text-[#287854] transition hover:bg-[#287854] hover:text-white">
                                        Discuss this role
                                    </a>
                                </article>
                            @empty
                                <div class="col-span-full rounded-2xl bg-white p-10 text-center shadow-[0_20px_50px_rgba(31,95,70,0.12)]">
                                    <h3 class="text-2xl font-semibold text-[#1b1b18]">No opportunities available</h3>
                                    <p class="mt-3 text-sm text-[#6b6b66]">Our consultants can still help you with custom recruitment needs.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                @endif

                @if (($pageType ?? '') === 'Role' && ($serviceAreas ?? collect())->isNotEmpty())
                    <section class="rounded-[28px] bg-white p-6 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Browse by area</p>
                            @if (!empty($currentArea))
                                <a href="{{ route($baseRouteName, $baseSlug) }}" class="inline-flex rounded-full border border-[#dfe8e3] bg-white px-4 py-2 text-xs font-semibold text-[#3f4b45] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7]">
                                    View all areas
                                </a>
                            @endif
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2.5">
                            @foreach ($serviceAreas as $areaItem)
                                <a href="{{ route($areaRouteName, ['slug' => $baseSlug, 'areaSlug' => $areaItem['slug']]) }}" class="inline-flex rounded-full border px-4 py-2 text-xs font-semibold transition {{ ($currentArea['slug'] ?? null) === $areaItem['slug'] ? 'border-[#287854] bg-[#ecf7f1] text-[#1f5f46]' : 'border-[#dfe8e3] bg-white text-[#3f4b45] hover:border-[#bcd7c8] hover:bg-[#f4faf7]' }}">
                                    {{ $areaItem['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                @if (($pageType ?? '') === 'Role')
                    <section class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">{{ $highlightsLabel }}</p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            @forelse ($highlights as $item)
                                <span
                                    class="inline-flex rounded-full border border-[#dfe8e3] bg-[#f7faf8] px-4 py-2 text-sm font-semibold text-[#1f5f46]">
                                    {{ $item }}
                                </span>
                            @empty
                                <p class="text-sm text-[#6b6b66]">No highlights available yet.</p>
                            @endforelse
                        </div>
                    </section>
                @endif
            </section>
        </main>
        <x-site-footer />
    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3" data-aos="fade-up">
        <button type="button"
            class="flex h-12 w-12 items-center justify-center rounded-full border border-[#b28b2e] bg-white text-[#b28b2e] shadow-lg transition hover:bg-[#b28b2e] hover:text-white"
            data-scroll-top aria-label="Move to top">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path d="M12 19V5" />
                <path d="M6 11l6-6 6 6" />
            </svg>
        </button>
        <a href="https://wa.me/6285739660906"
            class="group relative flex h-16 w-16 items-center justify-center overflow-visible rounded-full bg-transparent transition"
            aria-label="WhatsApp Chat">
            <img src="{{ asset('images/64px-WhatsApp.svg.png') }}" alt="WhatsApp" class="h-full w-full object-contain"
                draggable="false" loading="lazy" />
            <span
                class="pointer-events-none absolute right-full mr-3 flex items-center gap-2 whitespace-nowrap rounded-full bg-[#287854] px-4 py-2 text-[11px] font-semibold tracking-tight text-white shadow-lg opacity-0 transition duration-300 ease-out translate-x-6 scale-x-105 origin-right group-hover:translate-x-0 group-hover:opacity-100">
                Click here to chat
            </span>
        </a>
    </div></body>

</html>
