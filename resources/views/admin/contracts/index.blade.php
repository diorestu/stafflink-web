@extends('admin.layout')

@section('page-title', 'Contracts')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Contracts</h3>
            <a href="{{ route('admin.contracts.create') }}"
                class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Generate New Contract
            </a>
        </div>

        @if (session('success'))
            <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($contracts->count() > 0)
            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 border-b">
                <div class="bg-[#e6f1ec] rounded-lg p-4">
                    <p class="text-sm text-gray-600">Total Contracts</p>
                    <p class="text-2xl font-bold text-[#287854]">{{ $contracts->total() }}</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600">PKWT (Fixed-Term)</p>
                    <p class="text-2xl font-bold text-blue-700">{{ \App\Models\Contract::where('template', 'fixed_term_pkwt')->count() }}</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600">PKWTT (Permanent)</p>
                    <p class="text-2xl font-bold text-purple-700">{{ \App\Models\Contract::where('template', 'permanent_pkwtt')->count() }}</p>
                </div>
            </div>

            @if ($contracts->hasPages())
                <div class="px-6 py-4 border-b">
                    {{ $contracts->links() }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contract No.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($contracts as $contract)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm font-semibold text-gray-900">{{ $contract->contract_number }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $contract->employee_title }} {{ $contract->employee_name }}</p>
                                        @if ($contract->employee_id_number)
                                            <p class="text-xs text-gray-500">ID: {{ $contract->employee_id_number }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $contract->position_title }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $contract->template === 'fixed_term_pkwt' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $contract->getTemplateLabel() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div>{{ $contract->start_date->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">to {{ $contract->end_date->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    IDR {{ number_format($contract->salary_total, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $contract->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.contracts.regenerate', $contract) }}"
                                            class="text-[#287854] hover:text-[#1f5f46] font-medium text-sm"
                                            title="Download PDF">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.contracts.destroy', $contract) }}" method="POST"
                                            onsubmit="return confirm('Delete this contract record? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($contracts->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $contracts->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-600 mb-1">No contracts yet</h3>
                <p class="text-gray-400 mb-6">Generate your first employment contract to get started.</p>
                <a href="{{ route('admin.contracts.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2.5 rounded-lg font-medium inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Generate New Contract
                </a>
            </div>
        @endif
    </div>
@endsection
