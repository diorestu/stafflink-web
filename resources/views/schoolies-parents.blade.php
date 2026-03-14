<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Schoolies Parent Information',
        'seoDescription' => 'Important parent information for Schoolies trips including safety measures, support services, and what to expect.',
        'seoKeywords' => 'schoolies parents, schoolies safety, schoolies support services, schoolies information for parents',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8f3ea] text-[#202522]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen">
        <x-site-header />

        <main class="px-4 pb-16 pt-6 sm:px-6 sm:pb-20 sm:pt-8 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-6 sm:space-y-8">
                <section class="overflow-hidden rounded-[28px] bg-[linear-gradient(130deg,#1f5f46_0%,#287854_45%,#d4b466_100%)] px-6 py-8 text-white shadow-[0_18px_46px_rgba(31,95,70,0.2)] sm:px-8 sm:py-10 lg:px-10 lg:py-12">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/70">Parents</p>
                    <h1 class="mt-3 flex items-center gap-3 text-4xl font-semibold leading-tight sm:text-5xl">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/30 bg-black/15 text-white">
                            <x-ui-icon name="shield" class="h-6 w-6" />
                        </span>
                        A Message to Parents
                    </h1>
                    <p class="mt-5 max-w-5xl text-base leading-relaxed text-white/90">
                        This is a big moment for your child and a big moment for you too.
                    </p>
                    <p class="mt-3 max-w-5xl text-sm leading-relaxed text-white/88">
                        We understand this is an important milestone and that it can come with excitement, nerves and a lot of wanting to know what lies ahead. Remember, it is completely normal to want clarity and reassurance, and we're here to support and answer all your questions. This page is designed to provide you with information on what to expect, how Schoolies operates and the safety and support measures in place to help your child celebrate responsibly. Through the knowledge we have gained over our 35 years, you can rest assured that safety is at the forefront of our minds in both the planning and execution of our trips. Our aim is to give you confidence, peace of mind and the reassurance that your child is being supported every step of the way.
                    </p>
                </section>

                <section class="rounded-[24px] bg-white p-6 shadow-[0_14px_34px_rgba(16,24,40,0.08)] sm:p-7 lg:p-8">
                    <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight sm:text-3xl">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#e6f5f1] text-[#1f5f46]">
                            <x-ui-icon name="users" class="h-5 w-5" />
                        </span>
                        Who We Are
                    </h2>
                    <p class="mt-4 inline-flex items-center gap-2 text-lg font-semibold text-[#1f5f46]">
                        <x-ui-icon name="briefcase" class="h-5 w-5" />
                        <span>Your Global Talent Outsourcing Partner</span>
                    </p>
                    <p class="mt-3 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                        <x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                        <span>Staff Link Solutions delivers practical, reliable staffing support to businesses that need strong teams fast. We focus on quality hiring, consistent communication, and long-term partnerships that help you scale with confidence.</span>
                    </p>
                    <p class="mt-3 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                        <x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                        <span>We connect businesses with skilled professionals through a process that is fast, transparent, and tailored to each role. Every placement is guided by fit, performance, and long-term success.</span>
                    </p>
                    <p class="mt-3 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                        <x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                        <span>From initial screening to post-placement follow-up, we stay involved to keep quality high and onboarding smooth. Your team gets the right people, ready to contribute from day one.</span>
                    </p>
                </section>

                <section class="rounded-[24px] bg-white p-6 shadow-[0_14px_34px_rgba(16,24,40,0.08)] sm:p-7 lg:p-8">
                    <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight sm:text-3xl">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#e6f5f1] text-[#1f5f46]">
                            <x-ui-icon name="heart" class="h-5 w-5" />
                        </span>
                        Experiences That Matter
                    </h2>
                    <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        <p class="flex items-center gap-2 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]"><x-ui-icon name="building" class="h-4 w-4 shrink-0" /><span>Approved Accommodation</span></p>
                        <p class="flex items-center gap-2 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]"><x-ui-icon name="book" class="h-4 w-4 shrink-0" /><span>Trip Packages</span></p>
                        <p class="flex items-center gap-2 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]"><x-ui-icon name="target" class="h-4 w-4 shrink-0" /><span>Inclusive Events</span></p>
                        <p class="flex items-center gap-2 rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]"><x-ui-icon name="shield" class="h-4 w-4 shrink-0" /><span>Celebrating Safely</span></p>
                    </div>
                    <p class="mt-5 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                        <x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                        <span>We aim to create a fun and safe environment for school leavers on their Schoolies trip.</span>
                    </p>
                    <p class="mt-3 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                        <x-ui-icon name="shield" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                        <span>Schoolies week is a celebration of your child's achievement in finishing school, giving them the chance to create lasting memories in a fun, well-managed and supported environment. The safety and wellbeing of your child, and of those travelling with Staff Link Solutions, sit at the centre of how these experiences are planned and delivered. In some destinations, this includes access to a structured program of events for students staying in Staff Link Solutions accommodation. Please be aware, not all destinations have a program of events, please see the Schoolies party page for the most up-to-date information on parties, or contact our friendly team.</span>
                    </p>
                </section>

                <section class="grid gap-5 sm:gap-6 lg:grid-cols-2">
                    <article class="rounded-[24px] bg-white p-6 shadow-[0_14px_34px_rgba(16,24,40,0.08)] sm:p-7 lg:p-8">
                        <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight sm:text-3xl">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#e6f5f1] text-[#1f5f46]">
                                <x-ui-icon name="book" class="h-5 w-5" />
                            </span>
                            So What Is Schoolies?
                        </h2>
                        <p class="mt-4 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                            <x-ui-icon name="comments" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                            <span>Schoolies marks an important milestone, it's the end of school and the beginning of what comes next for your child. It's a time for school leavers to celebrate together, one last time with their graduating year, before everyone heads off in different directions. Each year, thousands of Year 12 students travel from across Australia to iconic Schoolies destinations to celebrate, unwind, and enjoy what is often their first real taste of independence. It's a well-earned rite of passage and the ultimate celebration of your child graduating year 12.</span>
                        </p>
                    </article>
                    <article class="rounded-[24px] border border-[#ead9ab] bg-[#fff9ea] p-6 shadow-[0_14px_34px_rgba(16,24,40,0.08)] sm:p-7 lg:p-8">
                        <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight sm:text-3xl">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#ffe8bf] text-[#a86800]">
                                <x-ui-icon name="shield" class="h-5 w-5" />
                            </span>
                            How Do We Promote Safety
                        </h2>
                        <p class="mt-4 flex items-start gap-3 text-sm leading-relaxed text-[#5b4d2c]">
                            <x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#a86800]" />
                            <span>Each year we review our schoolies program and make sure we are implementing responsible tactics to support the physical, mental, and emotional health and well-being of Schoolies during their trip. Staff Link Solutions bookings offer the following initiatives to support the safety of your child during their Schoolies holiday.</span>
                        </p>
                    </article>
                </section>

                <section class="rounded-[24px] bg-white p-6 shadow-[0_14px_34px_rgba(16,24,40,0.08)] sm:p-7 lg:p-8">
                    <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight sm:text-3xl">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#e6f5f1] text-[#1f5f46]">
                            <x-ui-icon name="shield" class="h-5 w-5" />
                        </span>
                        Safety Initiatives
                    </h2>
                    <div class="mt-6 grid gap-4 sm:gap-5 lg:grid-cols-2">
                        <article class="rounded-2xl border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <h3 class="flex items-center gap-2 text-xl font-semibold text-[#1f5f46]">
                                <x-ui-icon name="target" class="h-5 w-5" />
                                <span>Party Passes</span>
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#48524d]">Party passes are exclusive to Staff Link Solutions customers, giving access to Staff Link Solutions only events specifically for our guests.</p>
                        </article>
                        <article class="rounded-2xl border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <h3 class="flex items-center gap-2 text-xl font-semibold text-[#1f5f46]">
                                <x-ui-icon name="headset" class="h-5 w-5" />
                                <span>Additional Safety</span>
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#48524d]">A 24-hour hotline is available for both parents and graduates. With additional security in some key Staff Link Solutions hotels for added peace of mind.</p>
                        </article>
                        <article class="rounded-2xl border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <h3 class="flex items-center gap-2 text-xl font-semibold text-[#1f5f46]">
                                <x-ui-icon name="book" class="h-5 w-5" />
                                <span>Photo ID</span>
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#48524d]">Official Staff Link Solutions photo ID and lanyards for Staff Link Solutions customers. In some destinations, only Staff Link Solutions guests can access accommodation for safety purposes.*</p>
                        </article>
                        <article class="rounded-2xl border border-[#dcece7] bg-[#f6fbf9] p-5">
                            <h3 class="flex items-center gap-2 text-xl font-semibold text-[#1f5f46]">
                                <x-ui-icon name="users" class="h-5 w-5" />
                                <span>Partnerships and Staff</span>
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-[#48524d]">Staff Link Solutions partners with LIVIN, the Red Frogs and trusted support services, to provide on-ground support and help keep students safe throughout their stay.</p>
                        </article>
                    </div>
                </section>

                <section class="rounded-[24px] bg-white p-6 shadow-[0_14px_34px_rgba(16,24,40,0.08)] sm:p-7 lg:p-8">
                    <h2 class="flex items-center gap-3 text-2xl font-semibold leading-tight sm:text-3xl">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#e6f5f1] text-[#1f5f46]">
                            <x-ui-icon name="users" class="h-5 w-5" />
                        </span>
                        The Staff Link Solutions Team
                    </h2>
                    <p class="mt-4 flex items-start gap-3 text-sm leading-relaxed text-[#48524d]">
                        <x-ui-icon name="headset" class="mt-0.5 h-4 w-4 shrink-0 text-[#1f5f46]" />
                        <span>When you book with Staff Link Solutions you are booking with the Schoolies experts. Our small team of professionals are committed to providing support to not just school leavers but also their parents! Our awesome crew are available for any questions you might have. We are committed to delivering excellent customer service and even offer a 24-hour helpline during Schoolies week. Don't hesitate to drop our team a message if you would like to chat about schoolies. Email
                        <a href="mailto:info@stafflink.pro" class="font-semibold text-[#1f5f46] hover:text-[#163f31]">info@stafflink.pro</a>
                        and we will be in touch.</span>
                    </p>
                </section>

                <section class="rounded-[26px] bg-[#1f5f46] p-6 text-white shadow-[0_16px_42px_rgba(31,95,70,0.2)] sm:p-7 lg:p-10">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-white/70">Call to Action</p>
                    <h2 class="mt-3 flex items-center gap-3 text-3xl font-semibold leading-tight sm:text-4xl">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-white/30 bg-black/15 text-white">
                            <x-ui-icon name="target" class="h-5 w-5" />
                        </span>
                        Schoolies Bali 2026
                    </h2>
                    <p class="mt-3 max-w-3xl text-sm leading-relaxed text-white/85">Plan your next move with us, whether you want to book your Schoolies Bali 2026 trip or explore sponsor opportunities.</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-white bg-white px-6 py-3 text-sm font-semibold text-[#1f5f46] transition hover:bg-transparent hover:text-white"><x-ui-icon name="check" class="h-4 w-4" />Booking</a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#1f5f46]"><x-ui-icon name="briefcase" class="h-4 w-4" />Become Sponsor</a>
                    </div>
                </section>

            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
