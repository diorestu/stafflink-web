@php
    $hf = \App\Models\SiteSetting::headerFooter();
    $consultationUrl = trim((string) ($hf['consultation_url'] ?? ''));
    if ($consultationUrl === '' || $consultationUrl === '#') {
        $consultationUrl = route('appointments.create');
    }

    $getStartedLinks = collect([
        ['title' => 'Try the outsourcing calculator', 'url' => route('contact')],
        ['title' => 'Get 3 free quotes', 'url' => route('contact')],
        ['title' => 'Book a call', 'url' => route('appointments.create')],
    ]);

    $headerData = \Illuminate\Support\Facades\Cache::remember('site_header:menu:v4', now()->addHour(), function () {
        $categories = \App\Models\CareerCategory::query()
            ->where('is_active', true)
            ->with([
                'careers' => function ($query) {
                    $query->where('status', 'published')
                        ->orderByDesc('published_at')
                        ->orderBy('title');
                },
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $serviceCategories = $categories
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'roles' => $category->careers
                        ->pluck('title')
                        ->filter()
                        ->unique()
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();

        $serviceRoles = collect($serviceCategories)
            ->flatMap(fn ($category) => $category['roles'])
            ->filter()
            ->unique()
            ->values()
            ->all();

        $traditionalRecruitmentCards = collect([
            ['title' => 'Australia', 'slug' => 'australia'],
            ['title' => 'Indonesia', 'slug' => 'indonesia'],
            ['title' => 'America', 'slug' => 'america'],
        ])->map(function ($card) {
            return [
                'title' => $card['title'],
                'url' => route('global-staffing.country', ['country' => $card['slug']]),
            ];
        })->values()->all();

        return [
            'service_categories' => $serviceCategories,
            'service_roles' => $serviceRoles,
            'traditional_recruitment_cards' => $traditionalRecruitmentCards,
            'service_areas' => app(\App\Services\ServiceAreaService::class)->topAreas(18)->values()->all(),
        ];
    });

    $serviceCategories = collect($headerData['service_categories'] ?? []);
    $serviceRoles = collect($headerData['service_roles'] ?? []);
    $traditionalRecruitmentCards = collect($headerData['traditional_recruitment_cards'] ?? []);
    $serviceAreas = collect($headerData['service_areas'] ?? []);
@endphp

<header class="sticky top-0 z-50 w-full border-b border-[#dfe8e3] bg-white/95 backdrop-blur" data-aos="fade-down" data-site-header>
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6 px-6 py-3 lg:px-10">
        <div class="flex items-center">
            <a href="{{ url('/') }}" aria-label="Go to homepage">
                <img src="{{ asset('images/logo.webp') }}" alt="StaffLink logo" class="h-[101px] w-auto" draggable="false" fetchpriority="high" />
            </a>
        </div>
        <nav class="hidden items-center gap-6 text-[18px] font-medium text-[#4a4a45] lg:flex">
            <a href="{{ url('/') }}" class="transition hover:text-[#1b1b18]">Home</a>
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    About us
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-3 hidden w-72 rounded-2xl bg-white p-6 text-sm text-[#2e2e2e] shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-dropdown-menu>
                    <div class="space-y-4">
                        @foreach (($hf['about_links'] ?? []) as $link)
                            <a href="{{ $link['url'] ?? '#' }}" class="block transition hover:text-[#287854]">{{ $link['label'] ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="relative" data-dropdown data-services-mega>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    Services
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-1/2 top-full z-40 mt-4 hidden w-[72rem] max-w-[calc(100vw-4rem)] -translate-x-1/2 overflow-hidden rounded-[1.75rem] border border-[#dfe8e3] bg-white shadow-[0_22px_60px_rgba(31,95,70,0.18)]"
                    data-dropdown-menu>
                    <div class="grid grid-cols-[17rem_1fr]">
                        <aside class="border-r border-[#e3ebe6] bg-[#f7faf8] p-5">
                            <ul class="space-y-1">
                                <li>
                                    <button type="button"
                                        class="flex w-full items-center justify-between rounded-xl bg-[#e7f2ec] px-3 py-3 text-left text-[1.05rem] font-semibold text-[#287854] transition"
                                        data-services-tab="airport-services" aria-controls="services-panel-airport-services"
                                        aria-selected="true">
                                        <span>Airport Services</span>
                                        <span class="text-base leading-none">&gt;</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-left text-[1.05rem] font-semibold text-[#2e2e2e] transition hover:bg-[#eef5f1] hover:text-[#1f5f46]"
                                        data-services-tab="sectors" aria-controls="services-panel-sectors" aria-selected="false">
                                        <span>Sectors</span>
                                        <span class="text-base leading-none">&gt;</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-left text-[1.05rem] font-semibold text-[#2e2e2e] transition hover:bg-[#eef5f1] hover:text-[#1f5f46]"
                                        data-services-tab="roles" aria-controls="services-panel-roles" aria-selected="false">
                                        <span>Roles</span>
                                        <span class="text-base leading-none">&gt;</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-left text-[1.05rem] font-semibold text-[#2e2e2e] transition hover:bg-[#eef5f1] hover:text-[#1f5f46]"
                                        data-services-tab="areas" aria-controls="services-panel-areas" aria-selected="false">
                                        <span>Areas</span>
                                        <span class="text-base leading-none">&gt;</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-left text-[1.05rem] font-semibold text-[#2e2e2e] transition hover:bg-[#eef5f1] hover:text-[#1f5f46]"
                                        data-services-tab="get-started" aria-controls="services-panel-get-started"
                                        aria-selected="false">
                                        <span>Get Started</span>
                                        <span class="text-base leading-none">&gt;</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="flex w-full items-center justify-between rounded-xl px-3 py-3 text-left text-[1.05rem] font-semibold text-[#2e2e2e] transition hover:bg-[#eef5f1] hover:text-[#1f5f46]"
                                        data-services-tab="traditional-recruitment"
                                        aria-controls="services-panel-traditional-recruitment" aria-selected="false">
                                        <span>Global Staffing</span>
                                        <span class="text-base leading-none">&gt;</span>
                                    </button>
                                </li>
                            </ul>
                        </aside>
                        <div class="p-5">
                            <section id="services-panel-airport-services" data-services-panel="airport-services">
                                <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] p-6">
                                    <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Airport Services</p>
                                    <div class="mt-4">
                                        <a href="{{ route('airport-services.nanny-concierge') }}"
                                            class="inline-flex rounded-xl border border-[#dfe8e3] bg-white px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                            Nanny - Concierge Services
                                        </a>
                                    </div>
                                </div>
                            </section>

                            <section id="services-panel-sectors" class="hidden" data-services-panel="sectors">
                                <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] p-6">
                                    <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Sectors</p>
                                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                        <a href="{{ route('services.sectors.remote-worker') }}"
                                            class="rounded-xl border border-[#bcd7c8] bg-[#ecf7f1] px-4 py-3 text-sm font-semibold text-[#1f5f46] transition hover:border-[#9ec6b0] hover:bg-[#e3f2ea]">
                                            Remote Worker
                                        </a>
                                        @forelse ($serviceCategories as $category)
                                            <a href="{{ route('services.sectors.show', $category['slug']) }}"
                                                class="rounded-xl border border-[#dfe8e3] bg-white px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                                {{ $category['name'] }}
                                            </a>
                                        @empty
                                            <p class="text-sm text-[#6b6b66]">No sectors available yet.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </section>

                            <section id="services-panel-roles" class="hidden" data-services-panel="roles">
                                <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] p-6">
                                    <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Roles</p>
                                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                        @forelse ($serviceRoles as $role)
                                            <a href="{{ route('services.roles.show', \Illuminate\Support\Str::slug($role)) }}"
                                                class="rounded-xl border border-[#dfe8e3] bg-white px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                                {{ $role }}
                                            </a>
                                        @empty
                                            <p class="text-sm text-[#6b6b66]">No roles available yet.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </section>

                            <section id="services-panel-areas" class="hidden" data-services-panel="areas">
                                <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] p-6">
                                    <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Areas</p>
                                    <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                        @forelse ($serviceAreas as $area)
                                            <a href="{{ route('services.areas.show', $area['slug']) }}"
                                                class="rounded-xl border border-[#dfe8e3] bg-white px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                                {{ $area['label'] }}
                                            </a>
                                        @empty
                                            <p class="text-sm text-[#6b6b66]">No areas available yet.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </section>

                            <section id="services-panel-get-started" class="hidden" data-services-panel="get-started">
                                <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] p-6">
                                    <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Get Started</p>
                                    <div class="mt-4 space-y-2">
                                        @foreach ($getStartedLinks as $item)
                                            <a href="{{ $item['url'] }}"
                                                class="flex items-center justify-between rounded-xl border border-[#dfe8e3] bg-white px-4 py-3 text-sm font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                                <span>{{ $item['title'] }}</span>
                                                <span class="text-base leading-none">&gt;</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            <section id="services-panel-traditional-recruitment" class="hidden"
                                data-services-panel="traditional-recruitment">
                                <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] p-6">
                                    <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Global Staffing</p>
                                    <div class="mt-4 grid gap-3 sm:grid-cols-3">
                                        @foreach ($traditionalRecruitmentCards as $card)
                                            <a href="{{ $card['url'] }}"
                                                class="rounded-xl border border-[#dfe8e3] bg-white px-4 py-5 text-center text-base font-semibold text-[#2e2e2e] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7] hover:text-[#1f5f46]">
                                                {{ $card['title'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            @foreach (($hf['main_links'] ?? []) as $link)
                <a href="{{ $link['url'] ?? '#' }}" class="transition hover:text-[#1b1b18]">{{ $link['label'] ?? '' }}</a>
            @endforeach
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ $hf['apply_now_url'] ?? '#' }}" class="hidden rounded-full border border-[#b28b2e] px-4 py-2 text-[14px] font-semibold text-[#b28b2e] transition hover:bg-[#b28b2e] hover:text-white lg:inline-flex">{{ $hf['apply_now_label'] ?? 'Apply now' }}</a>
            <a href="{{ $consultationUrl }}" class="rounded-full bg-[#287854] px-4 py-2 text-[14px] font-semibold text-white shadow-sm transition hover:bg-[#1f5f46]">{{ $hf['consultation_label'] ?? 'Free Consultation' }}</a>
            <button type="button"
                class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-[#d6e4dc] text-[#1f5f46] transition hover:bg-[#f3f8f5] lg:hidden"
                aria-label="Open mobile menu"
                aria-controls="mobile-site-menu"
                aria-expanded="false"
                data-mobile-menu-toggle>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>
    <nav id="mobile-site-menu" class="hidden border-t border-[#e3ebe6] bg-white px-6 pb-6 pt-4 lg:hidden" data-mobile-menu>
        <div class="space-y-2 text-base font-medium text-[#2e2e2e]">
            <a href="{{ url('/') }}" class="block rounded-xl px-3 py-2 transition hover:bg-[#f3f8f5] hover:text-[#1f5f46]">Home</a>

            @if (!empty($hf['about_links'] ?? []))
                <details class="rounded-xl border border-[#e3ebe6] p-2">
                    <summary class="cursor-pointer list-none px-2 py-2 text-[#1f5f46]">About us</summary>
                    <div class="space-y-1 px-2 pb-1 pt-2 text-sm">
                        @foreach (($hf['about_links'] ?? []) as $link)
                            <a href="{{ $link['url'] ?? '#' }}" class="block rounded-lg px-2 py-2 transition hover:bg-[#f3f8f5]">
                                {{ $link['label'] ?? '' }}
                            </a>
                        @endforeach
                    </div>
                </details>
            @endif

            <details class="rounded-xl border border-[#e3ebe6] p-2">
                <summary class="cursor-pointer list-none px-2 py-2 text-[#1f5f46]">Services</summary>
                <div class="space-y-3 px-2 pb-1 pt-2 text-sm">
                    <a href="{{ route('airport-services.nanny-concierge') }}" class="block rounded-lg px-2 py-2 transition hover:bg-[#f3f8f5]">
                        Airport Services
                    </a>
                    @foreach ($serviceCategories->take(6) as $category)
                        <a href="{{ route('services.sectors.show', $category['slug']) }}" class="block rounded-lg px-2 py-2 transition hover:bg-[#f3f8f5]">
                            {{ $category['name'] }}
                        </a>
                    @endforeach
                    @foreach ($serviceAreas->take(6) as $area)
                        <a href="{{ route('services.areas.show', $area['slug']) }}" class="block rounded-lg px-2 py-2 transition hover:bg-[#f3f8f5]">
                            {{ $area['label'] }}
                        </a>
                    @endforeach
                </div>
            </details>

            @foreach (($hf['main_links'] ?? []) as $link)
                <a href="{{ $link['url'] ?? '#' }}" class="block rounded-xl px-3 py-2 transition hover:bg-[#f3f8f5] hover:text-[#1f5f46]">
                    {{ $link['label'] ?? '' }}
                </a>
            @endforeach

            <div class="mt-3 flex flex-col gap-2 pt-2">
                <a href="{{ $hf['apply_now_url'] ?? '#' }}" class="inline-flex justify-center rounded-full border border-[#b28b2e] px-4 py-2 text-sm font-semibold text-[#b28b2e] transition hover:bg-[#b28b2e] hover:text-white">
                    {{ $hf['apply_now_label'] ?? 'Apply now' }}
                </a>
                <a href="{{ $consultationUrl }}" class="inline-flex justify-center rounded-full bg-[#287854] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">
                    {{ $hf['consultation_label'] ?? 'Free Consultation' }}
                </a>
            </div>
        </div>
    </nav>
</header>

@once
    <script>
        (() => {
            const headers = Array.from(document.querySelectorAll('[data-site-header]'));
            headers.forEach((header) => {
                const toggle = header.querySelector('[data-mobile-menu-toggle]');
                const menu = header.querySelector('[data-mobile-menu]');
                if (!toggle || !menu) return;

                const closeMenu = () => {
                    menu.classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                    document.body.classList.remove('overflow-hidden');
                };

                toggle.addEventListener('click', () => {
                    const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
                    toggle.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
                    menu.classList.toggle('hidden', isExpanded);
                    document.body.classList.toggle('overflow-hidden', !isExpanded);
                });

                menu.querySelectorAll('a').forEach((link) => {
                    link.addEventListener('click', closeMenu);
                });

                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 1024) {
                        closeMenu();
                    }
                });
            });

            const megaMenus = Array.from(document.querySelectorAll('[data-services-mega]'));

            megaMenus.forEach((menu) => {
                const tabs = Array.from(menu.querySelectorAll('[data-services-tab]'));
                const panels = Array.from(menu.querySelectorAll('[data-services-panel]'));
                if (!tabs.length || !panels.length) return;

                const setActiveTab = (tabId) => {
                    tabs.forEach((tab) => {
                        const isActive = tab.dataset.servicesTab === tabId;
                        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                        tab.classList.toggle('bg-[#e7f2ec]', isActive);
                        tab.classList.toggle('text-[#287854]', isActive);
                        tab.classList.toggle('text-[#2e2e2e]', !isActive);
                    });

                    panels.forEach((panel) => {
                        panel.classList.toggle('hidden', panel.dataset.servicesPanel !== tabId);
                    });
                };

                setActiveTab(tabs[0].dataset.servicesTab);

                tabs.forEach((tab) => {
                    const tabId = tab.dataset.servicesTab;
                    if (!tabId) return;

                    tab.addEventListener('mouseenter', () => setActiveTab(tabId));
                    tab.addEventListener('focus', () => setActiveTab(tabId));
                    tab.addEventListener('click', () => setActiveTab(tabId));
                });
            });
        })();
    </script>
@endonce
