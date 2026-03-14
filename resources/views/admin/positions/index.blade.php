@extends('admin.layout')

@section('page-title', 'Positions')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Positions</h3>
            <a href="{{ route('admin.positions.create') }}"
                class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Position
            </a>
        </div>

        @if ($positions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($positions as $position)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $position->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $position->division?->name ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $position->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $position->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                        <a href="{{ route('admin.positions.edit', $position) }}"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1] hover:text-[#1f5f46]" title="Edit">
                                            <iconify-icon icon="mdi:pencil-outline" width="18" height="18"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.positions.destroy', $position) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Delete this position?');">
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

            @if ($positions->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $positions->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No positions yet</h3>
                <p class="text-gray-500 mb-4">Create positions to enable division-based position selection in contracts.</p>
                <a href="{{ route('admin.positions.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    Add Position
                </a>
            </div>
        @endif
    </div>
@endsection
