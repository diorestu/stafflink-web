@extends('admin.layout')

@section('page-title', 'Appointments')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-6">
            <p class="text-[#4b5563] text-sm">Total Appointments</p>
            <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ \App\Models\Appointment::count() }}</p>
        </div>
        <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-6">
            <p class="text-[#4b5563] text-sm">Upcoming</p>
            <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ \App\Models\Appointment::where('starts_at', '>=', now())->whereIn('status', ['pending', 'confirmed'])->count() }}</p>
        </div>
        <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-6">
            <p class="text-[#4b5563] text-sm">Pending</p>
            <p class="mt-2 text-2xl font-semibold text-[#1f5f46]">{{ \App\Models\Appointment::where('status', 'pending')->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex flex-wrap items-center justify-between gap-3">
            <h3 class="text-lg font-semibold">Appointments Schedule</h3>
            <div class="inline-flex rounded-lg border border-[#c7dfd4] overflow-hidden">
                <button type="button" data-view-tab="calendar"
                    class="px-4 py-2 text-sm font-medium bg-[#1f5f46] text-white">
                    Calendar View
                </button>
                <button type="button" data-view-tab="timeline"
                    class="px-4 py-2 text-sm font-medium bg-white text-[#374151]">
                    Timeline View
                </button>
            </div>
        </div>

        <div class="p-6">
            <div data-view-panel="calendar">
                <div class="mb-4 flex items-center justify-between">
                    <button type="button" id="calendar-prev"
                        class="rounded-md border border-[#c7dfd4] px-3 py-2 text-sm text-[#1f5f46] hover:bg-[#ecf6f1]">Previous</button>
                    <h4 id="calendar-title" class="text-base font-semibold text-[#1f5f46]"></h4>
                    <button type="button" id="calendar-next"
                        class="rounded-md border border-[#c7dfd4] px-3 py-2 text-sm text-[#1f5f46] hover:bg-[#ecf6f1]">Next</button>
                </div>
                <div id="calendar-grid" class="grid grid-cols-7 gap-2"></div>
            </div>

            <div data-view-panel="timeline" class="hidden">
                @php
                    $startOfWeek = \Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::MONDAY);
                    $endOfWeek = \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::SUNDAY);
                    $timelineWeekly = $appointments
                        ->filter(fn ($a) => $a->starts_at->between($startOfWeek, $endOfWeek))
                        ->sortBy('starts_at')
                        ->groupBy(fn ($a) => $a->starts_at->toDateString());
                @endphp
                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7">
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $day = $startOfWeek->copy()->addDays($i);
                            $dayItems = $timelineWeekly->get($day->toDateString(), collect());
                        @endphp
                        <section class="rounded-md border border-[#e4efe9] bg-[#fbfdfc] p-3">
                            <div class="border-b border-[#edf4f0] pb-2">
                                <p class="text-xs font-semibold uppercase tracking-wide text-[#1f5f46]">{{ $day->format('l') }}</p>
                                <p class="text-xs text-gray-500">{{ $day->format('d M') }}</p>
                            </div>
                            <div class="mt-2 space-y-2">
                                @forelse($dayItems as $appointment)
                                    <article class="rounded-md bg-[#f2f8f5] px-2.5 py-2">
                                        <p class="text-xs font-semibold text-gray-800">{{ $appointment->name }}</p>
                                        <p class="mt-1 text-[11px] text-gray-600">{{ $appointment->starts_at->format('H:i') }} - {{ $appointment->ends_at->format('H:i') }}</p>
                                        @if($appointment->status === 'pending')
                                            <button type="button" data-approve-id="{{ $appointment->id }}"
                                                class="mt-1.5 rounded border border-[#1f5f46]/20 bg-white px-2 py-0.5 text-[10px] font-semibold text-[#1f5f46] hover:bg-[#ecf6f1]">
                                                Approve
                                            </button>
                                        @endif
                                    </article>
                                @empty
                                    <p class="text-[11px] text-gray-400">No appointments</p>
                                @endforelse
                            </div>
                        </section>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div id="day-events-modal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/40 p-4">
        <div class="w-full max-w-2xl rounded-xl bg-white shadow-xl">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h4 id="day-events-title" class="text-lg font-semibold text-gray-800">Appointments</h4>
                <button id="day-events-close" type="button" class="rounded-md px-2 py-1 text-sm text-gray-600 hover:bg-gray-100">Close</button>
            </div>
            <div id="day-events-list" class="max-h-[70vh] space-y-3 overflow-y-auto p-6"></div>
        </div>
    </div>
    <div id="approve-processing-modal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/45 p-4">
        <div class="w-full max-w-sm rounded-2xl bg-white px-6 py-6 text-center shadow-xl">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#ecf6f1]">
                <svg class="h-7 w-7 animate-spin text-[#1f5f46]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity="0.25" stroke-width="3"></circle>
                    <path d="M12 3a9 9 0 0 1 9 9" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                </svg>
            </div>
            <p class="mt-4 text-base font-semibold text-[#1f5f46]">Processing approval...</p>
            <p class="mt-1 text-sm text-gray-600">Please wait while we update the appointment.</p>
        </div>
    </div>

    <script>
        (() => {
            const appointments = @json($appointmentsForJs);
            const appointmentTimeZone = 'Asia/Makassar';
            const csrfToken = @json(csrf_token());
            let currentOpenDayKey = null;

            const tabs = Array.from(document.querySelectorAll('[data-view-tab]'));
            const panels = Array.from(document.querySelectorAll('[data-view-panel]'));
            tabs.forEach((tab) => {
                tab.addEventListener('click', () => {
                    const target = tab.dataset.viewTab;
                    tabs.forEach((t) => {
                        const active = t.dataset.viewTab === target;
                        t.classList.toggle('bg-[#1f5f46]', active);
                        t.classList.toggle('text-white', active);
                        t.classList.toggle('bg-white', !active);
                        t.classList.toggle('text-gray-700', !active);
                    });
                    panels.forEach((panel) => {
                        panel.classList.toggle('hidden', panel.dataset.viewPanel !== target);
                    });
                });
            });

            const calendarGrid = document.getElementById('calendar-grid');
            const calendarTitle = document.getElementById('calendar-title');
            const prevBtn = document.getElementById('calendar-prev');
            const nextBtn = document.getElementById('calendar-next');
            const dayEventsModal = document.getElementById('day-events-modal');
            const dayEventsTitle = document.getElementById('day-events-title');
            const dayEventsList = document.getElementById('day-events-list');
            const dayEventsClose = document.getElementById('day-events-close');
            const approveProcessingModal = document.getElementById('approve-processing-modal');
            let currentDate = new Date();
            let isApproving = false;

            const statusClass = (status) => {
                if (status === 'confirmed') return 'bg-[#dff3e9] text-[#1f5f46]';
                if (status === 'cancelled') return 'bg-[#fcebea] text-[#b42318]';
                return 'bg-[#fff7e0] text-[#8a6d1f]';
            };

            const toAppointmentDateKey = (value) => {
                const date = new Date(value);
                const parts = new Intl.DateTimeFormat('en-CA', {
                    timeZone: appointmentTimeZone,
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                }).formatToParts(date);

                const year = parts.find((p) => p.type === 'year')?.value;
                const month = parts.find((p) => p.type === 'month')?.value;
                const day = parts.find((p) => p.type === 'day')?.value;

                return `${year}-${month}-${day}`;
            };

            const toAppointmentTime = (value) => {
                return new Intl.DateTimeFormat(undefined, {
                    timeZone: appointmentTimeZone,
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                }).format(new Date(value));
            };

            const renderCalendar = () => {
                if (!calendarGrid || !calendarTitle) return;

                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startWeekDay = firstDay.getDay();
                const totalDays = lastDay.getDate();

                calendarTitle.textContent = firstDay.toLocaleDateString(undefined, {
                    month: 'long',
                    year: 'numeric'
                });

                const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const cells = [];

                weekdays.forEach((w) => {
                    cells.push(`<div class="rounded-md bg-[#e6f1ec] px-2 py-2 text-xs font-semibold text-[#1f5f46]">${w}</div>`);
                });

                for (let i = 0; i < startWeekDay; i++) {
                    cells.push('<div class="min-h-[120px] rounded-md border border-[#edf4f0] bg-[#f9fcfa]"></div>');
                }

                for (let day = 1; day <= totalDays; day++) {
                    const dateObj = new Date(year, month, day);
                    const dateKey = [
                        dateObj.getFullYear(),
                        String(dateObj.getMonth() + 1).padStart(2, '0'),
                        String(dateObj.getDate()).padStart(2, '0'),
                    ].join('-');
                    const dayItems = appointments.filter((a) => {
                        return toAppointmentDateKey(a.starts_at) === dateKey;
                    });

                    const entries = dayItems.slice(0, 3).map((a) => {
                        const time = toAppointmentTime(a.starts_at);
                        return `<div class="mt-1 truncate rounded px-2 py-0.5 text-[11px] ${statusClass(a.status)}">${time} ${a.title}</div>`;
                    }).join('');
                    const more = dayItems.length > 3 ? `<div class="mt-1 text-[11px] text-gray-500">+${dayItems.length - 3} more</div>` : '';

                    cells.push(`
                        <button type="button" data-day-key="${dateKey}" class="relative min-h-[120px] rounded-md border border-[#d7e8df] bg-white p-2 text-left transition hover:border-[#1f5f46]">
                            <div class="absolute left-2 top-2 text-[150%] font-bold leading-none text-gray-800">${day}</div>
                            <div class="pt-8">
                            ${entries}
                            ${more}
                            </div>
                        </button>
                    `);
                }

                calendarGrid.innerHTML = cells.join('');

                calendarGrid.querySelectorAll('[data-day-key]').forEach((el) => {
                    el.addEventListener('click', () => openDayModal(el.dataset.dayKey));
                });
            };

            const showProcessingModal = () => {
                approveProcessingModal?.classList.remove('hidden');
                approveProcessingModal?.classList.add('flex');
            };

            const hideProcessingModal = () => {
                approveProcessingModal?.classList.add('hidden');
                approveProcessingModal?.classList.remove('flex');
            };

            const updateAppointmentStatus = (appointmentId, status) => {
                const targetId = Number(appointmentId);
                appointments.forEach((item) => {
                    if (Number(item.id) === targetId) {
                        item.status = status;
                    }
                });
            };

            const showToast = (text, isError = false) => {
                if (!window.Toastify || !text) return;
                Toastify({
                    text,
                    duration: 3200,
                    gravity: 'top',
                    position: 'center',
                    close: true,
                    stopOnFocus: true,
                    className: 'stafflink-toast',
                    style: {
                        background: '#ffffff',
                        color: '#1b1b18',
                        border: `1px solid ${isError ? '#b42318' : '#287854'}`,
                        borderRadius: '20px',
                    },
                }).showToast();
            };

            const approveAppointment = async (appointmentId) => {
                if (isApproving) {
                    return;
                }
                isApproving = true;
                showProcessingModal();

                try {
                    const response = await fetch(`/admin/appointments/${appointmentId}/approve`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: new URLSearchParams({
                            _method: 'PATCH',
                        }),
                    });

                    const payload = await response.json().catch(() => ({}));
                    if (!response.ok) {
                        throw new Error(payload.message || 'Failed to approve appointment.');
                    }

                    updateAppointmentStatus(payload.appointment_id ?? appointmentId, payload.status || 'confirmed');
                    renderCalendar();
                    if (currentOpenDayKey) {
                        openDayModal(currentOpenDayKey);
                    }

                    showToast(payload.message || 'Appointment approved successfully.');
                } catch (error) {
                    showToast(error.message || 'Failed to approve appointment.', true);
                } finally {
                    hideProcessingModal();
                    isApproving = false;
                }
            };

            const openDayModal = (dateKey) => {
                currentOpenDayKey = dateKey;
                const dayItems = appointments
                    .filter((a) => {
                        return toAppointmentDateKey(a.starts_at) === dateKey;
                    })
                    .sort((a, b) => new Date(a.starts_at) - new Date(b.starts_at));

                const prettyDate = new Date(dateKey + 'T00:00:00').toLocaleDateString(undefined, {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });

                dayEventsTitle.textContent = `Appointments - ${prettyDate}`;

                if (dayItems.length === 0) {
                    dayEventsList.innerHTML = '<p class="text-sm text-gray-500">No appointments on this date.</p>';
                } else {
                    dayEventsList.innerHTML = dayItems.map((item) => {
                        const start = toAppointmentTime(item.starts_at);
                        const end = toAppointmentTime(item.ends_at);
                        const badgeClass = item.status === 'confirmed'
                            ? 'bg-[#dff3e9] text-[#1f5f46]'
                            : (item.status === 'cancelled' ? 'bg-[#fcebea] text-[#b42318]' : 'bg-[#fff7e0] text-[#8a6d1f]');
                        const approveButton = item.status === 'pending'
                            ? `
                                <button type="button" data-approve-id="${item.id}" class="mt-3 rounded-md border border-[#1f5f46]/20 bg-white px-2.5 py-1 text-[11px] font-semibold text-[#1f5f46] hover:bg-[#ecf6f1]">
                                    Approve
                                </button>
                            `
                            : '';
                        return `
                            <article class="rounded-md bg-[#f6faf8] px-4 py-3">
                                <div class="flex items-center justify-between gap-2">
                                    <h5 class="font-semibold text-gray-800">${item.title}</h5>
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ${badgeClass}">
                                        ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                    </span>
                                </div>
                                <p class="mt-2 text-sm text-gray-600">${start} - ${end}</p>
                                <p class="mt-1 text-sm text-gray-600">${item.email} | ${item.phone}</p>
                                ${approveButton}
                            </article>
                        `;
                    }).join('');
                }

                dayEventsModal.classList.remove('hidden');
                dayEventsModal.classList.add('flex');
            };

            const closeDayModal = () => {
                currentOpenDayKey = null;
                dayEventsModal.classList.add('hidden');
                dayEventsModal.classList.remove('flex');
            };

            dayEventsClose?.addEventListener('click', closeDayModal);
            dayEventsModal?.addEventListener('click', (e) => {
                if (e.target === dayEventsModal) closeDayModal();
            });

            document.addEventListener('click', (event) => {
                const button = event.target.closest('[data-approve-id]');
                if (!button) return;

                const appointmentId = button.getAttribute('data-approve-id');
                if (!appointmentId) return;

                approveAppointment(appointmentId);
            });

            prevBtn?.addEventListener('click', () => {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
                renderCalendar();
            });

            nextBtn?.addEventListener('click', () => {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
                renderCalendar();
            });

            renderCalendar();
        })();
    </script>
@endsection
