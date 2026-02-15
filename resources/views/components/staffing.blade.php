@props(['content' => [], 'categories' => collect()])

@php
    $categoryCards = collect($categories ?? [])
        ->map(function ($category) {
            $careers = collect($category->careers ?? [])
                ->map(function ($career) {
                    $location = $career->location_display ?: 'Remote';
                    $type = ucwords(str_replace('-', ' ', (string) $career->type));

                    return [
                        'title' => $career->title,
                        'meta' => trim($type . ' • ' . $location, ' •'),
                        'description' => \Illuminate\Support\Str::limit(strip_tags((string) $career->description), 100),
                        'link' => '#',
                        'thumbnail' => $career->thumbnail_path
                            ? \Illuminate\Support\Facades\Storage::url($career->thumbnail_path)
                            : null,
                    ];
                })
                ->values()
                ->all();

            return [
                'title' => $category->name,
                'description' => \Illuminate\Support\Str::limit(
                    $category->description ?: count($careers) . ' career(s) available',
                    100,
                ),
                'jobs' => $careers,
                'image_path' => $category->image_path,
            ];
        })
        ->values();

    if ($categoryCards->isEmpty()) {
        $categoryCards = collect($content['cards'] ?? [])->map(function ($card) {
            return [
                'title' => $card['title'] ?? '',
                'description' => $card['description'] ?? '',
                'jobs' => $card['jobs'] ?? [],
                'image_path' => $card['image_path'] ?? null,
            ];
        });
    }
@endphp

<section class="bg-white px-6 pb-16 pt-14">
    <div class="mx-auto max-w-6xl">
        <p class="text-left text-xs uppercase tracking-[0.3em] text-[#b28b2e]" data-aos="fade-up">
            {{ $content['badge'] ?? 'Let us build your team' }}</p>
        <h2 class="mt-3 text-left text-3xl font-semibold" data-aos="fade-up" data-aos-delay="100">
            {!! $content['title'] ?? 'We find the perfect-match professionals<br>for you' !!}</h2>
        <p class="mt-3 max-w-2xl text-left text-sm text-[#6b6b66]" data-aos="fade-up" data-aos-delay="150">
            {{ $content['subtitle'] ?? 'Staff Link Solution matches you with the most qualified individuals you need to see your business reach its fullest potential.' }}
        </p>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($categoryCards as $i => $category)
                <button
                    class="group overflow-hidden rounded-2xl bg-white text-left shadow-sm transition duration-300 ease-out hover:-translate-y-1 hover:shadow-md"
                    data-modal-target="talent" data-talent-title="{{ $category['title'] ?? '' }}"
                    data-talent-description="{{ $category['description'] ?? '' }}"
                    data-talent-jobs='@json($category['jobs'] ?? [])' data-aos="fade-up"
                    data-aos-delay="{{ 100 + $i * 50 }}">
                    @if (!empty($category['image_path']))
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($category['image_path']) }}"
                            alt="{{ $category['title'] ?? 'Category image' }}"
                            class="h-40 w-full object-cover transition duration-300 ease-out group-hover:scale-105"
                            draggable="false" />
                    @else
                        <div class="flex h-40 w-full items-center justify-center bg-[#ecf7f1] text-[#287854]">
                            <i class="fa-solid fa-briefcase text-3xl leading-none" aria-hidden="true"></i>
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="text-base font-semibold text-[#2e2e2e]">{{ $category['title'] ?? '' }}</h3>
                        <p class="mt-2 text-sm text-[#6b6b66]">{{ $category['description'] ?? '' }}</p>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-6" data-modal="talent">
        <div class="relative w-full max-w-[96rem] rounded-3xl bg-white p-8 shadow-[0_30px_70px_rgba(31,95,70,0.25)]"
            data-modal-panel>
            <button
                class="absolute right-5 top-5 inline-flex h-9 w-9 items-center justify-center rounded-full border border-[#d7d9e4] text-[#4a4a45] transition hover:bg-[#f4f6fb]"
                data-modal-close aria-label="Close modal">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 6l12 12" />
                    <path d="M18 6L6 18" />
                </svg>
            </button>
            <div class="flex flex-wrap items-center justify-between gap-4 text-center sm:text-left">
                <div class="w-full">
                    <h3 class="mt-2 text-2xl font-semibold" data-talent-title></h3>
                    <p class="mt-2 text-sm text-[#6b6b66]" data-talent-description></p>
                </div>
            </div>
            <div class="mt-6 grid gap-5" data-talent-jobs></div>
        </div>
    </div>
</section>
