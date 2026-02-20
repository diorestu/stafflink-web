@extends('admin.layout')

@section('page-title', 'FAQ Management')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">All FAQs</h3>
            <a href="{{ route('admin.faqs.create') }}"
                class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add FAQ
            </a>
        </div>

        @if ($faqs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($faqs as $faq)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $faq->question }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($faq->answer), 120) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $faq->sort_order }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="inline-flex items-center gap-1">
                                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                                            class="inline-flex items-center justify-center rounded-md p-1.5 text-[#287854] hover:bg-[#ecf6f1] hover:text-[#1f5f46]" title="Edit">
                                            <iconify-icon icon="mdi:pencil-outline" width="18" height="18"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Delete this FAQ?');">
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

            @if ($faqs->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $faqs->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No FAQs yet</h3>
                <p class="text-gray-500 mb-4">Create your first FAQ to show on the landing page.</p>
                <a href="{{ route('admin.faqs.create') }}"
                    class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    Add FAQ
                </a>
            </div>
        @endif
    </div>
@endsection
