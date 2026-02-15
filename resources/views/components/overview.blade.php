@props(['content' => []])

<section class="px-6 pb-20">
    <div class="mx-auto max-w-[75.6rem]">
        @php
            $defaultCards = [
                [
                    'title' => 'Scale your business to new heights',
                    'description' =>
                        'See your business grow and prosper - minus the challenges and huge costs of finding & integrating the top talent you need to make that happen.',
                ],
                [
                    'title' => 'Partner with professionals committed to your success.',
                    'description' =>
                        'Work with talented individuals who are not only highly experienced & exceptionally qualified, but also with a heart to care for your business as much as you do.',
                ],
                [
                    'title' => 'Seamless services managed in our Indonesia headquarters',
                    'description' =>
                        'Get access to our international talent pool, selected & vetted by our local Australia-based hiring team.',
                ],
                [
                    'title' => 'Tailored solutions designed for your unique needs',
                    'description' =>
                        'We make it possible for businesses all over the world to deliver next-level services to their clients and enjoy increased revenue.',
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
                            'fa-solid fa-comments',
                            'fa-solid fa-user-group',
                            'fa-solid fa-building',
                            'fa-solid fa-bullseye',
                        ];
                    @endphp
                    @foreach ($cards as $i => $card)
                        <div class="rounded-2xl px-5 py-6" data-aos="fade-up"
                            data-aos-delay="{{ ($i + 1) * 100 }}">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-[#287854]/40 text-[#287854]">
                                <i class="{{ $icons[$i] ?? $icons[0] }} text-[1.45rem] leading-none" aria-hidden="true"></i>
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
                <img src="{{ asset('images/side_globe.png') }}" alt="World map"
                    class="absolute right-[-5rem] top-1/2 h-[450px] w-[450px] -translate-y-1/2 -scale-y-100 rotate-180 rounded-full object-cover" draggable="false" />
            </div>
        </div>
    </div>
</section>
