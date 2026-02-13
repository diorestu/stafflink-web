@extends('admin.layout')

@section('page-title', 'Pages')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All Pages</h3>
            <a href="{{ route('admin.pages.create') }}" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg text-sm font-medium">
                Add New Page
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#e6f1ec]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pages as $page)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $page->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">/p/{{ $page->slug }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $page->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($page->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $page->updated_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                <div class="inline-flex items-center gap-1">
                                <a href="{{ route('admin.pages.builder', $page) }}"
                                    class="inline-flex items-center justify-center rounded-md p-1.5 text-[#1f5f46] hover:bg-[#ecf6f1]"
                                    title="Builder">
                                    <iconify-icon icon="mdi:tools" width="18" height="18"></iconify-icon>
                                </a>
                                <a href="{{ route('admin.pages.edit', $page) }}"
                                    class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1]"
                                    title="Edit">
                                    <iconify-icon icon="mdi:pencil-outline" width="18" height="18"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-md p-1.5 text-red-600 hover:bg-red-50"
                                        title="Delete">
                                        <iconify-icon icon="mdi:trash-can-outline" width="18" height="18"></iconify-icon>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No pages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pages->hasPages())
            <div class="p-6 border-t">{{ $pages->links() }}</div>
        @endif
    </div>
@endsection
