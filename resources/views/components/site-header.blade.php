@php
    $hf = \App\Models\SiteSetting::headerFooter();
    $marqueeTitle = 'STAFF LINK | Global Staffing Solutions Company';
@endphp

<header class="sticky top-0 z-50 w-full border-b border-[#dfe8e3] bg-white/95 backdrop-blur" data-aos="fade-down">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6 px-6 py-3 lg:px-10">
        <div class="flex items-center">
            <a href="{{ url('/') }}" aria-label="Go to homepage">
                <img src="{{ asset('images/logo.png') }}" alt="StaffLink logo" class="h-[70px] w-auto" draggable="false" />
            </a>
        </div>
        <nav class="hidden items-center gap-6 text-sm font-medium text-[#4a4a45] lg:flex">
            <a href="{{ url('/') }}" class="transition hover:text-[#1b1b18]">Home</a>
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    About us
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-3 hidden w-72 rounded-2xl bg-white p-6 text-sm text-[#2e2e2e] shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-dropdown-menu>
                    <div class="space-y-4">
                        @foreach (($hf['about_links'] ?? []) as $link)
                            <a href="{{ $link['url'] ?? '#' }}" class="block transition hover:text-[#287854]">{{ $link['label'] ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="transition hover:text-[#1b1b18]">Services</a>
            @foreach (($hf['main_links'] ?? []) as $link)
                <a href="{{ $link['url'] ?? '#' }}" class="transition hover:text-[#1b1b18]">{{ $link['label'] ?? '' }}</a>
            @endforeach
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ $hf['apply_now_url'] ?? '#' }}" class="hidden rounded-full border border-[#b28b2e] px-4 py-2 text-sm font-semibold text-[#b28b2e] transition hover:bg-[#b28b2e] hover:text-white lg:inline-flex">{{ $hf['apply_now_label'] ?? 'Apply now' }}</a>
            <a href="{{ $hf['consultation_url'] ?? '#' }}" class="rounded-full bg-[#287854] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1f5f46]">{{ $hf['consultation_label'] ?? 'Free Consultation' }}</a>
        </div>
    </div>
</header>

@once
    <script>
        (() => {
            const marker = '__stafflink_title_marquee__';
            if (window[marker]) return;
            window[marker] = true;

            const base = @json($marqueeTitle . '   ');
            let text = base;
            document.title = @json($marqueeTitle);

            setInterval(() => {
                text = text.slice(1) + text.charAt(0);
                document.title = text;
            }, 220);
        })();
    </script>
@endonce
