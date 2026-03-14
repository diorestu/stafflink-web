@extends('admin.layout')

@section('page-title', 'Division & Position')

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

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <section class="bg-white rounded-lg shadow border border-gray-100">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Division Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Add and manage divisions used in contract generation.</p>
                </div>
                <div class="p-6 border-b bg-gray-50/40">
                    <form action="{{ route('admin.division-position.divisions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
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
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#e6f1ec]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Positions</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($divisions as $division)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $division->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $division->positions_count }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $division->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $division->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.division-position.divisions.destroy', $division) }}" method="POST"
                                            onsubmit="return confirm('Delete this division? It must not have any positions.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No divisions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="bg-white rounded-lg shadow border border-gray-100">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Position Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Add positions under a selected division.</p>
                </div>
                <div class="p-6 border-b bg-gray-50/40">
                    <form action="{{ route('admin.division-position.positions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                        @csrf
                        <div>
                            <label for="position_division_id" class="block text-sm font-medium text-gray-700 mb-2">Division</label>
                            <select id="position_division_id" name="division_id" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="position_name" class="block text-sm font-medium text-gray-700 mb-2">Position Name</label>
                            <input id="position_name" type="text" name="name" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="e.g. HR and Finance Manager">
                        </div>
                        <div>
                            <label for="position_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="position_active" name="is_active"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <button type="submit" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium">
                                Add Position
                            </button>
                        </div>
                    </form>
                </div>
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
                            @forelse ($positions as $position)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $position->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $position->division?->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $position->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $position->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.division-position.positions.destroy', $position) }}" method="POST"
                                            onsubmit="return confirm('Delete this position?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No positions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
