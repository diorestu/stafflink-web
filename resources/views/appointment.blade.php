<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\SiteSetting::siteName() }} - Schedule Appointment</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Google+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-[#2e2e2e]" id="page-top">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-8 pb-24 pt-12">
            <section class="mx-auto max-w-6xl space-y-8">
                <div class="rounded-[30px] bg-[#1f5f46] p-10 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Schedule Appointment</p>
                    <h1 class="mt-4 text-4xl font-semibold">Book a consultation</h1>
                    <p class="mt-4 max-w-2xl text-sm text-white">
                        Pick a date on the calendar, then choose an available time slot in the popup.
                        Every session is fixed to 1 hour.
                    </p>
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
                    <div class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up">
                        <div class="mb-5 flex items-center justify-between">
                            <button type="button" id="calendar-prev" class="rounded-lg border border-[#d1d5db] px-3 py-2 text-sm hover:bg-[#f7faf8]">Previous</button>
                            <h2 id="calendar-month" class="text-lg font-semibold text-[#1b1b18]"></h2>
                            <button type="button" id="calendar-next" class="rounded-lg border border-[#d1d5db] px-3 py-2 text-sm hover:bg-[#f7faf8]">Next</button>
                        </div>
                        <div id="calendar-grid" class="grid grid-cols-7 gap-2"></div>
                        <p class="mt-4 text-xs text-[#4b5563]">Click a date to check real-time slot availability.</p>
                    </div>

                    <div class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up" data-aos-delay="120">
                        <form id="appointment-form" action="{{ route('appointments.store') }}" method="POST" class="grid gap-5 sm:grid-cols-2">
                            @csrf
                            <input type="hidden" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}">
                            <input type="hidden" name="start_time" id="start_time" value="{{ old('start_time') }}">

                            <div class="sm:col-span-2 rounded-2xl border border-[#b5d6c5] bg-[#ecf7f1] px-6 py-5 shadow-[0_8px_20px_rgba(31,95,70,0.08)]">
                                <p class="text-xs uppercase tracking-[0.2em] text-[#287854]">Selected slot</p>
                                <p id="selected-slot" class="mt-2 text-base font-semibold text-[#1b1b18] sm:text-lg">
                                    @if(old('appointment_date') && old('start_time'))
                                        {{ \Carbon\Carbon::parse(old('appointment_date'))->format('l, d F Y') }}
                                    @else
                                        No timeslot selected yet.
                                    @endif
                                </p>
                                <p id="selected-slot-range" class="mt-2 text-xs font-medium text-[#2f8b62] @if(!(old('appointment_date') && old('start_time'))) hidden @endif">
                                    @if(old('appointment_date') && old('start_time'))
                                        ({{ old('start_time') }} to {{ \Carbon\Carbon::createFromFormat('H:i', old('start_time'))->addHour()->format('H:i') }}) 1 hour session
                                    @else
                                        (hh:mm to hh:mm) 1 hour session
                                    @endif
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Full Name</label>
                                <input name="name" value="{{ old('name') }}" type="text" required
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>

                            <div>
                                <label class="text-sm font-semibold">Business Email</label>
                                <input name="email" value="{{ old('email') }}" type="email" required
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Phone Number</label>
                                <input name="phone" value="{{ old('phone') }}" type="text" required
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Company (Optional)</label>
                                <input name="company" value="{{ old('company') }}" type="text"
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold">Notes (Optional)</label>
                                <textarea name="notes" rows="4"
                                    class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">{{ old('notes') }}</textarea>
                            </div>

                            <p id="slot-error" class="sm:col-span-2 hidden text-sm text-red-600">Please select an available date and time from the calendar.</p>

                            <div class="sm:col-span-2">
                                <button type="submit"
                                    class="w-full rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                                    Set Appointment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <x-site-footer />
    </div>

    <div id="slots-modal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/55 px-4 opacity-0 transition-opacity duration-200">
        <div id="slots-panel" class="w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl transition duration-200 ease-out translate-y-3 scale-95 opacity-0">
            <div class="flex items-center justify-between border-b pb-3">
                <h3 id="slots-title" class="text-lg font-semibold text-[#1b1b18]">Select a time</h3>
                <button id="slots-close" type="button" class="rounded-md px-2 py-1 text-sm text-[#6b6b66] hover:bg-gray-100">Close</button>
            </div>
            <p class="mt-3 text-xs text-[#6b6b66]">Available: green | Unavailable: gray</p>
            <div id="slots-container" class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3"></div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        (() => {
            const availabilityUrl = "{{ route('appointments.availability') }}";
            const calendarGrid = document.getElementById('calendar-grid');
            const calendarMonth = document.getElementById('calendar-month');
            const prevBtn = document.getElementById('calendar-prev');
            const nextBtn = document.getElementById('calendar-next');
            const modal = document.getElementById('slots-modal');
            const slotsTitle = document.getElementById('slots-title');
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

            const now = new Date();
            const oldDate = dateInput.value;
            let currentDate = oldDate ? new Date(oldDate + 'T00:00:00') : new Date(now.getFullYear(), now.getMonth(), 1);
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

            const addOneHour = (timeHHmm) => {
                const [h, m] = timeHHmm.split(':').map(Number);
                const d = new Date();
                d.setHours(h, m, 0, 0);
                d.setMinutes(d.getMinutes() + 60);
                const hh = String(d.getHours()).padStart(2, '0');
                const mm = String(d.getMinutes()).padStart(2, '0');
                return `${hh}:${mm}`;
            };

            const renderCalendar = () => {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                const first = new Date(year, month, 1);
                const last = new Date(year, month + 1, 0);
                const startDay = first.getDay();
                const totalDays = last.getDate();

                calendarMonth.textContent = first.toLocaleDateString(undefined, { month: 'long', year: 'numeric' });

                const headers = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const cells = headers.map((h) => `<div class="rounded-md bg-[#e6f1ec] px-2 py-2 text-xs font-semibold text-[#1f5f46]">${h}</div>`);

                for (let i = 0; i < startDay; i++) {
                    cells.push('<div class="h-[82px] rounded-md border border-transparent"></div>');
                }

                for (let day = 1; day <= totalDays; day++) {
                    const dateObj = new Date(year, month, day);
                    const dateKey = formatDateKey(dateObj);
                    const disabled = isPastDate(dateObj);
                    const active = activeDate === dateKey;
                    const classes = [
                        'relative h-[82px] rounded-md border p-2 text-left transition',
                        disabled ? 'cursor-not-allowed border-[#d1d5db] bg-[#f3f4f6] text-[#6b7280]' : 'border-[#c7dfd4] bg-white hover:border-[#1f5f46]'
                    ];
                    if (active) {
                        classes.push('ring-2 ring-[#287854]');
                    }

                    cells.push(`
                        <button type="button" data-date="${dateKey}" ${disabled ? 'disabled' : ''} class="${classes.join(' ')}">
                            <span class="absolute left-2 top-2 text-[150%] font-bold leading-none text-[#1b1b18]">${day}</span>
                            <span class="block pt-8">
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
                    weekday: 'long', day: '2-digit', month: 'long', year: 'numeric'
                });
                slotsTitle.textContent = `Select a time - ${prettyDate}`;
                slotsContainer.innerHTML = '<p class="col-span-full text-sm text-[#374151]">Loading slots...</p>';

                try {
                    const url = `${availabilityUrl}?date=${encodeURIComponent(dateKey)}`;
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) throw new Error('Failed to load slots');
                    const data = await res.json();

                    const items = data.slots.map((slot) => {
                        const disabled = !slot.available;
                        const classes = disabled
                            ? 'cursor-not-allowed border-[#d1d5db] bg-[#eceff3] text-[#4b5563]'
                            : 'border-[#86b99f] bg-[#dff3e9] text-[#134e3a] hover:bg-[#cfeada]';

                        return `
                            <button type="button" data-time="${slot.time}" ${disabled ? 'disabled' : ''}
                                class="rounded-lg border px-3 py-3 text-sm font-semibold ${classes}">
                                ${slot.label}
                                <span class="mt-1 block text-xs font-semibold ${disabled ? 'text-[#4b5563]' : 'text-[#14532d]'}">${disabled ? 'Unavailable' : 'Available'}</span>
                            </button>
                        `;
                    });

                    slotsContainer.innerHTML = items.length
                        ? items.join('')
                        : '<p class="col-span-full text-sm text-[#374151]">No timeslots available.</p>';

                    slotsContainer.querySelectorAll('[data-time]').forEach((btn) => {
                        btn.addEventListener('click', () => {
                            dateInput.value = dateKey;
                            timeInput.value = btn.dataset.time;
                            const endTime = addOneHour(btn.dataset.time);
                            selectedSlot.textContent = prettyDate;
                            selectedSlotRange.textContent = `(${btn.dataset.time} to ${endTime}) 1 hour session`;
                            selectedSlotRange.classList.remove('hidden');
                            slotError.classList.add('hidden');
                            closeModal();
                        });
                    });
                } catch (_e) {
                    slotsContainer.innerHTML = '<p class="col-span-full text-sm text-red-600">Could not load availability. Please try again.</p>';
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
                    if (window.Toastify) {
                        Toastify({
                            text,
                            duration: 4000,
                            gravity: 'top',
                            position: 'center',
                            close: true,
                            stopOnFocus: true,
                            className: 'stafflink-toast',
                            style: {
                                background: '#ffffff',
                                color: '#1b1b18',
                                border: '1px solid #287854',
                                borderRadius: '20px',
                            },
                        }).showToast();
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
                            const errorList = data.errors
                                ? Object.values(data.errors).flat()
                                : [data.message || 'Unable to submit appointment.'];
                            throw { errors: errorList };
                        }
                        return data;
                    })
                    .then((data) => {
                        showToast(data.message || 'Appointment request submitted successfully.', 'success');

                        form.reset();
                        dateInput.value = '';
                        timeInput.value = '';
                        activeDate = null;
                        renderCalendar();
                        selectedSlot.textContent = 'No timeslot selected yet.';
                        selectedSlotRange.classList.add('hidden');
                    })
                    .catch((err) => {
                        const messages = err?.errors || ['Unable to submit appointment. Please try again.'];
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
</body>
</html>
