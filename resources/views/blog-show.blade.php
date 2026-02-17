<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - {{ \App\Models\SiteSetting::siteName() }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Google+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />

        <main class="px-8 pb-24 pt-12 lg:px-10">
            <article class="mx-auto max-w-4xl rounded-[30px] bg-white p-8 shadow-[0_18px_44px_rgba(31,95,70,0.12)] lg:p-10">
                <a href="{{ route('blog') }}" class="text-sm font-semibold text-[#287854] hover:text-[#1f5f46]">← Back to blog</a>
                <p class="mt-4 text-xs uppercase tracking-[0.2em] text-[#287854]">{{ $post->published_at?->format('F d, Y') }}</p>
                <h1 class="mt-3 text-4xl font-semibold text-[#1b1b18]">{{ $post->title }}</h1>

                @if ($post->featured_image_path)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->featured_image_path) }}" alt="{{ $post->title }}"
                        class="mt-6 block h-[320px] w-full rounded-2xl object-cover" draggable="false">
                @endif

                <div class="prose prose-lg mt-8 max-w-none text-[#3f3f3a]">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </article>

            @if ($relatedPosts->count() > 0)
                <section class="mx-auto mt-10 max-w-6xl">
                    <h2 class="text-2xl font-semibold text-[#1b1b18]">Related Articles</h2>
                    <div class="mt-5 grid gap-6 md:grid-cols-3">
                        @foreach ($relatedPosts as $related)
                            <article class="overflow-hidden rounded-2xl border border-[#d9e3dc] bg-white shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                                @if ($related->featured_image_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($related->featured_image_path) }}"
                                        alt="{{ $related->title }}" class="block h-40 w-full object-cover" draggable="false">
                                @endif
                                <div class="p-5">
                                    <h3 class="text-lg font-semibold text-[#1b1b18]">{{ $related->title }}</h3>
                                    <a href="{{ route('blog.show', $related) }}" class="mt-3 inline-flex text-sm font-semibold text-[#287854] hover:text-[#1f5f46]">
                                        Read more →
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>

        <x-site-footer />
    </div>
</body>
</html>
