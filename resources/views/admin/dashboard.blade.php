@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Page Sections</p>
                    <p class="text-2xl font-semibold">{{ \App\Models\PageSection::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Total Jobs</p>
                    <p class="text-2xl font-semibold">{{ \App\Models\Job::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Published Jobs</p>
                    <p class="text-2xl font-semibold">{{ \App\Models\Job::where('status', 'published')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Upcoming Appointments</p>
                    <p class="text-2xl font-semibold">
                        {{ \App\Models\Appointment::where('starts_at', '>=', now())->whereIn('status', ['pending', 'confirmed'])->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Quick Actions</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.sections.index') }}"
                class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <div>
                    <p class="font-semibold">Edit Page Content</p>
                    <p class="text-sm text-gray-500">Manage homepage sections</p>
                </div>
            </a>
            <a href="{{ route('admin.jobs.create') }}"
                class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <div>
                    <p class="font-semibold">Add New Job</p>
                    <p class="text-sm text-gray-500">Post a new job opening</p>
                </div>
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
            <div class="space-y-3">
                @forelse($weeklyAppointments as $appointment)
                    <article class="rounded-lg border p-4">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h4 class="font-semibold text-gray-800">{{ $appointment->name }}</h4>
                            <span
                                class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">
                            {{ $appointment->starts_at->format('D, d M Y H:i') }} - {{ $appointment->ends_at->format('H:i') }}
                        </p>
                        <p class="mt-1 text-sm text-gray-600">{{ $appointment->email }}</p>
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
                    <p class="text-sm text-gray-500">No appointments for this week.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
