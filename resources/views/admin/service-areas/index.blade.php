@extends('admin.layout')

@section('page-title', 'Service Areas')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold">Manage Service Areas</h3>
            <p class="mt-1 text-sm text-gray-500">Area untuk halaman service per location disimpan dan dikelola dari database.</p>
        </div>
        <a href="{{ route('admin.service-areas.create') }}" class="rounded-lg bg-[#287854] px-4 py-2 text-sm font-medium text-white hover:bg-[#1f5f46]">
            Add Area
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Label</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Slug</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Order</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($areas as $area)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $area->label }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $area->slug }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ ucfirst($area->type) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $area->sort_order }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="rounded-full px-2 py-1 text-xs font-semibold {{ $area->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $area->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right text-sm">
                                <a href="{{ route('admin.service-areas.edit', $area) }}" class="font-medium text-[#287854] hover:text-[#1f5f46]">Edit</a>
                                <form action="{{ route('admin.service-areas.destroy', $area) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this area?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">No areas found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($areas->hasPages())
        <div class="mt-4">{{ $areas->links() }}</div>
    @endif
@endsection
