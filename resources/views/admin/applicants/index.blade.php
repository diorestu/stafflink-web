@extends('admin.layout')

@section('page-title', 'Job Applicants')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold">All Applicants</h3>
                    <p class="text-sm text-gray-500">Manage incoming applications and update their status.</p>
                </div>
                <form method="GET" action="{{ route('admin.applicants.index') }}" class="flex flex-wrap items-end gap-2">
                    <div>
                        <label for="search" class="block text-xs text-gray-500 mb-1">Search</label>
                        <input id="search" name="search" value="{{ $search }}" type="text"
                            placeholder="Name, email, phone, position"
                            class="w-64 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#287854] focus:outline-none">
                    </div>
                    <div>
                        <label for="status" class="block text-xs text-gray-500 mb-1">Status</label>
                        <select id="status" name="status"
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#287854] focus:outline-none">
                            <option value="">All statuses</option>
                            @foreach (['new', 'reviewed', 'shortlisted', 'rejected', 'hired'] as $opt)
                                <option value="{{ $opt }}" {{ $status === $opt ? 'selected' : '' }}>
                                    {{ ucfirst($opt) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="rounded-lg bg-[#287854] px-4 py-2 text-sm font-medium text-white hover:bg-[#1f5f46]">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        @if ($applications->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Applicant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Applied</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $application->full_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $application->email }}</p>
                                    <p class="text-sm text-gray-500">{{ $application->phone }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->position_title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $application->city }}, {{ $application->province }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.applicants.status', $application) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status"
                                            class="rounded-lg border border-gray-300 px-2 py-1 text-sm focus:border-[#287854] focus:outline-none">
                                            @foreach (['new', 'reviewed', 'shortlisted', 'rejected', 'hired'] as $opt)
                                                <option value="{{ $opt }}" {{ $application->status === $opt ? 'selected' : '' }}>
                                                    {{ ucfirst($opt) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="rounded-md bg-[#287854] px-2.5 py-1 text-xs font-semibold text-white hover:bg-[#1f5f46]">
                                            Save
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="mailto:{{ $application->email }}"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]">
                                            <iconify-icon icon="mdi:email-outline" width="18" height="18"></iconify-icon>
                                        </a>
                                        <a href="{{ route('admin.applicants.resume', $application) }}"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]">
                                            <iconify-icon icon="mdi:file-download-outline" width="18" height="18"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($applications->hasPages())
                <div class="border-t px-6 py-4">
                    {{ $applications->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900">No applicants found</h3>
                <p class="mt-2 text-sm text-gray-500">Applicants will appear here when users submit the apply form.</p>
            </div>
        @endif
    </div>
@endsection
