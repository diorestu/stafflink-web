<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - Jobs</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Google+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-10 pb-28 pt-3 lg:px-12">
            <section class="mx-auto max-w-7xl space-y-14">
                <div class="rounded-[30px] bg-[#1f5f46] p-12 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)] lg:p-10 mb-5 mt-3"
                    data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Careers</p>
                    <h1 class="mt-4 text-4xl font-semibold">Available Jobs</h1>
                    <p class="mt-4 max-w-2xl text-sm text-white/85">
                        Explore our current openings posted by StaffLink admin team. Find the right role and apply now.
                    </p>
                </div>

                <section class="rounded-2xl bg-white p-5 mb-5 shadow-[0_16px_40px_rgba(31,95,70,0.1)]"
                    data-aos="fade-up">
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-[1fr_170px_170px_180px_180px_220px_auto] md:items-end">
                        <div>
                            <label for="job-search" class="text-sm font-semibold text-[#2e2e2e]">Filter by name</label>
                            <input id="job-search" type="text" placeholder="Search job title..."
                                value="{{ request('search') }}"
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>
                        <div>
                            <label for="job-type-filter" class="text-sm font-semibold text-[#2e2e2e]">Category</label>
                            <select id="job-type-filter"
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value=""
                                    {{ request('type') === null || request('type') === '' ? 'selected' : '' }}>All
                                    categories</option>
                                <option value="full-time" {{ request('type') === 'full-time' ? 'selected' : '' }}>Full
                                    Time</option>
                                <option value="part-time" {{ request('type') === 'part-time' ? 'selected' : '' }}>Part
                                    Time</option>
                                <option value="contract" {{ request('type') === 'contract' ? 'selected' : '' }}>Contract
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="job-country-filter"
                                class="text-sm font-semibold text-[#2e2e2e]">Country</label>
                            <select id="job-country-filter"
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value=""
                                    {{ request('country') === null || request('country') === '' ? 'selected' : '' }}>
                                    All countries</option>
                                @foreach ($countryOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ request('country') === $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="job-state-filter"
                                class="text-sm font-semibold text-[#2e2e2e]">State</label>
                            <select id="job-state-filter"
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value=""
                                    {{ request('state') === null || request('state') === '' ? 'selected' : '' }}>
                                    All states</option>
                                @foreach ($stateOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ request('state') === $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="job-work-mode-filter"
                                class="text-sm font-semibold text-[#2e2e2e]">Work mode</label>
                            <select id="job-work-mode-filter"
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value=""
                                    {{ request('work_mode') === null || request('work_mode') === '' ? 'selected' : '' }}>
                                    All work modes</option>
                                @foreach ($workModeOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ request('work_mode') === $option ? 'selected' : '' }}>
                                        {{ strtoupper($option) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="job-salary-filter" class="text-sm font-semibold text-[#2e2e2e]">Salary
                                range</label>
                            <select id="job-salary-filter"
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value=""
                                    {{ request('salary_range') === null || request('salary_range') === '' ? 'selected' : '' }}>
                                    All salary ranges</option>
                                @foreach ($salaryRangeOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ request('salary_range') === $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button id="job-filter-reset" type="button"
                            class="rounded-xl border border-[#b5d6c5] bg-[#ecf7f1] px-4 py-3 text-sm font-semibold text-[#1f5f46] hover:bg-[#e3f1ea]">
                            Reset
                        </button>
                    </div>
                </section>

                <div id="jobs-container" class="grid gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                    data-next-page-url="{{ $jobs->nextPageUrl() }}" data-aos="fade-up">
                    @include('partials.job-cards', ['jobs' => $jobs])
                </div>

                <div id="jobs-loading" class="hidden py-4 text-center text-sm font-semibold text-[#287854]">Loading more
                    jobs...</div>
                <div id="jobs-end" class="hidden py-4 text-center text-sm text-[#6b6b66]">No more jobs to load.</div>
                <div id="jobs-sentinel" class="h-1"></div>
            </section>
        </main>
        <x-site-footer />
    </div>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        (() => {
            const container = document.getElementById('jobs-container');
            const sentinel = document.getElementById('jobs-sentinel');
            const loading = document.getElementById('jobs-loading');
            const endText = document.getElementById('jobs-end');
            const searchInput = document.getElementById('job-search');
            const typeSelect = document.getElementById('job-type-filter');
            const countrySelect = document.getElementById('job-country-filter');
            const stateSelect = document.getElementById('job-state-filter');
            const workModeSelect = document.getElementById('job-work-mode-filter');
            const salarySelect = document.getElementById('job-salary-filter');
            const resetBtn = document.getElementById('job-filter-reset');

            if (!container || !sentinel) return;

            let nextPageUrl = container.dataset.nextPageUrl || '';
            let isLoading = false;
            let debounceTimer = null;
            let activeController = null;

            const setLoading = (state) => {
                isLoading = state;
                loading.classList.toggle('hidden', !state);
            };

            const buildUrl = (page = 1) => {
                const url = new URL("{{ route('jobs.index') }}", window.location.origin);
                if (searchInput.value.trim() !== '') url.searchParams.set('search', searchInput.value.trim());
                if (typeSelect.value) url.searchParams.set('type', typeSelect.value);
                if (countrySelect.value) url.searchParams.set('country', countrySelect.value);
                if (stateSelect.value) url.searchParams.set('state', stateSelect.value);
                if (workModeSelect.value) url.searchParams.set('work_mode', workModeSelect.value);
                if (salarySelect.value) url.searchParams.set('salary_range', salarySelect.value);
                url.searchParams.set('page', String(page));
                return url.toString();
            };

            const fetchJobs = async ({
                reset = false
            } = {}) => {
                if (isLoading) return;
                if (!reset && !nextPageUrl) return;

                setLoading(true);
                endText.classList.add('hidden');

                if (activeController) activeController.abort();
                activeController = new AbortController();

                const targetUrl = reset ? buildUrl(1) : nextPageUrl;

                try {
                    const response = await fetch(targetUrl, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        signal: activeController.signal,
                    });

                    if (!response.ok) throw new Error('Failed to load jobs');

                    const data = await response.json();
                    nextPageUrl = data.next_page_url || '';

                    if (reset) {
                        container.innerHTML = data.html || '';
                    } else {
                        container.insertAdjacentHTML('beforeend', data.html || '');
                    }

                    if (!nextPageUrl) {
                        endText.classList.remove('hidden');
                    }
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error(error);
                    }
                } finally {
                    setLoading(false);
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && nextPageUrl && !isLoading) {
                        fetchJobs();
                    }
                });
            }, {
                rootMargin: '160px 0px'
            });

            observer.observe(sentinel);

            const triggerFilter = () => {
                if (debounceTimer) clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    nextPageUrl = '';
                    fetchJobs({
                        reset: true
                    });
                }, 280);
            };

            searchInput.addEventListener('input', triggerFilter);
            typeSelect.addEventListener('change', triggerFilter);
            countrySelect.addEventListener('change', triggerFilter);
            stateSelect.addEventListener('change', triggerFilter);
            workModeSelect.addEventListener('change', triggerFilter);
            salarySelect.addEventListener('change', triggerFilter);

            resetBtn.addEventListener('click', () => {
                searchInput.value = '';
                typeSelect.value = '';
                countrySelect.value = '';
                stateSelect.value = '';
                workModeSelect.value = '';
                salarySelect.value = '';
                triggerFilter();
            });
        })();
    </script>
</body>

</html>
