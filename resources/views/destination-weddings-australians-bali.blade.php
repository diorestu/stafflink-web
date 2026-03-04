<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Destination Weddings for Australians in Bali',
        'seoDescription' => 'Plan a seamless Bali destination wedding for Australian couples with structured coordination, vendor control, and premium guest experience support.',
        'seoKeywords' => 'destination wedding bali for australians, bali wedding planner australian couples, wedding organizer bali australia',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-parisienne { font-family: "Parisienne", cursive; }
        .script-accent { color: #c7922d; }
        .hero-video-wrap { position: relative; overflow: hidden; }
        .hero-video-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body class="bg-[#e9e9e9] text-[#708868]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen">
        <x-site-header />

        <main class="px-5 pb-20 pt-8 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-10">
                <header class="space-y-5">
                    <div class="flex items-start justify-between gap-4">
                        <p class="text-3xl font-semibold tracking-tight sm:text-4xl">Destination Weddings</p>
                        <p class="hidden text-right text-2xl font-light uppercase tracking-[0.12em] text-[#5b5e63] sm:block">Australia to Bali</p>
                    </div>
                    <div class="hero-video-wrap rounded-tr-[22px] rounded-br-[140px] rounded-tl-[22px] rounded-bl-[22px]">
                        <div class="h-[360px] w-full sm:h-[520px] lg:h-[620px]">
                            <video class="hero-video-bg" autoplay muted loop playsinline preload="metadata">
                                <source src="https://atelierhouseofevents.com/wp-content/uploads/2025/06/Website-Video_19.06.25.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </header>

                <section class="grid gap-8 lg:grid-cols-[1fr_0.9fr]">
                    <div>
                        <h1 class="text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">Destination Weddings for Australians Getting Married in Bali</h1>
                        <p class="mt-5 max-w-3xl text-base leading-relaxed text-[#2d2f33]">
                            Bali weddings should feel magical, not overwhelming. At Staff Link, we support Australian couples with structured destination wedding planning that combines creative vision, budget clarity, and flawless on-day execution.
                        </p>
                        <div class="mt-7 flex flex-wrap gap-3">
                            <a href="{{ route('appointments.create') }}" class="inline-flex rounded-none border-2 border-[#708868] bg-[#708868] px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#708868]">Book a Wedding Consultation with Us</a>
                            <a href="{{ route('contact') }}" class="inline-flex rounded-none border-2 border-[#708868] px-6 py-3 text-sm font-semibold text-[#708868] transition hover:bg-[#708868] hover:text-white">Contact Our Wedding Team</a>
                        </div>
                    </div>
                    <div class="grid gap-5 self-start border-l-0 border-[#708868]/15 pl-0 lg:border-l lg:pl-8">
                        <article>
                            <p class="script-accent text-center text-3xl leading-none">•</p>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Concept &amp; Timeline</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">A clear roadmap aligned to your vision, budget, and event milestones.</p>
                        </article>
                        <article>
                            <p class="script-accent text-center text-3xl leading-none">•</p>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Vendor Coordination</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Disciplined vendor delivery with transparent contracts and timelines.</p>
                        </article>
                        <article>
                            <p class="script-accent text-center text-3xl leading-none">•</p>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Guest Logistics</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Smooth travel, flow, and hospitality support for family and friends.</p>
                        </article>
                        <article>
                            <p class="script-accent text-center text-3xl leading-none">•</p>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Remote Planning</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Structured Australia-to-Bali coordination so distance never limits quality.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6 rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Wedding Planners in Bali for Australian Couples - Turning Vision into Reality</h2>
                    <p class="text-base leading-relaxed text-[#2f3136]">
                        Our Bali wedding planners work closely with Australian couples to transform ideas into a practical, high-performing execution plan. From concept to vendor strategy, we align every phase around quality, cost control, and timeline precision.
                    </p>
                    <div class="grid gap-4 md:grid-cols-2">
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Concept and Timeline Planning</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">A complete wedding roadmap from pre-arrival planning to post-event close, with clear milestones and dependencies.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Vendor and Contract Coordination</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Structured vendor management, contract control, and payment discipline to protect quality and budget.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Guest and Logistics Management</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Guest travel flow, accommodation touchpoints, and event-day hospitality coordination for a smooth experience.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">On-Day Execution Control</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Behind-the-scenes command of timelines and suppliers, so you can be fully present on your wedding day.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <article class="rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight">Australia to Bali Coordination</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">Planning from Australia should never compromise quality in Bali. We provide structured remote coordination, clear communication cadence, and transparent planning updates.</p>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">You receive one coordinated planning experience with local Bali execution standards and international-level professionalism.</p>
                    </article>
                    <article class="rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight">Child-Friendly Guest Experience</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">For family-inclusive celebrations, we coordinate optional childcare support including nanny staffing plans, supervised activity zones, and curated experiences for young guests.</p>
                        <h3 class="mt-4 text-lg font-semibold">Professional Nanny Support</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Vetted nanny professionals matched by guest count, children age groups, and venue requirements.</p>
                        <h3 class="mt-4 text-lg font-semibold">Children's Activity Coordination</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Elegant white bouncy castles and professionally managed face-painting sessions in supervised zones.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('forms.nannies-inquiry') }}" class="inline-flex rounded-none border-2 border-[#708868] bg-[#708868] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#708868]">Open Nanny Inquiry Form</a>
                            <a href="{{ route('contact') }}" class="inline-flex rounded-none border-2 border-[#708868] px-5 py-2.5 text-sm font-semibold text-[#708868] transition hover:bg-[#708868] hover:text-white">Ask Our Team First</a>
                        </div>
                    </article>
                </section>

                <section class="rounded-[20px] bg-[#708868] p-8 text-white lg:p-10">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">Destination Wedding Consultation</p>
                    <h2 class="mt-3 text-3xl font-semibold leading-tight">Plan Your Australian-Bali Wedding with Confidence</h2>
                    <p class="mt-3 max-w-4xl text-sm leading-relaxed text-white/85">Start with a structured consultation to align budget, venue, guest profile, and execution requirements. We will recommend the right coordination model for a premium, seamless Bali destination wedding.</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="inline-flex rounded-none border-2 border-white bg-white px-6 py-3 text-sm font-semibold text-[#708868] transition hover:bg-transparent hover:text-white">Contact Us</a>
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-none border-2 border-white px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#708868]">Book a Consultation with Us</a>
                    </div>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
