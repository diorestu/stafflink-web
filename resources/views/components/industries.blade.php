@props(['content' => []])

<section class="px-6 pb-20 pt-6">
    <div class="mx-auto max-w-[75.6rem]">
        @php
            $items = [
                [
                    'icon' => 'fa-solid fa-comments',
                    'title' => 'Industry Qualified',
                    'description' => 'We match you with global professionals who have access to continuous learning & development opportunities.',
                ],
                [
                    'icon' => 'fa-solid fa-book-open',
                    'title' => 'Local Expertise',
                    'description' => 'Our team is equipped with a deep understanding of the local market to provide responsive solutions to your business.',
                ],
                [
                    'icon' => 'fa-solid fa-check',
                    'title' => 'All Done For You',
                    'description' => 'We match you with global professionals who have access to continuous learning & development opportunities.',
                ],
                [
                    'icon' => 'fa-solid fa-headset',
                    'title' => 'Seamless Communications',
                    'description' => 'Reach out to our team anytime through easy-to-use platforms and communication channels.',
                ],
                [
                    'icon' => 'fa-solid fa-user-shield',
                    'title' => 'Guaranteed Data Protection',
                    'description' => 'State-of-the-art security systems & internal SOPs ensure your business information is secured 24/7.',
                ],
                [
                    'icon' => 'fa-solid fa-heart',
                    'title' => 'Inspiring Workplaces',
                    'description' => 'Our global facilities are fully equipped for ultimate productivity, efficiency and work quality.',
                ],
            ];
        @endphp

        <div class="text-center" data-aos="fade-up">
            <div class="mx-auto mt-3 max-w-4xl">
                <h2 class="text-3xl font-semibold leading-tight text-[#2e2e2e]">
                    Save time & cut costs with Staff Link Solutions
                </h2>
                <p class="mx-auto mt-3 max-w-3xl text-sm leading-relaxed text-[#6b6b66] sm:text-base">
                    The cost of finding and integrating top talent is benchmarked at thousands of dollars per hire. Here is the cheaper, faster & better way to find a team who perfectly matches your needs.
                </p>
            </div>

            <div class="mt-10 grid gap-6 text-left md:grid-cols-2 lg:grid-cols-3">
                @foreach ($items as $index => $item)
                    <article class="rounded-2xl bg-white px-6 py-6 shadow-[0_18px_35px_rgba(31,95,70,0.12)]" data-aos="fade-up"
                        data-aos-delay="{{ 100 + ($index * 50) }}">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#287854]/30 text-[#287854]">
                            <i class="{{ $item['icon'] ?? 'fa-solid fa-circle-check' }} text-[1.1rem] leading-none" aria-hidden="true"></i>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-[#2e2e2e]">
                            {{ $item['title'] ?? '' }}
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-[#6b6b66]">
                            {{ $item['description'] ?? '' }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
