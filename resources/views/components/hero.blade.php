@props(['content' => []])

<section class="px-6 pb-12 pt-8">
    <div class="mx-auto max-w-[75.6rem]">
        <div class="relative overflow-hidden rounded-[36px] bg-gradient-to-r from-[#1f5f46] via-[#287854] to-[#3b8a63] text-white shadow-[0_30px_80px_rgba(31,95,70,0.28)]"
            data-aos="fade-up">
            <div class="absolute inset-0">
                <img src="{{ asset('images/hero-bg.webp') }}" alt="Confident professional"
                    class="h-full w-full scale-105 object-cover object-[82%_center] opacity-90" draggable="false" width="2526" height="1786" fetchpriority="high" decoding="async" />
                <div class="absolute inset-0 bg-gradient-to-r from-[#1f5f46]/90 via-[#1f5f46]/65 to-transparent"></div>
            </div>
            <div class="relative grid gap-8 px-6 py-8 sm:px-8 sm:py-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-10 lg:px-10 lg:py-12">
                <div class="space-y-5" data-aos="fade-right" data-aos-delay="100">
                    <h1 class="text-3xl font-semibold leading-tight text-white sm:text-4xl lg:text-[42px]">
                        {{ $content['badge'] ?? 'Global Staffing Expansion Made Easy' }}
                    </h1>
                    <h4 class="mb-1 text-lg font-semibold leading-tight text-white/95 sm:text-xl lg:text-[23px]">
                        {{ $content['title'] ?? 'Power Your Business with Top-Tier Talent' }}
                    </h4>
                    <p class="max-w-2xl text-xs italic leading-relaxed text-white/75 sm:text-sm">
                        {{ $content['subtitle'] ?? 'Staff Link Solutions sources top-tier nannies, cleaners, admin professionals, and specialised sector and more — connecting you to high-performing experts who drive elevate efficiency and success.' }}
                    </p>
                    @php
                        $defaultFeatures = [
                            [
                                'title' => 'Seamless Staffing, Maximum Results',
                                'description' =>
                                    'Maximize productivity and profitability with expertly vetted, handpicked talent from Staff Link Solutions, delivering reliability and excellence in every role.',
                            ],
                        ];
                        $features = $content['features'] ?? $defaultFeatures;
                    @endphp
                    <div class="grid gap-4">
                        @foreach ($features as $feature)
                            <div>
                                <h4 class="mb-1 text-lg font-semibold leading-tight text-white/95 sm:text-xl lg:text-[23px]">{{ $feature['title'] ?? '' }}</h4>
                                <p class="max-w-2xl text-xs italic leading-relaxed text-white/75 sm:text-sm">
                                    {{ $feature['description'] ?? '' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden lg:flex"></div>
            </div>
            <div class="relative border-t border-white/10 bg-[#1f5f46]/80 px-5 py-5 sm:px-8 sm:py-6 lg:px-10">
                @php
                    $statStyles = [
                        ['bg' => 'bg-[#287854]/55', 'text' => 'text-white', 'labelText' => 'text-white/70'],
                        ['bg' => 'bg-[#1f5f46]/55', 'text' => 'text-white', 'labelText' => 'text-white/70'],
                        ['bg' => 'bg-[#2f8b62]/55', 'text' => 'text-white', 'labelText' => 'text-white/70'],
                    ];
                    $defaultStats = [
                        ['title' => 'MONTH TO MONTH FEES'],
                        ['title' => 'LOCK-IN CONTRACT'],
                        ['title' => 'BOOK A CALL'],
                    ];
                    $stats = $content['stats'] ?? $defaultStats;
                @endphp
                <div class="grid items-stretch gap-3 sm:grid-cols-3 sm:gap-4">
                    @foreach ($stats as $idx => $stat)
                        @php $style = $statStyles[$idx] ?? $statStyles[0]; @endphp
                        <div class="flex min-h-[91px] flex-col justify-center rounded-2xl border border-white/20 {{ $style['bg'] }} px-5 py-4 {{ $style['text'] }} shadow-[inset_0_1px_0_rgba(255,255,255,0.16)] backdrop-blur-md sm:min-h-[98px] sm:px-6 sm:py-5"
                            data-aos="zoom-in" data-aos-delay="{{ ($idx + 1) * 100 }}">
                            <div class="flex items-center justify-center gap-4 text-center">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full aspect-square {{ $idx === 2 ? 'bg-white/45' : 'bg-white/15' }}">
                                    <svg class="h-[2rem] w-[2rem]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        @if ($idx === 0)
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v2H2V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm15 9H2v8a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-8Z" />
                                        @elseif($idx === 1)
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.5A4.5 4.5 0 0 0 7.5 6v3H6A2.25 2.25 0 0 0 3.75 11.25v8.5A2.25 2.25 0 0 0 6 22h12a2.25 2.25 0 0 0 2.25-2.25v-8.5A2.25 2.25 0 0 0 18 9h-1.5V6A4.5 4.5 0 0 0 12 1.5Zm2.5 7.5h-5V6a2.5 2.5 0 1 1 5 0v3Z" />
                                        @else
                                            <path d="M6.62 2A2.62 2.62 0 0 0 4 4.62C4 14.22 9.78 20 19.38 20A2.62 2.62 0 0 0 22 17.38v-2.61a1.5 1.5 0 0 0-1.03-1.42l-4.1-1.37a1.5 1.5 0 0 0-1.56.38l-1.57 1.57a12.8 12.8 0 0 1-3.67-3.67l1.57-1.57a1.5 1.5 0 0 0 .38-1.56L10.65 3.03A1.5 1.5 0 0 0 9.23 2H6.62Z" />
                                        @endif
                                    </svg>
                                </div>
                                <p class="text-center text-[0.8rem] font-semibold leading-tight sm:text-[1rem] lg:text-[1.1rem] lg:leading-[1.1]">
                                    {{ $stat['title'] ?? trim(($stat['label'] ?? '') . ' ' . ($stat['value'] ?? '')) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    <a href="{{ route('jobs.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/35 bg-white/10 px-4 py-3 text-center text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-white/20">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="11" cy="11" r="6" />
                            <path d="M20 20l-4.2-4.2" />
                        </svg>
                        Explore Jobs
                    </a>
                    <a href="{{ route('appointments.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#b28b2e] px-4 py-3 text-center text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-[#9b7829]">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M5 12h14" />
                            <path d="M13 6l6 6-6 6" />
                        </svg>
                        Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
