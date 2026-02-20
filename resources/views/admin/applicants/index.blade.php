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
                            @foreach (['new', 'reviewed', 'shortlisted', 'rejected', 'hired', 'onboard'] as $opt)
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
                            @php
                                $waNumber = preg_replace('/\D+/', '', (string) $application->phone);
                                $waTemplate = (string) config('services.whatsapp.candidate_template', 'Hi {name}, thank you for applying to {position}. We would like to continue your process.');
                                $waMessage = strtr($waTemplate, [
                                    '{name}' => (string) $application->full_name,
                                    '{position}' => (string) $application->position_title,
                                ]);
                                $waUrl = $waNumber !== '' ? 'https://wa.me/' . $waNumber . '?text=' . urlencode($waMessage) : null;
                                $hasResume = filled($application->resume_path);
                                $hasIdKtp = filled($application->id_ktp_path);
                                $hasSkck = filled($application->skck_path);
                                $hasCoverLetter = filled($application->cover_letter_file_path);
                                $hasPortfolio = filled($application->portfolio_file_path);
                                $locationText = (string) ($application->address ?: trim($application->city . ', ' . $application->province, ', '));
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $application->full_name }}</p>
                                    <p class="text-xs leading-tight text-gray-500">{{ $application->email }}</p>
                                    <p class="text-xs leading-tight text-gray-500">{{ $application->phone }}</p>
                                    @if ($application->attachment_link)
                                        <a href="{{ $application->attachment_link }}" target="_blank" rel="noopener"
                                            class="mt-1 inline-flex text-xs font-medium text-[#287854] hover:text-[#1f5f46]">
                                            Attachment Link
                                        </a>
                                    @endif
                                    @if ($application->reference_name || $application->reference_company || $application->reference_phone || $application->reference_email)
                                        <details class="mt-2 rounded-md border border-gray-200 bg-gray-50 p-2">
                                            <summary class="cursor-pointer text-xs font-semibold text-gray-700">Reference contact</summary>
                                            <ul class="mt-2 space-y-1 text-xs text-gray-600">
                                                <li><span class="font-semibold">Name:</span> {{ $application->reference_name ?: '-' }}</li>
                                                <li><span class="font-semibold">Company:</span> {{ $application->reference_company ?: '-' }}</li>
                                                <li><span class="font-semibold">Phone:</span> {{ $application->reference_phone ?: '-' }}</li>
                                                <li><span class="font-semibold">Email:</span> {{ $application->reference_email ?: '-' }}</li>
                                            </ul>
                                        </details>
                                    @endif
                                    @if (is_array($application->custom_answers) && count($application->custom_answers))
                                        <details class="mt-2 rounded-md border border-gray-200 bg-gray-50 p-2">
                                            <summary class="cursor-pointer text-xs font-semibold text-gray-700">Custom answers</summary>
                                            <ul class="mt-2 space-y-1 text-xs text-gray-600">
                                                @foreach ($application->custom_answers as $question => $answer)
                                                    <li><span class="font-semibold">{{ $question }}:</span>
                                                        {{ \Illuminate\Support\Str::limit((string) $answer, 90) }}</li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->position_title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span title="{{ $locationText }}">{{ \Illuminate\Support\Str::limit($locationText, 20, '...') }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.applicants.status', $application) }}" method="POST" class="js-status-form flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status"
                                            data-initial-status="{{ $application->status }}"
                                            class="rounded-lg border border-gray-300 px-2 py-1 text-sm focus:border-[#287854] focus:outline-none">
                                            @foreach (['new', 'reviewed', 'shortlisted', 'rejected', 'hired', 'onboard'] as $opt)
                                                <option value="{{ $opt }}" {{ $application->status === $opt ? 'selected' : '' }}>
                                                    {{ ucfirst($opt) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-2">
                                        @if ($waUrl)
                                            <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#25d366] hover:bg-[#e9fce9]"
                                                title="Chat candidate via WhatsApp">
                                                <iconify-icon icon="mdi:whatsapp" width="18" height="18"></iconify-icon>
                                            </a>
                                        @endif
                                        @if ($hasResume)
                                            <a href="{{ route('admin.applicants.resume', $application) }}"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]"
                                                title="Download Resume">
                                                <iconify-icon icon="mdi:file-download-outline" width="18" height="18"></iconify-icon>
                                            </a>
                                        @else
                                            <span class="inline-flex cursor-not-allowed items-center justify-center rounded-md p-1.5 text-gray-300"
                                                title="Resume attachment not available" aria-disabled="true">
                                                <iconify-icon icon="mdi:file-download-outline" width="18" height="18"></iconify-icon>
                                            </span>
                                        @endif
                                        @if ($hasIdKtp)
                                            <a href="{{ route('admin.applicants.document', [$application, 'id_ktp']) }}"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]"
                                                title="Download ID / KTP">
                                                <iconify-icon icon="mdi:card-account-details-outline" width="18" height="18"></iconify-icon>
                                            </a>
                                        @else
                                            <span class="inline-flex cursor-not-allowed items-center justify-center rounded-md p-1.5 text-gray-300"
                                                title="ID / KTP attachment not available" aria-disabled="true">
                                                <iconify-icon icon="mdi:card-account-details-outline" width="18" height="18"></iconify-icon>
                                            </span>
                                        @endif
                                        @if ($hasSkck)
                                            <a href="{{ route('admin.applicants.document', [$application, 'skck']) }}"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]"
                                                title="Download SKCK">
                                                <iconify-icon icon="mdi:file-certificate-outline" width="18" height="18"></iconify-icon>
                                            </a>
                                        @else
                                            <span class="inline-flex cursor-not-allowed items-center justify-center rounded-md p-1.5 text-gray-300"
                                                title="SKCK attachment not available" aria-disabled="true">
                                                <iconify-icon icon="mdi:file-certificate-outline" width="18" height="18"></iconify-icon>
                                            </span>
                                        @endif
                                        @if ($hasCoverLetter)
                                            <a href="{{ route('admin.applicants.document', [$application, 'cover_letter']) }}"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]"
                                                title="Download Cover Letter">
                                                <iconify-icon icon="mdi:file-document-outline" width="18" height="18"></iconify-icon>
                                            </a>
                                        @else
                                            <span class="inline-flex cursor-not-allowed items-center justify-center rounded-md p-1.5 text-gray-300"
                                                title="Cover letter attachment not available" aria-disabled="true">
                                                <iconify-icon icon="mdi:file-document-outline" width="18" height="18"></iconify-icon>
                                            </span>
                                        @endif
                                        @if ($hasPortfolio)
                                            <a href="{{ route('admin.applicants.document', [$application, 'portfolio']) }}"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]"
                                                title="Download Portfolio">
                                                <iconify-icon icon="mdi:briefcase-outline" width="18" height="18"></iconify-icon>
                                            </a>
                                        @else
                                            <span class="inline-flex cursor-not-allowed items-center justify-center rounded-md p-1.5 text-gray-300"
                                                title="Portfolio attachment not available" aria-disabled="true">
                                                <iconify-icon icon="mdi:briefcase-outline" width="18" height="18"></iconify-icon>
                                            </span>
                                        @endif
                                        @if ($application->reference_token)
                                            <a href="{{ route('references.show', $application->reference_token) }}" target="_blank" rel="noopener"
                                                class="inline-flex items-center justify-center rounded-md p-1.5 text-[#2b89b5] hover:bg-[#ebf4fa]"
                                                title="Open reference link">
                                                <iconify-icon icon="mdi:link-variant" width="18" height="18"></iconify-icon>
                                            </a>
                                        @endif
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

    <script>
        (() => {
            const forms = document.querySelectorAll('.js-status-form');
            if (!forms.length) return;

            const showToast = (text, isError = false) => {
                if (!window.Toastify) return;
                Toastify({
                    text,
                    duration: 2800,
                    gravity: 'top',
                    position: 'center',
                    close: true,
                    stopOnFocus: true,
                    className: 'stafflink-toast',
                    style: {
                        background: '#ffffff',
                        color: '#1b1b18',
                        border: `1px solid ${isError ? '#dc2626' : '#287854'}`,
                        borderRadius: '20px',
                    },
                }).showToast();
            };

            forms.forEach((form) => {
                const select = form.querySelector('select[name="status"]');
                if (!select) return;

                select.addEventListener('change', async () => {
                    const previousStatus = select.dataset.initialStatus || '';
                    const nextStatus = select.value;

                    if (nextStatus === previousStatus) return;

                    select.disabled = true;

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            body: new URLSearchParams({
                                _method: 'PATCH',
                                status: nextStatus,
                            }),
                        });

                        const payload = await response.json().catch(() => ({}));
                        if (!response.ok) {
                            throw new Error(payload.message || 'Failed to update applicant status.');
                        }

                        select.dataset.initialStatus = payload.status || nextStatus;
                        showToast(payload.message || 'Applicant status updated.');
                    } catch (error) {
                        select.value = previousStatus;
                        showToast(error.message || 'Failed to update applicant status.', true);
                    } finally {
                        select.disabled = false;
                    }
                });
            });
        })();
    </script>
@endsection
