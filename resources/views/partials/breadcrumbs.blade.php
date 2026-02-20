@php
    $breadcrumbItems = collect($breadcrumbItems ?? [])->filter(fn ($item) => is_array($item) && !empty($item['name']))->values();
@endphp

@if ($breadcrumbItems->isNotEmpty())
    <nav aria-label="Breadcrumb" class="mb-6" data-aos="fade-up">
        <ol class="flex flex-wrap items-center gap-2 text-xs font-semibold tracking-wide text-[#4e5f56]">
            @foreach ($breadcrumbItems as $index => $item)
                @if ($index > 0)
                    <li aria-hidden="true" class="text-[#8ea89a]">/</li>
                @endif
                <li>
                    @if (!empty($item['url']) && $index < $breadcrumbItems->count() - 1)
                        <a href="{{ $item['url'] }}" class="transition hover:text-[#1f5f46]">{{ $item['name'] }}</a>
                    @else
                        <span class="text-[#1f5f46]">{{ $item['name'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
