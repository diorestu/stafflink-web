@extends('admin.layout')

@section('page-title', 'Roles and Responsibilities')
@section('title', 'Roles and Responsibilities')

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
                    <h3 class="text-lg font-semibold text-gray-900">Position Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Add positions under a selected division.</p>
                </div>
                <div class="p-6 border-b bg-gray-50/40">
                    <form action="{{ route('admin.roles-responsibilities.positions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                        @csrf
                        <div class="md:col-span-6">
                            <label for="position_division_id" class="block text-sm font-medium text-gray-700 mb-2">Division</label>
                            <select id="position_division_id" name="division_id" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-6">
                            <label for="position_sub_division_id" class="block text-sm font-medium text-gray-700 mb-2">Sub-Division</label>
                            <select id="position_sub_division_id" name="sub_division_id"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select sub-division</option>
                            </select>
                        </div>
                        <div class="md:col-span-12">
                            <label for="position_name" class="block text-sm font-medium text-gray-700 mb-2">Position Name</label>
                            <input id="position_name" type="text" name="name" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="e.g. Nanny">
                        </div>
                        <div class="md:col-span-12">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub-Division</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($positions as $position)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $position->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $position->division?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $position->subDivision?->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $position->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $position->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.roles-responsibilities.positions.destroy', $position) }}" method="POST"
                                            onsubmit="return confirm('Delete this position? Related responsibilities will also be deleted.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">No positions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="bg-white rounded-lg shadow border border-gray-100">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Responsibilities Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Add and manage responsibilities under each position.</p>
                </div>
                <div class="p-6 border-b bg-gray-50/40">
                    <form action="{{ route('admin.roles-responsibilities.responsibilities.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3 items-start">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="responsibility_position_id" class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                            <select id="responsibility_position_id" name="position_id" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}{{ $position->division?->name ? ' - '.$position->division->name : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="responsibility_title_id" class="block text-sm font-medium text-gray-700 mb-2">Judul (ID)</label>
                            <input id="responsibility_title_id" type="text" name="title_id" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="Contoh: Interaksi dengan Klien">
                        </div>
                        <div>
                            <label for="responsibility_title_en" class="block text-sm font-medium text-gray-700 mb-2">Title (EN)</label>
                            <input id="responsibility_title_en" type="text" name="title_en" required
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="Example: Client Engagement">
                        </div>
                        <div>
                            <label for="responsibility_description_id" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (ID)</label>
                            <textarea id="responsibility_description_id" name="description_id" rows="4"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="Tulis deskripsi tanggung jawab dalam Bahasa Indonesia"></textarea>
                        </div>
                        <div>
                            <label for="responsibility_description_en" class="block text-sm font-medium text-gray-700 mb-2">Description (EN)</label>
                            <textarea id="responsibility_description_en" name="description_en" rows="4"
                                class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="Write responsibility description in English"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-4 py-2 rounded-lg font-medium">
                                Add Responsibility
                            </button>
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#e6f1ec]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul / Title</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($responsibilities as $responsibility)
                                <tr class="hover:bg-gray-50 align-top">
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <p class="font-semibold text-gray-900">{{ $responsibility->position?->name ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">{{ $responsibility->position?->division?->name ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <p class="font-semibold text-gray-900">ID: {{ $responsibility->title_id }}</p>
                                        <p class="text-gray-600">{{ $responsibility->description_id ?: '-' }}</p>
                                        <p class="mt-2 font-semibold text-gray-900">EN: {{ $responsibility->title_en }}</p>
                                        <p class="text-gray-600">{{ $responsibility->description_en ?: '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.roles-responsibilities.responsibilities.destroy', $responsibility) }}" method="POST"
                                            onsubmit="return confirm('Delete this responsibility?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-sm text-gray-500">No responsibilities yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <script>
            (() => {
                const divisionSelect = document.getElementById('position_division_id');
                const subDivisionSelect = document.getElementById('position_sub_division_id');
                const subDivisionsByDivision = @json($subDivisionsByDivision ?? []);

                if (!divisionSelect || !subDivisionSelect) {
                    return;
                }

                const renderSubDivisions = () => {
                    const selectedDivisionId = String(divisionSelect.value || '');
                    const subDivisions = subDivisionsByDivision[selectedDivisionId] || [];

                    subDivisionSelect.innerHTML = '<option value="">Select sub-division</option>';
                    subDivisions.forEach((subDivision) => {
                        const option = document.createElement('option');
                        option.value = String(subDivision.id);
                        option.textContent = subDivision.name;
                        subDivisionSelect.appendChild(option);
                    });
                };

                divisionSelect.addEventListener('change', renderSubDivisions);
                renderSubDivisions();
            })();
        </script>
    </div>
@endsection
