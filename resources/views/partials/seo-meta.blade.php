@php
    $siteName = \App\Models\SiteSetting::siteName();
    $seoTitle = trim((string) ($seoTitle ?? $siteName));
    $seoDescription = trim((string) ($seoDescription ?? 'StaffLink Solutions provides trusted staffing, recruitment, and consultation services across Bali and beyond.'));
    $seoCanonical = $seoCanonical ?? request()->url();
    $seoType = $seoType ?? 'website';
    $seoImage = $seoImage ?? asset('images/logo.webp');
    $seoRobots = $seoRobots ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    $seoKeywords = trim((string) ($seoKeywords ?? 'staffing agency, recruitment services, outsourcing, bali staffing, hr services'));
    $seoPublishedTime = $seoPublishedTime ?? null;
    $seoModifiedTime = $seoModifiedTime ?? null;
    $seoAuthor = trim((string) ($seoAuthor ?? $siteName));
    $seoLocale = str_replace('_', '-', app()->getLocale());
    $seoOgLocale = str_replace('-', '_', $seoLocale);
    $seoStructuredDataNodes = is_array($seoStructuredDataNodes ?? null) ? $seoStructuredDataNodes : [];
    $seoBreadcrumbItems = is_array($seoBreadcrumbItems ?? null) ? $seoBreadcrumbItems : [];

    $titleParts = collect(explode('|', $seoTitle))
        ->map(fn ($part) => trim((string) $part))
        ->filter(fn ($part) => $part !== '' && strcasecmp($part, $siteName) !== 0)
        ->values();

    if ($titleParts->isEmpty()) {
        $seoTitle = $siteName;
    } else {
        $seoTitle = $titleParts->first().' | '.$siteName;
    }
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="author" content="{{ $seoAuthor }}">
<meta name="theme-color" content="#1f5f46">
<meta http-equiv="content-language" content="{{ $seoLocale }}">
<link rel="canonical" href="{{ $seoCanonical }}">
<link rel="alternate" hreflang="{{ $seoLocale }}" href="{{ $seoCanonical }}">
<link rel="alternate" hreflang="x-default" href="{{ $seoCanonical }}">
<link rel="icon" href="{{ asset('favicon.ico') }}">

<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="{{ $seoType }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:locale" content="{{ $seoOgLocale }}">
@if ($seoPublishedTime)
    <meta property="article:published_time" content="{{ $seoPublishedTime }}">
@endif
@if ($seoModifiedTime)
    <meta property="article:modified_time" content="{{ $seoModifiedTime }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">

@if (($seoStructuredData ?? true) === true)
    @php
        $graph = [
            [
                '@type' => 'Organization',
                '@id' => url('/').'#organization',
                'name' => $siteName,
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.webp'),
                ],
            ],
            [
                '@type' => 'LocalBusiness',
                '@id' => url('/').'#localbusiness',
                'name' => $siteName,
                'url' => url('/'),
                'image' => asset('images/logo.webp'),
                'areaServed' => ['@type' => 'Place', 'name' => 'Bali'],
                'telephone' => '+6285739660906',
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/').'#website',
                'url' => url('/'),
                'name' => $siteName,
                'publisher' => ['@id' => url('/').'#organization'],
                'inLanguage' => $seoLocale,
            ],
            [
                '@type' => 'WebPage',
                '@id' => $seoCanonical.'#webpage',
                'url' => $seoCanonical,
                'name' => $seoTitle,
                'description' => $seoDescription,
                'isPartOf' => ['@id' => url('/').'#website'],
                'inLanguage' => $seoLocale,
            ],
        ];

        if (!empty($seoBreadcrumbItems)) {
            $breadcrumbElements = [];
            foreach ($seoBreadcrumbItems as $index => $item) {
                if (!is_array($item) || empty($item['name'])) {
                    continue;
                }

                $breadcrumbElements[] = [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => (string) $item['name'],
                    'item' => (string) ($item['url'] ?? $seoCanonical),
                ];
            }

            if (!empty($breadcrumbElements)) {
                $graph[] = [
                    '@type' => 'BreadcrumbList',
                    '@id' => $seoCanonical.'#breadcrumb',
                    'itemListElement' => $breadcrumbElements,
                ];
            }
        }

        foreach ($seoStructuredDataNodes as $node) {
            if (is_array($node) && !empty($node)) {
                $graph[] = $node;
            }
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => array_values($graph),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
