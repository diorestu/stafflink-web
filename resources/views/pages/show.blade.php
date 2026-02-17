<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title }} - {{ \App\Models\SiteSetting::siteName() }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    @if($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
    <style>{!! $page->content_css !!}</style>
</head>

<body>
    {!! $page->content_html !!}
</body>

</html>
