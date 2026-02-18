<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - Who We Are</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Google+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-8 pb-28 pt-14 lg:px-10">
            <section class="mx-auto max-w-7xl space-y-20">
                <div class="overflow-hidden rounded-[32px] bg-[#dceae3] shadow-[0_20px_60px_rgba(31,95,70,0.16)]" data-aos="fade-up">
                    <div class="grid gap-12 p-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:p-14">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Who We Are</p>
                            <h1 class="mt-5 text-4xl font-semibold leading-tight text-[#1b1b18] md:text-5xl">
                                Your Global Talent
                                <br>
                                Outsourcing Partner
                            </h1>
                            <p class="mt-6 max-w-2xl text-sm leading-relaxed text-[#3f3f3a]">
                                StaffLink Solutions delivers practical, reliable staffing support to businesses that need strong teams fast.
                                We focus on quality hiring, consistent communication, and long-term partnerships that help you scale with confidence.
                            </p>
                            <a href="{{ route('appointments.create') }}"
                                class="mt-8 inline-flex rounded-full bg-[#287854] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">
                                Book a free consultation
                            </a>
                        </div>
                        <div class="flex items-end justify-center lg:justify-end">
                            <img src="{{ asset('images/single_img.png') }}" alt="StaffLink Team"
                                class="h-80 w-auto rounded-3xl bg-white/40 object-cover p-2 shadow-[0_10px_30px_rgba(31,95,70,0.2)]" draggable="false" />
                        </div>
                    </div>
                </div>

                <div class="grid gap-8 md:grid-cols-2" data-aos="fade-up">
                    <article class="rounded-[28px] bg-white p-10 shadow-[0_18px_44px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Our Mission</p>
                        <h2 class="mt-4 text-3xl font-semibold text-[#1b1b18]">Exceptional Talent for Unique Needs</h2>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            We connect businesses with skilled professionals through a process that is fast, transparent, and tailored
                            to each role. Every placement is guided by fit, performance, and long-term success.
                        </p>
                    </article>
                    <article class="rounded-[28px] bg-[#1f5f46] p-10 text-white shadow-[0_18px_44px_rgba(31,95,70,0.2)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Our Promise</p>
                        <h2 class="mt-4 text-3xl font-semibold">Reliable People. Real Results.</h2>
                        <p class="mt-4 text-sm leading-relaxed text-white/85">
                            From initial screening to post-placement follow-up, we stay involved to keep quality high and onboarding smooth.
                            Your team gets the right people, ready to contribute from day one.
                        </p>
                    </article>
                </div>

                <section class="rounded-[30px] bg-[#287854] px-10 py-12 text-white shadow-[0_18px_48px_rgba(31,95,70,0.22)] lg:px-12 lg:py-14" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Our Team Values</p>
                    <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-xl font-semibold">Responsibility</h3>
                            <p class="mt-2 text-sm text-white/80">We own every commitment and execute with accountability.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-xl font-semibold">Unity</h3>
                            <p class="mt-2 text-sm text-white/80">We work as one team with clients and candidates.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-xl font-semibold">Mindfulness</h3>
                            <p class="mt-2 text-sm text-white/80">We listen closely and adapt solutions to real needs.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-xl font-semibold">Impact</h3>
                            <p class="mt-2 text-sm text-white/80">We measure success by outcomes that move your business forward.</p>
                        </article>
                    </div>
                </section>

                <section data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Our Culture</p>
                    <h2 class="mt-4 text-3xl font-semibold text-[#1b1b18]">A Happy Team is a High-Performing Team</h2>
                    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                        <article class="rounded-2xl border border-[#d9e3dc] bg-white p-7 shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                            <h3 class="text-lg font-semibold text-[#1b1b18]">Team Activities</h3>
                            <p class="mt-3 text-sm text-[#6b6b66]">Regular team bonding and shared moments that strengthen collaboration.</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] bg-[#b28b2e] p-7 text-white shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                            <h3 class="text-lg font-semibold">Celebrating Milestones</h3>
                            <p class="mt-3 text-sm text-white/90">We recognize wins and progress to keep morale and momentum high.</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] bg-[#2b89b5] p-7 text-white shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                            <h3 class="text-lg font-semibold">Learning &amp; Development</h3>
                            <p class="mt-3 text-sm text-white/90">Continuous upskilling keeps our teams adaptive and future-ready.</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] bg-[#287854] p-7 text-white shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                            <h3 class="text-lg font-semibold">Stronger Connections</h3>
                            <p class="mt-3 text-sm text-white/90">Healthy relationships create better delivery and better results.</p>
                        </article>
                    </div>
                </section>

                <section class="rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:p-12" data-aos="fade-up">
                    <div class="grid gap-8 md:grid-cols-[1fr_auto] md:items-center">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Let’s Build Your Team</p>
                            <h2 class="mt-3 text-3xl font-semibold text-[#1b1b18]">Scale your business with trusted talent</h2>
                            <p class="mt-3 text-sm text-[#6b6b66]">
                                Tell us what role you need, and we will prepare a shortlisting strategy aligned to your timeline and budget.
                            </p>
                        </div>
                        <a href="{{ route('contact') }}"
                            class="inline-flex rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                            Talk to our team
                        </a>
                    </div>
                </section>
            </section>
        </main>
        <x-site-footer />
    </div>
    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3" data-aos="fade-up">
        <button
            type="button"
            class="flex h-12 w-12 items-center justify-center rounded-full border border-[#b28b2e] bg-white text-[#b28b2e] shadow-lg transition hover:bg-[#b28b2e] hover:text-white"
            data-scroll-top
            aria-label="Move to top"
        >
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path d="M12 19V5" />
                <path d="M6 11l6-6 6 6" />
            </svg>
        </button>
        <a
            href="https://wa.me/6285739660906"
            class="group relative flex h-14 w-14 items-center justify-center overflow-visible rounded-full bg-transparent transition"
            aria-label="WhatsApp Chat"
        >
            <img src="{{ asset('images/512px-WhatsApp.svg.webp') }}" alt="WhatsApp" class="h-[3.6rem] w-[3.6rem]" draggable="false" />
            <span class="pointer-events-none absolute right-full mr-3 flex items-center gap-2 whitespace-nowrap rounded-full bg-[#287854] px-4 py-2 text-[11px] font-semibold tracking-tight text-white shadow-lg opacity-0 transition duration-300 ease-out translate-x-6 scale-x-105 origin-right group-hover:translate-x-0 group-hover:opacity-100">
                Click here to chat
            </span>
        </a>
    </div>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</body>
</html>
