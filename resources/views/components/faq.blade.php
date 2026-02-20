@props(['items' => collect()])

@if (($items ?? collect())->isNotEmpty())
<section class="px-6 pb-16 pt-4" data-aos="fade-up">
    <div class="mx-auto max-w-6xl rounded-[30px] bg-white p-6 shadow-[0_20px_50px_rgba(31,95,70,0.12)] sm:p-10">
        <h2 class="mb-6 text-3xl font-semibold text-[#1b1b18] sm:text-4xl">Frequently Asked Questions (FAQs)</h2>
        <div class="space-y-3">
            @foreach ($items as $faq)
                <details class="faq-item group rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] px-5 py-4">
                    <summary class="flex cursor-pointer list-none items-start justify-between gap-4 text-left">
                        <span class="text-base font-semibold text-[#1f5f46]">{{ $faq->question }}</span>
                        <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-[#c3dbce] text-[#287854] transition duration-300 group-open:rotate-45">+</span>
                    </summary>
                    <div class="faq-answer">
                        <div class="faq-answer-inner mt-3 border-t border-[#e4eee8] pt-3 text-sm leading-relaxed text-[#4f5e57]">
                            {!! nl2br(e((string) $faq->answer)) !!}
                        </div>
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif
