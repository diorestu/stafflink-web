@extends('admin.layout')

@section('page-title', 'Contact Inquiries')

@section('content')
    <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
        <p class="text-sm text-gray-600">
            Messages submitted from the public contact form are stored here.
        </p>
        <form method="GET" action="{{ route('admin.contact-inquiries.index') }}" class="mt-4 flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search name, email, phone, company, message"
                class="min-w-[280px] rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
            <button type="submit"
                class="rounded-md bg-[#1f5f46] px-4 py-2 text-sm font-semibold text-white hover:bg-[#287854]">
                Filter
            </button>
            <a href="{{ route('admin.contact-inquiries.index') }}"
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
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Company</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Preferences</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Message</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Received</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($inquiries as $inquiry)
                        <tr>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="font-semibold text-gray-900">{{ $inquiry->name }}</p>
                                <p class="mt-1">{{ $inquiry->email }}</p>
                                <p>{{ $inquiry->phone }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="font-semibold text-gray-900">{{ $inquiry->company_name }}</p>
                                <p class="mt-1 text-xs text-gray-500">{{ $inquiry->company_size }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p>Time: {{ $inquiry->preferred_call_time ?: 'No preference' }}</p>
                                <p class="mt-1">Date: {{ $inquiry->preferred_call_date?->format('d M Y') ?: 'No preference' }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p class="max-w-md whitespace-pre-wrap break-words">{{ $inquiry->message ?: '-' }}</p>
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <p>{{ $inquiry->created_at?->timezone('+08:00')->format('d M Y, H:i') }} (UTC+8)</p>
                                @if ($inquiry->submitted_from_ip)
                                    <p class="mt-1 text-xs text-gray-500">IP: {{ $inquiry->submitted_from_ip }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-4 align-top text-sm text-gray-700">
                                <form method="POST" action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}"
                                    onsubmit="return confirm('Delete this contact inquiry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">
                                No contact inquiries found.
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
