<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - Our People, Your Dream Team</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">

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
                <section class="overflow-hidden rounded-[32px] bg-[#2f8b62] px-10 py-12 text-white shadow-[0_20px_60px_rgba(31,95,70,0.2)] lg:px-14 lg:py-16" data-aos="fade-up">
                    <div class="grid gap-10 lg:grid-cols-[1fr_0.9fr] lg:items-start">
                        <div>
                            <h1 class="text-4xl font-semibold leading-tight md:text-5xl">Meet Your Team</h1>
                            <p class="mt-5 max-w-xl text-sm leading-relaxed text-white/90">
                                Business growth starts with strong people. We build dedicated offshore teams that align with your goals,
                                your company culture, and your quality standards.
                            </p>
                            <p class="mt-4 max-w-xl text-sm leading-relaxed text-white/90">
                                Our team sourcing process is transparent, efficient, and designed to deliver high-performing talent
                                for long-term impact.
                            </p>
                            <a href="{{ route('appointments.create') }}"
                                class="mt-8 inline-flex rounded-full bg-[#b28b2e] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                                Book a free consultation call
                            </a>
                        </div>
                        <div class="flex justify-center lg:justify-end">
                            <img src="{{ asset('images/img_hero.webp') }}" alt="Professional team discussion"
                                class="h-[280px] w-full max-w-md rounded-2xl object-cover shadow-[0_14px_30px_rgba(0,0,0,0.2)]" draggable="false" />
                        </div>
                    </div>
                </section>

                <section class="grid gap-10 lg:grid-cols-2 lg:items-center" data-aos="fade-up">
                    <div>
                        <img src="{{ asset('images/img_hero.webp') }}" alt="Talent acquisition team"
                            class="h-[300px] w-full rounded-2xl object-cover shadow-[0_14px_30px_rgba(31,95,70,0.14)]" draggable="false" />
                    </div>
                    <article class="rounded-[28px] bg-white p-10 shadow-[0_18px_44px_rgba(31,95,70,0.12)]">
                        <h2 class="text-3xl font-semibold text-[#1b1b18]">Talent Acquisition for Future-Ready Businesses</h2>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            Staffing needs evolve quickly. We help you stay ahead by matching you with professionals who are ready
                            to perform and adapt as your business scales.
                        </p>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            From sourcing and screening to onboarding support, our approach is built for speed, quality, and continuity.
                        </p>
                        <a href="{{ route('contact') }}"
                            class="mt-7 inline-flex rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                            Get started
                        </a>
                    </article>
                </section>

                <section class="grid gap-10 lg:grid-cols-2 lg:items-center" data-aos="fade-up">
                    <article class="rounded-[28px] bg-white p-10 shadow-[0_18px_44px_rgba(31,95,70,0.12)]">
                        <h2 class="text-3xl font-semibold text-[#1b1b18]">You're in good hands.</h2>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            We understand that trust and reliability are critical when building offshore capability.
                            Our people-first model ensures every team member is supported, engaged, and set up to deliver.
                        </p>
                        <a href="{{ route('appointments.create') }}"
                            class="mt-7 inline-flex rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                            Book a free consultation call
                        </a>
                    </article>
                    <div>
                        <img src="{{ asset('images/single_img.png') }}" alt="StaffLink team members"
                            class="h-[330px] w-full rounded-2xl object-cover shadow-[0_14px_30px_rgba(31,95,70,0.14)]" draggable="false" />
                    </div>
                </section>

                <section class="rounded-[32px] bg-[#2f8b62] px-10 py-12 text-white shadow-[0_20px_60px_rgba(31,95,70,0.2)] lg:px-14 lg:py-16" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">For Indonesia professionals: We are still hiring!</p>
                    <h2 class="mt-4 text-4xl font-semibold leading-tight">Build Your Career With Us</h2>
                    <p class="mt-4 max-w-4xl text-sm leading-relaxed text-white/90">
                        Join a high-performing team and unlock opportunities to work with global businesses.
                        We provide growth pathways, modern workspaces, and strong support to help you do your best work.
                    </p>
                    <ul class="mt-6 list-disc space-y-3 pl-5 text-sm leading-relaxed text-white/90">
                        <li>Flexible roles aligned to your strengths and career goals.</li>
                        <li>Professional development and mentorship from experienced leaders.</li>
                        <li>A collaborative culture that values impact, integrity, and excellence.</li>
                    </ul>
                </section>

                <section class="rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:p-12" data-aos="fade-up">
                    <div class="grid gap-8 lg:grid-cols-[1fr_1.1fr]">
                        <div>
                            <h3 class="text-3xl font-semibold text-[#1b1b18]">Scale your business to new heights today</h3>
                            <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                                Share your requirements and we will map the right team structure, timeline, and budget.
                                Our team will guide you from planning to launch.
                            </p>
                            <div class="mt-6 space-y-2 text-sm text-[#2e2e2e]">
                                <p>info@stafflink.pro</p>
                                <p>+6285739660906</p>
                                <p>Seminyak, Bali</p>
                            </div>
                        </div>
                        <form class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Full name</label>
                                <input type="text" class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Business Email</label>
                                <input type="email" class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Contact Number</label>
                                <input type="text" class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Company Name</label>
                                <input type="text" class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Company Size</label>
                                <select class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option>1-10 Employees</option>
                                    <option>11-50 Employees</option>
                                    <option>51-200 Employees</option>
                                    <option>201-500 Employees</option>
                                    <option>500+ Employees</option>
                                </select>
                            </div>
                            <div class="sm:col-span-2">
                                <button type="submit"
                                    class="mt-2 w-full rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                                    Submit
                                </button>
                            </div>
                        </form>
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
