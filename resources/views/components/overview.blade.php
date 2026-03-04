@props(['content' => []])

<section class="px-6 pb-20">
    <div class="mx-auto max-w-[75.6rem]">
        @php
            $defaultCards = [
                [
                    'title' => 'Scale Global Operations with Confidence',
                    'description' =>
                        'Accelerate business growth without the high cost and complexity of hiring, integrating, and managing international talent alone.',
                ],
                [
                    'title' => 'Work with Vetted International Talent',
                    'description' =>
                        'Build reliable teams with pre-screened professionals who bring role-specific expertise, strong accountability, and long-term performance.',
                ],
                [
                    'title' => 'Structured Delivery with Regional Support',
                    'description' =>
                        'Access a global talent pool managed through standardized systems and responsive regional coordination for consistent execution.',
                ],
                [
                    'title' => 'Tailored Workforce Solutions for Scalable Growth',
                    'description' =>
                        'Align staffing strategy to your business goals, delivery model, and growth stage so you can improve efficiency and expand sustainably.',
                ],
            ];
            $cards = $content['cards'] ?? $defaultCards;
        @endphp
        <div class="relative overflow-hidden grid gap-10 rounded-[32px] border border-white/40 bg-white/35 px-8 py-12 shadow-[0_20px_60px_rgba(31,95,70,0.12)] backdrop-blur-xl lg:grid-cols-[1.2fr_0.8fr]"
            data-aos="fade-up">
            <div class="space-y-8">
                <div class="grid gap-6 sm:grid-cols-2">
                    @php
                        $icons = [
                            'comments',
                            'users',
                            'building',
                            'target',
                        ];
                    @endphp
                    @foreach ($cards as $i => $card)
                        <div class="rounded-2xl px-5 py-6" data-aos="fade-up"
                            data-aos-delay="{{ ($i + 1) * 100 }}">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-[#287854]/40 text-[#287854]">
                                <x-ui-icon :name="$icons[$i] ?? $icons[0]" class="h-6 w-6" />
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
            <div class="relative hidden lg:block" data-aos="zoom-in" data-aos-delay="200">
                <div
                    class="absolute right-[-6.6rem] top-1/2 h-[510px] w-[510px] -translate-y-1/2 rounded-full bg-gradient-to-br from-white via-[#f4f5f3] to-[#dfe9e4] shadow-[0_25px_60px_rgba(31,95,70,0.18)]">
                </div>
                <img src="{{ asset('images/side_globe.webp') }}" alt="World map"
                    class="absolute right-[-5rem] top-1/2 h-[450px] w-[450px] -translate-y-1/2 -scale-y-100 rotate-180 rounded-full object-cover" draggable="false" loading="lazy" decoding="async" />
            </div>
        </div>
    </div>
</section>
