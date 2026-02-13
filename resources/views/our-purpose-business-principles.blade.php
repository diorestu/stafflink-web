<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - Our Purpose &amp; Business Principles</title>
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
            <section class="mx-auto max-w-7xl space-y-12">
                <section class="overflow-hidden rounded-[20px] bg-white shadow-[0_16px_40px_rgba(31,95,70,0.14)]" data-aos="fade-up">
                    <div class="grid lg:grid-cols-[260px_1fr]">
                        <div class="bg-black px-8 py-12 text-white lg:flex lg:items-center lg:justify-center">
                            <h1 class="text-center text-3xl font-semibold leading-tight lg:text-4xl">
                                Our Purpose
                                <br>
                                &amp;
                                <br>
                                Business
                                <br>
                                Principles
                            </h1>
                        </div>
                        <img src="{{ asset('images/img_hero.webp') }}" alt="Our purpose and principles"
                            class="h-[300px] w-full object-cover lg:h-[360px]" draggable="false" />
                    </div>
                </section>

                <section class="text-center" data-aos="fade-up">
                    <h2 class="text-4xl font-semibold text-[#1b1b18] md:text-5xl">Making Dreams Possible</h2>
                    <p class="mt-2 text-2xl font-semibold text-[#1b1b18]">One Person at a Time</p>
                </section>

                <section class="overflow-hidden rounded-[18px] bg-white shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <div class="bg-[#2f8b62] px-8 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white">Staff Link Solutions</div>
                    <div class="grid gap-0 lg:grid-cols-2">
                        <div class="min-h-[220px] bg-[radial-gradient(circle_at_center,_#8dcdb0_0%,_#2f8b62_68%,_#1f5f46_100%)]"></div>
                        <div class="px-8 py-10 lg:px-10">
                            <h3 class="text-3xl font-semibold text-[#1b1b18]">Staff Link Solutions</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">Dear Colleague,</p>
                            <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">
                                Nearly 5 years ago, Staff Link Solutions Executives began with a clear vision and a commitment to delivering
                                exceptional staffing services that meet the unique needs of our clients. Much like that early guidebook,
                                our journey has been shaped by purpose and principles that define how we do business.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">
                                As we reflect on our growth and the impact we've made, we've come to realize that purpose-driven businesses
                                not only create lasting results but also have a deeper, more meaningful influence on the people we serve.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">
                                This year, we've solidified our mission with a simple yet powerful statement: "Making Dreams Possible - One Person at a Time."
                                This motto encapsulates who we are and what we stand for, empowering individuals and businesses by providing
                                the right talent to turn aspirations into reality.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">
                                It's a story we're proud to share and one that drives everything we do, from the clients we serve
                                to the communities we impact. Together, let's continue to make dreams possible, one person at a time,
                                and weave together what we value into how we deliver results for clients, colleagues and communities.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">
                                Our Purpose signifies for the first time a single, unifying message for Staff Link Solutions.
                                It tells the story of who we are and the unique business impact we make.
                            </p>
                            <p class="mt-6 text-[15px] font-semibold text-[#1b1b18]">Chairman and Chief Executive Officer</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-[18px] bg-white px-8 py-8 shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-5">
                        <article class="rounded-2xl border border-[#d9e3dc] p-5">
                            <p class="text-2xl font-semibold text-[#1b1b18]">1</p>
                            <p class="mt-2 text-[15px] font-semibold">Our purpose</p>
                            <p class="mt-1 text-xs text-[#6b6b66]">The impact we aspire to have</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-5">
                            <p class="text-2xl font-semibold text-[#1b1b18]">2</p>
                            <p class="mt-2 text-[15px] font-semibold">Our mission</p>
                            <p class="mt-1 text-xs text-[#6b6b66]">The ambition we hold ourselves to</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-5">
                            <p class="text-2xl font-semibold text-[#1b1b18]">3</p>
                            <p class="mt-2 text-[15px] font-semibold">Our values</p>
                            <p class="mt-1 text-xs text-[#6b6b66]">The mindsets that unite us all</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-5">
                            <p class="text-2xl font-semibold text-[#1b1b18]">4</p>
                            <p class="mt-2 text-[15px] font-semibold">Our business principles</p>
                            <p class="mt-1 text-xs text-[#6b6b66]">The principles that guide how we work</p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-5">
                            <p class="text-2xl font-semibold text-[#1b1b18]">5</p>
                            <p class="mt-2 text-[15px] font-semibold">Our promises</p>
                            <p class="mt-1 text-xs text-[#6b6b66]">Our value proposition to all stakeholders</p>
                        </article>
                    </div>
                    <p class="mt-6 text-xs uppercase tracking-[0.2em] text-[#2f8b62]">Jakarta</p>
                </section>

                <section class="rounded-[18px] bg-white px-8 py-10 shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <div class="flex items-end justify-between gap-6 border-b-[8px] border-[#2f8b62] pb-6">
                        <h2 class="text-4xl font-semibold text-[#1b1b18] md:text-5xl">OUR PURPOSE</h2>
                        <span class="text-8xl font-semibold leading-none text-[#1b1b18] md:text-9xl">1</span>
                    </div>
                </section>

                <section class="overflow-hidden rounded-[18px] bg-white shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <div class="grid gap-0 lg:grid-cols-2">
                        <img src="{{ asset('images/single_img.png') }}" alt="Purpose in action" class="h-[320px] w-full object-cover" draggable="false" />
                        <div class="px-8 py-10 lg:px-10">
                            <p class="text-xs uppercase tracking-[0.24em] text-[#2f8b62]">Our Purpose</p>
                            <h3 class="mt-4 text-3xl font-semibold text-[#1b1b18]">Make Dreams Possible</h3>
                            <p class="mt-1 text-xl font-semibold text-[#1b1b18]">One Person at a Time</p>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-3" data-aos="fade-up">
                    <article class="rounded-[18px] bg-white px-8 py-8 shadow-[0_14px_34px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.24em] text-[#2f2f2f]">Our Purpose</p>
                        <h3 class="mt-3 text-2xl font-semibold text-[#b28b2e]">We Make Impact at Scale.</h3>
                        <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                            At Staff Link Solutions, we think bigger, build stronger connections, and unlock new possibilities for individuals and businesses,
                            bringing dreams within reach for those we serve. Through our commitment to equity, inclusivity, and professional growth,
                            we expand access to meaningful employment and economic empowerment.
                        </p>
                        <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                            By bridging talent with opportunity, we help businesses thrive and individuals achieve their dreams, one person at a time.
                            Together, we shape a future where excellence, innovation, and impact drive lasting success.
                        </p>
                    </article>

                    <article class="rounded-[18px] bg-white px-8 py-8 shadow-[0_14px_34px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.24em] text-[#2f2f2f]">Our Purpose</p>
                        <h3 class="mt-3 text-2xl font-semibold text-[#b28b2e]">We are global.</h3>
                        <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                            At Staff Link Solutions, we bridge talent with opportunity across industries, individuals, and the broader global community.
                            Whether in local neighborhoods or international markets, we empower individuals and businesses to thrive.
                        </p>
                        <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                            By nurturing growth and unlocking potential, we help shape a future where everyone has access to meaningful opportunities
                            and the support they need to succeed.
                        </p>
                    </article>

                    <article class="rounded-[18px] bg-white px-8 py-8 shadow-[0_14px_34px_rgba(31,95,70,0.12)]">
                        <p class="text-xs uppercase tracking-[0.24em] text-[#2f2f2f]">Our Purpose</p>
                        <h3 class="mt-3 text-2xl font-semibold text-[#b28b2e]">We are relentless.</h3>
                        <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                            For nearly five years, we've been in constant motion, driven by a vision of progress and long-term impact.
                            We don't just fill roles; we build futures.
                        </p>
                        <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                            With foresight, dedication, and an unwavering commitment to excellence, we strive to elevate the workforce
                            and create lasting change. Our work is never finished because every success story inspires us to do more.
                        </p>
                    </article>
                </section>

                <section class="rounded-[18px] bg-[#1f5f46] px-8 py-10 text-white shadow-[0_18px_48px_rgba(31,95,70,0.22)]" data-aos="fade-up">
                    <h2 class="text-4xl font-semibold">Our Mission <span class="text-[#e9d29d]">2</span></h2>
                    <p class="mt-4 text-[15px] leading-relaxed text-white/90">
                        We aim to be the most trusted and respected staffing solutions provider, seamlessly linking exceptional talent
                        with businesses and individuals worldwide. Through integrity, innovation, and excellence, we empower people
                        and organizations to thrive, shaping a future where opportunity knows no limits.
                    </p>
                    <p class="mt-3 text-[15px] leading-relaxed text-white/90">
                        Through our work, we illuminate paths, remove barriers, and empower dreams, shaping a future where opportunity
                        flows boundlessly, and every connection sparks new possibilities.
                    </p>
                </section>

                <section class="rounded-[18px] bg-white px-8 py-10 shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <h2 class="text-4xl font-semibold text-[#1b1b18]">Our Values <span class="text-[#b28b2e]">3</span></h2>
                    <p class="mt-4 text-[15px] font-semibold text-[#2f8b62]">Responsibility | Unity | Mindfulness | Impact</p>
                    <div class="mt-6 grid gap-5 md:grid-cols-2">
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-xl font-semibold text-[#1b1b18]">Responsibility</h3>
                            <p class="mt-2 text-[15px] leading-relaxed text-[#6b6b66]">
                                We take ownership of our work, putting our clients, employees, and communities first. Our commitment
                                to world-class staffing solutions drives us to act with integrity and accountability.
                            </p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-xl font-semibold text-[#1b1b18]">Unity</h3>
                            <p class="mt-2 text-[15px] leading-relaxed text-[#6b6b66]">
                                We foster teamwork, trust, and respect. We create an inclusive and supportive environment where everyone
                                can thrive and bring their full selves to work.
                            </p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-xl font-semibold text-[#1b1b18]">Mindfulness</h3>
                            <p class="mt-2 text-[15px] leading-relaxed text-[#6b6b66]">
                                We approach challenges with thoughtfulness, humility, and a willingness to learn. By continuously improving,
                                we empower individuals and businesses to reach their full potential.
                            </p>
                        </article>
                        <article class="rounded-2xl border border-[#d9e3dc] p-6">
                            <h3 class="text-xl font-semibold text-[#1b1b18]">Impact</h3>
                            <p class="mt-2 text-[15px] leading-relaxed text-[#6b6b66]">
                                We set high standards and strive for excellence in everything we do. With determination and a long-term vision,
                                we create meaningful impact, one person at a time.
                            </p>
                        </article>
                    </div>
                </section>

                <section class="rounded-[18px] bg-white px-8 py-10 shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <h2 class="text-4xl font-semibold text-[#1b1b18]">Our Business Principles <span class="text-[#b28b2e]">4</span></h2>
                    <p class="mt-4 text-[15px] leading-relaxed text-[#6b6b66]">
                        At Staff Link Solutions, our principles define who we are, how we grow and key to our success.
                        They shape the way we serve clients, empower employees, and contribute to communities.
                    </p>
                    <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                        We do not claim perfection. Challenges are inevitable, but when they arise, we renew our commitment
                        to these principles and push forward with even greater resolve.
                    </p>
                    <p class="mt-3 text-[15px] leading-relaxed text-[#6b6b66]">
                        What we can and will promise is to be honest and transparent, to do what is right, to empower businesses and individuals,
                        to foster growth and inclusion, and to operate with fierce resolve and resilience.
                    </p>
                    <p class="mt-4 text-xs uppercase tracking-[0.2em] text-[#2f8b62]">Candi Borobudur, Middle Java</p>
                </section>

                <section class="grid gap-6 md:grid-cols-2" data-aos="fade-up">
                    <article class="rounded-2xl bg-[#f7faf8] p-7 shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                        <h3 class="text-2xl font-semibold text-[#1b1b18]">Exceptional client service</h3>
                        <ol class="mt-3 list-decimal space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                            <li>We focus on the customer.</li>
                            <li>We are field and client driven; we operate at the local level.</li>
                            <li>We provide world-class services; investing in people, businesses, and communities.</li>
                        </ol>
                    </article>
                    <article class="rounded-2xl bg-[#f7faf8] p-7 shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                        <h3 class="text-2xl font-semibold text-[#1b1b18]">Operational excellence</h3>
                        <ol class="mt-3 list-decimal space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                            <li>We set the highest standards of performance.</li>
                            <li>We demand financial rigor and risk discipline.</li>
                            <li>We strive for the best internal governance and controls.</li>
                            <li>We act and think like owners and partners.</li>
                            <li>We strive to build and maintain the best, most efficient systems and operations.</li>
                            <li>We are disciplined in everything we do.</li>
                            <li>We execute with both skill and urgency.</li>
                        </ol>
                    </article>
                    <article class="rounded-2xl bg-[#f7faf8] p-7 shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                        <h3 class="text-2xl font-semibold text-[#1b1b18]">A commitment to integrity, fairness and responsibility</h3>
                        <ol class="mt-3 list-decimal space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                            <li>We will not compromise our integrity.</li>
                            <li>We face facts.</li>
                            <li>We have fortitude.</li>
                            <li>We foster respect, inclusiveness, humanity and humility.</li>
                            <li>We help strengthen the communities in which we live and work.</li>
                        </ol>
                    </article>
                    <article class="rounded-2xl bg-[#f7faf8] p-7 shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                        <h3 class="text-2xl font-semibold text-[#1b1b18]">A great team and winning culture</h3>
                        <ol class="mt-3 list-decimal space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                            <li>We hire, train and retain great, diverse employees.</li>
                            <li>We build teamwork, loyalty and morale.</li>
                            <li>We maintain an open, entrepreneurial meritocracy for all.</li>
                            <li>We communicate honestly, clearly and consistently.</li>
                            <li>We strive to be good leaders.</li>
                        </ol>
                    </article>
                </section>

                <section class="rounded-[18px] bg-white px-8 py-10 shadow-[0_14px_34px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                    <h3 class="text-2xl font-semibold text-[#1b1b18]">Detailed Principles</h3>
                    <div class="mt-6 grid gap-6 lg:grid-cols-2">
                        <article>
                            <h4 class="text-lg font-semibold text-[#2f8b62]">We focus on the customer</h4>
                            <ul class="mt-2 list-disc space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                                <li>Treat the customer the way you want to be treated.</li>
                                <li>Read customer complaints and be the customer's advocate.</li>
                                <li>Exceed expectations by listening and anticipating needs.</li>
                                <li>Earn trust by focusing on customers' best interests.</li>
                                <li>Offer high-quality, competitively priced services.</li>
                                <li>Never let short-term profit get in the way of doing what is right.</li>
                            </ul>
                        </article>
                        <article>
                            <h4 class="text-lg font-semibold text-[#2f8b62]">We are disciplined and execute with urgency</h4>
                            <ul class="mt-2 list-disc space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                                <li>Be rigorous and detailed, with continuous follow-up.</li>
                                <li>Maintain an intense work ethic to get the job done right.</li>
                                <li>Fight complacency and drive change in a coordinated way.</li>
                                <li>Conduct regular, organized and thorough business reviews.</li>
                                <li>Work with energy and focus; deliver on commitments.</li>
                                <li>Get a little better every day and raise the bar.</li>
                            </ul>
                        </article>
                        <article>
                            <h4 class="text-lg font-semibold text-[#2f8b62]">Integrity, fairness and responsibility</h4>
                            <ul class="mt-2 list-disc space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                                <li>Do the right thing even when it is not easy.</li>
                                <li>Have zero tolerance for unethical behavior.</li>
                                <li>Be accountable, straightforward and honest.</li>
                                <li>Have one truth for all audiences.</li>
                                <li>Demonstrate resilience and tenacity through setbacks.</li>
                                <li>Strengthen the communities where we live and work.</li>
                            </ul>
                        </article>
                        <article>
                            <h4 class="text-lg font-semibold text-[#2f8b62]">Winning culture and leadership</h4>
                            <ul class="mt-2 list-disc space-y-2 pl-5 text-[15px] text-[#6b6b66]">
                                <li>Hire great people and train them well.</li>
                                <li>Encourage lifelong learning and deep curiosity.</li>
                                <li>Provide honest, direct and consistent feedback.</li>
                                <li>Put loyalty to the institution ahead of personal agenda.</li>
                                <li>Challenge the status quo and support constructive challenge.</li>
                                <li>Lead in your community and strive for continual improvement.</li>
                            </ul>
                        </article>
                    </div>
                </section>

                <section class="rounded-[18px] bg-[#1f5f46] px-8 py-10 text-white shadow-[0_18px_48px_rgba(31,95,70,0.22)]" data-aos="fade-up">
                    <h2 class="text-4xl font-semibold">Our Promises <span class="text-[#e9d29d]">5</span></h2>
                    <p class="mt-4 text-[15px] leading-relaxed text-white/90">
                        Ethical behavior does not just happen. It has to be cultivated and repeatedly affirmed.
                    </p>
                    <div class="mt-6 grid gap-5 md:grid-cols-2">
                        <article class="rounded-2xl bg-white/10 p-6">
                            <p class="text-lg font-semibold">We power economic growth, serving our customers, clients and communities.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6">
                            <p class="text-lg font-semibold">We uplift communities around the world, making tangible impact at scale.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6">
                            <p class="text-lg font-semibold">We champion opportunity and enterprise that unlock equity, inclusion and sustainable growth.</p>
                        </article>
                        <article class="rounded-2xl bg-white/10 p-6">
                            <p class="text-lg font-semibold">We are a great place to work, an unmatched combination of humanity and excellence at scale.</p>
                        </article>
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
            href="https://wa.me/1234567890"
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
