<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Airport Baggage Drop Off',
        'seoDescription' => 'Baggage drop off from airport to your hotel, with luggage collection, storage, and on-demand delivery while you are on the go.',
        'seoKeywords' => 'airport baggage drop off, luggage transfer, luggage storage, airport service bali',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-[#2e2e2e]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />

        <main class="px-6 pb-20 pt-12 lg:px-10">
            <section class="mx-auto max-w-5xl space-y-8">
                <header class="rounded-[28px] bg-[#1f5f46] p-8 text-white shadow-[0_20px_60px_rgba(31,95,70,0.3)] lg:p-12">
                    <p class="inline-flex items-center rounded-full border border-[#f0dba8] bg-[#f0dba8]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-[#f0dba8]">Airport Services</p>
                    <h1 class="mt-4 text-3xl font-semibold leading-tight lg:text-5xl">Baggage Drop Off</h1>
                    <p class="mt-5 max-w-3xl text-sm italic leading-relaxed text-white/90">
                        Arriving in Bali and want to go straight to your plans? We collect your luggage at the airport and deliver it directly to your hotel. If you are on the go, we can also collect, store, and bring your bags to you when and where you need them.
                    </p>
                    <div class="mt-7 flex flex-wrap items-center justify-start gap-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full bg-[#f0dba8] px-5 py-2.5 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#e5cc8a]">Book Airport Baggage Service</a>
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border border-white/40 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">Talk to Our Team</a>
                    </div>
                </header>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">How It Works</h2>
                    <div class="mt-4 grid gap-4 md:grid-cols-3">
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">1. Airport Pickup</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Our team receives your luggage at the airport after your arrival.</p>
                        </article>
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">2. Safe Handling</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Your bags are securely handled and can be temporarily stored when needed.</p>
                        </article>
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">3. Flexible Delivery</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">We deliver your luggage to your hotel or your requested location and timing.</p>
                        </article>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Best For</h2>
                    <ul class="mt-4 list-disc space-y-2 pl-5 text-sm text-[#5a5a55]">
                        <li>Travelers who want to start activities immediately after landing</li>
                        <li>Guests waiting for hotel check-in time</li>
                        <li>Business travelers with back-to-back meetings</li>
                        <li>Families who need easier airport-to-hotel logistics</li>
                    </ul>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
