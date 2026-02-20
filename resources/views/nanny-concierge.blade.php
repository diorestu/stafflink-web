<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $seoArea = $seoArea ?? null;
        $serviceAreas = $serviceAreas ?? collect();
        $areaLabel = $seoArea['seo_label'] ?? null;
        $pageTitle = $areaLabel ? "Nanny Concierge Services in {$areaLabel}" : 'Nanny Concierge Services';
        $pageDescription = $areaLabel
            ? "Discover VIP nanny and concierge recruitment services in {$areaLabel} with Staff Link."
            : 'Discover VIP nanny and concierge recruitment services with Staff Link.';
        $breadcrumbItems = [['name' => 'Home', 'url' => url('/')], ['name' => 'Airport Services', 'url' => route('airport-services.nanny-concierge')]];
        if ($areaLabel) {
            $breadcrumbItems[] = ['name' => $areaLabel, 'url' => request()->url()];
        }

        $serviceSchema = [
            '@type' => 'Service',
            '@id' => request()->url().'#service',
            'name' => $pageTitle,
            'serviceType' => 'Nanny Concierge Service',
            'description' => $pageDescription,
            'provider' => ['@id' => url('/').'#organization'],
            'url' => request()->url(),
            'areaServed' => [
                '@type' => 'Place',
                'name' => $areaLabel ?? 'Bali',
            ],
        ];
    @endphp
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | '.$pageTitle,
        'seoDescription' => $pageDescription,
        'seoKeywords' => 'nanny concierge service, airport service, childcare recruitment bali',
        'seoBreadcrumbItems' => $breadcrumbItems,
        'seoStructuredDataNodes' => [$serviceSchema],
    ])

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />

        <main class="px-6 pb-20 pt-12 lg:px-10">
            <section class="mx-auto max-w-6xl">
                @include('partials.breadcrumbs', ['breadcrumbItems' => $breadcrumbItems])
            </section>
            <section class="mx-auto max-w-6xl overflow-hidden rounded-[32px] shadow-[0_20px_60px_rgba(31,95,70,0.16)]" data-aos="fade-up">
                <div class="relative min-h-[620px]">
                    <img src="{{ asset('images/img_hero.webp') }}" alt="Nanny assisting child" class="absolute inset-0 h-full w-full object-cover" draggable="false" loading="lazy" />
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/45"></div>

                    <div class="relative flex h-full items-center px-8 py-10 lg:px-12">
                        <div class="max-w-3xl rounded-[26px] border border-white/20 bg-black/35 p-6 text-white shadow-[0_14px_34px_rgba(0,0,0,0.25)] backdrop-blur-[2px] md:p-8">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Airport Services</p>
                            <h1 class="mt-4 text-4xl font-semibold leading-tight text-white md:text-5xl">
                                International Childcare Recruitment Agency @if($areaLabel) in {{ $areaLabel }} @endif
                            </h1>
                            <p class="mt-5 max-w-2xl text-sm leading-relaxed text-white/90">
                                Staff Link is the first International VIP Agency specialising in the recruitment and placement of professional
                                Nannies, Mannies, Bilingual Nannies, Governesses, Nanny/Housekeepers, Maternity Nurses and Tutors for luxury households in Indonesia.
                            </p>
                            <p class="mt-4 max-w-2xl text-sm leading-relaxed text-white/90">
                                We have successfully placed highly qualified candidates for International &amp; American TV Stars and UHNW clients.
                                From renowned business figures to politicians and celebrities, our Indonesia-based offices give us global reach for both clients and candidates.
                            </p>
                            <p class="mt-4 max-w-2xl text-sm leading-relaxed text-white/90">
                                Our team is fluent in English, Russian, Mandarin, Bahasa, Persian/Farsi and Turkish. Every Staff Link consultant has firsthand
                                household experience, so we assess and match candidates to each family’s unique requirements with confidence.
                            </p>
                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ route('contact') }}" class="inline-flex items-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#e7f2ec]">Call Us</a>
                                <a href="{{ route('applications.create') }}" class="inline-flex items-center rounded-full border border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#1f5f46]">Candidate Registration</a>
                                <a href="{{ route('appointments.create') }}" class="inline-flex items-center rounded-full border border-[#e9d29d] px-6 py-3 text-sm font-semibold text-[#f3ddac] transition hover:bg-[#e9d29d] hover:text-[#1f5f46]">Nanny &amp; Governess Training School</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if ($serviceAreas->isNotEmpty())
                <section class="mx-auto mt-8 max-w-6xl rounded-[24px] bg-white p-6 shadow-[0_18px_44px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Airport service areas</p>
                        @if ($areaLabel)
                            <a href="{{ route('airport-services.nanny-concierge') }}" class="inline-flex rounded-full border border-[#dfe8e3] bg-white px-4 py-2 text-xs font-semibold text-[#3f4b45] transition hover:border-[#bcd7c8] hover:bg-[#f4faf7]">
                                View all areas
                            </a>
                        @endif
                    </div>
                    <div class="mt-4 flex flex-wrap gap-x-3 gap-y-3 sm:gap-x-4 sm:gap-y-4">
                        @foreach ($serviceAreas as $area)
                            <a href="{{ route('airport-services.nanny-concierge.area', $area['slug']) }}" class="inline-flex rounded-full border px-4 py-2 text-xs font-semibold transition {{ ($seoArea['slug'] ?? null) === $area['slug'] ? 'border-[#287854] bg-[#ecf7f1] text-[#1f5f46]' : 'border-[#dfe8e3] bg-white text-[#3f4b45] hover:border-[#bcd7c8] hover:bg-[#f4faf7]' }}">
                                {{ $area['label'] }}
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="mx-auto mt-16 max-w-5xl space-y-10" data-aos="fade-up">
                <div class="text-center space-y-4">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#b28b2e]">International Childcare Recruitment</p>
                    <h2 class="text-3xl font-semibold text-[#1b1b18]">Elite childcare for families relocating or holidaying in Indonesia</h2>
                    <p class="mx-auto max-w-3xl text-sm leading-relaxed text-[#6b6b66]">
                        Our consultants customise every search and introduce only the candidates who perfectly meet each family’s expectations.
                        We successfully place childcare professionals in private homes daily across Indonesia for clients around the world.
                    </p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_38px_rgba(31,95,70,0.08)]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">VIP nanny &amp; governess roster</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">Nannies, Mannies, bilingual nannies, nanny/housekeepers, maternity nurses, and tutors for luxury households.</p>
                    </article>
                    <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_38px_rgba(31,95,70,0.08)]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">UHNW &amp; celebrity placements</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">Trusted by international TV stars, business figures, politicians, and discerning UHNW families.</p>
                    </article>
                    <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_38px_rgba(31,95,70,0.08)]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">Multilingual consultants</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">English, Russian, Mandarin, Bahasa, Persian/Farsi, and Turkish support for seamless coordination.</p>
                    </article>
                    <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_38px_rgba(31,95,70,0.08)]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">Household experience</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">All consultants have worked in private households, often as nannies or governesses themselves.</p>
                    </article>
                    <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_38px_rgba(31,95,70,0.08)]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">Tailored matching</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">We advise on mono, bi, or trilingual nannies, travelling governesses, tutors, or maternity nurses.</p>
                    </article>
                    <article class="rounded-2xl border border-[#dfe8e3] bg-white p-5 shadow-[0_16px_38px_rgba(31,95,70,0.08)]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">Daily placements in Indonesia</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">Families relocating or holidaying here rely on our local knowledge and rigorous vetting.</p>
                    </article>
                </div>
            </section>

            <section class="mx-auto mt-16 max-w-6xl space-y-12" data-aos="fade-up">
                <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                    <div>
                        <p class="text-xs uppercase tracking-[0.25em] text-[#b28b2e]">For Families</p>
                        <h3 class="mt-3 text-2xl font-semibold text-[#1b1b18]">Want to find the right Nanny for your Family?</h3>
                        <p class="mt-3 text-sm leading-relaxed text-[#6b6b66]">Meet our specialist to assist you and your family to hire the best nanny.</p>
                        <p class="mt-3 text-sm leading-relaxed text-[#6b6b66]">We customise recruitment daily and introduce only those candidates who perfectly meet your expectations.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full bg-[#287854] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">Schedule a Call</a>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-[24px] shadow-[0_20px_50px_rgba(31,95,70,0.16)]">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80" alt="Family with nanny" class="h-full w-full object-cover" loading="lazy" />
                    </div>
                </div>

                <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
                    <div class="overflow-hidden rounded-[24px] shadow-[0_20px_50px_rgba(31,95,70,0.16)]">
                        <img src="https://images.unsplash.com/photo-1519451241324-20b4ea2c4220?auto=format&fit=crop&w=1200&q=80" alt="Nanny reading with children" class="h-full w-full object-cover" loading="lazy" />
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.25em] text-[#b28b2e]">For Nannies</p>
                        <h3 class="mt-3 text-2xl font-semibold text-[#1b1b18]">Want to find the right Nanny job?</h3>
                        <p class="mt-3 text-sm leading-relaxed text-[#6b6b66]">Apply to the best international Nanny Jobs and Vacancies through our elite placement agency.</p>
                        <p class="mt-3 text-sm leading-relaxed text-[#6b6b66]">Staff Link Academy is the only elite childcare training school in Indonesia, offering year-round professional training for Nannies and Governesses.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('jobs.index') }}" class="inline-flex rounded-full bg-[#287854] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">Apply Now</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto mt-16 max-w-6xl" data-aos="fade-up">
                <div class="rounded-[30px] bg-[#287854] px-10 py-12 text-white shadow-[0_18px_48px_rgba(31,95,70,0.22)]">
                    <div class="space-y-6">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">How do we recruit an experienced nanny?</p>
                        <p class="text-sm leading-relaxed text-white/90">Families who use our services look for people already trained, qualified, experienced, and with excellent references, which is why we are very demanding with our recruitment process.</p>
                        <p class="text-sm leading-relaxed text-white/90">First, our consultants capture a clear understanding of the family’s needs and environment from a detailed job description and desired profile.</p>
                        <p class="text-sm leading-relaxed text-white/90">Based on this assessment, we advise whether to employ a monolingual, bilingual, or trilingual nanny, a travelling governess, a tutor specialising in early education, or a maternity nurse.</p>
                        <p class="text-sm leading-relaxed text-white/90">Each candidate is thoroughly interviewed by a consultant who knows household work firsthand. For long-term roles we build a profile folder with diplomas, certificates, references, and background checks including criminal record certificates.</p>
                        <p class="text-sm leading-relaxed text-white/90">All candidates must have a minimum of two years’ childcare experience to have their profile pre-screened by our team.</p>
                        <div class="flex flex-wrap gap-3 pt-1">
                            <a href="{{ route('contact') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#287854] transition hover:bg-[#e7f2ec]">Call Us</a>
                            <a href="{{ route('applications.create') }}" class="inline-flex rounded-full border border-white px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#287854]">Candidate Registration</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto mt-16 max-w-6xl" data-aos="fade-up">
                <div class="grid gap-6 rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:grid-cols-[1fr_1.2fr] lg:items-center">
                    <div class="space-y-3">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Proof of care</p>
                        <h3 class="text-2xl font-semibold text-[#1b1b18]">International Nanny Placement Agency</h3>
                        <p class="text-sm leading-relaxed text-[#6b6b66]">With broad experience in recruitment and placement, Staff Link conducts full background checks and verifies every document to uphold a five-star standard.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] p-6 text-center">
                            <p class="text-4xl font-semibold text-[#1f5f46] lg:text-5xl">8+</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.25em] text-[#6b6b66]">Agencies in the world</p>
                        </div>
                        <div class="rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] p-6 text-center">
                            <p class="text-4xl font-semibold text-[#1f5f46] lg:text-5xl">50k+</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.25em] text-[#6b6b66]">Nannies registered</p>
                        </div>
                        <div class="rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] p-6 text-center">
                            <p class="text-4xl font-semibold text-[#1f5f46] lg:text-5xl">3m+</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.25em] text-[#6b6b66]">Users a year</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto mt-16 max-w-6xl" data-aos="fade-up">
                <div class="rounded-[30px] bg-[#287854] p-10 text-white shadow-[0_18px_44px_rgba(31,95,70,0.22)]">
                    <div class="grid gap-6 lg:grid-cols-2 lg:items-start">
                        <div class="space-y-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Find our customers everywhere in the world</p>
                            <h3 class="text-2xl font-semibold text-white">Global reach, local expertise in Indonesia</h3>
                            <p class="text-sm leading-relaxed text-white/85">Our network serves Los Angeles, New York, Paris, London, the French Riviera, Rolle, Malaysia, Australia, Iran and Dubai while specialising in relocations and holidays within Indonesia.</p>
                            <p class="text-sm leading-relaxed text-white/85">Employers can enhance their nanny’s skills through customised training at your home or in our exclusive training villa with accommodation provided.</p>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#287854] transition hover:bg-[#e7f2ec]">Book a consultation</a>
                                <a href="{{ route('contact') }}" class="inline-flex rounded-full border border-white px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#287854]">Call Us</a>
                            </div>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <article class="rounded-2xl border border-white/30 bg-white/10 p-5">
                                <p class="text-sm font-semibold text-white">Custom training</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/85">Our expert trainers assess at your residence or host your nanny in our training villa.</p>
                            </article>
                            <article class="rounded-2xl border border-white/30 bg-white/10 p-5">
                                <p class="text-sm font-semibold text-white">Relocation support</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/85">Daily placements for families relocating or holidaying in Indonesia.</p>
                            </article>
                            <article class="rounded-2xl border border-white/30 bg-white/10 p-5">
                                <p class="text-sm font-semibold text-white">Elite academy</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/85">Year-round VIP nanny and governess training through Staff Link Academy.</p>
                            </article>
                            <article class="rounded-2xl border border-white/30 bg-white/10 p-5">
                                <p class="text-sm font-semibold text-white">Career advancement</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/85">Transition into childcare or elevate your career with personalised coaching.</p>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-site-footer />
    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3" data-aos="fade-up">
        <button type="button" class="flex h-12 w-12 items-center justify-center rounded-full border border-[#b28b2e] bg-white text-[#b28b2e] shadow-lg transition hover:bg-[#b28b2e] hover:text-white" data-scroll-top aria-label="Move to top">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path d="M12 19V5" />
                <path d="M6 11l6-6 6 6" />
            </svg>
        </button>
        <a href="https://wa.me/6285739660906" class="group relative flex h-16 w-16 items-center justify-center overflow-visible rounded-full bg-transparent transition" aria-label="WhatsApp Chat">
            <img src="{{ asset('images/64px-WhatsApp.svg.png') }}" alt="WhatsApp" class="h-full w-full object-contain" draggable="false" loading="lazy" />
            <span class="pointer-events-none absolute right-full mr-3 flex items-center gap-2 whitespace-nowrap rounded-full bg-[#287854] px-4 py-2 text-[11px] font-semibold tracking-tight text-white shadow-lg opacity-0 transition duration-300 ease-out translate-x-6 scale-x-105 origin-right group-hover:translate-x-0 group-hover:opacity-100">
                Click here to chat
            </span>
        </a>
    </div></body>
</html>
