@props(['content' => []])

<section class="px-6 pb-24">
    <div class="mx-auto max-w-6xl">
        <p class="text-center text-xs uppercase tracking-[0.3em] text-[#b28b2e]" data-aos="fade-up">
            {{ $content['badge'] ?? 'Talent solutions' }}</p>
        <h2 class="mt-3 text-center text-3xl font-semibold" data-aos="fade-up" data-aos-delay="100">
            {{ $content['title'] ?? '' }}</h2>
        <p class="mx-auto mt-3 max-w-2xl text-center text-sm text-[#6b6b66]" data-aos="fade-up" data-aos-delay="150">
            {{ $content['subtitle'] ?? '' }}
        </p>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($content['cards'] ?? [] as $i => $card)
                <button
                    class="group overflow-hidden rounded-2xl bg-white text-left shadow-sm transition duration-300 ease-out hover:-translate-y-1 hover:shadow-md"
                    data-modal-target="talent" data-talent-title="{{ $card['title'] ?? '' }}"
                    data-talent-description="{{ $card['description'] ?? '' }}"
                    data-talent-jobs='@json($card['jobs'] ?? [])' data-aos="fade-up"
                    data-aos-delay="{{ 100 + $i * 50 }}">
                    <img src="{{ $card['image'] ?? '' }}" alt="{{ $card['title'] ?? '' }}"
                        class="h-32 w-full object-cover transition duration-300 ease-out group-hover:scale-105"
                        draggable="false" />
                    <div class="px-5 py-5">
                        <h3 class="text-base font-semibold">{{ $card['title'] ?? '' }}</h3>
                        <p class="mt-2 text-sm text-[#6b6b66]">{{ $card['description'] ?? '' }}</p>
                    </div>
                </button>
            @endforeach
        </div>
        <div class="mt-10 flex justify-center" data-aos="fade-up" data-aos-delay="500">
            <button
                class="rounded-full bg-[#b28b2e] px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#9b7829]"
                data-modal-target="overview">
                More Details
            </button>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-6" data-modal="overview">
        <div class="w-full max-w-3xl rounded-3xl bg-white p-8 shadow-[0_30px_70px_rgba(31,95,70,0.25)]" data-modal-panel>
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Open roles</p>
                    <h3 class="mt-2 text-2xl font-semibold">Current staffing opportunities</h3>
                </div>
                <button class="rounded-full border border-[#d7d9e4] px-4 py-2 text-xs font-semibold text-[#4a4a45]"
                    data-modal-close>
                    Close
                </button>
            </div>
            <div class="mt-6 grid gap-5 sm:grid-cols-2">
                @foreach ($content['modal_roles'] ?? [] as $role)
                    <div class="rounded-2xl border border-[#ececf4] p-4">
                        <h4 class="text-base font-semibold">{{ $role['title'] ?? '' }}</h4>
                        <p class="mt-2 text-sm text-[#6b6b66]">{{ $role['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-6" data-modal="talent">
        <div class="w-full max-w-3xl rounded-3xl bg-white p-8 shadow-[0_30px_70px_rgba(31,95,70,0.25)]" data-modal-panel>
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">Talent focus</p>
                    <h3 class="mt-2 text-2xl font-semibold" data-talent-title></h3>
                    <p class="mt-2 text-sm text-[#6b6b66]" data-talent-description></p>
                </div>
                <button class="rounded-full border border-[#d7d9e4] px-4 py-2 text-xs font-semibold text-[#4a4a45]"
                    data-modal-close>
                    Close
                </button>
            </div>
            <div class="mt-6 grid gap-5 sm:grid-cols-2" data-talent-jobs></div>
        </div>
    </div>
</section>
