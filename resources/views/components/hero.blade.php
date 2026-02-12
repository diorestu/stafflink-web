@props(['content' => []])

<section class="px-6 pb-16 pt-10">
    <div class="mx-auto max-w-6xl">
        <div class="relative overflow-hidden rounded-[36px] bg-gradient-to-r from-[#1f5f46] via-[#287854] to-[#3b8a63] text-white shadow-[0_30px_80px_rgba(31,95,70,0.28)]"
            data-aos="fade-up">
            <div class="absolute inset-0">
                <img src="{{ asset('images/single_img.png') }}" alt="Confident professional"
                    class="h-full w-full object-cover object-[right_20%] opacity-90" draggable="false" />
                <div class="absolute inset-0 bg-gradient-to-r from-[#1f5f46]/90 via-[#1f5f46]/65 to-transparent"></div>
            </div>
            <div class="relative grid gap-10 px-10 py-12 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="space-y-6" data-aos="fade-right" data-aos-delay="100">
                    <div
                        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.2em] text-white/80">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#d6c18a]"></span>
                        {{ $content['badge'] ?? 'Global hiring' }}
                    </div>
                    <h1 class="text-4xl font-semibold leading-tight sm:text-5xl">
                        {{ $content['title'] ?? 'Global Staffing Expansion Made Easy' }}
                    </h1>
                    <p class="max-w-xl text-sm text-white/85 sm:text-base">
                        {{ $content['subtitle'] ?? '' }}
                    </p>
                    <div class="grid gap-6 sm:grid-cols-2">
                        @foreach ($content['features'] ?? [] as $feature)
                            <div>
                                <p class="text-lg font-semibold">{{ $feature['title'] ?? '' }}</p>
                                <p class="mt-2 text-sm text-white/80">
                                    {{ $feature['description'] ?? '' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden lg:flex"></div>
            </div>
            <div class="relative grid gap-4 border-t border-white/10 bg-[#1f5f46]/85 px-10 py-6 sm:grid-cols-3">
                @php
                    $statStyles = [
                        ['bg' => 'bg-[#287854]', 'text' => 'text-white', 'labelText' => 'text-white/70'],
                        ['bg' => 'bg-[#1f5f46]', 'text' => 'text-white', 'labelText' => 'text-white/70'],
                        ['bg' => 'bg-[#b28b2e]', 'text' => 'text-[#2e2e2e]', 'labelText' => 'text-[#3c3c2f]'],
                    ];
                @endphp
                @foreach ($content['stats'] ?? [] as $idx => $stat)
                    @php $style = $statStyles[$idx] ?? $statStyles[0]; @endphp
                    <div class="flex items-center gap-4 rounded-2xl {{ $style['bg'] }} px-5 py-4 {{ $style['text'] }}"
                        data-aos="zoom-in" data-aos-delay="{{ ($idx + 1) * 100 }}">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full {{ $idx === 2 ? 'bg-white/45' : 'bg-white/15' }}">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                @if ($idx === 0)
                                    <rect x="5" y="11" width="14" height="10" rx="2" />
                                    <path d="M8 11V7a4 4 0 0 1 8 0v4" />
                                @elseif($idx === 1)
                                    <path d="M7 3h7l4 4v14H7z" />
                                    <path d="M14 3v4h4" />
                                    <path d="M9 12h6" />
                                    <path d="M9 16h6" />
                                @else
                                    <path d="M5 4h4l2 5-2 2a12 12 0 0 0 6 6l2-2 5 2v4a2 2 0 0 1-2 2 16 16 0 0 1-14-14 2 2 0 0 1 2-2" />
                                @endif
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs {{ $style['labelText'] }}">{{ $stat['label'] ?? '' }}</p>
                            <p class="text-sm font-semibold">{{ $stat['value'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
