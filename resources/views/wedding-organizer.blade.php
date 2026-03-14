<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://atelierhouseofevents.com" crossorigin>
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
    @php
        $heroVideos = [
            'https://atelierhouseofevents.com/wp-content/uploads/2025/06/Website-Video_19.06.25.mp4',
            asset('images/wedding_hero.mp4'),
        ];
    @endphp
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
                            <div class="relative h-full w-full" data-hero-carousel data-videos='@json($heroVideos)'>
                                <video
                                    class="hero-video-bg"
                                    data-hero-video
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                    preload="metadata"
                                    poster="{{ asset('images/hero-bg.webp') }}">
                                    <source src="{{ $heroVideos[0] ?? '' }}" type="video/mp4">
                                </video>
                                <div class="absolute right-4 top-4 z-10">
                                    <button
                                        type="button"
                                        data-video-sound-toggle
                                        aria-pressed="false"
                                        class="inline-flex items-center gap-2 rounded-full border border-white/40 bg-black/35 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm transition hover:bg-black/50">
                                        <x-ui-icon name="headset" class="h-4 w-4" />
                                        <span data-video-sound-label>Sound off</span>
                                    </button>
                                </div>
                                @if (count($heroVideos) > 1)
                                    <div class="absolute inset-x-0 bottom-4 z-10 flex items-center justify-center gap-2">
                                        <div class="flex items-center gap-2" data-hero-dots></div>
                                    </div>
                                @endif
                            </div>
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
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">A clear roadmap aligned to your vision, budget, and event milestones.</p>
                        </article>
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Vendor Coordination</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Disciplined vendor delivery with transparent contracts and timelines.</p>
                        </article>
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">Guest Logistics</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Smooth guest flow, hospitality support, and event-day coordination.</p>
                        </article>
                        <article>
                            <h3 class="font-parisienne script-accent text-center text-[2.05rem] leading-tight">On-Day Control</h3>
                            <p class="mt-1 text-center text-sm text-[#3c3f44]">Behind-the-scenes command so you can stay fully present and enjoy the day.</p>
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
                            <h3 class="text-xl font-semibold">Wedding Organizers &amp; Wedding Planners in Bali - Concept and Timeline Planning</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali define your event flow, guest journey, and milestone timeline to ensure disciplined planning from preparation through post-event wrap-up.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">We shape your vision into a seamless sequence of moments that unfold naturally and beautifully.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Wedding Organizers &amp; Wedding Planners in Bali - Vendor and Contract Coordination</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali manage vendor negotiations, contracts, and payment schedules to protect your budget and maintain operational clarity.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">Let us take care of the details and ensure everything is handled properly so you can relax, enjoy, and celebrate every moment stress-free, full of smiles and love.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Wedding Organizers &amp; Wedding Planners in Bali - Guest and Logistics Management</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali curate guest flow, comfort, and hospitality so every attendee feels part of an unforgettable celebration.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">We create an atmosphere where your family and friends feel welcomed, supported, and fully present on your special day.</p>
                        </article>
                        <article class="border border-[#708868]/20 bg-[#fafafa] p-5">
                            <h3 class="text-xl font-semibold">Wedding Organizers &amp; Wedding Planners in Bali - On-Day Execution Control</h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali manage every moving part behind the scenes, allowing you to stay present, confident, and fully immersed in your special day.</p>
                            <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">While we oversee the coordination, you simply embrace the joy of the moment.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6">
                    <article class="rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight">Wedding Organizers &amp; Wedding Planners in Bali - Destination Wedding Coordination</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali manage cross-border planning, structured communication, and remote coordination for international couples choosing Bali.</p>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">We guide you with clarity and reassurance throughout the process, ensuring distance never limits the wedding experience you envision.</p>
                    </article>
                    <article class="rounded-[20px] bg-white p-7 shadow-[0_12px_30px_rgba(0,0,0,0.06)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight">Wedding Organizers &amp; Wedding Planners in Bali - Child-Friendly Guest Experience Coordination</h2>
                        <p class="mt-3 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali design structured child-friendly experiences as an optional add-on to support families attending your celebration. We prepare a dedicated guest list for attendees requiring nanny assistance, coordinate supervised children’s activity areas, and arrange refined entertainment elements such as elegant white bouncy castles and professionally managed face-painting sessions, ensuring young guests are engaged while adults celebrate with complete peace of mind.</p>
                        <h3 class="mt-4 text-lg font-semibold">Wedding Organizers &amp; Wedding Planners in Bali - Professional Nanny Support</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali match experienced and vetted nanny professionals based on guest count, age groups, and venue requirements to provide reliable supervision and structured childcare coverage throughout the event.</p>
                        <h3 class="mt-4 text-lg font-semibold">Wedding Organizers &amp; Wedding Planners in Bali - Children’s Activity Coordination</h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#4b4f55]">At Staff Link, our Wedding Organizers &amp; Wedding Planners in Bali coordinate supervised entertainment areas, including elegant white bouncy castles and professionally managed face-painting sessions, to ensure young guests are safely engaged in a dedicated environment during the celebration.</p>
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
    @once
        <script>
            (() => {
                const SOUND_PREFERENCE_KEY = 'stafflink:hero-video-sound';
                const carousels = document.querySelectorAll('[data-hero-carousel]');

                carousels.forEach((carousel) => {
                    const video = carousel.querySelector('[data-hero-video]');
                    if (!video) return;

                    video.playsInline = true;

                    let videos = [];
                    try {
                        videos = JSON.parse(carousel.getAttribute('data-videos') || '[]');
                    } catch (_e) {
                        videos = [];
                    }
                    videos = videos.filter(Boolean);

                    const dotsWrap = carousel.querySelector('[data-hero-dots]');
                    const soundToggle = carousel.querySelector('[data-video-sound-toggle]');
                    const soundLabel = carousel.querySelector('[data-video-sound-label]');
                    let index = 0;
                    let timer = null;
                    let isVisible = true;

                    const playSafely = async () => {
                        try {
                            await video.play();
                            return true;
                        } catch (_e) {
                            return false;
                        }
                    };

                    const updateSoundUi = () => {
                        if (!soundToggle || !soundLabel) return;
                        const soundOn = !video.muted;
                        soundToggle.setAttribute('aria-pressed', soundOn ? 'true' : 'false');
                        soundLabel.textContent = soundOn ? 'Sound on' : 'Sound off';
                    };

                    const playUsingPreference = async () => {
                        const preference = localStorage.getItem(SOUND_PREFERENCE_KEY);
                        const shouldTrySound = preference === 'on' || preference === null;

                        if (shouldTrySound) {
                            video.muted = false;
                            video.volume = 1;
                            const startedWithSound = await playSafely();
                            if (startedWithSound) {
                                updateSoundUi();
                                return;
                            }
                        }

                        video.muted = true;
                        await playSafely();
                        updateSoundUi();
                    };

                    const renderDots = () => {
                        if (!dotsWrap) return;
                        dotsWrap.innerHTML = '';
                        videos.forEach((_, i) => {
                            const dot = document.createElement('button');
                            dot.type = 'button';
                            dot.className = i === index
                                ? 'h-2.5 w-2.5 rounded-full bg-white'
                                : 'h-2.5 w-2.5 rounded-full bg-white/45';
                            dot.addEventListener('click', () => {
                                setIndex(i);
                                restartTimer();
                            });
                            dotsWrap.appendChild(dot);
                        });
                    };

                    const setIndex = async (nextIndex) => {
                        index = (nextIndex + videos.length) % videos.length;
                        const nextSrc = videos[index];
                        if (nextSrc && video.currentSrc !== nextSrc) {
                            video.src = nextSrc;
                            video.load();
                        }
                        await playUsingPreference();
                        renderDots();
                    };

                    const restartTimer = () => {
                        if (timer) clearInterval(timer);
                        if (videos.length <= 1 || !isVisible) return;
                        timer = setInterval(() => setIndex(index + 1), 10000);
                    };

                    const stopTimer = () => {
                        if (!timer) return;
                        clearInterval(timer);
                        timer = null;
                    };

                    if (soundToggle) {
                        soundToggle.addEventListener('click', async () => {
                            const shouldEnableSound = video.muted;
                            video.muted = !shouldEnableSound;
                            if (shouldEnableSound) {
                                video.volume = 1;
                            }
                            localStorage.setItem(SOUND_PREFERENCE_KEY, shouldEnableSound ? 'on' : 'off');
                            await playSafely();
                            updateSoundUi();
                        });
                    }

                    renderDots();
                    playUsingPreference();
                    restartTimer();

                    if ('IntersectionObserver' in window) {
                        const observer = new IntersectionObserver((entries) => {
                            isVisible = !!entries[0]?.isIntersecting;
                            if (!isVisible) {
                                video.pause();
                                stopTimer();
                                return;
                            }

                            playUsingPreference();
                            restartTimer();
                        }, { threshold: 0.25 });
                        observer.observe(carousel);
                    }

                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            video.pause();
                            stopTimer();
                            return;
                        }

                        if (isVisible) {
                            playUsingPreference();
                            restartTimer();
                        }
                    });
                });
            })();
        </script>
    @endonce
</body>
</html>
