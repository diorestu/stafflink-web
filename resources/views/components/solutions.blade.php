@props(['content' => []])

<section class="px-6 pb-20">
    <div class="mx-auto max-w-6xl text-center" data-aos="fade-up">
        <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">{{ $content['badge'] ?? 'StaffLink Solutions' }}</p>
        <h2 class="mt-3 text-3xl font-semibold">{{ $content['title'] ?? '' }}</h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm text-[#6b6b66]">
            {{ $content['subtitle'] ?? '' }}
        </p>
        <div class="mt-10 grid gap-6 text-left sm:grid-cols-2 lg:grid-cols-3">
            @php
                $icons = [
                    '<rect x="4" y="6" width="16" height="12" rx="2" /><path d="M8 10h8" /><path d="M8 14h5" />',
                    '<path d="M12 3l8 4v6c0 5-3 7-8 8-5-1-8-3-8-8V7l8-4z" />',
                    '<circle cx="12" cy="12" r="8" /><path d="M12 8v4l3 3" />',
                    '<path d="M4 6h16" /><path d="M7 10h10" /><path d="M7 14h10" /><path d="M9 18h6" />',
                    '<path d="M8 4h8" /><path d="M9 4v16" /><path d="M15 4v16" /><path d="M6 8h12" /><path d="M6 16h12" />',
                    '<circle cx="12" cy="12" r="8" /><path d="M8 12l2 2 4-4" />',
                ];
            @endphp
            @foreach ($content['cards'] ?? [] as $i => $card)
                <div class="rounded-2xl bg-white px-6 py-6 shadow-[0_18px_35px_rgba(31,95,70,0.12)]" data-aos="fade-up"
                    data-aos-delay="{{ 100 + $i * 50 }}">
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-full border border-[#287854]/30 text-[#287854]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            {!! $icons[$i] ?? $icons[0] !!}
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold">{{ $card['title'] ?? '' }}</h3>
                    <p class="mt-2 text-sm text-[#6b6b66]">{{ $card['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
