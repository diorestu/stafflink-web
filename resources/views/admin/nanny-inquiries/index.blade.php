@extends('admin.layout')

@section('page-title', 'Nanny Inquiries')

@section('content')
    <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
        <div class="mt-4 rounded-lg border border-[#d7e8df] bg-white p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-[#1f5f46]">Create Shareable Wedding Form Link</p>
            <form method="POST" action="{{ route('admin.nanny-inquiries.wedding-events.store') }}" class="mt-3 grid gap-3">
                @csrf
                <div class="grid gap-3 sm:grid-cols-2">
                    <input name="couple_names" type="text" required placeholder="Wedding of (Bride & Groom full names)"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                    <input name="unique_code" type="text" required placeholder="Unique code (e.g. WED-BALI-001)"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm uppercase focus:border-[#1f5f46] focus:outline-none">
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <input name="wedding_date" type="date" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                    <input name="wedding_start_time" type="time" required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                </div>
                <div class="grid gap-3 sm:grid-cols-1">
                    <input name="wedding_venue_name" type="text" placeholder="Hotel/Villa Name (optional)"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                </div>
                <textarea name="wedding_location_address" rows="2" required placeholder="Wedding location address"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none"></textarea>
                <div>
                    <button type="submit" class="rounded-md bg-[#1f5f46] px-4 py-2 text-sm font-semibold text-white hover:bg-[#287854]">
                        Save Event & Generate Link
                    </button>
                </div>
            </form>
            @if ($weddingEvents->isNotEmpty())
                <div class="mt-4 overflow-x-auto rounded-md border border-[#d7e8df]">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Wedding</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Date</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Share Link</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($weddingEvents as $event)
                                <tr>
                                    <td class="px-3 py-2 text-sm text-gray-800">{{ $event->couple_names }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ $event->wedding_date?->format('d M Y') }}</td>
                                    <td class="px-3 py-2 text-xs text-[#1f5f46]">
                                        <div class="mb-1 font-semibold text-[#173f31]">Code: {{ $event->unique_code ?: \Illuminate\Support\Str::upper($event->share_token) }}</div>
                                        {{ route('forms.nannies-inquiry', ['event' => $event->share_token]) }}
                                    </td>
                                    <td class="px-3 py-2 text-xs">
                                        <form method="POST" action="{{ route('admin.nanny-inquiries.wedding-events.destroy', $event) }}"
                                            onsubmit="return confirm('Delete this wedding event link?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md border border-red-300 px-2 py-1 font-semibold text-red-600 hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @if ($groupedBookings->isNotEmpty())
            <div class="mt-4 rounded-lg border border-[#d7e8df] bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-[#1f5f46]">Wedding Booking Groups</p>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Wedding</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Families</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Children</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Nannies</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold uppercase text-gray-600">Sheet</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($groupedBookings as $group)
                                <tr>
                                    <td class="px-3 py-2 text-sm text-gray-800">
                                        <p class="font-semibold">{{ $group->wedding_couple_names }}</p>
                                        <p class="text-xs text-gray-500">Code: {{ $group->unique_code ?: '-' }}</p>
                                        <p class="text-xs text-gray-500">{{ \Illuminate\Support\Carbon::parse($group->wedding_date)->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ (int) $group->total_families }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ (int) $group->total_children }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">{{ (int) $group->total_nannies }}</td>
                                    <td class="px-3 py-2 text-sm">
                                        <a href="{{ route('admin.nanny-inquiries.export-wedding', ['wedding' => $group->wedding_group_key]) }}"
                                            class="inline-flex rounded-md border border-[#1f5f46] px-3 py-1.5 text-xs font-semibold text-[#1f5f46] hover:bg-[#ecf7f1]">
                                            Download CSV
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <form method="GET" action="{{ route('admin.nanny-inquiries.index') }}" class="mt-4 flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Search wedding, code, name, email, phone, or date"
                class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
            <button type="submit"
                class="rounded-md bg-[#1f5f46] px-4 py-2 text-sm font-semibold text-white hover:bg-[#287854]">
                Filter
            </button>
            <a href="{{ route('admin.nanny-inquiries.index') }}"
                class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Reset
            </a>
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Wedding</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Guardian</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Children</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Service</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Submitted</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($inquiries as $inquiry)
                        <tr>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="font-semibold text-gray-900">{{ $inquiry->wedding_couple_names ?: '-' }}</p>
                                <p class="mt-1 text-xs text-gray-500">Code: {{ $inquiry->unique_code ?: '-' }}</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Date:
                                    {{ $inquiry->wedding_date?->format('d M Y') ?: '-' }}
                                    @if ($inquiry->wedding_start_time)
                                        • {{ $inquiry->wedding_start_time }}
                                    @endif
                                </p>
                                <p class="mt-1 text-xs text-gray-500">Venue: {{ $inquiry->wedding_venue_name ?: '-' }}</p>
                                <p class="mt-1 text-xs text-gray-500">Address: {{ $inquiry->wedding_location_address ?: '-' }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="font-semibold text-gray-900">{{ $inquiry->guardian_name }}</p>
                                <p class="mt-1">{{ $inquiry->guardian_email }}</p>
                                <p>{{ $inquiry->guardian_phone }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="font-medium text-gray-900">{{ $inquiry->children_count }} child(ren)</p>
                                <p class="mt-1 text-xs text-gray-500">Nannies needed: {{ $inquiry->nannies_required ?: '-' }}</p>
                                <details class="mt-2">
                                    <summary class="cursor-pointer text-xs font-semibold text-[#1f5f46] hover:text-[#287854]">
                                        View details
                                    </summary>
                                    <div class="mt-2 space-y-2 rounded-md border border-[#d7e8df] bg-[#f6faf8] p-3 text-xs text-gray-700">
                                        @foreach (($inquiry->children ?? []) as $index => $child)
                                            <div>
                                                <p class="font-semibold text-gray-900">Child {{ $index + 1 }}</p>
                                                <p>Name: {{ $child['name'] ?? '-' }}</p>
                                                <p>Age: {{ $child['age'] ?? '-' }}</p>
                                                <p>Special: {{ ($child['special_requirement'] ?? '') !== '' ? $child['special_requirement'] : '-' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </details>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p>Accommodation: <span class="font-medium">{{ $inquiry->accommodation_location_option === 'prior' ? 'Prior to wedding' : 'At the wedding' }}</span></p>
                                @if ($inquiry->accommodation_detail)
                                    <p class="mt-1 text-xs text-gray-500">Detail: {{ $inquiry->accommodation_detail }}</p>
                                @endif
                                <p class="mt-2">Ceremony: <span class="font-medium">{{ $inquiry->ceremony_service_choice === 'yes' ? 'Subsidized hour' : 'Self paid' }}</span></p>
                                <p class="mt-2 text-xs text-gray-500">Additional hours: {{ $inquiry->additional_hours !== '' ? $inquiry->additional_hours : '-' }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p>{{ $inquiry->created_at?->timezone('+08:00')->format('d M Y, H:i') }} (UTC+8)</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <form method="POST" action="{{ route('admin.nanny-inquiries.destroy', $inquiry) }}"
                                    onsubmit="return confirm('Delete this nanny inquiry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md border border-red-300 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">
                                No nanny inquiries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $inquiries->links() }}
    </div>
@endsection
