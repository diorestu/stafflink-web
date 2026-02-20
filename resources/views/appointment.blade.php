<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Book a Consultation',
        'seoDescription' => 'Book a consultation with StaffLink Solutions. All appointments are scheduled in Bali time (UTC+8).',
        'seoKeywords' => 'book staffing consultation, recruitment appointment, bali time utc+8',
    ])
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    </noscript>
    <style>
        .phone-code-select2+.select2-container .select2-selection--single {
            height: 48px;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
        }

        .phone-code-select2+.select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 46px;
            padding-left: 0.75rem;
            color: #2e2e2e;
            font-size: 0.875rem;
        }

        .phone-code-select2+.select2-container .select2-selection--single .select2-selection__arrow {
            height: 46px;
            right: 8px;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            overflow: hidden;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-4 pb-20 pt-8 sm:px-8 sm:pb-24 sm:pt-12">
            <section class="mx-auto max-w-6xl space-y-8">
                <div class="rounded-[30px] bg-[#1f5f46] p-6 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)] sm:p-10"
                    data-aos="fade-up">
                    <div class="grid gap-5 lg:grid-cols-[1.65fr_1fr] lg:gap-8">
                        <div class="min-w-0">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Schedule Appointment</p>
                            <h1 class="mt-4 text-3xl font-semibold sm:text-4xl">Book a consultation</h1>
                            <p class="mt-4 max-w-2xl text-[16.1px] leading-relaxed text-white">
                                Select a date from the calendar, then choose an available time slot in the popup.
                                <br />Each session lasts 1 hour.
                            </p>
                        </div>
                        <div
                            class="rounded-2xl border border-[#e9d29d]/35 bg-[#f3c24f]/12 px-5 py-5 text-[#fff7df] backdrop-blur-md">
                            <div class="flex items-start gap-3">
                                <span
                                    class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#f3c24f] text-[#573f00]">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.721-1.36 3.486 0l6.518 11.591c.75 1.334-.213 2.99-1.742 2.99H3.48c-1.53 0-2.492-1.656-1.742-2.99L8.257 3.1zM11 8a1 1 0 10-2 0v3a1 1 0 102 0V8zm-1 7a1.1 1.1 0 100-2.2A1.1 1.1 0 0010 15z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.3em] font-bold text-[#ffe7ac]">Timezone
                                        Notice</p>
                                    <p class="mt-2 text-lg font-bold leading-tight text-white">All appointments are
                                        scheduled in Bali Timezone (UTC+8)</p>
                                    <p class="mt-2 text-xs leading-relaxed text-[#fff1c9]">
                                        Displayed times reflect your local timezone
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid gap-8 lg:grid-cols-[1fr_1fr]">
                    <div class="rounded-[28px] bg-white p-5 shadow-[0_20px_50px_rgba(31,95,70,0.12)] sm:p-8"
                        data-aos="fade-up">
                        <div class="mb-5 flex items-center justify-between">
                            <button type="button" id="calendar-prev"
                                class="rounded-lg border border-[#d1d5db] px-2.5 py-2 text-xs hover:bg-[#f7faf8] sm:px-3 sm:text-sm">Previous</button>
                            <h2 id="calendar-month" class="text-base font-semibold text-[#1b1b18] sm:text-lg"></h2>
                            <button type="button" id="calendar-next"
                                class="rounded-lg border border-[#d1d5db] px-2.5 py-2 text-xs hover:bg-[#f7faf8] sm:px-3 sm:text-sm">Next</button>
                        </div>
                        <div id="calendar-grid" class="grid grid-cols-7 gap-2"></div>
                        <p class="mt-4 text-xs text-[#4b5563]">Click a date to see real-time slot availability.</p>
                    </div>

                    <div class="rounded-[28px] bg-white p-5 shadow-[0_20px_50px_rgba(31,95,70,0.12)] sm:p-8"
                        data-aos="fade-up" data-aos-delay="120">
                        <form id="appointment-form" action="{{ route('appointments.store') }}" method="POST"
                            class="grid gap-5 sm:grid-cols-2">
                            @csrf
                            <div class="hidden" aria-hidden="true">
                                <label for="website">Website</label>
                                <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                            </div>
                            @php
                                $phoneCodes = $phoneCodes ?? collect();
                            @endphp
                            <input type="hidden" name="appointment_date" id="appointment_date"
                                value="{{ old('appointment_date') }}">
                            <input type="hidden" name="start_time" id="start_time" value="{{ old('start_time') }}">

                            <div
                                class="sm:col-span-2 rounded-2xl border border-[#b5d6c5] bg-[#ecf7f1] px-6 py-5 shadow-[0_8px_20px_rgba(31,95,70,0.08)]">
                                <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Selected slot</p>
                                <p id="selected-slot" class="mt-2 text-base font-semibold text-[#1b1b18] sm:text-lg">
                                    @if (old('appointment_date') && old('start_time'))
                                        {{ \Carbon\Carbon::parse(old('appointment_date'))->format('l, d F Y') }}
                                    @else
                                        No time slot selected yet.
                                    @endif
                                </p>
                                <p id="selected-slot-range"
                                    class="mt-2 text-xs font-medium text-[#2f8b62] @if (!(old('appointment_date') && old('start_time'))) hidden @endif">
                                    @if (old('appointment_date') && old('start_time'))
                                        ({{ old('start_time') }} to
                                        {{ \Carbon\Carbon::createFromFormat('H:i', old('start_time'))->addHour()->format('H:i') }})
                                        1-hour session
                                    @else
                                        (hh:mm to hh:mm)
                                        1-hour session
                                    @endif
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Full Name</label>
                                <input name="name" value="{{ old('name') }}" type="text" required
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>

                            <div>
                                <label class="text-sm font-semibold">Company (Optional)</label>
                                <input name="company" value="{{ old('company') }}" type="text"
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Business Email</label>
                                <input name="email" value="{{ old('email') }}" type="email" required
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Phone Number</label>
                                <div class="mt-2 grid gap-3 sm:grid-cols-[170px_1fr]">
                                    <select name="phone_country_code" required
                                        id="phone_country_code"
                                        class="phone-code-select2 rounded-xl border border-[#d1d5db] px-3 py-3 text-sm focus:border-[#287854] focus:outline-none"
                                        >
                                        <option value="">Code</option>
                                        @foreach ($phoneCodes as $item)
                                            <option value="{{ $item['code'] }}"
                                                @selected(old('phone_country_code', '+62') === $item['code'])>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input name="phone_number" value="{{ old('phone_number') }}" type="text" required
                                        placeholder="81234567890"
                                        class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Notes (Optional)</label>
                                <textarea name="notes" rows="4"
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">{{ old('notes') }}</textarea>
                            </div>

                            <p id="slot-error" class="sm:col-span-2 hidden text-sm text-red-600">Please select an
                                available date and time from the calendar.</p>

                            @if (($turnstileEnabled ?? false) && filled($turnstileSiteKey ?? ''))
                                <div class="sm:col-span-2">
                                    <div class="cf-turnstile" data-sitekey="{{ $turnstileSiteKey }}"></div>
                                </div>
                            @endif

                            <div class="sm:col-span-2">
                                <button type="submit"
                                    class="w-full rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                                    Book Appointment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <x-site-footer />
    </div>

    <div id="slots-modal"
        class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/55 px-4 opacity-0 transition-opacity duration-200">
        <div id="slots-panel"
            class="w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl transition duration-200 ease-out translate-y-3 scale-95 opacity-0">
            <div class="flex items-center justify-between border-b pb-3">
                <h3 id="slots-title" class="text-lg font-semibold text-[#1b1b18]">Select a time</h3>
                <button id="slots-close" type="button"
                    class="rounded-md px-2 py-1 text-sm text-[#6b6b66] hover:bg-gray-100">Close</button>
            </div>
            <p id="slots-hint" class="mt-3 text-xs text-[#6b6b66]">Green = available, gray = unavailable.</p>
            <div id="slots-container" class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3"></div>
        </div>
    </div>
    <script>
        (() => {
            const availabilityUrl = "{{ route('appointments.availability') }}";
            const calendarGrid = document.getElementById('calendar-grid');
            const calendarMonth = document.getElementById('calendar-month');
            const prevBtn = document.getElementById('calendar-prev');
            const nextBtn = document.getElementById('calendar-next');
            const modal = document.getElementById('slots-modal');
            const slotsTitle = document.getElementById('slots-title');
            const slotsHint = document.getElementById('slots-hint');
            const slotsContainer = document.getElementById('slots-container');
            const closeBtn = document.getElementById('slots-close');
            const slotsPanel = document.getElementById('slots-panel');
            const dateInput = document.getElementById('appointment_date');
            const timeInput = document.getElementById('start_time');
            const selectedSlot = document.getElementById('selected-slot');
            const selectedSlotRange = document.getElementById('selected-slot-range');
            const form = document.getElementById('appointment-form');
            const slotError = document.getElementById('slot-error');
            const submitBtn = form.querySelector('button[type="submit"]');
            const appointmentTimezoneLabel = 'Bali time (UTC+8)';
            const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone || 'UTC';

            const now = new Date();
            const oldDate = dateInput.value;
            let currentDate = oldDate ? new Date(oldDate + 'T00:00:00') : new Date(now.getFullYear(), now.getMonth(),
                1);
            let activeDate = oldDate || null;

            const formatDateKey = (date) => {
                const y = date.getFullYear();
                const m = String(date.getMonth() + 1).padStart(2, '0');
                const d = String(date.getDate()).padStart(2, '0');
                return `${y}-${m}-${d}`;
            };

            const isPastDate = (date) => {
                const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                return date < today;
            };

            const formatLocalDate = (dateObj) => {
                return new Intl.DateTimeFormat(undefined, {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric',
                    timeZone: userTimeZone,
                }).format(dateObj);
            };

            const formatLocalTime = (dateObj) => {
                return new Intl.DateTimeFormat(undefined, {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                    timeZone: userTimeZone,
                }).format(dateObj);
            };

            const renderCalendar = () => {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                const first = new Date(year, month, 1);
                const last = new Date(year, month + 1, 0);
                const startDay = first.getDay();
                const totalDays = last.getDate();

                calendarMonth.textContent = first.toLocaleDateString(undefined, {
                    month: 'long',
                    year: 'numeric'
                });

                const headers = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const cells = headers.map((h) =>
                    `<div class="rounded-md bg-[#e6f1ec] px-2 py-2 text-xs font-semibold text-[#1f5f46]">${h}</div>`
                );

                for (let i = 0; i < startDay; i++) {
                    cells.push('<div class="h-[74px] rounded-md border border-transparent sm:h-[82px]"></div>');
                }

                for (let day = 1; day <= totalDays; day++) {
                    const dateObj = new Date(year, month, day);
                    const dateKey = formatDateKey(dateObj);
                    const disabled = isPastDate(dateObj);
                    const active = activeDate === dateKey;
                    const classes = [
                        'relative h-[74px] rounded-md border p-2 text-left transition sm:h-[82px]',
                        disabled ? 'cursor-not-allowed border-[#d1d5db] bg-[#f3f4f6] text-[#6b7280]' :
                        'border-[#c7dfd4] bg-white hover:border-[#1f5f46]'
                    ];
                    if (active) {
                        classes.push('ring-2 ring-[#287854]');
                    }

                    cells.push(`
                        <button type="button" data-date="${dateKey}" ${disabled ? 'disabled' : ''} class="${classes.join(' ')}">
                            <span class="absolute left-2 top-2 text-[135%] font-bold leading-none text-[#1b1b18] sm:text-[150%]">${day}</span>
                            <span class="block pt-7 sm:pt-8">
                                ${disabled ? '' : `
                                                        <span class="inline-flex h-4 w-4 items-center justify-center rounded-full bg-[#dff3e9] text-[#1f5f46]">
                                                            <svg class="h-2.5 w-2.5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.415 0l-3-3a1 1 0 111.415-1.42l2.292 2.294 6.792-6.794a1 1 0 011.416 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                    `}
                            </span>
                        </button>
                    `);
                }

                calendarGrid.innerHTML = cells.join('');

                calendarGrid.querySelectorAll('[data-date]').forEach((btn) => {
                    btn.addEventListener('click', () => openSlots(btn.dataset.date));
                });
            };

            const openModal = () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-0');
                    slotsPanel.classList.remove('translate-y-3', 'scale-95', 'opacity-0');
                });
            };

            const closeModal = () => {
                modal.classList.add('opacity-0');
                slotsPanel.classList.add('translate-y-3', 'scale-95', 'opacity-0');
                window.setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }, 200);
            };

            const openSlots = async (dateKey) => {
                activeDate = dateKey;
                renderCalendar();
                openModal();

                const prettyDate = new Date(dateKey + 'T00:00:00').toLocaleDateString(undefined, {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
                slotsTitle.textContent = `Select a time on ${prettyDate}`;
                slotsHint.textContent =
                    `Times are shown in your local timezone (${userTimeZone}), while appointment records are saved in ${appointmentTimezoneLabel}. Green = available, gray = unavailable.`;
                slotsContainer.innerHTML =
                    '<p class="col-span-full text-sm text-[#374151]">Loading slots...</p>';

                try {
                    const url = `${availabilityUrl}?date=${encodeURIComponent(dateKey)}`;
                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) throw new Error('Failed to load slots');
                    const data = await res.json();

                    const items = data.slots.map((slot) => {
                        const disabled = !slot.available;
                        const localStart = new Date(slot.starts_at_iso);
                        const localEnd = new Date(slot.ends_at_iso);
                        const localRange =
                            `${formatLocalTime(localStart)} - ${formatLocalTime(localEnd)}`;
                        const localDate = formatLocalDate(localStart);
                        const utc8Range = `${slot.time} - ${slot.end_time}`;
                        const classes = disabled ?
                            'cursor-not-allowed border-[#d1d5db] bg-[#eceff3] text-[#4b5563]' :
                            'border-[#86b99f] bg-[#dff3e9] text-[#134e3a] hover:bg-[#cfeada]';

                        return `
                            <button type="button" data-date="${slot.date}" data-time="${slot.time}" data-local-date="${localDate}" data-local-range="${localRange}" data-utc8-range="${utc8Range}" ${disabled ? 'disabled' : ''}
                                class="rounded-lg border px-3 py-3 text-sm font-semibold ${classes}">
                                <span class="block">${localRange}</span>
                                <span class="mt-1 block text-xs font-semibold ${disabled ? 'text-[#4b5563]' : 'text-[#14532d]'}">${disabled ? 'Unavailable' : 'Available'}</span>
                            </button>
                        `;
                    });

                    slotsContainer.innerHTML = items.length ?
                        items.join('') :
                        '<p class="col-span-full text-sm text-[#374151]">No time slots are available.</p>';

                    slotsContainer.querySelectorAll('[data-time][data-date]').forEach((btn) => {
                        btn.addEventListener('click', () => {
                            dateInput.value = btn.dataset.date;
                            timeInput.value = btn.dataset.time;
                            selectedSlot.textContent =
                                `${btn.dataset.localDate} (${userTimeZone})`;
                            selectedSlotRange.textContent =
                                `Local time: ${btn.dataset.localRange} (${userTimeZone}) | Stored time: ${btn.dataset.utc8Range} ${appointmentTimezoneLabel}`;
                            selectedSlotRange.classList.remove('hidden');
                            slotError.classList.add('hidden');
                            closeModal();
                        });
                    });
                } catch (_e) {
                    slotsContainer.innerHTML =
                        '<p class="col-span-full text-sm text-red-600">Could not load availability. Please try again.</p>';
                }
            };

            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            form.addEventListener('submit', (e) => {
                e.preventDefault();

                if (!dateInput.value || !timeInput.value) {
                    slotError.classList.remove('hidden');
                    return;
                }

                const showToast = (text, type = 'success') => {
                    if (window.stafflinkToast) {
                        window.stafflinkToast(text, type);
                        return;
                    }
                    if (type === 'error') {
                        console.error(text);
                    }
                };

                const payload = new FormData(form);
                const originalBtnText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';
                slotError.classList.add('hidden');

                fetch(form.action, {
                        method: 'POST',
                        body: payload,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then(async (res) => {
                        const data = await res.json().catch(() => ({}));
                        if (!res.ok) {
                            const errorList = data.errors ?
                                Object.values(data.errors).flat() : [data.message ||
                                    'Unable to submit appointment.'
                                ];
                            throw {
                                errors: errorList
                            };
                        }
                        return data;
                    })
                    .then((data) => {
                        showToast(data.message ||
                            'Your appointment request has been submitted successfully.', 'success');

                        form.reset();
                        if (window.turnstile && typeof window.turnstile.reset === 'function') {
                            window.turnstile.reset();
                        }
                        dateInput.value = '';
                        timeInput.value = '';
                        activeDate = null;
                        renderCalendar();
                        selectedSlot.textContent = 'No time slot selected yet.';
                        selectedSlotRange.classList.add('hidden');
                    })
                    .catch((err) => {
                        const messages = err?.errors || [
                            'Unable to submit your appointment request. Please try again.'
                        ];
                        messages.forEach((msg) => showToast(msg, 'error'));
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalBtnText;
                    });
            });

            prevBtn.addEventListener('click', () => {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
                renderCalendar();
            });

            nextBtn.addEventListener('click', () => {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
                renderCalendar();
            });

            renderCalendar();
        })();
    </script>
    @if (($turnstileEnabled ?? false) && filled($turnstileSiteKey ?? ''))
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script>
        window.addEventListener('load', () => {
            if (window.jQuery && window.jQuery.fn.select2) {
                window.jQuery('#phone_country_code').select2({
                    width: '100%',
                    placeholder: 'Code',
                });
            }
        });
    </script>
</body>

</html>
