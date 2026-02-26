<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $breadcrumbItems = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Services in '.$area['seo_label'], 'url' => request()->url()],
        ];

        $serviceSchema = [
            '@type' => 'Service',
            '@id' => request()->url().'#service',
            'name' => 'Staffing Services in '.$area['seo_label'],
            'serviceType' => 'Recruitment and Staffing',
            'description' => $metaDescription ?? ('Explore sectors and roles with active opportunities in '.$area['seo_label'].'.'),
            'provider' => ['@id' => url('/').'#organization'],
            'url' => request()->url(),
            'areaServed' => [
                '@type' => 'Place',
                'name' => $area['seo_label'],
            ],
        ];
    @endphp
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Services in '.$area['seo_label'],
        'seoDescription' => $metaDescription ?? ('Explore sectors and roles with active opportunities in '.$area['seo_label'].'.'),
        'seoKeywords' => 'staffing by area, bali service areas, recruitment in '.$area['label'],
        'seoBreadcrumbItems' => $breadcrumbItems,
        'seoStructuredDataNodes' => [$serviceSchema],
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-4 pb-24 pt-10 sm:px-8 sm:pt-12">
            <section class="mx-auto max-w-6xl space-y-8">
                @include('partials.breadcrumbs', ['breadcrumbItems' => $breadcrumbItems])
                <div class="rounded-[30px] bg-[#1f5f46] p-6 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)] sm:p-10" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Service Area</p>
                    <h1 class="mt-4 text-3xl font-semibold sm:text-4xl">Services in {{ $area['seo_label'] }}</h1>
                    <p class="mt-4 max-w-3xl text-sm leading-relaxed text-white/90">
                        Explore sectors and roles with active opportunities in {{ $area['seo_label'] }}.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#e7f2ec]">Book consultation</a>
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border border-white px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#1f5f46]">Contact specialist</a>
                    </div>
                </div>

                @if (($serviceAreas ?? collect())->isNotEmpty())
                    <section class="rounded-[24px] bg-white p-6 shadow-[0_18px_44px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Other areas</p>
                        <div class="mt-4 flex flex-wrap gap-2.5">
                            @foreach ($serviceAreas as $item)
                                <a href="{{ route('services.areas.show', $item['slug']) }}" class="inline-flex rounded-full border px-4 py-2 text-xs font-semibold transition {{ $item['slug'] === $area['slug'] ? 'border-[#287854] bg-[#ecf7f1] text-[#1f5f46]' : 'border-[#dfe8e3] bg-white text-[#3f4b45] hover:border-[#bcd7c8] hover:bg-[#f4faf7]' }}">
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="grid gap-8 lg:grid-cols-2" data-aos="fade-up">
                    <div class="rounded-[24px] bg-white p-6 shadow-[0_18px_44px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Sectors in {{ $area['seo_label'] }}</p>
                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            @forelse ($categories as $category)
                                <a href="{{ route('services.sectors.areas.show', ['slug' => $category->slug, 'areaSlug' => $area['slug']]) }}"
                                    class="rounded-xl border border-[#dfe8e3] bg-[#f9fbfa] px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                    {{ $category->name }}
                                </a>
                            @empty
                                <p class="text-sm text-[#6b6b66]">No sector data available in this area yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-6 shadow-[0_18px_44px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Roles in {{ $area['seo_label'] }}</p>
                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            @forelse ($roles as $role)
                                <a href="{{ route('services.roles.areas.show', ['slug' => \Illuminate\Support\Str::slug($role), 'areaSlug' => $area['slug']]) }}"
                                    class="rounded-xl border border-[#dfe8e3] bg-[#f9fbfa] px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                    {{ $role }}
                                </a>
                            @empty
                                <p class="text-sm text-[#6b6b66]">No role data available in this area yet.</p>
                            @endforelse
                        </div>
                    </div>
                </section>

                <section class="rounded-[24px] bg-white p-6 shadow-[0_18px_44px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Airport services</p>
                    <a href="{{ route('airport-services.nanny-concierge.area', $area['slug']) }}"
                        class="mt-4 inline-flex rounded-xl border border-[#dfe8e3] bg-[#f9fbfa] px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                        Nanny - Concierge Services in {{ $area['seo_label'] }}
                    </a>
                </section>

                <section class="space-y-5" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#b28b2e]">Recent opportunities</p>
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @forelse ($relatedCareers as $career)
                            <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_36px_rgba(31,95,70,0.08)]">
                                <h3 class="text-lg font-semibold text-[#1b1b18]">{{ $career->title }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">{{ $career->location_display ?: $area['label'] }}</p>
                                @if ($career->category)
                                    <p class="mt-2 text-xs uppercase tracking-[0.2em] text-[#287854]">{{ $career->category->name }}</p>
                                @endif
                            </article>
                        @empty
                            <p class="text-sm text-[#6b6b66]">No opportunities found in this area.</p>
                        @endforelse
                    </div>
                </section>
            </section>
        </main>
        <x-site-footer />
    </div></body>
</html>
