@extends('admin.layout')

@section('page-title', 'Jobs & Careers')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Jobs</h3>
            <div class="flex items-center gap-2">
                <button type="submit" form="bulk-delete-form" id="bulk-delete-btn"
                    class="hidden bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                    Delete Selected
                </button>
                <a href="{{ route('admin.jobs.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Job
                </a>
            </div>
        </div>
        <form id="bulk-delete-form" action="{{ route('admin.jobs.bulk-destroy') }}" method="POST"
            onsubmit="return confirm('Delete selected jobs? This action cannot be undone.');" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        @if ($jobs->count() > 0)
            @if ($jobs->hasPages())
                <div class="px-6 py-4 border-b">
                    {{ $jobs->links() }}
                </div>
            @endif
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox" id="select-all-jobs"
                                    class="h-4 w-4 rounded border-gray-300 text-[#287854] focus:ring-[#287854]">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($jobs as $job)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4">
                                    <input type="checkbox" name="job_ids[]" value="{{ $job->id }}"
                                        form="bulk-delete-form"
                                        class="job-checkbox h-4 w-4 rounded border-gray-300 text-[#287854] focus:ring-[#287854]">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $job->title }}</p>
                                            @if ($job->salary_range)
                                                <p class="text-sm text-gray-500">{{ $job->salary_range }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $job->location ?? '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $job->type === 'full-time' ? 'bg-blue-100 text-blue-800' : ($job->type === 'part-time' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800') }}">
                                        {{ ucwords(str_replace('-', ' ', $job->type)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $job->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    @if ($job->published_at)
                                        {{ $job->published_at->format('M d, Y') }}
                                    @else
                                        {{ $job->created_at->format('M d, Y') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('admin.jobs.edit', $job) }}"
                                        class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1] hover:text-[#1f5f46]"
                                        title="Edit">
                                        <iconify-icon icon="mdi:pencil-outline" width="18" height="18"></iconify-icon>
                                    </a>
                                    <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this job?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-red-600 hover:bg-red-50 hover:text-red-800"
                                            title="Delete">
                                            <iconify-icon icon="mdi:trash-can-outline" width="18" height="18"></iconify-icon>
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($jobs->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $jobs->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No jobs yet</h3>
                <p class="text-gray-500 mb-4">Get started by creating your first job posting.</p>
                <a href="{{ route('admin.jobs.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Job
                </a>
            </div>
        @endif
    </div>

    <script>
        (() => {
            const selectAll = document.getElementById('select-all-jobs');
            const rowChecks = Array.from(document.querySelectorAll('.job-checkbox'));
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

            if (!selectAll || !rowChecks.length || !bulkDeleteBtn) return;

            const syncButton = () => {
                const checkedCount = rowChecks.filter((cb) => cb.checked).length;
                bulkDeleteBtn.classList.toggle('hidden', checkedCount === 0);
                selectAll.checked = checkedCount === rowChecks.length;
                selectAll.indeterminate = checkedCount > 0 && checkedCount < rowChecks.length;
            };

            selectAll.addEventListener('change', () => {
                rowChecks.forEach((cb) => {
                    cb.checked = selectAll.checked;
                });
                syncButton();
            });

            rowChecks.forEach((cb) => cb.addEventListener('change', syncButton));
            syncButton();
        })();
    </script>
@endsection
