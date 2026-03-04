<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $countryCurrencyBySlug = [
            'australia' => 'AUD',
            'america' => 'USD',
            'indonesia' => 'IDR',
            'bali' => 'IDR',
            'canada' => 'CAD',
            'malaysia' => 'MYR',
            'germany' => 'EUR',
            'singapore' => 'SGD',
        ];

        $bniAudRates = [
            'AUD' => 1,
            'USD' => 0.65,
            'IDR' => 10150,
            'CAD' => 0.89,
            'MYR' => 3.06,
            'EUR' => 0.60,
            'SGD' => 0.87,
        ];

        $pageSlug = (string) ($countrySlug ?? '');
        $minimumRateAmount = $pageSlug === 'australia' ? 10.0 : 8.0;
        $minimumRateCurrency = $pageSlug === 'australia' ? 'AUD' : 'USD';
        $serviceFeeRate = 0.11;

        $convertCurrency = function (float $amount, string $fromCurrency, string $toCurrency) use ($bniAudRates): float {
            $from = strtoupper($fromCurrency);
            $to = strtoupper($toCurrency);

            if (!isset($bniAudRates[$from], $bniAudRates[$to])) {
                return $amount;
            }

            $amountInAud = $amount / (float) $bniAudRates[$from];

            return $amountInAud * (float) $bniAudRates[$to];
        };

        $pageCurrencyCode = $countryCurrencyBySlug[$pageSlug] ?? 'AUD';
        $pageBaseValue = $convertCurrency($minimumRateAmount, $minimumRateCurrency, $pageCurrencyCode);
        $pageFeeValue = $pageBaseValue * $serviceFeeRate;
        $pageTotalValue = $pageBaseValue + $pageFeeValue;

        $formatAmount = fn (float $value, string $currencyCode): string => $currencyCode . ' ' . number_format($value, 2, '.', ',');
        $pageBaseLabel = $formatAmount($pageBaseValue, $pageCurrencyCode) . '/hour';
        $pageFeeLabel = $formatAmount($pageFeeValue, $pageCurrencyCode) . '/hour';
        $pageTotalLabel = $formatAmount($pageTotalValue, $pageCurrencyCode) . '/hour';
        $pageHeadlineLabel = 'From ' . $formatAmount($pageBaseValue, $pageCurrencyCode) . '/hour + 11% service fee';
    @endphp
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Hire Remote Staff for '.$countryAdjective.' Companies',
        'seoDescription' => 'Build your offshore team in Bali with trusted, English-speaking remote staff for '.$countryAdjective.' businesses, starting from '.$pageBaseLabel.' + 11% service fee.',
        'seoKeywords' => 'remote staff '.\Illuminate\Support\Str::lower($countryName).', offshore staffing bali, hire remote worker, virtual assistant '.\Illuminate\Support\Str::lower($countryName),
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-6 pb-20 pt-12 lg:px-10">
            <section class="mx-auto max-w-5xl space-y-10">
                <header class="rounded-[28px] bg-[#1f5f46] p-8 text-white shadow-[0_20px_60px_rgba(31,95,70,0.3)] lg:p-12">
                    <p class="inline-flex items-center rounded-full border border-[#f0dba8] bg-[#f0dba8]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-[#f0dba8]">{{ $countryName }}</p>
                    <h1 class="mt-4 text-3xl font-semibold leading-tight text-white lg:text-5xl">Hire Remote Staff for {{ $countryAdjective }} Companies</h1>
                    <p class="mt-3 text-xl font-semibold text-[#9de6c3]" data-price-headline>{{ $pageHeadlineLabel }}</p>
                    <h2 class="mt-8 text-2xl font-semibold text-[#f0dba8]">Build Your Offshore Team in Bali</h2>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-[0.2em] text-[#f6e7c1]">Trusted by {{ $countryOwnerLabel }} Business Owners</p>
                    <p class="mt-5 text-sm italic leading-relaxed text-white/90">
                        {{ $countryAdjective }} businesses are scaling smarter by hiring remote staff in Bali. Get reliable, English-speaking professionals from {{ $pageBaseLabel }} + 11% service fee, without lock-in contracts. We help {{ $countryOwnerLabel }} companies reduce overhead, improve efficiency, and build long-term offshore teams that actually feel like part of your business.
                    </p>
                </header>

                <section class="space-y-4 rounded-[24px] bg-white p-8 shadow-[0_16px_46px_rgba(31,95,70,0.12)] lg:p-10">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Why {{ $countryAdjective }} Businesses Are Hiring Remote Staff</h2>
                    <p class="text-sm leading-relaxed text-[#5a5a55]">
                        Rising labour costs, recruitment delays, and operational expenses in {{ $countryName }} are pushing businesses to rethink how they scale. Hiring offshore staff allows you to access skilled professionals without the full cost of local employment.
                    </p>
                    <p class="text-sm leading-relaxed text-[#5a5a55]">
                        Bali has become a strategic offshore location due to strong English proficiency, compatible time zones, and a growing pool of experienced professionals.
                    </p>
                    <h3 class="pt-2 text-xl font-semibold text-[#1f5f46]">Key Benefits</h3>
                    <div class="grid gap-3 lg:grid-cols-5">
                        <div class="flex min-h-[130px] items-center justify-center rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-4 text-center text-sm font-semibold text-[#1f5f46]">Save up to 60-70% on staffing costs</div>
                        <div class="flex min-h-[130px] items-center justify-center rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-4 text-center text-sm font-semibold text-[#1f5f46]">Flexible month-to-month engagement</div>
                        <div class="flex min-h-[130px] items-center justify-center rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-4 text-center text-sm font-semibold text-[#1f5f46]">Pre-screened and vetted candidates</div>
                        <div class="flex min-h-[130px] items-center justify-center rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-4 text-center text-sm font-semibold text-[#1f5f46]">Strong overlap with {{ $countryAdjective }} working hours</div>
                        <div class="flex min-h-[130px] items-center justify-center rounded-xl border border-[#d9e3dc] bg-[#f7faf8] p-4 text-center text-sm font-semibold text-[#1f5f46]">Fast hiring process</div>
                    </div>
                </section>

                <section class="space-y-6 rounded-[24px] bg-white p-8 shadow-[0_16px_46px_rgba(31,95,70,0.12)] lg:p-10">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Staff, Outsourcing and Recruitment Support Available for {{ $countryAdjective }} Companies</h2>
                    <div class="grid gap-4 text-sm text-[#5a5a55] lg:grid-cols-3">
                        <article class="flex min-h-[180px] flex-col justify-center rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Virtual Assistants &amp; Administrative Support</h3>
                            <p class="mt-1">Inbox management, scheduling, CRM updates, customer service, data entry, reporting.</p>
                        </article>
                        <article class="flex min-h-[180px] flex-col justify-center rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Marketing &amp; Digital Support</h3>
                            <p class="mt-1">Social media management, content creation, paid ads assistance, SEO support, email campaigns.</p>
                        </article>
                        <article class="flex min-h-[180px] flex-col justify-center rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Bookkeeping &amp; Finance Support</h3>
                            <p class="mt-1">Invoice processing, reconciliation, payroll assistance, Xero support, reporting.</p>
                        </article>
                    </div>
                    <div class="grid gap-4 text-sm text-[#5a5a55] lg:grid-cols-2">
                        <article class="flex min-h-[180px] flex-col justify-center rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Sales &amp; Business Development Support</h3>
                            <p class="mt-1">Lead generation, database building, cold outreach, appointment setting.</p>
                        </article>
                        <article class="flex min-h-[180px] flex-col justify-center rounded-2xl border border-[#d9e3dc] bg-[#f7faf8] p-5">
                            <h3 class="text-lg font-semibold text-[#1f5f46]">Operations &amp; Project Support</h3>
                            <p class="mt-1">Workflow coordination, task tracking, supplier communication, backend support.</p>
                        </article>
                    </div>
                </section>

                <section class="space-y-4 rounded-[24px] bg-[#287854] p-8 text-white shadow-[0_16px_46px_rgba(31,95,70,0.2)] lg:p-10"
                    data-dynamic-pricing data-base-amount="{{ $minimumRateAmount }}" data-base-currency="{{ $minimumRateCurrency }}" data-service-fee-rate="0.11" data-default-currency="{{ $pageCurrencyCode }}" data-country-slug="{{ $countrySlug }}">
                    <h2 class="text-2xl font-semibold">Transparent Staff Hire Pricing</h2>
                    <p class="text-sm leading-relaxed text-white/90">
                        Minimum hourly rate starts from <span class="font-semibold text-[#f0dba8]" data-price-base>{{ $pageBaseLabel }}</span> + <span class="font-semibold text-[#f0dba8]">11% service fee</span>.
                    </p>
                    <div class="grid gap-3 rounded-2xl border border-white/20 bg-white/10 p-4 text-sm sm:grid-cols-3">
                        <div class="rounded-xl border border-white/15 bg-black/10 p-3">
                            <p class="text-white/80">Base</p>
                            <p class="mt-1 text-base font-semibold text-[#f0dba8]" data-price-base>{{ $pageBaseLabel }}</p>
                        </div>
                        <div class="rounded-xl border border-white/15 bg-black/10 p-3">
                            <p class="text-white/80">Service Fee (11%)</p>
                            <p class="mt-1 text-base font-semibold text-[#f0dba8]" data-price-fee>{{ $pageFeeLabel }}</p>
                        </div>
                        <div class="rounded-xl border border-white/15 bg-black/10 p-3">
                            <p class="text-white/80">Total Minimum</p>
                            <p class="mt-1 text-base font-semibold text-[#f0dba8]" data-price-total>{{ $pageTotalLabel }}</p>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed text-white/80">
                        Currency: <span class="font-semibold text-[#f0dba8]" data-price-currency-code>{{ $pageCurrencyCode }}</span>. Exchange-rate reference: BNI (Bank Negara Indonesia), updated periodically.
                    </p>
                    <ul class="space-y-2 text-sm font-semibold text-[#f0dba8]">
                        <li class="flex items-center gap-2">
                            <span aria-hidden="true">✓</span>
                            <span>No recruitment surprises.</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span aria-hidden="true">✓</span>
                            <span>No long-term lock-in contracts.</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span aria-hidden="true">✓</span>
                            <span>Simple, flexible month-to-month structure.</span>
                        </li>
                    </ul>
                    <p class="text-sm leading-relaxed text-white/90">
                        This allows {{ $countryAdjective }} businesses to scale safely while maintaining full control over growth.
                    </p>
                </section>

                <section class="space-y-4 rounded-[24px] bg-white p-8 shadow-[0_16px_46px_rgba(31,95,70,0.12)] lg:p-10">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">How to Hire Remote Staff for Your {{ $countryAdjective }} Business</h2>
                    <div class="text-sm text-[#5a5a55]">
                        <h3 class="text-lg font-semibold text-[#1f5f46]">Book a discovery call</h3>
                        <div class="mt-3 overflow-x-auto pb-1">
                            <ol class="flex min-w-max items-center gap-3">
                                <li class="flex items-center gap-2 rounded-full border border-[#d9e3dc] bg-[#f7faf8] px-4 py-2">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#287854] text-xs font-semibold text-white">1</span>
                                    <span>Tell us the role and requirements</span>
                                </li>
                                <li class="text-[#1f5f46]">&rarr;</li>
                                <li class="flex items-center gap-2 rounded-full border border-[#d9e3dc] bg-[#f7faf8] px-4 py-2">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#287854] text-xs font-semibold text-white">2</span>
                                    <span>We shortlist pre-vetted candidates</span>
                                </li>
                                <li class="text-[#1f5f46]">&rarr;</li>
                                <li class="flex items-center gap-2 rounded-full border border-[#d9e3dc] bg-[#f7faf8] px-4 py-2">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#287854] text-xs font-semibold text-white">3</span>
                                    <span>You interview and select</span>
                                </li>
                                <li class="text-[#1f5f46]">&rarr;</li>
                                <li class="flex items-center gap-2 rounded-full border border-[#d9e3dc] bg-[#f7faf8] px-4 py-2">
                                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#287854] text-xs font-semibold text-white">4</span>
                                    <span>Your remote staff member starts</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-[#5a5a55]">
                        The process is streamlined and designed for busy {{ $countryAdjective }} business owners.
                    </p>
                </section>

                <section class="space-y-4 rounded-[24px] bg-[#1f5f46] p-8 text-white shadow-[0_16px_46px_rgba(31,95,70,0.22)] lg:p-10">
                    <h2 class="text-2xl font-semibold text-white">Built for Growing {{ $countryAdjective }} Businesses</h2>
                    <p class="text-sm leading-relaxed text-white/90">
                        Whether you're a startup, agency, e-commerce brand, trades company, or professional services firm, offshore staffing can reduce pressure on your local team while improving productivity.
                    </p>
                    <p class="text-sm leading-relaxed text-white/90">
                        We focus on long-term remote placements, not short-term freelancing. Our goal is to help {{ $countryAdjective }} businesses build structured, reliable offshore teams.
                    </p>
                </section>

                <section class="space-y-4 rounded-[24px] bg-white p-8 shadow-[0_16px_46px_rgba(31,95,70,0.12)] lg:p-10" data-faq-accordion>
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Frequently Asked Questions</h2>

                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">How does hiring remote staff from Bali actually work?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">We manage the recruitment, screening, and shortlisting process based on your requirements. You interview the selected candidates and choose who fits your business best. Once confirmed, your remote staff member works directly with you while we handle HR structure and administrative support.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Are the remote staff fluent in English?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Yes. All candidates are screened for written and spoken English. Many have previous experience working with international businesses, ensuring clear communication and cultural understanding.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Will they work {{ $countryAdjective }} business hours?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Yes. Our remote staff align their schedules with {{ $countryAdjective }} time zones, including {{ $primaryTimeZones }}. We ensure sufficient overlap so your team operates smoothly during your standard business hours.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Is there a minimum contract period?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">No. We operate on a flexible month-to-month model. There are no long-term lock-in contracts, giving {{ $countryAdjective }} businesses the flexibility to scale up or down as needed.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">What is included in the {{ $pageBaseLabel }} minimum + 11% service fee?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">The base hourly rate covers the dedicated staff member's salary and core HR administration. The 11% service fee covers staffing operations and support. Depending on the role and level of experience required, rates may vary. During your discovery call, we'll provide a clear breakdown with no hidden fees.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Can I hire part-time or full-time?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Yes. You can hire part-time remote staff, full-time dedicated staff, or project-based support. We tailor the setup to your business needs and workload.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">What types of {{ $countryAdjective }} businesses do you work with?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">We support a wide range of businesses including agencies, trades, e-commerce brands, consultants, startups, professional services firms, and growing SMEs across {{ $countryName }}.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">How quickly can I hire someone?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">In most cases, we can begin shortlisting candidates within a few days after understanding your requirements. Hiring timelines typically depend on role complexity, but many clients onboard within 1-2 weeks.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">What if the staff member is not a good fit?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">If performance or cultural fit is not aligned, we work with you to resolve the issue. If needed, we can assist with a replacement process to ensure your business remains supported.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">How is performance managed?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Your remote staff reports directly to you, just like an in-house employee. We recommend clear KPIs, weekly check-ins, and structured onboarding to ensure long-term success. We can also provide guidance on managing remote teams if required.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Do I need to provide equipment or software?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Typically, remote staff use their own equipment. You will provide access to your systems, tools, and software (such as Xero, CRM platforms, project management tools, etc.) as required for the role.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Is offshore staffing secure and compliant?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">We follow structured hiring processes and confidentiality agreements. For sensitive roles, NDAs and data protection measures can be implemented to protect your business information.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">How does offshore staffing compare to hiring locally in {{ $countryName }}?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Hiring offshore significantly reduces salary costs, superannuation, payroll tax, and office overhead. Many {{ $countryAdjective }} businesses use offshore teams to handle operational support while keeping strategic roles locally.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Can I scale my offshore team over time?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Absolutely. Many {{ $countryAdjective }} businesses start with one remote staff member and gradually build a small offshore team as operations grow. Our model is designed to support scalable growth.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Why choose Bali as an offshore location?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Bali offers a strong talent pool, cultural alignment with {{ $countryAdjective }} businesses, and time zone compatibility. It has become a growing hub for remote professionals supporting international companies.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Is offshore staffing legal for {{ $countryAdjective }} companies?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Yes, offshore staffing is legal for {{ $countryAdjective }} companies. Many {{ $countryAdjective }} businesses hire remote staff overseas as independent contractors or through offshore staffing partners. The key is ensuring the arrangement is structured correctly, with clear agreements, defined responsibilities, and proper compliance with {{ $countryAdjective }} business regulations. Offshore staffing is commonly used by SMEs, agencies, and growing businesses looking to reduce operational costs while maintaining productivity. If structured properly, it is a legitimate and widely adopted business model in {{ $countryName }}.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">What is the best way to hire remote staff for {{ $countryAdjective }} SMEs?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">The best way for {{ $countryAdjective }} SMEs to hire remote staff is through a structured process: clearly define the role and outcomes, partner with a reliable offshore staffing provider, interview shortlisted candidates, set measurable performance indicators, and start with a flexible engagement model. SMEs benefit most when they treat offshore staff as long-term team members rather than short-term freelancers. A dedicated remote professional integrated into daily operations will deliver far stronger results than ad-hoc outsourcing. For many {{ $countryAdjective }} small and medium businesses, starting with one dedicated remote staff member is often the smartest first step.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Is the {{ $pageBaseLabel }} minimum realistic for quality staff?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Yes, in the right market. The cost of living and salary standards in Indonesia are significantly lower than in {{ $countryName }}, which makes {{ $pageBaseLabel }} plus service fee a competitive and fair entry point while still being cost-effective for {{ $countryAdjective }} businesses. At this level, you can hire experienced professionals for roles such as virtual assistants, admin support, marketing assistants, bookkeeping support, and lead generation specialists. More specialised or senior-level positions may require a higher rate depending on experience and complexity.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">What are the risks of hiring offshore?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Like any hiring decision, offshore staffing comes with risks if not structured properly. Common risks include hiring without proper screening, poor communication expectations, no clear KPIs or accountability, cultural or workflow misalignment, and treating offshore staff as freelancers instead of team members. These risks are avoidable with a structured recruitment process, clear documentation, and regular performance reviews. When offshore staff are integrated properly with defined roles, measurable outcomes, and consistent communication, many {{ $countryAdjective }} businesses find they become long-term, reliable team members. Offshore staffing is not about cheap labour. It is about building efficient, scalable teams with the right structure in place.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">How much can {{ $countryAdjective }} businesses actually save with offshore staff?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Savings depend on the role, but many {{ $countryAdjective }} businesses reduce staffing costs by 50-70% compared to hiring locally. For example, an entry-level admin or support role in {{ $countryName }} may cost $55,000-$70,000 per year plus superannuation, payroll tax, leave entitlements, and office overhead. With offshore staffing starting from {{ $pageBaseLabel }} plus 11% service fee, businesses can significantly reduce salary expenses while still maintaining dedicated, full-time support. Beyond salary savings, companies also reduce superannuation contributions, payroll tax, office space costs, equipment overhead, and recruitment delays.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">What happens if my business grows and I need more staff?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Offshore staffing is designed to scale with your business. Many {{ $countryAdjective }} companies start with one remote staff member, often in admin, marketing, or operations support, and gradually expand into a small offshore team as workload increases. Because the model is flexible and month-to-month, you can add additional team members, increase hours, transition from part-time to full-time, and build a structured offshore department. Scaling offshore is often faster and more cost-effective than recruiting locally, especially during growth phases.</p>
                    </article>
                    <article>
                        <h4 class="text-base font-semibold text-[#1f5f46]">Is offshore staffing suitable for small businesses?</h4>
                        <p class="mt-1 text-sm leading-relaxed text-[#5a5a55]">Yes, in fact, small and medium-sized businesses often benefit the most. For {{ $countryAdjective }} SMEs, hiring locally can feel financially risky. Offshore staffing allows small businesses to access skilled support without committing to high fixed employment costs. It is particularly effective for business owners overwhelmed with admin, agencies needing backend support, trades or service businesses handling growing enquiries, and e-commerce brands needing marketing and operations help. Starting with one dedicated remote staff member can immediately reduce founder workload and create space to focus on revenue-generating activities. Offshore staffing is not just for large corporations, it is a strategic tool for small businesses that want to grow sustainably.</p>
                    </article>
                </section>
            </section>
        </main>
        <x-site-footer />
    </div>
    @once
        <script>
            (() => {
                const pricingCard = document.querySelector('[data-dynamic-pricing]');

                if (pricingCard) {
                    const baseAmount = Number(pricingCard.dataset.baseAmount || '10');
                    const baseCurrency = String(pricingCard.dataset.baseCurrency || 'AUD').toUpperCase();
                    const serviceFeeRate = Number(pricingCard.dataset.serviceFeeRate || '0.11');
                    const countrySlug = String(pricingCard.dataset.countrySlug || '').toLowerCase();
                    const defaultCurrencyCode = String(pricingCard.dataset.defaultCurrency || 'AUD').toUpperCase();
                    const locale = (navigator.languages && navigator.languages[0]) || navigator.language || 'en-AU';

                    // Reference rates for 1 AUD in target currencies (BNI reference, periodically updated).
                    const bniAudRates = {
                        AUD: 1,
                        USD: 0.65,
                        IDR: 10150,
                        CAD: 0.89,
                        MYR: 3.06,
                        EUR: 0.6,
                        SGD: 0.87,
                    };

                    const pageCurrencyBySlug = {
                        australia: 'AUD',
                        america: 'USD',
                        indonesia: 'IDR',
                        bali: 'IDR',
                        canada: 'CAD',
                        malaysia: 'MYR',
                        germany: 'EUR',
                        singapore: 'SGD',
                    };

                    const setText = (selector, value) => {
                        document.querySelectorAll(selector).forEach((element) => {
                            element.textContent = value;
                        });
                    };

                    const formatCurrency = (value, currencyCode) => {
                        try {
                            return new Intl.NumberFormat(locale, {
                                style: 'currency',
                                currency: currencyCode,
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            }).format(value);
                        } catch (error) {
                            return `${currencyCode} ${value.toFixed(2)}`;
                        }
                    };

                    const convertAmount = (amount, fromCurrency, toCurrency) => {
                        const from = String(fromCurrency || '').toUpperCase();
                        const to = String(toCurrency || '').toUpperCase();

                        if (!Object.prototype.hasOwnProperty.call(bniAudRates, from) || !Object.prototype.hasOwnProperty.call(bniAudRates, to)) {
                            return amount;
                        }

                        const amountInAud = amount / bniAudRates[from];
                        return amountInAud * bniAudRates[to];
                    };

                    const updatePricing = (rawCurrencyCode) => {
                        const requestedCurrencyCode = String(rawCurrencyCode || 'AUD').toUpperCase();
                        const currencyCode = Object.prototype.hasOwnProperty.call(bniAudRates, requestedCurrencyCode)
                            ? requestedCurrencyCode
                            : 'AUD';
                        const baseValue = convertAmount(baseAmount, baseCurrency, currencyCode);
                        const feeValue = baseValue * serviceFeeRate;
                        const totalValue = baseValue + feeValue;

                        setText('[data-price-base]', `${formatCurrency(baseValue, currencyCode)}/hour`);
                        setText('[data-price-fee]', `${formatCurrency(feeValue, currencyCode)}/hour`);
                        setText('[data-price-total]', `${formatCurrency(totalValue, currencyCode)}/hour`);
                        setText('[data-price-currency-code]', currencyCode);
                        setText('[data-price-headline]', `From ${formatCurrency(baseValue, currencyCode)}/hour + 11% service fee`);
                    };

                    const pageCurrency = pageCurrencyBySlug[countrySlug] || defaultCurrencyCode || 'AUD';
                    updatePricing(pageCurrency);
                }

                const faq = document.querySelector('[data-faq-accordion]');
                if (!faq) return;

                const items = Array.from(faq.querySelectorAll('article'));
                if (!items.length) return;

                const closeItem = (item) => {
                    const answer = item.querySelector('p');
                    const icon = item.querySelector('[data-faq-icon]');
                    if (!answer || !icon) return;
                    answer.classList.add('hidden');
                    icon.textContent = '+';
                    item.classList.remove('bg-[#f7faf8]');
                };

                const openItem = (item) => {
                    const answer = item.querySelector('p');
                    const icon = item.querySelector('[data-faq-icon]');
                    if (!answer || !icon) return;
                    answer.classList.remove('hidden');
                    icon.textContent = '-';
                    item.classList.add('bg-[#f7faf8]');
                };

                items.forEach((item, index) => {
                    item.classList.add('rounded-2xl', 'border', 'border-[#d9e3dc]', 'p-5', 'transition');

                    const question = item.querySelector('h4');
                    const answer = item.querySelector('p');
                    if (!question || !answer) return;

                    const icon = document.createElement('span');
                    icon.dataset.faqIcon = 'true';
                    icon.className = 'ml-3 text-xl leading-none text-[#287854]';
                    question.appendChild(icon);
                    question.classList.add('cursor-pointer', 'flex', 'items-center', 'justify-between');
                    question.setAttribute('role', 'button');
                    question.setAttribute('tabindex', '0');
                    answer.classList.add('mt-2');

                    if (index === 0) {
                        openItem(item);
                    } else {
                        closeItem(item);
                    }

                    const toggle = () => {
                        const isOpen = !answer.classList.contains('hidden');
                        items.forEach((other) => closeItem(other));
                        if (!isOpen) {
                            openItem(item);
                        }
                    };

                    question.addEventListener('click', toggle);
                    question.addEventListener('keydown', (event) => {
                        if (event.key === 'Enter' || event.key === ' ') {
                            event.preventDefault();
                            toggle();
                        }
                    });
                });
            })();
        </script>
    @endonce
</body>
</html>
