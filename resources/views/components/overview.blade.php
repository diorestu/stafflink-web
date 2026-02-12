@props(['content' => []])

<section class="px-6 pb-20">
    <div class="mx-auto max-w-6xl">
        <div class="grid gap-10 rounded-[32px] bg-[#e6f1ec] px-8 py-12 shadow-[0_20px_60px_rgba(31,95,70,0.12)] lg:grid-cols-[1.2fr_0.8fr]"
            data-aos="fade-up">
            <div class="space-y-8">
                <div class="grid gap-6 sm:grid-cols-2">
                    @php
                        $icons = [
                            '<path d="M4 19h16" /><path d="M5 15l4-4 3 3 5-6" />',
                            '<circle cx="8" cy="9" r="3" /><circle cx="16" cy="9" r="3" /><path d="M2 20a6 6 0 0 1 12 0" /><path d="M10 20a6 6 0 0 1 12 0" />',
                            '<path d="M12 4l7 4v8l-7 4-7-4V8z" /><path d="M12 12l7-4" /><path d="M12 12l-7-4" />',
                            '<circle cx="12" cy="12" r="8" /><circle cx="12" cy="12" r="3" />',
                        ];
                    @endphp
                    @foreach ($content['cards'] ?? [] as $i => $card)
                        <div class="rounded-2xl bg-white px-5 py-6 shadow-sm" data-aos="fade-up"
                            data-aos-delay="{{ ($i + 1) * 100 }}">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-[#287854]/40 text-[#287854]">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    {!! $icons[$i] ?? $icons[0] !!}
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold">{{ $card['title'] ?? '' }}</h3>
                            <p class="mt-2 text-sm text-[#6b6b66]">{{ $card['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
                <button
                    class="inline-flex items-center gap-2 rounded-full bg-[#b28b2e] px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#9b7829]"
                    data-aos="fade-up" data-aos-delay="500">
                    {{ $content['button_text'] ?? 'Learn more' }}
                </button>
            </div>
            <div class="relative flex items-center justify-center" data-aos="zoom-in" data-aos-delay="200">
                <div
                    class="absolute h-[280px] w-[280px] rounded-full bg-gradient-to-br from-white via-[#f4f5f3] to-[#dfe9e4] shadow-[0_25px_60px_rgba(31,95,70,0.18)]">
                </div>
                <img src="{{ asset('images/side_globe.png') }}" alt="World map"
                    class="relative h-[240px] w-[240px] rounded-full object-cover" draggable="false" />
            </div>
        </div>
    </div>
</section>
