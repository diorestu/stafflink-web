<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Bali Relocation Support',
        'seoDescription' => 'Structured relocation support in Bali for retirees, families, business owners, and international professionals who need operational stability from day one.',
        'seoKeywords' => 'bali relocation support, move to bali, relocation consultation bali, bali integration support',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f3f1ea] text-[#1f2a24]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen">
        <x-site-header />

        <main class="px-5 pb-20 pt-8 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-8">
                <section class="overflow-hidden rounded-[28px] bg-[linear-gradient(135deg,#1f5f46_0%,#2f7b5b_58%,#d4b466_100%)] px-7 py-10 text-white shadow-[0_20px_60px_rgba(31,95,70,0.18)] lg:px-10 lg:py-14">
                    <div class="grid gap-8 lg:grid-cols-[1.25fr_0.75fr] lg:items-end">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70">Featured Service</p>
                            <h1 class="mt-4 max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">Bali Relocation Support</h1>
                            <p class="mt-5 max-w-3xl text-base leading-relaxed text-white/88 sm:text-lg">
                                Relocation should feel intentional, not experimental. We help you secure the right environment, install the right systems, and stabilise life in Bali with structure, discretion, and operational control.
                            </p>
                            <div class="mt-7 flex flex-wrap gap-3">
                                <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full border-2 border-white bg-white px-6 py-3 text-sm font-semibold text-[#1f5f46] transition hover:bg-transparent hover:text-white">Schedule a Private Consultation</a>
                                <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#1f5f46]">Contact Us Directly</a>
                            </div>
                        </div>
                        <div class="grid gap-4 rounded-[24px] bg-white/10 p-5 backdrop-blur-sm">
                            <div class="rounded-[20px] border border-white/15 bg-black/10 px-5 py-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-white/70">Property & Setup</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/90">Lifestyle alignment, area suitability, property coordination, and household system design.</p>
                            </div>
                            <div class="rounded-[20px] border border-white/15 bg-black/10 px-5 py-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-white/70">30-Day Stability</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/90">A structured arrival framework that moves you from uncertainty to control.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Property & Environment Alignment</h2>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">The objective is not just to find a villa, but to secure an environment that supports your rhythm of life.</p>
                        <ul class="mt-6 space-y-3 text-sm leading-relaxed text-[#25332d]">
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Lifestyle alignment</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Area suitability and risk assessment</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Long-term comfort evaluation</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Discreet property coordination</li>
                        </ul>
                    </article>

                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Operational Setup & Infrastructure Installation</h2>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">Successful relocation requires systems.</p>
                        <h3 class="mt-6 text-lg font-semibold text-[#1f5f46]">We structure:</h3>
                        <ul class="mt-4 space-y-3 text-sm leading-relaxed text-[#25332d]">
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Banking and payment access</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Communication and digital platforms</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Vendor verification and pricing alignment</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Logistics and address configuration</li>
                            <li class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-3">Household staffing coordination</li>
                        </ul>
                        <p class="mt-5 text-sm leading-relaxed text-[#46534d]">This is preventative architecture, not reactive troubleshooting.</p>
                    </article>
                </section>

                <section class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">30-Day Stabilisation Framework</h2>
                    <p class="mt-4 max-w-4xl text-base leading-relaxed text-[#46534d]">
                        The first 30 days determine long-term stability. Our structured framework ensures clarity, coordination, and operational control from arrival.
                    </p>
                    <div class="mt-8 grid gap-4 lg:grid-cols-3">
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Week 1 - Environmental Alignment</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Immediate functionality: property assessment, utilities setup, and essential vendor verification.</p>
                        </article>
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Week 2-3 - Infrastructure Installation</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Banking optimisation, staffing placement, healthcare alignment, and contract guidance.</p>
                        </article>
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Week 4 - Integration & Stability</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Cultural orientation, network access, and long-term system review.</p>
                        </article>
                    </div>
                    <p class="mt-6 text-sm font-medium text-[#173a2b]">By Day 30, you move from new arrival to operationally stable resident.</p>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Lifestyle & Household Infrastructure</h2>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">We coordinate trusted suppliers, domestic staff, wellness practitioners, and emergency response frameworks, eliminating trial-and-error decision-making.</p>
                    </article>
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Cultural & Social Integration</h2>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">Structured introductions, cultural guidance, and access to established networks reduce dependency and accelerate belonging.</p>
                    </article>
                </section>

                <section class="grid gap-6 lg:grid-cols-[1fr_0.9fr]">
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Engagement Models</h2>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">We deliver support through:</p>
                        <div class="mt-6 grid gap-4">
                            <article class="rounded-[20px] border border-[#e3ebe6] bg-[#f9fbfa] p-5">
                                <h3 class="text-lg font-semibold text-[#1f5f46]">Strategic Consultation</h3>
                                <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Private advisory before relocation.</p>
                            </article>
                            <article class="rounded-[20px] border border-[#e3ebe6] bg-[#f9fbfa] p-5">
                                <h3 class="text-lg font-semibold text-[#1f5f46]">Integration Intensive</h3>
                                <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Focused in-person stabilisation.</p>
                            </article>
                            <article class="rounded-[20px] border border-[#e3ebe6] bg-[#f9fbfa] p-5">
                                <h3 class="text-lg font-semibold text-[#1f5f46]">Dedicated Integration Partner</h3>
                                <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Ongoing monthly oversight.</p>
                            </article>
                        </div>
                        <p class="mt-5 text-sm leading-relaxed text-[#46534d]">Each engagement is scope-defined and discreet.</p>
                    </article>

                    <article class="rounded-[24px] border border-[#d7c18a] bg-[#fff9ea] p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Designed For</h2>
                        <div class="mt-6 grid gap-3">
                            <h3 class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Retirees relocating long-term</h3>
                            <h3 class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">International families</h3>
                            <h3 class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Business owners establishing presence</h3>
                            <h3 class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">High-net-worth individuals</h3>
                            <h3 class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Remote professionals</h3>
                        </div>
                        <p class="mt-6 text-base font-semibold text-[#173a2b]">This is not tourism support.</p>
                        <p class="mt-2 text-base font-semibold text-[#173a2b]">It is structured relocation.</p>
                    </article>
                </section>

                <section class="rounded-[28px] bg-[#173a2b] px-7 py-9 text-white shadow-[0_20px_50px_rgba(23,58,43,0.2)] lg:px-10 lg:py-11">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/65">Begin with Control</p>
                    <h2 class="mt-3 text-3xl font-semibold leading-tight sm:text-4xl">Relocation should feel intentional, not experimental.</h2>
                    <p class="mt-4 max-w-4xl text-base leading-relaxed text-white/82">Schedule a private consultation to discuss your transition to Bali.</p>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full border-2 border-[#d4b466] bg-[#d4b466] px-6 py-3 text-sm font-semibold text-[#173a2b] transition hover:bg-transparent hover:text-[#d4b466]">Schedule a Private Consultation</a>
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#173a2b]">Send an Inquiry</a>
                    </div>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
