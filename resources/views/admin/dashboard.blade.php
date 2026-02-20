@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
    @php
        $dashboardTimezone = 'Asia/Singapore'; // UTC+8
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <div class="rounded-xl border border-[#d7e8df] bg-[#f6faf8] p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-[#5b6d63]">Page Sections</p>
                    <p class="mt-2 text-3xl font-semibold leading-none text-[#1f5f46]">{{ $metrics['page_sections'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#e6f1ec] text-[#1f5f46]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-[#d7e8df] bg-[#f6faf8] p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-[#5b6d63]">Total Jobs</p>
                    <p class="mt-2 text-3xl font-semibold leading-none text-[#1f5f46]">{{ $metrics['total_jobs'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#e6f1ec] text-[#1f5f46]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-[#d7e8df] bg-[#f6faf8] p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-[#5b6d63]">Published Jobs</p>
                    <p class="mt-2 text-3xl font-semibold leading-none text-[#1f5f46]">{{ $metrics['published_jobs'] ?? 0 }}</p>
                </div>
                <div class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#e6f1ec] text-[#1f5f46]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-[#d7e8df] bg-[#f6faf8] p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[11px] uppercase tracking-wide text-[#5b6d63]">Upcoming Appointments</p>
                    <p class="mt-2 text-3xl font-semibold leading-none text-[#1f5f46]">
                        {{ $metrics['upcoming_appointments'] ?? 0 }}
                    </p>
                </div>
                <div class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#e6f1ec] text-[#1f5f46]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Quick Actions</h3>
        </div>
        <div class="p-6 flex flex-wrap items-center gap-3">
            @if (auth()->user()?->role === 'super_admin')
                <a href="{{ route('admin.sections.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-[#c7dfd4] bg-[#f6faf8] px-4 py-2 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#eaf5ef]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Page Content</span>
                </a>
                <a href="{{ route('admin.pages.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-[#c7dfd4] bg-[#f6faf8] px-4 py-2 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#eaf5ef]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-6m-8-8h8m0 0v8m0-8L10 14" />
                    </svg>
                    <span>Manage Pages</span>
                </a>
                <a href="{{ route('admin.jobs.create') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-[#c7dfd4] bg-[#f6faf8] px-4 py-2 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#eaf5ef]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Add New Job</span>
                </a>
            @endif
            <a href="{{ route('admin.careers.create') }}"
                class="inline-flex items-center gap-2 rounded-full border border-[#c7dfd4] bg-[#f6faf8] px-4 py-2 text-sm font-semibold text-[#1f5f46] transition hover:bg-[#eaf5ef]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Add Service</span>
            </a>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-lg shadow">
        <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-lg font-semibold">This Week's Appointments</h3>
            <a href="{{ route('admin.appointments.index') }}" class="text-sm font-semibold text-[#1f5f46] hover:text-[#287854]">
                View all
            </a>
        </div>
        <div class="p-6">
            @php
                $startOfWeek = \Carbon\Carbon::now($dashboardTimezone)->startOfWeek(\Carbon\Carbon::MONDAY);
                $appointmentsByDay = $weeklyAppointments->groupBy(fn ($item) => $item->starts_at->copy()->timezone($dashboardTimezone)->toDateString());
            @endphp

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7">
                @for ($i = 0; $i < 7; $i++)
                    @php
                        $day = $startOfWeek->copy()->addDays($i);
                        $dayItems = $appointmentsByDay->get($day->toDateString(), collect());
                    @endphp
                    <section class="rounded-md border border-[#e4efe9] bg-[#fbfdfc] p-3">
                        <div class="border-b border-[#edf4f0] pb-2">
                            <p class="text-xs font-semibold uppercase tracking-wide text-[#1f5f46]">{{ $day->format('l') }}</p>
                            <p class="text-xs text-gray-500">{{ $day->format('d M') }}</p>
                        </div>

                        <div class="mt-2 space-y-2">
                            @forelse ($dayItems as $appointment)
                                <article class="rounded-md bg-[#f2f8f5] px-2.5 py-2">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-xs font-semibold text-gray-800">{{ $appointment->name }}</p>
                                        @if($appointment->status === 'confirmed')
                                            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-[#dff3e9] text-[#1f5f46]" title="Confirmed">
                                                <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.415 0l-3-3a1 1 0 111.415-1.42l2.292 2.294 6.792-6.794a1 1 0 011.416 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @elseif($appointment->status === 'pending')
                                            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-[#fff7e0] text-[#8a6d1f]" title="Pending">
                                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="9"></circle>
                                                    <path d="M12 7v6l4 2"></path>
                                                </svg>
                                            </span>
                                        @else
                                            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-[#fcebea] text-[#b42318]" title="{{ ucfirst($appointment->status) }}">
                                                <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.293a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 101.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mt-1 text-[11px] text-gray-600">
                                        {{ $appointment->starts_at->copy()->timezone($dashboardTimezone)->format('H:i') }}
                                        -
                                        {{ $appointment->ends_at->copy()->timezone($dashboardTimezone)->format('H:i') }}
                                        (UTC+8)
                                    </p>
                                    <div class="mt-1.5 flex flex-wrap gap-1.5">
                                        @if($appointment->status === 'pending')
                                            <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="rounded border border-[#1f5f46]/20 bg-white px-2 py-0.5 text-[10px] font-semibold text-[#1f5f46] hover:bg-[#ecf6f1]">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                        @if($appointment->status !== 'cancelled')
                                            <form action="{{ route('admin.appointments.cancel', $appointment) }}" method="POST"
                                                onsubmit="return confirm('Cancel this appointment?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="rounded border border-[#b42318]/20 bg-white px-2 py-0.5 text-[10px] font-semibold text-[#b42318] hover:bg-[#fdf3f2]">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST"
                                            onsubmit="return confirm('Delete this appointment permanently? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded border border-gray-300 bg-white px-2 py-0.5 text-[10px] font-semibold text-gray-700 hover:bg-gray-100">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
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

@endsection
