@forelse ($jobs as $job)
    <article class="mb-2 flex h-full flex-col rounded-xl border border-[#d9e3dc] bg-white p-5 shadow-[0_10px_24px_rgba(31,95,70,0.08)]">
        <div class="flex items-start justify-between gap-3">
            <h2 class="text-lg font-semibold text-[#1b1b18]">{{ $job->title }}</h2>
            <span
                class="shrink-0 whitespace-nowrap rounded-full border border-[#b5d6c5] bg-[#ecf7f1] px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-[#1f5f46]">
                {{ ucwords(str_replace('-', ' ', $job->type)) }}
            </span>
        </div>

        <div class="mt-3 space-y-1 text-xs text-[#6b6b66]">
            <p><span class="font-semibold text-[#2e2e2e]">Location:</span>
                {{ $job->location_display ?: 'Not specified' }}</p>
            @if ($job->salary_range)
                <p><span class="font-semibold text-[#2e2e2e]">Salary:</span>
                    {{ $job->salary_range }}</p>
            @endif
            <p><span class="font-semibold text-[#2e2e2e]">Posted:</span>
                {{ ($job->published_at ?? $job->created_at)->format('d M Y') }}</p>
        </div>

        <div class="mt-auto pt-4">
            <a href="{{ route('applications.create', ['job_id' => $job->id]) }}"
                class="inline-flex w-full items-center justify-center rounded-full border border-[#287854] bg-white px-4 py-2 text-xs font-semibold text-[#287854] transition hover:bg-[#287854] hover:text-white">
                Apply now
            </a>
        </div>
    </article>
@empty
    <div class="col-span-full rounded-2xl bg-white p-10 text-center shadow-[0_20px_50px_rgba(31,95,70,0.12)]">
        <h2 class="text-2xl font-semibold text-[#1b1b18]">Currently no jobs available</h2>
        <p class="mt-3 text-sm text-[#6b6b66]">Please check back later for new openings.</p>
    </div>
@endforelse
