@props(['content' => []])

<section class="px-6 pb-20 pt-6">
    <div class="mx-auto max-w-[75.6rem]">
        @php
            $items = [
                [
                    'icon' => 'comments',
                    'title' => 'Strategic, Industry-Qualified Talent',
                    'description' => 'Access pre-vetted international professionals with role-specific expertise to support global operations from day one.',
                ],
                [
                    'icon' => 'book',
                    'title' => 'Local Insight, Global Execution',
                    'description' => 'Combine global talent delivery with local market knowledge to keep expansion practical, compliant, and growth-focused.',
                ],
                [
                    'icon' => 'check',
                    'title' => 'End-to-End Workforce Delivery',
                    'description' => 'From sourcing and screening to onboarding coordination, we manage the full process so you can scale faster with less risk.',
                ],
                [
                    'icon' => 'headset',
                    'title' => 'Seamless Stakeholder Communication',
                    'description' => 'Maintain clear, responsive communication across your team, our consultants, and your remote workforce.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Structured Governance and Data Protection',
                    'description' => 'Protect your operations through standardized SOPs, confidentiality safeguards, and secure data handling at every stage.',
                ],
                [
                    'icon' => 'heart',
                    'title' => 'Performance-Driven Workforce Systems',
                    'description' => 'Enable consistency, accountability, and measurable results through structured operational support.',
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
                            <x-ui-icon :name="$item['icon'] ?? 'check-circle'" class="h-5 w-5" />
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
