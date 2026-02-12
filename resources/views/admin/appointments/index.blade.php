@extends('admin.layout')

@section('page-title', 'Appointments')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 text-sm">Total Appointments</p>
            <p class="mt-2 text-2xl font-semibold">{{ \App\Models\Appointment::count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 text-sm">Upcoming</p>
            <p class="mt-2 text-2xl font-semibold">{{ \App\Models\Appointment::where('starts_at', '>=', now())->whereIn('status', ['pending', 'confirmed'])->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 text-sm">Pending</p>
            <p class="mt-2 text-2xl font-semibold">{{ \App\Models\Appointment::where('status', 'pending')->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex flex-wrap items-center justify-between gap-3">
            <h3 class="text-lg font-semibold">Appointments Schedule</h3>
            <div class="inline-flex rounded-lg border overflow-hidden">
                <button type="button" data-view-tab="calendar"
                    class="px-4 py-2 text-sm font-medium bg-[#1f5f46] text-white">
                    Calendar View
                </button>
                <button type="button" data-view-tab="timeline"
                    class="px-4 py-2 text-sm font-medium bg-white text-gray-700">
                    Timeline View
                </button>
            </div>
        </div>

        <div class="p-6">
            <div data-view-panel="calendar">
                <div class="mb-4 flex items-center justify-between">
                    <button type="button" id="calendar-prev"
                        class="rounded-md border px-3 py-2 text-sm hover:bg-gray-50">Previous</button>
                    <h4 id="calendar-title" class="text-base font-semibold text-gray-800"></h4>
                    <button type="button" id="calendar-next"
                        class="rounded-md border px-3 py-2 text-sm hover:bg-gray-50">Next</button>
                </div>
                <div id="calendar-grid" class="grid grid-cols-7 gap-2"></div>
            </div>

            <div data-view-panel="timeline" class="hidden">
                <div class="space-y-4">
                    @forelse($appointments->sortBy('starts_at') as $appointment)
                        <article class="rounded-lg border p-3">
                            <h4 class="text-sm font-semibold text-gray-800">{{ $appointment->name }}</h4>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $appointment->starts_at->format('D, d M Y H:i') }} - {{ $appointment->ends_at->format('H:i') }}
                            </p>
                            <p class="mt-1 text-sm text-gray-700">
                                {{ $appointment->notes ?: '-' }}
                            </p>
                            @if($appointment->status === 'pending')
                                <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded-md bg-[#1f5f46] px-3 py-2 text-xs font-semibold text-white hover:bg-[#287854]">
                                        Approve
                                    </button>
                                </form>
                            @endif
                        </article>
                    @empty
                        <p class="text-sm text-gray-500">No appointments scheduled yet.</p>
                    @endforelse
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

    <script>
        (() => {
            const appointments = @json($appointmentsForJs);

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
            let currentDate = new Date();

            const statusClass = (status) => {
                if (status === 'confirmed') return 'bg-green-100 text-green-800';
                if (status === 'cancelled') return 'bg-red-100 text-red-800';
                return 'bg-yellow-100 text-yellow-800';
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
                    cells.push(`<div class="rounded-md bg-gray-50 px-2 py-2 text-xs font-semibold text-gray-600">${w}</div>`);
                });

                for (let i = 0; i < startWeekDay; i++) {
                    cells.push('<div class="min-h-[120px] rounded-md border bg-gray-50/60"></div>');
                }

                for (let day = 1; day <= totalDays; day++) {
                    const dateObj = new Date(year, month, day);
                    const dateKey = dateObj.toISOString().slice(0, 10);
                    const dayItems = appointments.filter((a) => {
                        const d = new Date(a.starts_at);
                        return d.toISOString().slice(0, 10) === dateKey;
                    });

                    const entries = dayItems.slice(0, 3).map((a) => {
                        const time = new Date(a.starts_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        return `<div class="mt-1 truncate rounded px-2 py-0.5 text-[11px] ${statusClass(a.status)}">${time} ${a.title}</div>`;
                    }).join('');
                    const more = dayItems.length > 3 ? `<div class="mt-1 text-[11px] text-gray-500">+${dayItems.length - 3} more</div>` : '';

                    cells.push(`
                        <button type="button" data-day-key="${dateKey}" class="min-h-[120px] rounded-md border bg-white p-2 text-left transition hover:border-[#1f5f46]">
                            <div class="text-xs font-semibold text-gray-700">${day}</div>
                            ${entries}
                            ${more}
                        </button>
                    `);
                }

                calendarGrid.innerHTML = cells.join('');

                calendarGrid.querySelectorAll('[data-day-key]').forEach((el) => {
                    el.addEventListener('click', () => openDayModal(el.dataset.dayKey));
                });
            };

            const openDayModal = (dateKey) => {
                const dayItems = appointments
                    .filter((a) => {
                        const d = new Date(a.starts_at);
                        return d.toISOString().slice(0, 10) === dateKey;
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
                        const start = new Date(item.starts_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        const end = new Date(item.ends_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        const badgeClass = item.status === 'confirmed'
                            ? 'bg-green-100 text-green-700'
                            : (item.status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700');
                        const approveForm = item.status === 'pending'
                            ? `
                                <form action="/admin/appointments/${item.id}/approve" method="POST" class="mt-3">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="rounded-md bg-[#1f5f46] px-3 py-2 text-xs font-semibold text-white hover:bg-[#287854]">
                                        Approve
                                    </button>
                                </form>
                            `
                            : '';
                        return `
                            <article class="rounded-lg border p-4">
                                <div class="flex items-center justify-between gap-2">
                                    <h5 class="font-semibold text-gray-800">${item.title}</h5>
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ${badgeClass}">
                                        ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                    </span>
                                </div>
                                <p class="mt-2 text-sm text-gray-600">${start} - ${end}</p>
                                <p class="mt-1 text-sm text-gray-600">${item.email} | ${item.phone}</p>
                                ${approveForm}
                            </article>
                        `;
                    }).join('');
                }

                dayEventsModal.classList.remove('hidden');
                dayEventsModal.classList.add('flex');
            };

            const closeDayModal = () => {
                dayEventsModal.classList.add('hidden');
                dayEventsModal.classList.remove('flex');
            };

            dayEventsClose?.addEventListener('click', closeDayModal);
            dayEventsModal?.addEventListener('click', (e) => {
                if (e.target === dayEventsModal) closeDayModal();
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
