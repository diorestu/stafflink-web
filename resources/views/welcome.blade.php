<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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
</head>

<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main>
            <x-hero :content="$hero" />
            <x-overview :content="$overview" />
            <x-industries :content="$industries" />
            <x-staffing :content="$staffing" :categories="$careerCategories" />
            <x-cta :content="$cta" />
            <x-faq :items="$faqs" />
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
