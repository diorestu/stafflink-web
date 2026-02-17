<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - What We Offer</title>
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
                <div class="overflow-hidden rounded-[32px] bg-[#dceae3] shadow-[0_20px_60px_rgba(31,95,70,0.16)]" data-aos="fade-up">
                    <div class="grid gap-12 p-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:p-14">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">What We Offer</p>
                            <h1 class="mt-5 text-4xl font-semibold leading-tight text-[#1b1b18] md:text-5xl">
                                Stafflink: Revolutionising Global Talent Solutions
                            </h1>
                            <p class="mt-6 max-w-2xl text-sm leading-relaxed text-[#3f3f3a]">
                                The success of your business is our success. As we unlock the full potential of people, we help
                                enterprises grow. And when businesses flourish, we play an active part in building thriving, vibrant communities.
                            </p>
                            <p class="mt-4 max-w-2xl text-sm leading-relaxed text-[#3f3f3a]">
                                Let us kickstart that growth today.
                            </p>
                            <p class="mt-4 max-w-2xl text-sm leading-relaxed text-[#3f3f3a]">
                                Talk to us to discover how our high-performing talent pool can empower you to realise your firm's aspirations.
                            </p>
                            <a href="{{ route('appointments.create') }}"
                                class="mt-8 inline-flex rounded-full bg-[#287854] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">
                                Book a free consultation call
                            </a>
                        </div>
                        <div class="flex items-end justify-center lg:justify-end">
                            <img src="{{ asset('images/single_img.png') }}" alt="StaffLink Team"
                                class="h-80 w-auto rounded-3xl bg-white/40 object-cover p-2 shadow-[0_10px_30px_rgba(31,95,70,0.2)]" draggable="false" />
                        </div>
                    </div>
                </div>

                <section class="rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:p-12" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Elevate your business value</p>
                    <h2 class="mt-4 text-3xl font-semibold text-[#1b1b18]">Premium talent aligned to your standards</h2>
                    <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                        Enhance the value and efficiency of your firm by working with outsourced talents who can provide you with
                        the performance and quality of work you seek. Whether you need more time to focus on important matters or want
                        access to specialised skills and knowledge to bolster your business goals, our dedicated team members can deliver.
                    </p>
                    <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                        We offer premium talent that fits your company standards and culture across a range of roles, including accounting,
                        marketing, customer support, marketing creatives, administrative staff and more.
                    </p>
                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Accountants / CPAs</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Bookkeepers</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Virtual Assistants</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Virtual Administrators</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Virtual Receptionists</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Call Center Agents</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Web Chat / Live Chat Agents</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Web Designer</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Graphic Designer</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Copywriter</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Social Media Manager</div>
                        <div class="rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5 text-sm font-semibold text-[#1f5f46]">Remote IT Support / Assistance</div>
                    </div>
                </section>

                <section class="rounded-[30px] bg-[#287854] px-10 py-12 text-white shadow-[0_18px_48px_rgba(31,95,70,0.22)] lg:px-12 lg:py-14" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Know exactly how your business can benefit</p>
                    <h2 class="mt-4 text-3xl font-semibold">Cost-effective, reliable, and professional support</h2>
                    <p class="mt-4 text-sm leading-relaxed text-white/85">
                        Unlock a world of advantages, including cost-effective solutions, round-the-clock support and the assurance
                        of reliable and professional services.
                    </p>
                    <a href="{{ route('contact') }}"
                        class="mt-7 inline-flex rounded-full bg-[#b28b2e] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                        Get started
                    </a>
                </section>

                <div class="grid gap-8 md:grid-cols-2" data-aos="fade-up">
                    <article class="rounded-[28px] bg-white p-10 shadow-[0_18px_44px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Premium Support and Security</p>
                        <h3 class="mt-4 text-2xl font-semibold text-[#1b1b18]">Enhanced Systems and Security</h3>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            Experience the seamless operation of your remote team through our continually improving and developing technologies,
                            coupled with our stringent and top-notch security systems.
                        </p>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            We take pride in our high-quality systems to ensure quality control and the continuity of your business operations.
                        </p>
                        <a href="{{ route('contact') }}" class="mt-6 inline-flex text-sm font-semibold text-[#287854] hover:text-[#1f5f46]">Get started</a>
                    </article>
                    <article class="rounded-[28px] bg-[#1f5f46] p-10 text-white shadow-[0_18px_44px_rgba(31,95,70,0.2)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Development</p>
                        <h3 class="mt-4 text-2xl font-semibold">State-of-the-art platforms</h3>
                        <p class="mt-4 text-sm leading-relaxed text-white/85">
                            Our behind-the-scenes tech team are always pushing boundaries to develop and implement state-of-the-art platforms.
                        </p>
                        <p class="mt-4 text-sm leading-relaxed text-white/85">
                            We take pride in our systems to give you peace of mind that your job is completed in a timely manner,
                            whilst honouring the integrity of all things to do with safety and security.
                        </p>
                    </article>
                </div>

                <section data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Inspiring Workspaces</p>
                    <h2 class="mt-4 text-3xl font-semibold text-[#1b1b18]">Workplaces Designed for the Best</h2>
                    <p class="mt-4 max-w-4xl text-sm leading-relaxed text-[#6b6b66]">
                        Our purpose-built modern facilities are designed to promote productivity, while offering privacy and great acoustics
                        to perform a variety of roles. With our workspaces being incredibly generous and state-of-the-art, we ensure the comfort
                        and productivity of our hard-working team members.
                    </p>
                    <div class="mt-8 rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:p-12">
                        <h3 class="text-2xl font-semibold text-[#1b1b18]">Productivity Through Empowerment</h3>
                        <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                            Our office strategies focus on providing all the support team members need to do their most impressive work.
                        </p>
                        <ul class="mt-6 list-disc space-y-3 pl-5 text-sm leading-relaxed text-[#6b6b66]">
                            <li>Strategic deployment and delegation that cuts down commute time and gives employees the chance to build work-life balance.</li>
                            <li>Setting up systems that drive team collaborations, innovations and excellence.</li>
                            <li>A solid employee rewards and recognition strategy.</li>
                        </ul>
                    </div>
                </section>

                <section class="rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:p-12" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">On-Shore Local Support</p>
                    <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                        Our local on-the-ground experts possess in-depth knowledge of local markets.
                    </p>
                    <p class="mt-4 text-sm leading-relaxed text-[#6b6b66]">
                        Therefore, when you partner with us, you gain not only a dedicated team or team member for key roles in your business,
                        you also get an Account Manager on-shore committed to ensuring the success of your global team.
                    </p>
                    <a href="{{ route('contact') }}"
                        class="mt-7 inline-flex rounded-full bg-[#b28b2e] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                        Get started
                    </a>
                </section>

                <section class="rounded-[30px] bg-[#1f5f46] px-10 py-12 text-white shadow-[0_18px_48px_rgba(31,95,70,0.22)] lg:px-12 lg:py-14" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Trust Us to Exceed Your Expectations</p>
                    <h2 class="mt-4 text-3xl font-semibold">Our mission is to help your business succeed</h2>
                    <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-lg font-semibold">Unmatched Support</h3>
                            <p class="mt-2 text-sm text-white/80">Our dedicated support teams and systems are available round-the-clock to assist teams and clients.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-lg font-semibold">Team Benefits</h3>
                            <p class="mt-2 text-sm text-white/80">Each team member receives best-in-class benefits with strong HR and incentive programs.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-lg font-semibold">Rewards and Recognition</h3>
                            <p class="mt-2 text-sm text-white/80">We empower fulfilled team members so onshore teams can focus on profitability.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6 backdrop-blur">
                            <h3 class="text-lg font-semibold">Sense of Community</h3>
                            <p class="mt-2 text-sm text-white/80">We foster community through regular events and meaningful team activities.</p>
                        </article>
                    </div>
                    <a href="{{ route('contact') }}"
                        class="mt-7 inline-flex rounded-full bg-[#b28b2e] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                        Get started
                    </a>
                </section>

                <section class="rounded-[28px] bg-white p-10 shadow-[0_20px_50px_rgba(31,95,70,0.12)] lg:p-12" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Questions? We have the answer</p>
                    <div class="mt-6 space-y-5">
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-lg font-semibold text-[#1b1b18]">Where do we find our staff?</h3>
                            <p class="mt-2 text-sm text-[#6b6b66]">
                                We personally know a lot of people, get recommendations on a frequent basis, and use various social media channels to acquire staff.
                            </p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-lg font-semibold text-[#1b1b18]">How is the payment procedure done?</h3>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-lg font-semibold text-[#1b1b18]">Is there any guarantee for me as a customer?</h3>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-lg font-semibold text-[#1b1b18]">How much does it cost to use our service?</h3>
                        </article>
                    </div>
                </section>

                <section class="rounded-[30px] bg-[#dceae3] px-10 py-12 shadow-[0_20px_60px_rgba(31,95,70,0.16)] lg:px-12 lg:py-14" data-aos="fade-up">
                    <h2 class="text-3xl font-semibold text-[#1b1b18]">
                        In today's high-risk, high-stake business landscape, your people are your greatest competitive advantage.
                    </h2>
                    <p class="mt-4 max-w-4xl text-sm leading-relaxed text-[#3f3f3a]">
                        AOG empowers your business to reach greater heights by matching you with trustworthy, reliable, five-star global talent.
                    </p>
                    <a href="{{ route('contact') }}"
                        class="mt-7 inline-flex rounded-full bg-[#287854] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">
                        Get started
                    </a>
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
