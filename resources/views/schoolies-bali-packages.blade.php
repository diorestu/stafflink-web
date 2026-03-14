<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Schoolies Bali Packages',
        'seoDescription' => 'Explore official Bali Schoolies trip packages, event inclusions, and activities for the ultimate graduation celebration.',
        'seoKeywords' => 'schoolies bali packages, bali schoolies info, schoolies trip inclusions, FINNS schoolies',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fff8ee] text-[#1e2b26]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen">
        <x-site-header />

        <main class="px-5 pb-20 pt-8 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-8">
                <section class="overflow-hidden rounded-[30px] bg-[linear-gradient(130deg,#0f766e_0%,#158f95_45%,#ee9b00_100%)] px-7 py-10 text-white shadow-[0_20px_50px_rgba(15,118,110,0.2)] lg:px-10 lg:py-12">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/75">Official Packages</p>
                    <h1 class="mt-3 text-4xl font-semibold leading-tight sm:text-5xl">Schoolies Bali Trip Packages</h1>
                    <p class="mt-4 max-w-4xl text-sm leading-relaxed text-white/90 sm:text-base">
                        Bali trip packages for Schoolies celebration with official accommodation, event access, and curated activities.
                    </p>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Bali Schoolies Info</h2>
                    <p class="mt-4 text-sm leading-relaxed text-[#4c5f59]">
                        Want to take your Schoolies experience to the next level? Bali is the ultimate destination for a graduation celebration to remember. We’ve partnered with the world's best beach club - FINNS Beach Club to bring you the most epic parties and events for you to celebrate graduation the right way. Stay where all the action is with thousands of other Schoolies in our official accommodation options, and score exclusive access to the Official Schoolies Event Package for the ultimate Schoolies experience in Bali. With a stacked lineup of events, parties &amp; activities all valued at over $1,500, plus iconic Balinese accommodation, these packages will not last long. Grab your Schoolies Squad, passport and the good vibes and get ready for the time of your life in paradise!
                    </p>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    @php
                        $ticketPackages = [
                            [
                                'badge' => 'Popular',
                                'name' => '4 Hari Pass',
                                'subtitle' => 'Ideal untuk grup yang fokus event utama + highlight activities.',
                                'accent' => 'teal',
                                'image' => 'https://www.schoolies.com/images/home-page-slides/45.jpg',
                                'image_alt' => 'Schoolies Bali 4 hari package thumbnail',
                                'prices' => [
                                    ['label' => 'Early Bird', 'value' => 'By Request'],
                                    ['label' => 'Pre-Sale', 'value' => 'By Request'],
                                    ['label' => 'Regular', 'value' => 'By Request'],
                                ],
                                'inclusions' => [
                                    'Official event pass access',
                                    'Selected venue entry coordination',
                                    'Daily breakfast package support',
                                    'On-ground team assistance',
                                ],
                            ],
                            [
                                'badge' => 'Best Value',
                                'name' => 'Full 7 Hari Pass',
                                'subtitle' => 'Pengalaman Schoolies Bali penuh dari awal sampai puncak event.',
                                'accent' => 'gold',
                                'image' => 'https://images.unsplash.com/photo-1473116763249-2faaef81ccda?auto=format&fit=crop&w=1200&q=80',
                                'image_alt' => 'Schoolies Bali full 7 hari package thumbnail',
                                'prices' => [
                                    ['label' => 'Early Bird', 'value' => 'By Request'],
                                    ['label' => 'Pre-Sale', 'value' => 'By Request'],
                                    ['label' => 'Regular', 'value' => 'By Request'],
                                ],
                                'inclusions' => [
                                    'Full 7-day event access bundle',
                                    'Priority entry for key events',
                                    'Extended activity coordination',
                                    'Dedicated support hotline access',
                                ],
                            ],
                        ];
                    @endphp
                    <div class="flex flex-wrap items-end justify-between gap-3">
                        <h2 class="text-3xl font-semibold leading-tight">Paket &amp; Harga</h2>
                        <p class="text-sm text-[#4c5f59]">Pilih paket durasi lalu sesuaikan dengan tier harga Early Bird, Pre-Sale, atau Regular.</p>
                    </div>
                    <div class="mt-6 grid gap-5 lg:grid-cols-2">
                        @foreach ($ticketPackages as $package)
                            @php
                                $isGold = $package['accent'] === 'gold';
                                $cardClasses = $isGold
                                    ? 'border border-[#f2dfbe] bg-[#fff7ea]'
                                    : 'border-2 border-[#0f766e] bg-white shadow-[0_12px_30px_rgba(15,118,110,0.12)]';
                                $titleColor = $isGold ? 'text-[#a86800]' : 'text-[#0f766e]';
                                $badgeColor = $isGold ? 'text-[#a86800]' : 'text-[#0f766e]';
                                $rowClasses = $isGold
                                    ? 'border border-[#f2dfbe] bg-white/80'
                                    : 'border border-[#dcece7] bg-[#f6fbf9]';
                            @endphp
                            <article class="rounded-[20px] p-5 {{ $cardClasses }}">
                                <div class="overflow-hidden rounded-xl">
                                    <img src="{{ $package['image'] }}" alt="{{ $package['image_alt'] }}"
                                        class="h-40 w-full object-cover {{ $isGold ? 'object-center' : 'object-top' }}" loading="lazy">
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] {{ $badgeColor }}">{{ $package['badge'] }}</p>
                                    <span class="rounded-full bg-white/80 px-3 py-1 text-xs font-semibold {{ $titleColor }}">Get Ticket</span>
                                </div>
                                <h3 class="mt-2 text-2xl font-semibold {{ $titleColor }}">{{ $package['name'] }}</h3>
                                <p class="mt-2 text-sm {{ $isGold ? 'text-[#5a4930]' : 'text-[#3f524c]' }}">{{ $package['subtitle'] }}</p>
                                <div class="mt-5 space-y-2.5">
                                    @foreach ($package['prices'] as $price)
                                        <div class="flex items-center justify-between rounded-xl px-4 py-3 {{ $rowClasses }}">
                                            <span class="text-sm font-semibold {{ $titleColor }}">{{ $price['label'] }}</span>
                                            <span class="text-sm font-semibold {{ $titleColor }}">{{ $price['value'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-5 rounded-xl {{ $rowClasses }} px-4 py-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.16em] {{ $titleColor }}">Inclusions</p>
                                    <ul class="mt-3 space-y-2 text-sm {{ $isGold ? 'text-[#5a4930]' : 'text-[#3f524c]' }}">
                                        @foreach ($package['inclusions'] as $inclusion)
                                            <li class="flex items-start gap-2">
                                                <x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 {{ $titleColor }}" />
                                                <span>{{ $inclusion }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-[#0f766e] bg-[#0f766e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#0f766e]">Request Package Price</a>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight text-[#0f766e]">Trip Inclusions</h2>
                        <ul class="mt-5 space-y-2 text-sm leading-relaxed text-[#3f524c]">
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>The Official Bali Schoolies Event Package (valued at over $1,500)</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Official Schoolies Accommodation</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>7-day FINNS x Schoolies Pass Voucher</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Daily Breakfast</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Official Schoolies.com ID pass</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>$150 Travel Online voucher for you or your parents</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Red Frogs Support Team</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Discounted Travel Insurance</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>24-hour Schoolies.com phone hotline</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>City Beach Discount Code</span></li>
                            <li class="flex items-start gap-2"><x-ui-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-[#0f766e]" /><span>Flexi Pay Plans</span></li>
                        </ul>
                    </article>

                    <article class="rounded-[24px] border border-[#f2dfbe] bg-[#fffaf0] p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-2xl font-semibold leading-tight text-[#a86800]">Events</h2>
                        <p class="mt-4 text-sm leading-relaxed text-[#5a4930]">
                            We've teamed up with some of Bali's best venues including FINNS, the world's best beach club to bring you a stacked lineup of epic parties and events to make sure you celebrate graduation the right way. As part of the Official Schoolies Event Package you get access to 5 incredible dedicated schoolies events:
                        </p>
                        <ul class="mt-4 space-y-2 text-sm leading-relaxed text-[#5a4930]">
                            <li>Opening Party</li>
                            <li>Pool Party</li>
                            <li>FINNS Beach Club Party</li>
                            <li>White Party</li>
                            <li>Closing Party</li>
                        </ul>
                        <p class="mt-4 text-sm leading-relaxed font-semibold text-[#5a4930]">The best part? All of these events are included in your Schoolies.com Bali booking, winning!</p>
                        <p class="mt-4 text-xs leading-relaxed text-[#7a6a4f]">Please note: the 2025 Official Schoolies Event Package is yet to be finalised and subject to change.</p>
                    </article>
                </section>

                <section class="rounded-[26px] bg-white p-7 shadow-[0_16px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight">Things To Do</h2>
                    <p class="mt-3 text-sm leading-relaxed text-[#4c5f59]">There's a huge range of activities to keep you and the squad entertained during your days in Bali, including:</p>
                    <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Karaoke</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Breathwork</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Pilates</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Yoga</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Fitness Classes</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Bali Bingo</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">ATVs</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Water Rafting</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Surf Lessons</p>
                        <p class="rounded-xl border border-[#dcece7] bg-[#f6fbf9] px-4 py-3 text-sm font-semibold text-[#1f5f46]">Cooking Class</p>
                    </div>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-[#0f766e] bg-[#0f766e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-transparent hover:text-[#0f766e]">Ask About Package Availability</a>
                        <a href="{{ route('services.schoolies-australia-bali') }}" class="inline-flex rounded-full border-2 border-[#0f766e] px-6 py-3 text-sm font-semibold text-[#0f766e] transition hover:bg-[#0f766e] hover:text-white">Back to Schoolies Page</a>
                    </div>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
