<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.gtag-head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => $page->title.' | '.\App\Models\SiteSetting::siteName(),
        'seoDescription' => $page->meta_description ?: \Illuminate\Support\Str::limit(strip_tags((string) $page->content_html), 160),
        'seoKeywords' => 'stafflink page, staffing information, recruitment content',
    ])
    <style>{!! $page->content_css !!}</style>
</head>

<body>
    @include('partials.gtm-noscript')
    @if (!str_contains(strtolower((string) $page->content_html), '<h1'))
        <h1 style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
            {{ $page->title }}
        </h1>
    @endif
    {!! $page->content_html !!}
</body>

</html>
