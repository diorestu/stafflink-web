@extends('admin.layout')

@section('page-title', 'Role Page Copy')

@section('content')
    <div class="rounded-lg bg-white shadow">
        <div class="border-b p-6">
            <h3 class="text-lg font-semibold">Role Page Copy</h3>
            <p class="mt-1 text-sm text-gray-500">Kelola hero, CTA, dan section copywriting untuk setiap halaman role tanpa edit Blade lagi.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-600">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-600">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($roles as $role)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $role['title'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $role['slug'] }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $role['has_copy'] ? 'bg-[#ecf7f1] text-[#1f5f46]' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $role['has_copy'] ? 'Custom copy active' : 'Default template' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.role-page-wording.edit', $role['slug']) }}"
                                    class="inline-flex rounded-lg border border-[#1f5f46] px-4 py-2 font-semibold text-[#1f5f46] hover:bg-[#ecf7f1]">
                                    Edit Copy
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No roles found yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
