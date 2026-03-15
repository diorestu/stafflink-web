@extends('admin.layout')

@section('page-title', 'Divisions')
@section('title', 'Divisions')

@section('content')
    <div class="space-y-6">
        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="bg-white rounded-lg shadow border border-gray-100">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Division Data</h3>
                <p class="text-sm text-gray-500 mt-1">Add and manage divisions used in contract generation.</p>
            </div>
            <div class="p-6 border-b bg-gray-50/40">
                <form action="{{ route('admin.divisions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                    @csrf
                    <div class="md:col-span-2">
                        <label for="division_name" class="block text-sm font-medium text-gray-700 mb-2">Division Name</label>
                        <input id="division_name" type="text" name="name" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="e.g. Human Resources">
                    </div>
                    <div>
                        <label for="division_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="division_active" name="is_active"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <button type="submit" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium">
                            Add Division
                        </button>
                    </div>
                </form>
            </div>
            <div class="p-6 border-b bg-white">
                <form action="{{ route('admin.divisions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                    <input type="hidden" name="sub_divisions_page" value="{{ request('sub_divisions_page') }}">
                    <input type="hidden" name="sub_divisions_search" value="{{ $subDivisionsSearch ?? '' }}">
                    <div class="md:col-span-10">
                        <label for="divisions_search" class="block text-sm font-medium text-gray-700 mb-2">Search Divisions</label>
                        <input id="divisions_search" type="search" name="divisions_search" value="{{ $divisionsSearch ?? '' }}"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="Search by division name">
                    </div>
                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit" class="w-full bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium">Search</button>
                        <a href="{{ route('admin.divisions.index', ['sub_divisions_page' => request('sub_divisions_page'), 'sub_divisions_search' => $subDivisionsSearch ?? '']) }}"
                            class="w-full text-center border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg font-medium">Reset</a>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Positions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub-divisions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($divisions as $division)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $division->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $division->positions_count }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $division->sub_divisions_count }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $division->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $division->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.divisions.destroy', $division) }}" method="POST"
                                        onsubmit="return confirm('Delete this division? It must not have any positions.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No divisions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t bg-white">
                {{ $divisions->appends(['sub_divisions_page' => request('sub_divisions_page'), 'divisions_search' => $divisionsSearch ?? '', 'sub_divisions_search' => $subDivisionsSearch ?? ''])->links() }}
            </div>
        </section>

        <section class="bg-white rounded-lg shadow border border-gray-100">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Sub-Division Data</h3>
                <p class="text-sm text-gray-500 mt-1">Add and manage sub-divisions under each division.</p>
            </div>
            <div class="p-6 border-b bg-gray-50/40">
                <form action="{{ route('admin.divisions.sub-divisions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                    @csrf
                    <div>
                        <label for="sub_division_division_id" class="block text-sm font-medium text-gray-700 mb-2">Division</label>
                        <select id="sub_division_division_id" name="division_id" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="">Select division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sub_division_name" class="block text-sm font-medium text-gray-700 mb-2">Sub-Division Name</label>
                        <input id="sub_division_name" type="text" name="name" required
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="e.g. Finance Operations">
                    </div>
                    <div>
                        <label for="sub_division_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="sub_division_active" name="is_active"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <button type="submit" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium">
                            Add Sub-Division
                        </button>
                    </div>
                </form>
            </div>
            <div class="p-6 border-b bg-white">
                <form action="{{ route('admin.divisions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                    <input type="hidden" name="divisions_page" value="{{ request('divisions_page') }}">
                    <input type="hidden" name="divisions_search" value="{{ $divisionsSearch ?? '' }}">
                    <div class="md:col-span-10">
                        <label for="sub_divisions_search" class="block text-sm font-medium text-gray-700 mb-2">Search Sub-Divisions</label>
                        <input id="sub_divisions_search" type="search" name="sub_divisions_search" value="{{ $subDivisionsSearch ?? '' }}"
                            class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="Search by sub-division or division name">
                    </div>
                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit" class="w-full bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium">Search</button>
                        <a href="{{ route('admin.divisions.index', ['divisions_page' => request('divisions_page'), 'divisions_search' => $divisionsSearch ?? '']) }}"
                            class="w-full text-center border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg font-medium">Reset</a>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#e6f1ec]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub-Division</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($subDivisions as $subDivision)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $subDivision->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $subDivision->division?->name ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $subDivision->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $subDivision->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.divisions.sub-divisions.destroy', $subDivision) }}" method="POST"
                                        onsubmit="return confirm('Delete this sub-division?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No sub-divisions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t bg-white">
                {{ $subDivisions->appends(['divisions_page' => request('divisions_page'), 'divisions_search' => $divisionsSearch ?? '', 'sub_divisions_search' => $subDivisionsSearch ?? ''])->links() }}
            </div>
        </section>
    </div>
@endsection
