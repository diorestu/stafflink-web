<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - Blog</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">

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
            <section class="mx-auto max-w-7xl space-y-14">
                <div class="rounded-[32px] bg-[#dceae3] p-10 shadow-[0_20px_60px_rgba(31,95,70,0.16)] lg:p-14" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#287854]">Blog</p>
                    <h1 class="mt-5 text-4xl font-semibold leading-tight text-[#1b1b18] md:text-5xl">
                        Insights for Hiring
                        <br>
                        and Workforce Growth
                    </h1>
                    <p class="mt-6 max-w-3xl text-sm leading-relaxed text-[#3f3f3a]">
                        Practical guides and updates from StaffLink to help you build better teams and make faster hiring decisions.
                    </p>
                </div>

                @if ($featuredPost)
                    <section class="overflow-hidden rounded-[30px] bg-white shadow-[0_18px_44px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <div class="grid gap-0 lg:grid-cols-2">
                            <a href="{{ route('blog.show', $featuredPost) }}" class="block h-full">
                                @if ($featuredPost->featured_image_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($featuredPost->featured_image_path) }}"
                                        alt="{{ $featuredPost->title }}" class="block h-full min-h-[280px] w-full object-cover" draggable="false">
                                @else
                                    <div class="flex h-full min-h-[280px] items-center justify-center bg-[#e6f1ec] text-[#287854]">
                                        <span class="text-lg font-semibold">Featured Post</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-8 lg:p-10">
                                <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Featured</p>
                                <h2 class="mt-4 text-3xl font-semibold text-[#1b1b18]">{{ $featuredPost->title }}</h2>
                                <p class="mt-3 text-sm text-[#6b6b66]">
                                    {{ \Illuminate\Support\Str::limit($featuredPost->excerpt ?: strip_tags($featuredPost->content), 220) }}
                                </p>
                                <p class="mt-4 text-xs text-[#7a7a74]">{{ $featuredPost->published_at?->format('F d, Y') }}</p>
                                <a href="{{ route('blog.show', $featuredPost) }}"
                                    class="mt-6 inline-flex rounded-full bg-[#287854] px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">
                                    Read Article
                                </a>
                            </div>
                        </div>
                    </section>
                @endif

                <section data-aos="fade-up">
                    <div class="flex items-end justify-between gap-4">
                        <h2 class="text-3xl font-semibold text-[#1b1b18]">Latest Articles</h2>
                        <span class="text-sm text-[#6b6b66]">{{ $posts->total() }} post{{ $posts->total() === 1 ? '' : 's' }}</span>
                    </div>

                    @if ($posts->count() > 0)
                        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($posts as $post)
                                <article class="overflow-hidden rounded-2xl border border-[#d9e3dc] bg-white shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
                                    <a href="{{ route('blog.show', $post) }}" class="block">
                                        @if ($post->featured_image_path)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->featured_image_path) }}"
                                                alt="{{ $post->title }}" class="block h-48 w-full object-cover" draggable="false">
                                        @else
                                            <div class="h-48 w-full bg-[#e6f1ec]"></div>
                                        @endif
                                    </a>
                                    <div class="p-6">
                                        <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">{{ $post->published_at?->format('M d, Y') }}</p>
                                        <h3 class="mt-3 text-xl font-semibold text-[#1b1b18]">
                                            <a href="{{ route('blog.show', $post) }}" class="hover:text-[#287854] transition">{{ $post->title }}</a>
                                        </h3>
                                        <p class="mt-3 text-sm leading-relaxed text-[#6b6b66]">
                                            {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 150) }}
                                        </p>
                                        <a href="{{ route('blog.show', $post) }}" class="mt-4 inline-flex text-sm font-semibold text-[#287854] hover:text-[#1f5f46]">
                                            Read more →
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        @if ($posts->hasPages())
                            <div class="mt-8">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    @else
                        <div class="mt-8 rounded-2xl border border-[#d9e3dc] bg-white p-10 text-center">
                            <h3 class="text-xl font-semibold text-[#1b1b18]">No blog posts published yet</h3>
                            <p class="mt-2 text-sm text-[#6b6b66]">Please check back soon for updates.</p>
                        </div>
                    @endif
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3" data-aos="fade-up">
        <button type="button"
            class="flex h-12 w-12 items-center justify-center rounded-full border border-[#b28b2e] bg-white text-[#b28b2e] shadow-lg transition hover:bg-[#b28b2e] hover:text-white"
            data-scroll-top aria-label="Move to top">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path d="M12 19V5" />
                <path d="M6 11l6-6 6 6" />
            </svg>
        </button>
        <a href="https://wa.me/6285739660906"
            class="group relative flex h-14 w-14 items-center justify-center overflow-visible rounded-full bg-transparent transition"
            aria-label="WhatsApp Chat">
            <img src="{{ asset('images/512px-WhatsApp.svg.webp') }}" alt="WhatsApp" class="h-[3.6rem] w-[3.6rem]" draggable="false" />
            <span class="pointer-events-none absolute right-full mr-3 flex items-center gap-2 whitespace-nowrap rounded-full bg-[#287854] px-4 py-2 text-[11px] font-semibold tracking-tight text-white shadow-lg opacity-0 transition duration-300 ease-out translate-x-6 scale-x-105 origin-right group-hover:translate-x-0 group-hover:opacity-100">
                Click here to chat
            </span>
        </a>
    </div>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</body>
</html>
