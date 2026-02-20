@extends('admin.layout')

@section('page-title', 'Leads')

@section('content')
    <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
        <p class="text-sm text-gray-600">
            Lead data is sourced from the appointment form submissions.
        </p>
        <form method="GET" action="{{ route('admin.leads.index') }}" class="mt-4 grid gap-3 md:grid-cols-4">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search name, email, phone, company"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">

            <select name="lead_status"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                <option value="">All lead statuses</option>
                @foreach ($leadStatusOptions as $option)
                    <option value="{{ $option }}" @selected($leadStatus === $option)>{{ ucfirst($option) }}</option>
                @endforeach
            </select>

            <select name="appointment_status"
                class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                <option value="">All appointment statuses</option>
                @foreach (['pending', 'confirmed', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected($appointmentStatus === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit"
                    class="rounded-md bg-[#1f5f46] px-4 py-2 text-sm font-semibold text-white hover:bg-[#287854]">
                    Filter
                </button>
                <a href="{{ route('admin.leads.index') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Appointment</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Lead Follow-up</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($leads as $lead)
                        <tr>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="font-semibold text-gray-900">{{ $lead->name }}</p>
                                <p class="mt-1">{{ $lead->email }}</p>
                                <p>{{ $lead->phone }}</p>
                                @if ($lead->company)
                                    <p class="mt-1 text-xs text-gray-500">{{ $lead->company }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p>{{ $lead->starts_at?->timezone('+08:00')->format('d M Y, H:i') }} - {{ $lead->ends_at?->timezone('+08:00')->format('H:i') }} (UTC+8)</p>
                                @if ($lead->notes)
                                    <p class="mt-1 line-clamp-3 text-xs text-gray-500">{{ $lead->notes }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-4 align-top text-sm">
                                <span
                                    class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                    {{ $lead->status === 'confirmed' ? 'bg-[#dff3e9] text-[#1f5f46]' : ($lead->status === 'cancelled' ? 'bg-[#fcebea] text-[#b42318]' : 'bg-[#fff7e0] text-[#8a6d1f]') }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 align-top">
                                <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="space-y-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="lead_status"
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                                        @foreach ($leadStatusOptions as $option)
                                            <option value="{{ $option }}" @selected($lead->lead_status === $option)>
                                                {{ ucfirst($option) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <textarea name="lead_notes" rows="3" placeholder="Internal follow-up notes..."
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">{{ $lead->lead_notes }}</textarea>

                                    <button type="submit"
                                        class="rounded-md bg-[#1f5f46] px-3 py-1.5 text-xs font-semibold text-white hover:bg-[#287854]">
                                        Save
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">
                                No leads found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $leads->links() }}
    </div>
@endsection

