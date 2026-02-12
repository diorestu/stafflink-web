@props(['content' => []])

<section class="px-6 pb-20">
    <div class="mx-auto max-w-6xl">
        <div class="rounded-[32px] bg-[#1f5f46] px-8 py-12 text-white shadow-[0_20px_60px_rgba(31,95,70,0.2)]"
            data-aos="fade-up">
            <div class="flex flex-wrap items-center justify-between gap-6">
                <div>
                    <h3 class="text-3xl text-[#d6c18a]">{{ $content['title'] ?? 'Get Started' }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ $content['subtitle'] ?? "We're here to help." }}</p>
                </div>
                <button
                    class="rounded-full bg-[#b28b2e] px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#9b7829]">{{ $content['button_text'] ?? "Let's Talk" }}</button>
            </div>
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                @php
                    $ctaIcons = [
                        '<path d="M8 9h8" /><path d="M8 13h5" /><path d="M4 4h16v12H8l-4 4z" />',
                        '<path d="M5 4h4l2 5-2 2a12 12 0 0 0 6 6l2-2 5 2v4a2 2 0 0 1-2 2 16 16 0 0 1-14-14 2 2 0 0 1 2-2" />',
                        '<circle cx="9" cy="7" r="3" /><circle cx="17" cy="7" r="3" /><path d="M2 20a7 7 0 0 1 14 0" /><path d="M10 20a7 7 0 0 1 14 0" />',
                    ];
                @endphp
                @foreach ($content['cards'] ?? [] as $i => $card)
                    <div class="rounded-2xl bg-white/15 px-6 py-6 text-white backdrop-blur-lg ring-1 ring-white/30 shadow-[0_18px_40px_rgba(31,95,70,0.18)]"
                        data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white/30 text-white">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                {!! $ctaIcons[$i] ?? $ctaIcons[0] !!}
                            </svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold">{{ $card['title'] ?? '' }}</h3>
                        <p class="mt-2 text-sm text-white/80">{{ $card['description'] ?? '' }}</p>
                        @if (($card['contact_type'] ?? '') === 'email')
                            <a href="mailto:{{ $card['contact'] ?? '' }}"
                                class="mt-4 inline-flex text-sm font-semibold text-white">{{ $card['contact'] ?? '' }}</a>
                        @elseif(($card['contact_type'] ?? '') === 'hours')
                            <p class="mt-4 text-sm font-semibold text-white">{{ $card['contact'] ?? '' }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
