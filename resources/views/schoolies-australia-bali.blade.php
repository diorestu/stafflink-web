<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Schoolies Bali 2026',
        'seoDescription' => 'Schoolies Bali 2026 for Australian graduates featuring an exclusive one-night event, optional group Bali experiences, and parent-focused support.',
        'seoKeywords' => 'schoolies bali 2026, bali schoolies, australian graduates bali, school leavers bali, schoolies event bali',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fff8ee] text-[#1e2b26]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen">
        <x-site-header />

        <main class="px-5 pb-20 pt-8 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-8">
                <section
                    class="overflow-hidden rounded-[30px] px-7 py-10 text-white shadow-[0_20px_50px_rgba(15,118,110,0.25)] lg:px-10 lg:py-14"
                    style="background-image: linear-gradient(130deg, rgba(15,118,110,0.86) 0%, rgba(10,147,150,0.74) 42%, rgba(238,155,0,0.6) 100%), url('https://www.schoolies.com/images/home-page-slides/45.jpg'); background-size: cover; background-position: center;">
                    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70">Bali Schoolies 2026</p>
                            <h1 class="mt-4 max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">Schoolies Bali 2026 - <span class="text-[0.9em]">The Ultimate Graduation Party in Bali</span></h1>
                            <p class="mt-5 max-w-3xl text-xs leading-relaxed text-white/90 sm:text-sm">
                                Celebrate finishing school with one unforgettable night in Bali. An exclusive Schoolies event for Australian graduates featuring music, beach atmosphere, and curated social experiences. In partnership with Love Link Weddings &amp; Events, a Bali-based event production team specializing in destination celebrations.
                            </p>
                            <div class="mt-7 flex flex-wrap gap-3">
                                <a href="{{ route('services.schoolies-bali-packages') }}" class="inline-flex rounded-full border-2 border-white bg-white px-6 py-3 text-sm font-semibold text-[#0f766e] transition hover:bg-transparent hover:text-white">Get Schoolies Tickets</a>
                                <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#0f766e]">Plan Your Bali Schoolies 2026</a>
                            </div>
                        </div>
                        <div class="grid gap-4 rounded-[24px] bg-black/15 p-5 backdrop-blur-sm">
                            <div class="flex items-start gap-3 rounded-[18px] border border-white/20 bg-white/10 px-4 py-3">
                                <span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/30 bg-black/15 text-white">
                                    <x-ui-icon name="book" class="h-4 w-4" />
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">Season</p>
                                    <p class="mt-1 text-sm font-semibold">Late November - Early December</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-[18px] border border-white/20 bg-white/10 px-4 py-3">
                                <span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/30 bg-black/15 text-white">
                                    <x-ui-icon name="users" class="h-4 w-4" />
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">Program Format</p>
                                    <p class="mt-1 text-sm font-semibold">1 Night Main Event<br>Optional Bali Trip Packages</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-[18px] border border-white/20 bg-white/10 px-4 py-3">
                                <span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/30 bg-black/15 text-white">
                                    <x-ui-icon name="target" class="h-4 w-4" />
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">Focus</p>
                                    <p class="mt-1 text-sm font-semibold">Beach Party • Music • Graduation Celebration • Safety</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="relative overflow-hidden rounded-[26px] bg-[#0f1a17] shadow-[0_20px_50px_rgba(15,118,110,0.2)]">
                    <video
                        id="schoolies-video"
                        class="w-full object-cover"
                        autoplay
                        muted
                        loop
                        playsinline
                        preload="metadata">
                        <source src="{{ asset('images/schoolies_video.webm') }}" type="video/webm">
                    </video>
                    <button
                        id="schoolies-sound-btn"
                        onclick="toggleSchooliesSound()"
                        class="absolute bottom-4 right-4 inline-flex items-center gap-2 rounded-full bg-black/50 px-4 py-2 text-xs font-semibold text-white backdrop-blur-sm transition hover:bg-black/70">
                        <svg id="schoolies-icon-muted" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                        </svg>
                        <svg id="schoolies-icon-sound" class="hidden h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 6v12m-3.536-9.536A5 5 0 005.93 12a5 5 0 002.534 4.536M19.07 4.929a9 9 0 010 14.142" />
                        </svg>
                        <span id="schoolies-sound-label">Sound Off</span>
                    </button>
                </section>
                <script>
                    function toggleSchooliesSound() {
                        const video = document.getElementById('schoolies-video');
                        const label = document.getElementById('schoolies-sound-label');
                        const iconMuted = document.getElementById('schoolies-icon-muted');
                        const iconSound = document.getElementById('schoolies-icon-sound');
                        video.muted = !video.muted;
                        if (video.muted) {
                            label.textContent = 'Sound Off';
                            iconMuted.classList.remove('hidden');
                            iconSound.classList.add('hidden');
                        } else {
                            label.textContent = 'Sound On';
                            iconMuted.classList.add('hidden');
                            iconSound.classList.remove('hidden');
                        }
                    }
                </script>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">What Makes Schoolies Bali by Us Different</h2>
                    <div class="mt-6 grid gap-5 lg:grid-cols-3">
                        <article class="rounded-[20px] border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-[#e6f5f1] text-[#0f766e]">
                                <x-ui-icon name="building" class="h-5 w-5" />
                            </span>
                            <h3 class="mt-3 text-xl font-semibold text-[#0f766e]">Beachfront Celebration</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#3f524c]">Celebrate graduation in a premium Bali venue with sunset views, music, and unforgettable party energy.</p>
                        </article>
                        <article class="rounded-[20px] border border-[#f2dfbe] bg-[#fff7ea] p-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-[#ffe8bf] text-[#a86800]">
                                <x-ui-icon name="shield" class="h-5 w-5" />
                            </span>
                            <h3 class="mt-3 text-xl font-semibold text-[#a86800]">Curated Schoolies Event</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#5a4930]">Structured access, controlled guest list, and coordinated entry planning to keep the event smooth and enjoyable.</p>
                        </article>
                        <article class="rounded-[20px] border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-[#e6f5f1] text-[#0f766e]">
                                <x-ui-icon name="heart" class="h-5 w-5" />
                            </span>
                            <h3 class="mt-3 text-xl font-semibold text-[#0f766e]">Optional Bali Experiences</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#3f524c]">Groups can extend their Schoolies trip with curated Bali activities before or after the main event.</p>
                        </article>
                    </div>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Schoolies Bali Event Format</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#4c5f59]">The Schoolies Bali experience is built around a signature one-night celebration, with optional travel extensions for groups wanting to explore Bali.</p>
                    <div class="mt-6 grid gap-5 lg:grid-cols-3">
                        <article class="rounded-[20px] border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <h3 class="text-xl font-semibold text-[#0f766e]">Main Schoolies Event</h3>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#3f524c]">
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Exclusive graduation celebration</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Premium Bali venue</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Music, DJs, and social atmosphere</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Organized entry &amp; event coordination</span></li>
                            </ul>
                        </article>
                        <article class="rounded-[20px] border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <h3 class="text-xl font-semibold text-[#0f766e]">Group Schoolies Trip</h3>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e]">For groups traveling together.</p>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#3f524c]">
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Shared villa accommodation</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Bali activities and day trips</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Group transport coordination</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Local support</span></li>
                            </ul>
                        </article>
                        <article class="rounded-[20px] border border-[#f2dfbe] bg-[#fff7ea] p-5">
                            <h3 class="text-xl font-semibold text-[#a86800]">Private Group Experience</h3>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-[#a86800]">For schools or large friend groups.</p>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#5a4930]">
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Custom Bali itinerary</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Private transport planning</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Activity planning</span></li>
                                <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Dedicated group coordination</span></li>
                            </ul>
                        </article>
                    </div>
                </section>

                <section class="overflow-hidden rounded-[28px] bg-[linear-gradient(130deg,#e9b896_0%,#e6a8af_55%,#d78dbc_100%)] px-6 py-10 shadow-[0_18px_46px_rgba(120,41,85,0.18)] lg:px-10">
                    <div class="mx-auto max-w-6xl">
                        <p class="text-center text-xs font-semibold uppercase tracking-[0.24em] text-white/85">How to Book</p>
                        <h2 class="mt-3 text-center text-3xl font-semibold tracking-wide text-white sm:text-4xl">How to Book Your Schoolies Bali Experience</h2>
                        <p class="mt-3 text-center text-sm text-white/90">Follow these 4 simple steps to secure your Schoolies celebration in Bali.</p>
                        <div class="mt-8 grid gap-5 lg:grid-cols-4">
                            <article class="relative rounded-[20px] bg-[#f4f4f4] p-6 text-center shadow-[0_10px_24px_rgba(0,0,0,0.08)]">
                                <span class="absolute -top-6 left-1/2 inline-flex h-14 w-14 -translate-x-1/2 items-center justify-center rounded-full bg-[#f1aa00] text-3xl font-bold text-white">1</span>
                                <h3 class="mt-4 text-2xl font-semibold text-[#2f2f33]">Gather Your Schoolies Squad</h3>
                                <p class="mt-4 text-sm leading-relaxed text-[#515157]">Start by gathering your friends who want to celebrate Schoolies together in Bali. Create a group chat so everyone can coordinate plans and get excited for the trip.</p>
                            </article>
                            <article class="relative rounded-[20px] bg-[#f4f4f4] p-6 text-center shadow-[0_10px_24px_rgba(0,0,0,0.08)]">
                                <span class="absolute -top-6 left-1/2 inline-flex h-14 w-14 -translate-x-1/2 items-center justify-center rounded-full bg-[#f1aa00] text-3xl font-bold text-white">2</span>
                                <h3 class="mt-4 text-2xl font-semibold text-[#2f2f33]">Choose Your Schoolies Experience</h3>
                                <p class="mt-4 text-sm leading-relaxed text-[#515157]">Decide whether you want to attend the main Schoolies event only or extend your trip with optional Bali experiences and group travel plans.</p>
                            </article>
                            <article class="relative rounded-[20px] bg-[#f4f4f4] p-6 text-center shadow-[0_10px_24px_rgba(0,0,0,0.08)]">
                                <span class="absolute -top-6 left-1/2 inline-flex h-14 w-14 -translate-x-1/2 items-center justify-center rounded-full bg-[#f1aa00] text-3xl font-bold text-white">3</span>
                                <h3 class="mt-4 text-2xl font-semibold text-[#2f2f33]">Secure Your Tickets</h3>
                                <p class="mt-4 text-sm leading-relaxed text-[#515157]">Choose the number of tickets for your group and complete the booking to reserve your place at Schoolies Bali.</p>
                            </article>
                            <article class="relative rounded-[20px] bg-[#f4f4f4] p-6 text-center shadow-[0_10px_24px_rgba(0,0,0,0.08)]">
                                <span class="absolute -top-6 left-1/2 inline-flex h-14 w-14 -translate-x-1/2 items-center justify-center rounded-full bg-[#f1aa00] text-3xl font-bold text-white">4</span>
                                <h3 class="mt-4 text-2xl font-semibold text-[#2f2f33]">Prepare for Bali</h3>
                                <p class="mt-4 text-sm leading-relaxed text-[#515157]">Once your ticket is secured, you can start planning the rest of your Bali trip including accommodation, activities, and travel arrangements.</p>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Sample Bali Schoolies Week Flow</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#4c5f59]">Many groups turn their Schoolies event into a full Bali trip.</p>
                    <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <article class="rounded-[18px] border border-[#dcece7] bg-[#f6fbf9] p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e]">Day 1</p>
                            <p class="mt-2 text-sm text-[#3f524c]">Arrival in Bali, villa check-in, welcome dinner.</p>
                        </article>
                        <article class="rounded-[18px] border border-[#dcece7] bg-[#f6fbf9] p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e]">Day 2</p>
                            <p class="mt-2 text-sm text-[#3f524c]">Beach club afternoon and sunset social gathering.</p>
                        </article>
                        <article class="rounded-[18px] border border-[#dcece7] bg-[#f6fbf9] p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e]">Day 3</p>
                            <p class="mt-2 text-sm text-[#3f524c]">Explore Bali nature spots or water activities.</p>
                        </article>
                        <article class="rounded-[18px] border border-[#dcece7] bg-[#f6fbf9] p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e]">Day 4</p>
                            <p class="mt-2 text-sm text-[#3f524c]">Free day for shopping, cafes, and beach time.</p>
                        </article>
                        <article class="rounded-[18px] border border-[#f2dfbe] bg-[#fff7ea] p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#a86800]">Day 5</p>
                            <p class="mt-2 text-sm text-[#5a4930]">Adventure activities or island trips.</p>
                        </article>
                        <article class="rounded-[18px] border border-[#f2dfbe] bg-[#fff7ea] p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#a86800]">Day 6</p>
                            <p class="mt-2 text-sm text-[#5a4930]">Pre-event gatherings and social meetups.</p>
                        </article>
                        <article class="rounded-[18px] border border-[#dcece7] bg-[#f6fbf9] p-4 md:col-span-2 lg:col-span-2">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e]">Day 7</p>
                            <p class="mt-2 text-sm text-[#3f524c]">Schoolies Bali Main Event Night.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight"><span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#e6f5f1] text-[#0f766e]"><x-ui-icon name="headset" class="h-5 w-5" /></span>What We Coordinate</h2>
                        <ul class="mt-5 space-y-3 text-sm leading-relaxed text-[#3f524c]">
                            <li class="flex items-start gap-3 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3"><x-ui-icon name="building" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Event venue coordination</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3"><x-ui-icon name="target" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Guest access and event entry management</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3"><x-ui-icon name="book" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Optional accommodation recommendations</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3"><x-ui-icon name="users" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Transport planning for groups</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3"><x-ui-icon name="headset" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>On-ground support during the event</span></li>
                        </ul>
                    </article>
                    <article class="rounded-[24px] border border-[#f2dfbe] bg-[#fffaf0] p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight"><span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#ffe8bf] text-[#a86800]"><x-ui-icon name="shield" class="h-5 w-5" /></span>Parent &amp; Safety Information</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#5a4930]">We understand that many Schoolies travelers are visiting Bali for the first time. Our program structure includes coordination, clear communication, and local support options.</p>
                        <ul class="mt-5 space-y-3 text-sm leading-relaxed text-[#5a4930]">
                            <li class="flex items-start gap-3 rounded-xl border border-[#f2dfbe] bg-white/80 px-4 py-3"><x-ui-icon name="users" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Pre-trip information available for families</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#f2dfbe] bg-white/80 px-4 py-3"><x-ui-icon name="headset" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Local coordination contacts</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#f2dfbe] bg-white/80 px-4 py-3"><x-ui-icon name="book" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Event guidelines and conduct policies</span></li>
                            <li class="flex items-start gap-3 rounded-xl border border-[#f2dfbe] bg-white/80 px-4 py-3"><x-ui-icon name="comments" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" /><span>Support channels during the event</span></li>
                        </ul>
                        <div class="mt-6">
                            <a href="{{ route('services.schoolies-parents') }}" class="inline-flex rounded-full border-2 border-[#a86800] px-5 py-2.5 text-sm font-semibold text-[#a86800] transition hover:bg-[#a86800] hover:text-white">View Parent Information</a>
                        </div>
                    </article>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Schoolies Bali Planning Guides</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#4c5f59]">Planning your Schoolies trip to Bali? Explore our guides to help you prepare the perfect graduation celebration.</p>
                    <ul class="mt-5 grid gap-3 text-sm leading-relaxed text-[#3f524c] md:grid-cols-2">
                        <li class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3">How to Plan a Schoolies Trip to Bali</li>
                        <li class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3">Best Areas to Stay in Bali for Schoolies</li>
                        <li class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3">What to Pack for a Schoolies Trip to Bali</li>
                        <li class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3">Top Bali Experiences for School Leavers</li>
                    </ul>
                    <div class="mt-6">
                        <a href="{{ route('blog') }}" class="inline-flex rounded-full border-2 border-[#0f766e] bg-[#0f766e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#0f766e]">Read the Schoolies Blog</a>
                    </div>
                </section>

                <section class="rounded-[28px] bg-[#0f766e] px-7 py-9 text-white shadow-[0_20px_50px_rgba(15,118,110,0.22)] lg:px-10 lg:py-11">
                    <h2 class="text-3xl font-semibold leading-tight sm:text-4xl">Celebrate Schoolies in Bali</h2>
                    <p class="mt-4 max-w-4xl text-base leading-relaxed text-white/86">Join the next generation of graduates celebrating Schoolies in one of the world's most exciting destinations. Whether you're coming for the main event night or planning a full Bali Schoolies trip, start your journey here.</p>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full border-2 border-white bg-white px-6 py-3 text-sm font-semibold text-[#0f766e] transition hover:bg-transparent hover:text-white">Book Your Schoolies Ticket</a>
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#0f766e]">Become a Schoolies Partner or Sponsor</a>
                    </div>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Frequently Asked Questions</h2>
                    <div class="mt-5 space-y-3">
                        <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-[#1f5f46]">How far in advance should I book Schoolies Bali?</span>
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                            </summary>
                            <div class="faq-answer">
                                <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                    Most students begin planning their Schoolies trip during Year 11 or early Year 12. Booking early helps ensure you and your friends can secure the best options and plan the trip together.
                                </div>
                            </div>
                        </details>
                        <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-[#1f5f46]">Can I attend Schoolies Bali with my group of friends?</span>
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                            </summary>
                            <div class="faq-answer">
                                <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                    Yes. Schoolies trips are typically planned in groups, and many graduates organise their travel together with friends from the same school or social group. Planning early helps make sure everyone can stay and celebrate together.
                                </div>
                            </div>
                        </details>
                        <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-[#1f5f46]">Do I need a passport to attend Schoolies Bali?</span>
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                            </summary>
                            <div class="faq-answer">
                                <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                    Yes. Since Bali is an international destination, Australian students will need a valid passport to travel to Indonesia. It's recommended to check that your passport is valid well before your planned travel dates.
                                </div>
                            </div>
                        </details>
                        <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-[#1f5f46]">Are flights included in Schoolies Bali bookings?</span>
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                            </summary>
                            <div class="faq-answer">
                                <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                    Flights are usually booked separately so students can travel from different cities across Australia and choose the flights that work best for their group. More details about travel planning will be provided during the booking process.
                                </div>
                            </div>
                        </details>
                        <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-[#1f5f46]">Can parents find information about the event?</span>
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                            </summary>
                            <div class="faq-answer">
                                <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                    Yes. We provide a dedicated Parent Information page that explains how the event is organised, safety considerations, and important details for families.
                                </div>
                            </div>
                        </details>
                        <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                <span class="text-base font-semibold text-[#1f5f46]">Where can I find full details about Schoolies Bali 2026?</span>
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                            </summary>
                            <div class="faq-answer">
                                <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                    You can explore the full event information, updates, and announcements on the Schoolies Bali 2026 page, where all the latest details will be shared.
                                </div>
                            </div>
                        </details>
                    </div>
                </section>

                <section class="rounded-[24px] border border-[#dcece7] bg-white p-6 text-center shadow-[0_10px_26px_rgba(16,24,40,0.06)]">
                    <p class="text-sm leading-relaxed text-[#4c5f59]">Schoolies Bali 2026 is organised in partnership with Love Link Weddings &amp; Events</p>
                    <p class="mt-2 text-sm text-[#4c5f59]">Our Instagram: <a href="https://www.instagram.com/lovelink_weddings" target="_blank" rel="noopener" class="font-semibold text-[#0f766e] hover:text-[#0b5d56]">@lovelink_weddings</a></p>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
