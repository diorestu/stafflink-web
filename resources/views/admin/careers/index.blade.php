@extends('admin.layout')

@section('page-title', 'Services')

@section('content')
    @php
        $search = $search ?? '';
        $sortBy = $sortBy ?? 'sort_order';
        $sortDir = $sortDir ?? 'asc';
        $sortUrl = function (string $column) use ($sortBy, $sortDir) {
            $nextDir = ($sortBy === $column && $sortDir === 'asc') ? 'desc' : 'asc';
            return request()->fullUrlWithQuery(['sort_by' => $column, 'sort_dir' => $nextDir, 'page' => 1]);
        };
        $sortIcon = function (string $column) use ($sortBy, $sortDir) {
            if ($sortBy !== $column) {
                return '↕';
            }
            return $sortDir === 'asc' ? '↑' : '↓';
        };
    @endphp
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Services</h3>
            <a href="{{ route('admin.careers.create') }}"
                class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Service
            </a>
        </div>
        <div class="px-6 py-4 border-b bg-gray-50/60">
            <form method="GET" action="{{ route('admin.careers.index') }}" class="flex flex-wrap items-center gap-2">
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Search title, category, or description"
                    class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-[#1f5f46] focus:outline-none">
                <input type="hidden" name="sort_by" value="{{ $sortBy }}">
                <input type="hidden" name="sort_dir" value="{{ $sortDir }}">
                <button type="submit"
                    class="rounded-md bg-[#1f5f46] px-4 py-2 text-sm font-semibold text-white hover:bg-[#287854]">
                    Search
                </button>
                <a href="{{ route('admin.careers.index') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Reset
                </a>
            </form>
        </div>

        @if ($careers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ $sortUrl('title') }}" class="inline-flex items-center gap-1 hover:text-[#1f5f46]">
                                    Title <span>{{ $sortIcon('title') }}</span>
                                </a>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ $sortUrl('sort_order') }}" class="inline-flex items-center gap-1 hover:text-[#1f5f46]">
                                    Urutan <span>{{ $sortIcon('sort_order') }}</span>
                                </a>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ $sortUrl('created_at') }}" class="inline-flex items-center gap-1 hover:text-[#1f5f46]">
                                    Dibuat <span>{{ $sortIcon('created_at') }}</span>
                                </a>
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($careers as $career)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $career->title }}</p>
                                    <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit(strip_tags($career->description), 80) }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $career->category?->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $career->sort_order ?? 0 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $career->created_at?->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                        <a href="{{ route('admin.careers.edit', $career) }}"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1] hover:text-[#1f5f46]" title="Edit">
                                            <iconify-icon icon="mdi:pencil-outline" width="18" height="18"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Delete this career?');">
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
            @if ($careers->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $careers->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No services yet</h3>
                <p class="text-gray-500 mb-4">Create services that will appear in the category popup.</p>
                <a href="{{ route('admin.careers.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    Add Service
                </a>
            </div>
        @endif
    </div>
@endsection
