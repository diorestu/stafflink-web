<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Hire Dedicated Remote Workers $8/hour',
        'seoDescription' => 'Hire dedicated remote workers from $8/hour. Build a reliable offshore team with flexible month-to-month support.',
        'seoKeywords' => 'remote worker, hire remote staff, offshore team, dedicated remote workers, outsourcing support',
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
                    <p class="inline-flex items-center rounded-full border border-[#f0dba8] bg-[#f0dba8]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-[#f0dba8]">Remote Worker</p>
                    <h1 class="mt-4 text-3xl font-semibold leading-tight lg:text-5xl">Hire Dedicated Remote Workers $8/hour</h1>
                    <h2 class="mt-6 text-2xl font-semibold text-[#f0dba8]">Build a Reliable Offshore Teams</h2>
                    <p class="mt-4 text-sm italic leading-relaxed text-white/90">
                        Scaling your business does not have to mean higher overhead. Hire dedicated remote workers just $8/hour and build a structured offshore team that supports your daily operations. No long-term lock-in contracts. Flexible month-to-month model. Pre-screened professionals ready to integrate into your workflow.
                    </p>
                    <div class="mt-7 flex flex-wrap items-center justify-start gap-3">
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full bg-[#f0dba8] px-5 py-2.5 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#e5cc8a]">Book a Free Discovery Call</a>
                        <a href="{{ route('applications.create') }}" class="inline-flex rounded-full border border-white/40 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">Apply for Remote Roles</a>
                    </div>
                </header>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">What Is a Dedicated Remote Worker?</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#5a5a55]">
                        A dedicated remote worker is a full-time or part-time professional who works exclusively with your business from an offshore location. Unlike freelancers juggling multiple clients, dedicated remote staff operate as part of your team, aligned with your systems, KPIs, and daily workflow.
                    </p>
                    <p class="mt-3 text-sm leading-relaxed text-[#5a5a55]">
                        This model gives you the consistency of an in-house employee without the cost structure of local hiring.
                    </p>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Remote Staff and Roles You Can Hire</h2>
                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Virtual Assistants &amp; Administrative Support</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Inbox management, scheduling, CRM updates, data entry, reporting, document preparation, customer communication.</p>
                        </article>
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Marketing &amp; Digital Support</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Social media management, content scheduling, basic graphic design, paid ads assistance, email campaigns, SEO support.</p>
                        </article>
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Bookkeeping &amp; Finance Support</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Invoice processing, reconciliation, accounts payable/receivable support, payroll assistance, financial reporting support.</p>
                        </article>
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Sales &amp; Lead Generation</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Prospecting, database building, outbound outreach, appointment setting, CRM management.</p>
                        </article>
                        <article class="rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-5 md:col-span-2">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Operations &amp; Project Coordination</h3>
                            <p class="mt-2 text-sm text-[#5a5a55]">Workflow tracking, supplier coordination, internal documentation, task management support.</p>
                        </article>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Why Businesses Hire Offshore Remote Workers</h2>
                    <p class="mt-3 text-sm text-[#5a5a55]">Hiring offshore remote staff allows companies to:</p>
                    <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-[#5a5a55]">
                        <li>Reduce employment costs by up to 50-70%</li>
                        <li>Scale operations without increasing fixed overhead</li>
                        <li>Access a growing global talent pool</li>
                        <li>Maintain flexibility with month-to-month structures</li>
                        <li>Focus internal teams on higher-value tasks</li>
                    </ul>
                    <p class="mt-3 text-sm text-[#5a5a55]">For many growing businesses, offshore staffing creates immediate breathing room without sacrificing productivity.</p>
                </section>

                <section class="rounded-2xl bg-[#287854] p-7 text-white shadow-[0_14px_40px_rgba(31,95,70,0.22)] lg:p-9">
                    <h2 class="text-2xl font-semibold">Transparent Pricing - $8/hour</h2>
                    <p class="mt-3 text-sm text-white/90">Remote workers $8 per hour, depending on role complexity and experience level.</p>
                    <h3 class="mt-4 text-lg font-semibold text-[#f0dba8]">You can hire:</h3>
                    <ul class="mt-2 list-disc space-y-2 pl-5 text-sm text-white/90">
                        <li>Part-time remote staff</li>
                        <li>Full-time dedicated staff</li>
                        <li>Project-based support</li>
                    </ul>
                    <ul class="mt-4 space-y-2 text-sm font-semibold text-[#f0dba8]">
                        <li class="flex items-center gap-2"><span aria-hidden="true">✓</span><span>No hidden recruitment fees.</span></li>
                        <li class="flex items-center gap-2"><span aria-hidden="true">✓</span><span>No long-term lock-in contracts.</span></li>
                        <li class="flex items-center gap-2"><span aria-hidden="true">✓</span><span>Flexible engagement structure.</span></li>
                    </ul>
                    <p class="mt-4 text-sm text-white/90">Clear pricing allows you to scale confidently while maintaining cost control.</p>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">How the Hiring Process Works</h2>
                    <div class="mt-4 space-y-4 text-sm text-[#5a5a55]">
                        <p><strong class="text-[#1f5f46]">Step 1 - Discovery Call</strong><br>We understand your business, role requirements, and expectations.</p>
                        <p><strong class="text-[#1f5f46]">Step 2 - Candidate Shortlisting</strong><br>We screen and present pre-vetted remote workers suited to your needs.</p>
                        <p><strong class="text-[#1f5f46]">Step 3 - Interview &amp; Selection</strong><br>You interview and choose the best fit for your team.</p>
                        <p><strong class="text-[#1f5f46]">Step 4 - Onboarding</strong><br>Your remote worker integrates into your systems and workflows.</p>
                        <p><strong class="text-[#1f5f46]">Step 5 - Ongoing Support</strong><br>We provide structural HR support while you manage performance directly.</p>
                    </div>
                    <p class="mt-4 text-sm text-[#5a5a55]">The process is streamlined, transparent, and designed for growing businesses.</p>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Is $8/hour Realistic for Quality Remote Workers?</h2>
                    <p class="mt-3 text-sm text-[#5a5a55]">Yes, in the right market. Lower cost of living in offshore locations allows businesses to hire skilled professionals at competitive rates while still offering fair local compensation.</p>
                    <p class="mt-3 text-sm text-[#5a5a55]">More specialised roles may require higher rates, but operational and support positions are highly viable at this level.</p>
                    <p class="mt-3 text-sm text-[#5a5a55]">The key to quality is not just pricing, it is proper screening, structured onboarding, and clear KPIs.</p>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9" data-role-faq>
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Common Questions About Hiring Remote Workers</h2>
                    <div class="mt-4 space-y-3">
                        <article><h4 class="text-base font-semibold text-[#1f5f46]">Is offshore staffing legal?</h4><p class="mt-1 text-sm text-[#5a5a55]">Yes. Businesses globally hire offshore staff through structured agreements. Proper documentation and clear contracts ensure compliance.</p></article>
                        <article><h4 class="text-base font-semibold text-[#1f5f46]">What are the risks of hiring offshore?</h4><p class="mt-1 text-sm text-[#5a5a55]">Risks usually stem from poor screening or unclear expectations. With structured recruitment, clear KPIs, and consistent communication, offshore staff can perform like in-house employees.</p></article>
                        <article><h4 class="text-base font-semibold text-[#1f5f46]">Can I scale my remote team over time?</h4><p class="mt-1 text-sm text-[#5a5a55]">Yes. Many businesses start with one remote worker and expand into a small offshore team as operations grow.</p></article>
                        <article><h4 class="text-base font-semibold text-[#1f5f46]">What if the remote worker is not a good fit?</h4><p class="mt-1 text-sm text-[#5a5a55]">We work with you to address performance concerns and, if needed, assist with replacement to ensure continuity.</p></article>
                        <article><h4 class="text-base font-semibold text-[#1f5f46]">Do remote workers align with my time zone?</h4><p class="mt-1 text-sm text-[#5a5a55]">Yes. Work schedules can be adjusted to ensure operational overlap with your business hours.</p></article>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-7 shadow-[0_14px_40px_rgba(31,95,70,0.12)] lg:p-9">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Who Is This Model Best For?</h2>
                    <ul class="mt-4 list-disc space-y-2 pl-5 text-sm text-[#5a5a55]">
                        <li>Startups needing cost control</li>
                        <li>Agencies needing backend support</li>
                        <li>E-commerce brands scaling operations</li>
                        <li>Service-based businesses handling growing admin</li>
                        <li>Founders overwhelmed with daily tasks</li>
                    </ul>
                    <p class="mt-4 text-sm text-[#5a5a55]">If your workload is increasing but local hiring feels financially risky, a dedicated remote worker may be the most strategic next step.</p>
                </section>

                <section class="rounded-2xl bg-[#1f5f46] p-8 text-white shadow-[0_14px_40px_rgba(31,95,70,0.22)]">
                    <h2 class="text-2xl font-semibold">Ready to Hire a Dedicated Remote Worker?</h2>
                    <p class="mt-3 text-sm text-white/90">Build a structured offshore team without long-term commitments. Start with one remote worker and scale as your business grows.</p>
                    <a href="{{ route('appointments.create') }}" class="mt-6 inline-flex self-start rounded-full bg-[#f0dba8] px-6 py-2.5 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#e5cc8a]">Book Your Free Discovery Call</a>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>

    @once
        <script>
            (() => {
                const faq = document.querySelector('[data-role-faq]');
                if (!faq) return;
                const items = Array.from(faq.querySelectorAll('article'));
                items.forEach((item, index) => {
                    item.classList.add('rounded-xl', 'border', 'border-[#d9e3dc]', 'p-4');
                    const h = item.querySelector('h4');
                    const p = item.querySelector('p');
                    if (!h || !p) return;
                    const icon = document.createElement('span');
                    icon.className = 'ml-2 text-[#287854]';
                    h.classList.add('flex', 'cursor-pointer', 'items-center', 'justify-between');
                    h.appendChild(icon);
                    const setOpen = (open) => {
                        p.classList.toggle('hidden', !open);
                        icon.textContent = open ? '-' : '+';
                        item.classList.toggle('bg-[#f7faf8]', open);
                    };
                    setOpen(index === 0);
                    h.addEventListener('click', () => {
                        const isOpen = !p.classList.contains('hidden');
                        items.forEach((other) => {
                            const otherP = other.querySelector('p');
                            const otherIcon = other.querySelector('h4 span');
                            if (otherP && otherIcon) {
                                otherP.classList.add('hidden');
                                otherIcon.textContent = '+';
                                other.classList.remove('bg-[#f7faf8]');
                            }
                        });
                        if (!isOpen) setOpen(true);
                    });
                });
            })();
        </script>
    @endonce
</body>
</html>
