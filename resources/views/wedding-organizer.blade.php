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
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Wedding Organizer Services',
        'seoDescription' => 'Plan your special day with Staff Link wedding organizer services, from concept and vendor coordination to on-day execution in Bali.',
        'seoKeywords' => 'wedding organizer bali, wedding planning service, event coordination bali',
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
                        <p class="text-3xl font-semibold tracking-tight text-[#c7922d] sm:text-4xl">Wedding Services</p>
                        <p class="hidden text-right text-lg font-light uppercase tracking-[0.12em] text-[#5b5e63] sm:block">Staff Link Weddings</p>
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
                        <h1 class="text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">Wedding Organizers &amp; Wedding Planners in Bali</h1>
                        <p class="mt-5 max-w-3xl text-base leading-relaxed text-[#2d2f33]">
                            Premium weddings demand structure, financial discipline, and flawless execution. They should also feel effortless, meaningful, and unforgettable.
                            At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali transform your vision into a beautifully executed celebration where creativity meets disciplined planning, and every detail reflects your story with precision and care.
                        </p>
                        <div class="mt-7 flex flex-wrap gap-3">
                            <a href="{{ route('appointments.create') }}" class="inline-flex rounded-none border-2 border-[#708868] bg-[#708868] px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#708868]">Book a Wedding Consultation with Us</a>
                            <a href="{{ route('contact') }}" class="inline-flex rounded-none border-2 border-[#708868] px-6 py-3 text-sm font-semibold text-[#708868] transition hover:bg-[#708868] hover:text-white">Contact Our Wedding Team</a>
                        </div>
                    </div>
                    <div class="grid gap-5 self-start border-l-0 border-[#708868]/15 pl-0 lg:border-l lg:pl-8">
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Concept &amp; Timeline</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Structured milestone planning from pre-event prep to final wrap-up.</p>
                        </article>
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Vendor Coordination</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Clear contracts, payment schedules, and quality delivery controls.</p>
                        </article>
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Guest Logistics</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Comfort-first guest flow, hospitality, and on-site coordination.</p>
                        </article>
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">On-Day Control</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Seamless behind-the-scenes execution while you enjoy every moment.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6 rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Wedding Organizers &amp; Wedding Planners in Bali - Turning Vision into Reality</h2>
                    <p class="text-base leading-relaxed text-[#2f3136]">
                        At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali begin with your dream concept and translate it into a clear execution roadmap, balancing creativity, budget control, and seamless coordination.
                        We bring meaningful celebrations to life with structure behind every beautiful detail, ensuring your ideas evolve from inspiration into an unforgettable reality.
                    </p>
                    <div class="grid gap-4 md:grid-cols-2">
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Concept and Timeline Planning</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali define your event flow, guest journey, and milestone timeline to ensure disciplined planning from preparation through post-event wrap-up.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">We shape your vision into a seamless sequence of moments that unfold naturally and beautifully.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Vendor and Contract Coordination</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali manage vendor negotiations, contracts, and payment schedules to protect your budget and maintain operational clarity.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Let us take care of the details and ensure everything is handled properly so you can relax, enjoy, and celebrate every moment stress-free, full of smiles and love.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Guest and Logistics Management</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali curate guest flow, comfort, and hospitality so every attendee feels part of an unforgettable celebration.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">We create an atmosphere where your family and friends feel welcomed, supported, and fully present on your special day.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">On-Day Execution Control</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali manage every moving part behind the scenes, allowing you to stay present, confident, and fully immersed in your special day.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">While we oversee the coordination, you simply embrace the joy of the moment.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6">
                    <article class="rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight">Destination Wedding Coordination</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali manage cross-border planning, structured communication, and remote coordination for international couples choosing Bali.</p>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">We guide you with clarity and reassurance throughout the process, ensuring distance never limits the wedding experience you envision.</p>
                    </article>
                    <article class="rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight">Child-Friendly Guest Experience Coordination</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali design structured child-friendly experiences as an optional add-on to support families attending your celebration.</p>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">We prepare a dedicated guest list for attendees requiring nanny assistance, coordinate supervised children’s activity areas, and arrange elegant white bouncy castles with professionally managed face-painting sessions.</p>
                        <h3 class="mt-4 text-lg font-semibold">Professional Nanny Support</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Experienced and vetted nanny professionals matched by guest count, age groups, and venue requirements.</p>
                        <h3 class="mt-4 text-lg font-semibold">Children’s Activity Coordination</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Supervised entertainment areas designed so children are safely engaged in a dedicated environment throughout the celebration.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('forms.nannies-inquiry') }}" class="inline-flex rounded-none border-2 border-[#708868] bg-[#708868] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#708868]">Open Nanny Inquiry Form</a>
                            <a href="{{ route('contact') }}" class="inline-flex rounded-none border-2 border-[#708868] px-5 py-2.5 text-sm font-semibold text-[#708868] transition hover:bg-[#708868] hover:text-white">Ask Our Team First</a>
                        </div>
                    </article>
                </section>

                <section class="rounded-[20px] bg-[#708868] p-8 text-white lg:p-10">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">Service Consultation</p>
                    <h2 class="mt-3 text-3xl font-semibold leading-tight">Wedding Organizers &amp; Wedding Planners in Bali - Service Consultation</h2>
                    <p class="mt-3 max-w-4xl text-sm leading-relaxed text-white/85">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali begin with a structured consultation to assess your event scale, venue selection, budget framework, and execution requirements.</p>
                    <p class="mt-3 max-w-4xl text-sm leading-relaxed text-white/85">We recommend the appropriate coordination model to ensure premium standards, disciplined delivery, and a wedding experience that feels as exceptional as it looks.</p>
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
