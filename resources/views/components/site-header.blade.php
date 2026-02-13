@php
    $hf = \App\Models\SiteSetting::headerFooter();
@endphp

<header class="sticky top-0 z-50 px-6 pt-6" data-aos="fade-down">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-8 rounded-full bg-white/95 px-10 py-4 shadow-[0_14px_34px_rgba(31,95,70,0.2)] backdrop-blur">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="StaffLink logo" class="h-14 w-auto" draggable="false" />
        </div>
        <nav class="hidden items-center gap-6 text-sm text-[#4a4a45] lg:flex">
            <a href="{{ url('/') }}" class="transition hover:text-[#1b1b18]">Home</a>
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    About us
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-4 hidden w-72 rounded-2xl bg-white p-6 text-sm text-[#2e2e2e] shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-dropdown-menu>
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
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    User
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-4 hidden w-44 rounded-2xl bg-white p-4 text-sm text-[#2e2e2e] shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-dropdown-menu>
                    <div class="space-y-3">
                        @foreach (($hf['user_links'] ?? []) as $link)
                            <a href="{{ $link['url'] ?? '#' }}" class="block transition hover:text-[#287854]">{{ $link['label'] ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ $hf['apply_now_url'] ?? '#' }}" class="hidden rounded-full border border-[#b28b2e] px-4 py-2 text-sm font-semibold text-[#b28b2e] transition hover:bg-[#b28b2e] hover:text-white lg:inline-flex">{{ $hf['apply_now_label'] ?? 'Apply now' }}</a>
            <a href="{{ $hf['consultation_url'] ?? '#' }}" class="rounded-full bg-[#287854] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1f5f46]">{{ $hf['consultation_label'] ?? 'Free Consultation' }}</a>
        </div>
    </div>
</header>
