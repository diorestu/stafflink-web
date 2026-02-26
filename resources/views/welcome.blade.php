<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $faqStructuredDataNodes = [];
        if (($faqs ?? collect())->isNotEmpty()) {
            $faqStructuredDataNodes[] = [
                '@type' => 'FAQPage',
                '@id' => request()->url().'#faq',
                'mainEntity' => ($faqs ?? collect())
                    ->take(20)
                    ->map(function ($faq) {
                        return [
                            '@type' => 'Question',
                            'name' => (string) $faq->question,
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => strip_tags((string) $faq->answer),
                            ],
                        ];
                    })
                    ->values()
                    ->all(),
            ];
        }
    @endphp
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Global Staffing & Recruitment Services',
        'seoDescription' => 'StaffLink Solutions helps businesses hire trusted global talent with tailored staffing, recruitment, and outsourcing support.',
        'seoKeywords' => 'stafflink, recruitment agency, staffing solutions, outsourcing services, global hiring',
        'seoStructuredDataNodes' => $faqStructuredDataNodes,
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @verbatim
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "EmploymentAgency",
        "name": "Staff Link Solutions",
        "description": "Premier staffing company specializing in providing top-tier nannies, cleaners, gardeners, handymen, office staff and specialised training to meet the diverse needs of individuals, hotels, residential properties, and businesses.",
        "url": "https://stafflink.pro", 
        "telephone": "+6285739660906",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Drupadi 1 No.20, Seminyak",
            "addressLocality": "Kec. Kuta, Kabupaten Badung",
            "addressRegion": "Bali",
            "postalCode": "80361",
            "addressCountry": "ID"
        },
        "openingHours": "Mo,Tu,We,Th,Fr,Sa 09:00-17:00",
        "areaServed": [
            "Seminyak",
            "Kuta",
            "Badung",
            "Bali"
        ],
        "makesOffer": [
            {
            "@type": "Offer",
            "itemOffered": {
                "@type": "Service",
                "name": "Professional Nannies"
            }
            },
            {
            "@type": "Offer",
            "itemOffered": {
                "@type": "Service",
                "name": "Cleaners & Housekeeping"
            }
            },
            {
            "@type": "Offer",
            "itemOffered": {
                "@type": "Service",
                "name": "Gardeners & Handymen"
            }
            },
            {
            "@type": "Offer",
            "itemOffered": {
                "@type": "Service",
                "name": "Office Staff & Specialised Training"
            }
            }
        ]
        }
        </script>
        @endverbatim
</head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main>
            <x-hero :content="$hero" />
            <x-overview :content="$overview" />
            <x-industries :content="$industries" />
            <x-staffing :content="$staffing" :categories="$careerCategories" />
            <x-cta :content="$cta" />
            @if (($faqs ?? collect())->isNotEmpty())
                <section class="px-6 pb-16 pt-4">
                    <div class="mx-auto grid max-w-6xl gap-6 lg:grid-cols-2 lg:items-stretch">
                        <div class="overflow-hidden rounded-[30px] shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.053958613446!2d115.16522599999999!3d-8.686418999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd247e6799ea107%3A0x11e082e1a331687!2sStaff%20Link!5e0!3m2!1sid!2sid!4v1771912308980!5m2!1sid!2sid"
                                class="h-[400px] w-full lg:h-[560px]"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="rounded-[30px] bg-white p-6 shadow-[0_20px_50px_rgba(31,95,70,0.12)] sm:p-10 lg:h-[560px] lg:overflow-y-auto" data-aos="fade-up" data-aos-delay="120">
                            <h2 class="mb-6 text-3xl font-semibold text-[#1b1b18] sm:text-4xl">Frequently Asked Questions (FAQs)</h2>
                            <div class="space-y-3">
                                @foreach ($faqs as $faq)
                                    <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                                        <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                                            <span class="text-base font-semibold text-[#1f5f46]">{{ $faq->question }}</span>
                                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                                        </summary>
                                        <div class="faq-answer">
                                            <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                                                {!! nl2br(e((string) $faq->answer)) !!}
                                            </div>
                                        </div>
                                    </details>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </main>
        <x-site-footer />
    </div>
    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3" data-aos="fade-up">
        <button type="button"
            class="flex h-12 w-12 items-center justify-center rounded-full border border-[#b28b2e] bg-white text-[#b28b2e] shadow-lg transition hover:bg-[#b28b2e] hover:text-white"
            data-scroll-top aria-label="Move to top">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                aria-hidden="true">
                <path d="M12 19V5" />
                <path d="M6 11l6-6 6 6" />
            </svg>
        </button>
        <a href="https://wa.me/6285739660906?text=Hello,%20I%E2%80%99m%20interested%20in%20learning%20more%20about%20your%20staffing%20services.%0A%0ACompany%20Name:%20%0AIndustry:%20%0APositions%20Needed:%20%0ANumber%20of%20Hires:%20%0AWork%20Arrangement%20(On-site%20/%20Remote%20/%20Hybrid):%20%0A%0APlease%20let%20me%20know%20how%20we%20can%20proceed%20with%20a%20consultation.%20Thank%20you."
            class="group relative flex h-16 w-16 items-center justify-center overflow-visible rounded-full bg-transparent transition"
            aria-label="WhatsApp Chat">
            <img src="{{ asset('images/64px-WhatsApp.svg.png') }}" alt="WhatsApp" class="h-full w-full object-contain"
                draggable="false" loading="lazy" />
            <span
                class="pointer-events-none absolute right-full mr-3 flex items-center gap-2 whitespace-nowrap rounded-full bg-[#287854] px-4 py-2 text-[11px] font-semibold tracking-tight text-white shadow-lg opacity-0 transition duration-300 ease-out translate-x-6 scale-x-105 origin-right group-hover:translate-x-0 group-hover:opacity-100">
                Click here to chat
            </span>
        </a>
    </div></body>

</html>
