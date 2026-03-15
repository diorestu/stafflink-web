@extends('admin.layout')

@section('page-title', 'Create Contract')
@section('title', 'Create Contract')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        .contract-compact label { margin-bottom: 0.35rem !important; font-size: 0.8rem; }
        .contract-compact input,
        .contract-compact select,
        .contract-compact textarea { padding: 0.5rem 0.75rem !important; font-size: 0.85rem; }
        .section-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            background: #ffffff;
            padding: 1rem;
        }
        .mini-editor {
            min-height: 120px;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background: #ffffff;
            overflow-wrap: anywhere;
        }
        .mini-editor .ql-toolbar.ql-snow {
            border: 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .mini-editor .ql-container.ql-snow {
            border: 0;
            font-size: 0.85rem;
            min-height: 120px;
        }
        .mini-editor .ql-editor {
            min-height: 120px;
        }
    </style>
    <div class="max-w-7xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-5 py-4 border-b bg-gray-50/60 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-900">Create Employment Contract from Template</h3>
                <p class="text-sm text-gray-500 mt-1">Template mengikuti dokumen kontrak kerja, Isi data pelengkap, lalu unduh PDF.</p>
            </div>

            <form action="{{ route('admin.contracts.generate') }}" method="POST" class="contract-compact p-5">
                @csrf
                <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">
                    <div class="xl:col-span-8 space-y-5">
                <div class="section-card">
                    <label for="contract_number" class="block text-sm font-medium text-gray-700 mb-2">Contract Number</label>
                    <input type="text" id="contract_number" name="contract_number" value="{{ old('contract_number') }}"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                        placeholder="Contoh: SL-EMP-2026-001">
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="template" class="block text-sm font-medium text-gray-700 mb-2">Template *</label>
                        <select id="template" name="template" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            @foreach ($templates as $value => $label)
                                <option value="{{ $value }}" {{ old('template', 'fixed_term_pkwt') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="employment_basis" class="block text-sm font-medium text-gray-700 mb-2">Employee Type / Tipe Karyawan *</label>
                        <select id="employment_basis" name="employment_basis" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            @foreach (['Full Time', 'Part Time'] as $employeeType)
                                <option value="{{ $employeeType }}" {{ old('employment_basis', 'Full Time') === $employeeType ? 'selected' : '' }}>{{ $employeeType }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="md:col-span-3">
                        <p class="text-sm font-semibold text-gray-800">1. Position Category</p>
                    </div>
                    <div>
                        <label for="division" class="block text-sm font-medium text-gray-700 mb-2">Division *</label>
                        <select id="division" name="division_id" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="">Select division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" {{ (string) old('division_id') === (string) $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sub_division_id" class="block text-sm font-medium text-gray-700 mb-2">Sub-Division</label>
                        <select id="sub_division_id" name="sub_division_id"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="">Select sub-division</option>
                        </select>
                    </div>
                    <div>
                        <label for="position_id" class="block text-sm font-medium text-gray-700 mb-2">Position Title *</label>
                        <select id="position_id" name="position_id" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="">Select position</option>
                        </select>
                    </div>
                </div>

                <div class="section-card">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role Highlights (Short Bullet List)</label>
                    <div id="role_brief_points_editor" class="mini-editor text-sm"></div>
                    <input type="hidden" id="role_brief_points" name="role_brief_points" value="{{ old('role_brief_points') }}">
                    <p class="mt-2 text-xs text-gray-500">Bagian ini memakai Quill editor dan akan disimpan sebagai HTML untuk ditampilkan di PDF.</p>
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-12 gap-3">
                    <div class="md:col-span-12">
                        <p class="text-sm font-semibold text-gray-800">2. Staff Details</p>
                    </div>
                    <div class="md:col-span-2">
                        <label for="employee_title" class="block text-sm font-medium text-gray-700 mb-2">Employee Title *</label>
                        <select id="employee_title" name="employee_title" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            @foreach (['Mr.', 'Mrs.', 'Miss'] as $title)
                                <option value="{{ $title }}" {{ old('employee_title', 'Miss') === $title ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-5">
                        <label for="employee_name" class="block text-sm font-medium text-gray-700 mb-2">Employee Name *</label>
                        <input type="text" id="employee_name" name="employee_name" required value="{{ old('employee_name') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div class="md:col-span-5">
                        <label for="employee_id_number" class="block text-sm font-medium text-gray-700 mb-2">ID Number (KTP/SIM/Passport)</label>
                        <input type="text" id="employee_id_number" name="employee_id_number" value="{{ old('employee_id_number') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div class="md:col-span-4">
                        <label for="employee_birth_info" class="block text-sm font-medium text-gray-700 mb-2">Place & Date of Birth</label>
                        <input type="text" id="employee_birth_info" name="employee_birth_info" value="{{ old('employee_birth_info') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div class="md:col-span-4">
                        <label for="employee_gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select id="employee_gender" name="employee_gender"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="">Select gender</option>
                            @foreach (['Male', 'Female', 'Other'] as $gender)
                                <option value="{{ $gender }}" {{ old('employee_gender') === $gender ? 'selected' : '' }}>{{ $gender }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-4">
                        <label for="employee_religion" class="block text-sm font-medium text-gray-700 mb-2">Religion</label>
                        <select id="employee_religion" name="employee_religion"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                            <option value="">Select religion</option>
                            @foreach (['Islam', 'Christian', 'Catholic', 'Hindu', 'Buddhist', 'Confucian', 'Other'] as $religion)
                                <option value="{{ $religion }}" {{ old('employee_religion') === $religion ? 'selected' : '' }}>{{ $religion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-4">
                        <label for="employee_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="text" id="employee_phone" name="employee_phone" value="{{ old('employee_phone') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div class="md:col-span-8">
                        <label for="employee_address" class="block text-sm font-medium text-gray-700 mb-2">Employee Address</label>
                        <input type="text" id="employee_address" name="employee_address" value="{{ old('employee_address') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="md:col-span-3">
                        <p class="text-sm font-semibold text-gray-800">3. Contract Details</p>
                    </div>
                    <div>
                        <label for="agreement_date" class="block text-sm font-medium text-gray-700 mb-2">Agreement Date *</label>
                        <input type="date" id="agreement_date" name="agreement_date" required value="{{ old('agreement_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                        <input type="date" id="start_date" name="start_date" required value="{{ old('start_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                        <input type="date" id="end_date" name="end_date" required value="{{ old('end_date') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                        <input type="text" id="company_name" name="company_name" required value="{{ old('company_name', 'PT Staff Link Solutions') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="company_address" class="block text-sm font-medium text-gray-700 mb-2">Company Registered Address *</label>
                        <input type="text" id="company_address" name="company_address" required value="{{ old('company_address', 'Jl. Drupadi 1, No. 20, Seminyak') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label for="probation_months" class="block text-sm font-medium text-gray-700 mb-2">Probation (Months) *</label>
                        <input type="number" id="probation_months" name="probation_months" min="0" max="12" required value="{{ old('probation_months', 3) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="notice_period_days" class="block text-sm font-medium text-gray-700 mb-2">Notice Period (Days) *</label>
                        <input type="number" id="notice_period_days" name="notice_period_days" min="1" max="180" required value="{{ old('notice_period_days', 30) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                </div>

                <div class="section-card grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div>
                        <label for="working_hours_per_day" class="block text-sm font-medium text-gray-700 mb-2">Working Hours / Day *</label>
                        <input type="text" id="working_hours_per_day" name="working_hours_per_day" required value="{{ old('working_hours_per_day', '7 hours 30 minutes') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="working_days_per_week" class="block text-sm font-medium text-gray-700 mb-2">Working Days / Week *</label>
                        <input type="number" id="working_days_per_week" name="working_days_per_week" min="1" max="7" required value="{{ old('working_days_per_week', 6) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="work_start_time" class="block text-sm font-medium text-gray-700 mb-2">Work Start Time *</label>
                        <input type="text" id="work_start_time" name="work_start_time" required value="{{ old('work_start_time', '08.30 WITA') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                    <div>
                        <label for="work_end_time" class="block text-sm font-medium text-gray-700 mb-2">Work End Time *</label>
                        <input type="text" id="work_end_time" name="work_end_time" required value="{{ old('work_end_time', '17.00 WITA') }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                    </div>
                </div>

                <div class="section-card space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">4. Salary Details</p>
                    </div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 md:items-center">
                            <label for="pay_day" class="block text-sm font-medium text-gray-700 md:col-span-4">Salary Pay Day *</label>
                            <input type="number" id="pay_day" name="pay_day" min="1" max="31" required value="{{ old('pay_day', 7) }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent md:col-span-8">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 md:items-center">
                            <label for="salary_total" class="block text-sm font-medium text-gray-700 md:col-span-4">Total Monthly Salary (IDR) *</label>
                            <input type="text" id="salary_total" name="salary_total" value="{{ old('salary_total') }}"
                                data-currency="idr"
                                readonly
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-[#287854] focus:border-transparent md:col-span-8"
                                placeholder="5.500.000">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 md:items-center">
                            <label for="salary_base" class="block text-sm font-medium text-gray-700 md:col-span-4">Base Salary (IDR)</label>
                            <input type="text" id="salary_base" name="salary_base" value="{{ old('salary_base') }}"
                                data-currency="idr"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent md:col-span-8"
                                placeholder="3.800.000">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 md:items-center">
                            <label for="salary_allowance" class="block text-sm font-medium text-gray-700 md:col-span-4">Overtime and Holiday Allowance (IDR)</label>
                            <input type="text" id="salary_allowance" name="salary_allowance" value="{{ old('salary_allowance') }}"
                                data-currency="idr"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent md:col-span-8"
                                placeholder="400.000">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 md:items-center">
                            <label for="food_allowance" class="block text-sm font-medium text-gray-700 md:col-span-4">Food Allowance (IDR)</label>
                            <input type="text" id="food_allowance" name="food_allowance" value="{{ old('food_allowance') }}"
                                data-currency="idr"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent md:col-span-8"
                                placeholder="200.000">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 md:items-center">
                            <label for="transport_allowance" class="block text-sm font-medium text-gray-700 md:col-span-4">Transport Allowance (IDR)</label>
                            <input type="text" id="transport_allowance" name="transport_allowance" value="{{ old('transport_allowance') }}"
                                data-currency="idr"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent md:col-span-8"
                                placeholder="300.000">
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 p-4 space-y-4">
                        <p class="text-sm font-semibold text-gray-800">BPJS Coverage</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label for="bpjs_health_status" class="block text-sm font-medium text-gray-700 mb-2">BPJS Kesehatan</label>
                                <select id="bpjs_health_status" name="bpjs_health_status"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                    <option value="yes" {{ old('bpjs_health_status', 'yes') === 'yes' ? 'selected' : '' }}>Menerima</option>
                                    <option value="no" {{ old('bpjs_health_status') === 'no' ? 'selected' : '' }}>Tidak Menerima</option>
                                </select>
                            </div>
                            <div>
                                <label for="bpjs_employment_status" class="block text-sm font-medium text-gray-700 mb-2">BPJS Ketenagakerjaan</label>
                                <select id="bpjs_employment_status" name="bpjs_employment_status"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                    <option value="yes" {{ old('bpjs_employment_status', 'yes') === 'yes' ? 'selected' : '' }}>Menerima</option>
                                    <option value="no" {{ old('bpjs_employment_status') === 'no' ? 'selected' : '' }}>Tidak Menerima</option>
                                </select>
                            </div>
                        </div>

                        <div id="bpjs-employment-components" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="rounded-lg border border-gray-200 px-3 py-2.5 flex items-start gap-2">
                                <input type="checkbox" name="bpjs_jht_enabled" value="1" class="mt-1"
                                    {{ old('bpjs_jht_enabled', '1') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">JHT - total 5,7% (3,7% pemberi kerja, 2% pekerja)</span>
                            </label>
                            <label class="rounded-lg border border-gray-200 px-3 py-2.5 flex items-start gap-2">
                                <input type="checkbox" name="bpjs_jkk_enabled" value="1" class="mt-1"
                                    {{ old('bpjs_jkk_enabled', '1') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">JKK - 0,24% sampai 1,74% sesuai tingkat risiko (ditanggung pemberi kerja)</span>
                            </label>
                            <label class="rounded-lg border border-gray-200 px-3 py-2.5 flex items-start gap-2">
                                <input type="checkbox" name="bpjs_jkm_enabled" value="1" class="mt-1"
                                    {{ old('bpjs_jkm_enabled', '1') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">JKM - 0,3% dari upah (ditanggung pemberi kerja)</span>
                            </label>
                            <label class="rounded-lg border border-gray-200 px-3 py-2.5 flex items-start gap-2">
                                <input type="checkbox" name="bpjs_jp_enabled" value="1" class="mt-1"
                                    {{ old('bpjs_jp_enabled', '1') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">JP - total 3% (2% pemberi kerja, 1% pekerja)</span>
                            </label>
                            <label class="rounded-lg border border-gray-200 px-3 py-2.5 flex items-start gap-2 md:col-span-2">
                                <input type="checkbox" name="bpjs_jkp_enabled" value="1" class="mt-1"
                                    {{ old('bpjs_jkp_enabled', '1') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">JKP - 0,46% (0,22% subsidi pemerintah, 0,14% rekomposisi JKK, 0,10% rekomposisi JKM)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="section-card">
                    <div class="flex items-center justify-between gap-3 mb-2">
                        <label class="block text-sm font-medium text-gray-700">Responsibilities</label>
                        @if ($canCreateResponsibilities ?? false)
                            <button type="button" id="open-responsibility-modal"
                                class="inline-flex items-center justify-center rounded-full bg-[#287854] text-white w-8 h-8 text-lg leading-none hover:bg-[#1f5f46]"
                                aria-label="Add responsibility">+</button>
                        @endif
                    </div>
                    <div class="mb-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label for="responsibility-role-select" class="block text-sm font-medium text-gray-700 mb-2">Select responsibilities for the required role</label>
                            <select id="responsibility-role-select"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select role name</option>
                                @foreach ($divisions as $division)
                                    @foreach ($division->positions as $position)
                                        <option value="{{ $position->id }}" {{ (string) old('position_id') === (string) $position->id ? 'selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">This follows the selected Position Title above.</p>
                        </div>
                        <div>
                            <label for="responsibility-search" class="block text-sm font-medium text-gray-700 mb-2">Search Responsibilities</label>
                            <input type="search" id="responsibility-search"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                placeholder="Search responsibilities by title or description">
                        </div>
                    </div>
                    <input type="hidden" id="responsibilities" name="responsibilities" value="{{ old('responsibilities') }}">
                    <div class="mb-3 space-y-2">
                        <p id="responsibility-search-status" class="text-xs text-gray-500">Showing all responsibilities.</p>
                        @if ($canEditResponsibilities ?? false)
                            <div class="flex items-center justify-end">
                                <button type="button" id="bulk-delete-responsibilities"
                                    class="inline-flex items-center rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-100">
                                    Delete Checked
                                </button>
                            </div>
                        @elseif ($canCreateResponsibilities ?? false)
                            <p class="text-xs text-amber-700">Admin can add new responsibility data, but only super admin can select, edit, or delete existing responsibility data on this page.</p>
                        @else
                            <p class="text-xs text-amber-700">Only super admin can manage responsibility master data on this page.</p>
                        @endif
                    </div>
                    <div id="responsibility-list" class="space-y-3 rounded-lg border border-gray-200 bg-gray-50 p-4"></div>
                    <p class="mt-2 text-xs text-gray-500">
                        @if ($canSelectResponsibilities ?? false)
                            Tick responsibilities to include in Ayat 2 (Indonesia) and Paragraph 2 (English).
                        @else
                            All responsibilities for the selected role will be included automatically in Ayat 2 (Indonesia) and Paragraph 2 (English).
                        @endif
                        Each responsibility stores 4 fields: Judul + Deskripsi (ID), Title + Description (EN).
                    </p>
                </div>

                @if ($canCreateResponsibilities ?? false)
                    <div id="responsibility-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
                        <div class="w-full max-w-lg rounded-xl bg-white shadow-xl border border-gray-200">
                            <div class="px-6 py-4 border-b">
                                <h4 class="text-lg font-semibold text-gray-900">Create New Responsibility</h4>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="new_responsibility_title_id" class="block text-sm font-medium text-gray-700 mb-2">Judul (ID)</label>
                                        <input type="text" id="new_responsibility_title_id"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                            placeholder="Contoh: Interaksi dengan Klien">
                                    </div>
                                    <div>
                                        <label for="new_responsibility_title_en" class="block text-sm font-medium text-gray-700 mb-2">Title (EN)</label>
                                        <input type="text" id="new_responsibility_title_en"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                            placeholder="Example: Client Engagement">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="new_responsibility_description_id" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (ID)</label>
                                        <textarea id="new_responsibility_description_id" rows="4"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                            placeholder="Tulis deskripsi tanggung jawab dalam Bahasa Indonesia"></textarea>
                                    </div>
                                    <div>
                                        <label for="new_responsibility_description_en" class="block text-sm font-medium text-gray-700 mb-2">Description (EN)</label>
                                        <textarea id="new_responsibility_description_en" rows="4"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                                            placeholder="Write responsibility description in English"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 border-t flex items-center justify-end gap-3">
                                <button type="button" id="cancel-responsibility-modal" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</button>
                                <button type="button" id="save-responsibility-modal" class="px-4 py-2 rounded-lg bg-[#287854] text-white hover:bg-[#1f5f46]">Add Responsibility</button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="section-card">
                    <label for="additional_terms" class="block text-sm font-medium text-gray-700 mb-2">Additional Terms</label>
                    <textarea id="additional_terms" name="additional_terms" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">{{ old('additional_terms') }}</textarea>
                </div>

                    </div>

                    <div class="xl:col-span-4">
                        <div class="xl:sticky xl:top-6 space-y-5">
                            <div class="section-card grid grid-cols-1 gap-3">
                                <div>
                                    <label for="language_law" class="block text-sm font-medium text-gray-700 mb-2">Language Law</label>
                                    @php
                                        $languageLawOptions = [
                                            ['en' => 'English text shall prevail', 'id' => 'teks Bahasa Inggris yang berlaku'],
                                            ['en' => 'Indonesian text shall prevail', 'id' => 'teks Bahasa Indonesia yang berlaku'],
                                            ['en' => 'Both language versions shall be equally valid', 'id' => 'kedua versi bahasa berlaku sama'],
                                        ];
                                        $selectedLanguageLaw = old('language_law', 'English text shall prevail');
                                    @endphp
                                    <select id="language_law" name="language_law"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                        @foreach ($languageLawOptions as $option)
                                            <option value="{{ $option['en'] }}" data-language-law-id="{{ $option['id'] }}" {{ $selectedLanguageLaw === $option['en'] ? 'selected' : '' }}>{{ $option['en'] }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="language_law_id" name="language_law_id" value="{{ old('language_law_id', 'teks Bahasa Inggris yang berlaku') }}">
                                </div>
                                <div>
                                    <label for="governing_law" class="block text-sm font-medium text-gray-700 mb-2">Governing Law</label>
                                    <input type="text" id="governing_law" name="governing_law" value="{{ old('governing_law', 'Republic of Indonesia') }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                                </div>
                                <div>
                                    <label for="sign_employer_name" class="block text-sm font-medium text-gray-700 mb-2">Employer Signatory *</label>
                                    <input type="text" id="sign_employer_name" name="sign_employer_name" required value="{{ old('sign_employer_name') }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                                </div>
                                <div>
                                    <label for="sign_employee_name" class="block text-sm font-medium text-gray-700 mb-2">Employee Signatory *</label>
                                    <input type="text" id="sign_employee_name" name="sign_employee_name" required value="{{ old('sign_employee_name') }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="section-card">
                                <button type="submit" class="w-full bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2.5 rounded-lg font-medium">
                                    Submit Contract
                                </button>
                            </div>

                            <div class="section-card space-y-2">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-sm font-medium text-gray-800">Draft Autosave</p>
                                    <button type="button" id="clear-contract-draft" class="text-xs text-red-600 hover:text-red-700">Clear draft</button>
                                </div>
                                <p id="contract-draft-status" class="text-xs text-gray-500">Draft not saved yet.</p>
                                <p class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-xs text-amber-800">
                                    Warning: draft autosave runs every 5 minutes in this browser. Changes made after the last autosave may be lost if the laptop shuts down unexpectedly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        (() => {
            const canCreateResponsibilities = @json($canCreateResponsibilities ?? false);
            const canEditResponsibilities = @json($canEditResponsibilities ?? false);
            const canSelectResponsibilities = @json($canSelectResponsibilities ?? false);
            const listEl = document.getElementById('responsibility-list');
            const hiddenInput = document.getElementById('responsibilities');
            const responsibilityRoleSelect = document.getElementById('responsibility-role-select');
            const responsibilitySearchInput = document.getElementById('responsibility-search');
            const responsibilitySearchStatus = document.getElementById('responsibility-search-status');
            const bulkDeleteBtn = document.getElementById('bulk-delete-responsibilities');
            const modal = document.getElementById('responsibility-modal');
            const openModalBtn = document.getElementById('open-responsibility-modal');
            const cancelModalBtn = document.getElementById('cancel-responsibility-modal');
            const saveModalBtn = document.getElementById('save-responsibility-modal');
            const modalTitleEl = modal?.querySelector('h4');
            const newTitleIdInput = document.getElementById('new_responsibility_title_id');
            const newDescIdInput = document.getElementById('new_responsibility_description_id');
            const newTitleEnInput = document.getElementById('new_responsibility_title_en');
            const newDescEnInput = document.getElementById('new_responsibility_description_en');
            const form = document.querySelector('form[action="{{ route('admin.contracts.generate') }}"]');
            const draftStatusEl = document.getElementById('contract-draft-status');
            const clearDraftBtn = document.getElementById('clear-contract-draft');
            const templateSelect = document.getElementById('template');
            const endDateInput = document.getElementById('end_date');
            const languageLawSelect = document.getElementById('language_law');
            const languageLawIdInput = document.getElementById('language_law_id');
            const roleBriefEditor = document.getElementById('role_brief_points_editor');
            const roleBriefInput = document.getElementById('role_brief_points');
            const csrfToken = document.querySelector('input[name="_token"]')?.value || '';
            const divisionSelect = document.getElementById('division');
            const subDivisionSelect = document.getElementById('sub_division_id');
            const positionSelect = document.getElementById('position_id');
            const bpjsEmploymentSelect = document.getElementById('bpjs_employment_status');
            const bpjsComponentsWrap = document.getElementById('bpjs-employment-components');
            const salaryBaseInput = document.getElementById('salary_base');
            const salaryAllowanceInput = document.getElementById('salary_allowance');
            const foodAllowanceInput = document.getElementById('food_allowance');
            const transportAllowanceInput = document.getElementById('transport_allowance');
            const salaryTotalInput = document.getElementById('salary_total');
            const oldPositionId = @json(old('position_id'));
            const oldSubDivisionId = @json(old('sub_division_id'));
            let restoredDraftPositionId = null;
            let restoredDraftSubDivisionId = null;
            const positionsByDivision = @json(($divisions ?? [])->mapWithKeys(fn($d) => [$d->id => ($d->positions ?? [])->map(fn($p) => ['id' => $p->id, 'name' => $p->name])->values()]));
            const subDivisionsByDivision = @json($subDivisionsByDivision ?? []);
            const draftStorageKey = 'stafflink_contract_create_draft_v1';
            const autosaveIntervalMs = 5 * 60 * 1000;
            const quill = roleBriefEditor
                ? new Quill('#role_brief_points_editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            ['link', 'clean'],
                        ],
                    },
                })
                : null;

            const responsibilitiesByPosition = @json($responsibilitiesByPosition ?? []);
            const responsibilityDestroyUrlTemplate = "{{ route('admin.contracts.responsibilities.destroy', ['responsibility' => '__RESPONSIBILITY_ID__']) }}";
            const responsibilityUpdateUrlTemplate = "{{ route('admin.contracts.responsibilities.update', ['responsibility' => '__RESPONSIBILITY_ID__']) }}";
            const responsibilityBulkDestroyUrl = "{{ route('admin.contracts.responsibilities.bulk-destroy') }}";
            let responsibilities = [];
            const oldRaw = @json(old('responsibilities'));

            const checkedMap = new Map();
            let draftDirty = false;
            let responsibilitySearchTerm = '';
            let oldResponsibilitiesApplied = false;
            let editingResponsibilityId = null;

            const setDraftStatus = (savedAt) => {
                if (!draftStatusEl) {
                    return;
                }

                if (!savedAt) {
                    draftStatusEl.textContent = 'Draft not saved yet.';
                    return;
                }

                const savedDate = new Date(savedAt);
                draftStatusEl.textContent = Number.isNaN(savedDate.getTime())
                    ? 'Draft saved.'
                    : `Last saved ${savedDate.toLocaleString('en-GB')}`;
            };

            const markDraftDirty = () => {
                draftDirty = true;

                if (!draftStatusEl) {
                    return;
                }

                draftStatusEl.textContent = 'Unsaved changes detected. Next autosave runs within 5 minutes.';
            };

            const normalizeResponsibilityItem = (item) => {
                const normalized = {
                    id: item?.id ? Number(item.id) : null,
                    position_id: item?.position_id ? Number(item.position_id) : null,
                    title_id: String(item?.title_id || item?.title || '').trim(),
                    description_id: String(item?.description_id || item?.description || '').trim(),
                    title_en: String(item?.title_en || item?.title || '').trim(),
                    description_en: String(item?.description_en || item?.description || '').trim(),
                };

                if (!normalized.title_id) normalized.title_id = normalized.title_en;
                if (!normalized.title_en) normalized.title_en = normalized.title_id;

                return normalized;
            };

            const setResponsibilitiesForPosition = (positionId) => {
                const sourceItems = Array.isArray(responsibilitiesByPosition?.[String(positionId)])
                    ? responsibilitiesByPosition[String(positionId)]
                    : [];

                responsibilities = sourceItems
                    .map((item) => normalizeResponsibilityItem(item))
                    .filter((item) => item.title_id || item.title_en);

                checkedMap.clear();
                responsibilities.forEach((_, index) => checkedMap.set(index, true));
            };

            const removeResponsibilityById = (positionId, responsibilityId) => {
                const key = String(positionId || '');
                if (!Array.isArray(responsibilitiesByPosition[key])) {
                    return;
                }

                responsibilitiesByPosition[key] = responsibilitiesByPosition[key]
                    .filter((item) => Number(item?.id || 0) !== Number(responsibilityId));
            };

            const updateResponsibilityById = (positionId, updatedItem) => {
                const key = String(positionId || '');
                if (!Array.isArray(responsibilitiesByPosition[key])) {
                    return;
                }

                const targetId = Number(updatedItem?.id || 0);
                responsibilitiesByPosition[key] = responsibilitiesByPosition[key].map((item) => {
                    if (Number(item?.id || 0) !== targetId) {
                        return item;
                    }

                    return {
                        ...item,
                        ...updatedItem,
                    };
                });
            };

            const applyResponsibilitiesFromRaw = (raw) => {
                if (!raw) return false;

                try {
                    const parsed = JSON.parse(raw);
                    if (Array.isArray(parsed)) {
                        parsed.forEach((row) => {
                            if (!row || typeof row !== 'object') return;

                            const normalized = {
                                title_id: String(row.title_id || row.title || '').trim(),
                                description_id: String(row.description_id || row.description || '').trim(),
                                title_en: String(row.title_en || row.title || '').trim(),
                                description_en: String(row.description_en || row.description || '').trim(),
                            };

                            if (!normalized.title_id && !normalized.title_en) return;
                            if (!normalized.title_id) normalized.title_id = normalized.title_en;
                            if (!normalized.title_en) normalized.title_en = normalized.title_id;

                            const idx = responsibilities.findIndex((item) =>
                                String(item.title_id || '').toLowerCase() === normalized.title_id.toLowerCase() &&
                                String(item.title_en || '').toLowerCase() === normalized.title_en.toLowerCase()
                            );

                            if (idx === -1) {
                                responsibilities.push(normalized);
                                checkedMap.set(responsibilities.length - 1, true);
                            } else {
                                checkedMap.set(idx, true);
                            }
                        });

                        return true;
                    }
                } catch (_) {
                    // Fallback for legacy plain-text responsibilities format.
                }

                const lines = raw.split(/\r\n|\r|\n/).map((line) => line.trim()).filter(Boolean);
                lines.forEach((line) => {
                    const parts = line.split(':');
                    const title = (parts.shift() || '').trim();
                    const description = parts.join(':').trim();
                    if (!title) return;

                    const legacyItem = {
                        title_id: title,
                        description_id: description,
                        title_en: title,
                        description_en: description,
                    };

                    responsibilities.push(legacyItem);
                    checkedMap.set(responsibilities.length - 1, true);
                });

                return lines.length > 0;
            };

            const parseOldResponsibilities = () => {
                applyResponsibilitiesFromRaw(oldRaw);
            };

            const defaultAllChecked = () => {
                responsibilities.forEach((_, index) => checkedMap.set(index, true));
            };

            const syncHiddenInput = () => {
                const selected = responsibilities
                    .filter((_, index) => !canSelectResponsibilities || checkedMap.get(index))
                    .map((item) => ({
                        title_id: String(item.title_id || '').trim(),
                        description_id: String(item.description_id || '').trim(),
                        title_en: String(item.title_en || '').trim(),
                        description_en: String(item.description_en || '').trim(),
                    }));
                hiddenInput.value = JSON.stringify(selected);
            };

            const normalizeResponsibilitySearch = (value) => String(value || '').trim().toLowerCase();

            const matchesResponsibilitySearch = (item) => {
                if (!responsibilitySearchTerm) {
                    return true;
                }

                const haystack = [
                    item.title_id,
                    item.description_id,
                    item.title_en,
                    item.description_en,
                ].map((value) => normalizeResponsibilitySearch(value)).join(' ');

                return haystack.includes(responsibilitySearchTerm);
            };

            const updateResponsibilitySearchStatus = (visibleCount, totalCount) => {
                if (!responsibilitySearchStatus) {
                    return;
                }

                if (!responsibilitySearchTerm) {
                    responsibilitySearchStatus.textContent = `Showing all responsibilities (${totalCount}).`;
                    return;
                }

                responsibilitySearchStatus.textContent = `Showing ${visibleCount} of ${totalCount} responsibilities for "${responsibilitySearchTerm}".`;
            };

            const renderList = () => {
                listEl.innerHTML = '';
                const filteredResponsibilities = responsibilities
                    .map((item, index) => ({ item, index }))
                    .filter(({ item }) => matchesResponsibilitySearch(item));

                updateResponsibilitySearchStatus(filteredResponsibilities.length, responsibilities.length);

                if (filteredResponsibilities.length === 0) {
                    const emptyState = document.createElement('div');
                    emptyState.className = 'rounded-lg border border-dashed border-gray-300 bg-white px-4 py-5 text-sm text-gray-500';
                    emptyState.textContent = 'No responsibilities match your search.';
                    listEl.appendChild(emptyState);
                    syncHiddenInput();
                    return;
                }

                filteredResponsibilities.forEach(({ item, index }) => {
                    const wrapper = document.createElement(canSelectResponsibilities ? 'label' : 'div');
                    wrapper.className = 'flex items-start gap-3 rounded-lg border border-gray-200 bg-white px-4 py-3';

                    const textWrap = document.createElement('div');
                    textWrap.className = 'text-sm flex-1';
                    const titleIdEl = document.createElement('p');
                    titleIdEl.className = 'font-semibold text-gray-900';
                    titleIdEl.textContent = `ID: ${item.title_id || '-'}`;
                    const descIdEl = document.createElement('p');
                    descIdEl.className = 'text-gray-600 mt-0.5';
                    descIdEl.textContent = item.description_id || '-';

                    const titleEnEl = document.createElement('p');
                    titleEnEl.className = 'font-semibold text-gray-900 mt-2';
                    titleEnEl.textContent = `EN: ${item.title_en || '-'}`;
                    const descEnEl = document.createElement('p');
                    descEnEl.className = 'text-gray-600 mt-0.5';
                    descEnEl.textContent = item.description_en || '-';

                    textWrap.appendChild(titleIdEl);
                    textWrap.appendChild(descIdEl);
                    textWrap.appendChild(titleEnEl);
                    textWrap.appendChild(descEnEl);

                    let actionWrap = null;
                    if (canEditResponsibilities && item.id) {
                        actionWrap = document.createElement('div');
                        actionWrap.className = 'ml-3 flex flex-col gap-1';

                        const editBtn = document.createElement('button');
                        editBtn.type = 'button';
                        editBtn.className = 'inline-flex items-center rounded-md border border-blue-200 bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 hover:bg-blue-100';
                        editBtn.textContent = 'Edit';
                        editBtn.addEventListener('click', (event) => {
                            event.preventDefault();
                            event.stopPropagation();

                            editingResponsibilityId = Number(item.id);
                            newTitleIdInput.value = item.title_id || '';
                            newDescIdInput.value = item.description_id || '';
                            newTitleEnInput.value = item.title_en || '';
                            newDescEnInput.value = item.description_en || '';

                            if (modalTitleEl) {
                                modalTitleEl.textContent = 'Edit Responsibility';
                            }
                            saveModalBtn.textContent = 'Update Responsibility';

                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            newTitleIdInput.focus();
                        });

                        const deleteBtn = document.createElement('button');
                        deleteBtn.type = 'button';
                        deleteBtn.className = 'inline-flex items-center rounded-md border border-red-200 bg-red-50 px-2 py-1 text-xs font-medium text-red-700 hover:bg-red-100';
                        deleteBtn.textContent = 'Delete';
                        deleteBtn.addEventListener('click', (event) => {
                            event.preventDefault();
                            event.stopPropagation();

                            const confirmed = window.confirm('Delete this responsibility? This action cannot be undone.');
                            if (!confirmed) {
                                return;
                            }

                            const selectedPositionId = String(positionSelect?.value || responsibilityRoleSelect?.value || item.position_id || '');
                            const targetUrl = responsibilityDestroyUrlTemplate.replace('__RESPONSIBILITY_ID__', String(item.id));

                            fetch(targetUrl, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                            })
                                .then((response) => {
                                    if (!response.ok) {
                                        throw new Error('Unable to delete responsibility.');
                                    }

                                    return response.json();
                                })
                                .then(() => {
                                    removeResponsibilityById(selectedPositionId, item.id);
                                    setResponsibilitiesForPosition(selectedPositionId);
                                    renderList();
                                    markDraftDirty();
                                })
                                .catch(() => {
                                    alert('Failed to delete responsibility. Please try again.');
                                });
                        });

                        actionWrap.appendChild(editBtn);
                        actionWrap.appendChild(deleteBtn);
                    }

                    if (canSelectResponsibilities) {
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.className = 'mt-1 h-4 w-4 rounded border-gray-300 text-[#287854] focus:ring-[#287854]';
                        checkbox.checked = Boolean(checkedMap.get(index));
                        checkbox.addEventListener('change', () => {
                            checkedMap.set(index, checkbox.checked);
                            syncHiddenInput();
                            markDraftDirty();
                        });

                        wrapper.appendChild(checkbox);
                    }
                    wrapper.appendChild(textWrap);
                    if (canEditResponsibilities && item.id) {
                        wrapper.appendChild(actionWrap);
                    }
                    listEl.appendChild(wrapper);
                });
                syncHiddenInput();
            };

            const openModal = () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                newTitleIdInput.focus();
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                editingResponsibilityId = null;
                if (modalTitleEl) {
                    modalTitleEl.textContent = 'Create New Responsibility';
                }
                saveModalBtn.textContent = 'Add Responsibility';
                newTitleIdInput.value = '';
                newDescIdInput.value = '';
                newTitleEnInput.value = '';
                newDescEnInput.value = '';
            };

            if (canCreateResponsibilities && openModalBtn && cancelModalBtn && modal && saveModalBtn) {
                openModalBtn.addEventListener('click', openModal);
                cancelModalBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) closeModal();
                });
            }

            saveModalBtn?.addEventListener('click', () => {
                const titleId = newTitleIdInput.value.trim();
                const descId = newDescIdInput.value.trim();
                const titleEn = newTitleEnInput.value.trim();
                const descEn = newDescEnInput.value.trim();
                const selectedPositionId = String(positionSelect?.value || responsibilityRoleSelect?.value || '');

                if (!titleId || !titleEn) return;
                if (!selectedPositionId) {
                    alert('Please select a role/position first before adding responsibility.');
                    return;
                }
                saveModalBtn.disabled = true;
                saveModalBtn.classList.add('opacity-70', 'cursor-not-allowed');

                const isEditing = Number.isInteger(editingResponsibilityId) && editingResponsibilityId > 0;
                const requestUrl = isEditing
                    ? responsibilityUpdateUrlTemplate.replace('__RESPONSIBILITY_ID__', String(editingResponsibilityId))
                    : "{{ route('admin.contracts.responsibilities.store') }}";
                const requestMethod = isEditing ? 'PATCH' : 'POST';

                fetch(requestUrl, {
                    method: requestMethod,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        position_id: selectedPositionId,
                        title_id: titleId,
                        description_id: descId,
                        title_en: titleEn,
                        description_en: descEn,
                    }),
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Unable to save responsibility.');
                        }
                        return response.json();
                    })
                    .then((payload) => {
                        const savedItem = normalizeResponsibilityItem(payload?.item || {
                            title_id: titleId,
                            description_id: descId,
                            title_en: titleEn,
                            description_en: descEn,
                        });

                        if (!Array.isArray(responsibilitiesByPosition[selectedPositionId])) {
                            responsibilitiesByPosition[selectedPositionId] = [];
                        }

                        if (isEditing) {
                            updateResponsibilityById(selectedPositionId, savedItem);
                        } else {
                            responsibilitiesByPosition[selectedPositionId].push(savedItem);
                        }
                        setResponsibilitiesForPosition(selectedPositionId);
                        checkedMap.set(responsibilities.length - 1, true);
                        if (responsibilitySearchInput) {
                            responsibilitySearchInput.value = '';
                        }
                        responsibilitySearchTerm = '';
                        renderList();
                        markDraftDirty();
                        closeModal();
                    })
                    .catch(() => {
                        alert('Failed to save responsibility. Please try again.');
                    })
                    .finally(() => {
                        saveModalBtn.disabled = false;
                        saveModalBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                    });
            });

            if (canEditResponsibilities && bulkDeleteBtn) {
                bulkDeleteBtn.addEventListener('click', () => {
                    const selectedPositionId = String(positionSelect?.value || responsibilityRoleSelect?.value || '');
                    const selectedIds = responsibilities
                        .filter((item, index) => checkedMap.get(index) && item.id)
                        .map((item) => Number(item.id));

                    if (selectedIds.length === 0) {
                        alert('Select at least one responsibility to delete.');
                        return;
                    }

                    const confirmed = window.confirm(`Delete ${selectedIds.length} checked responsibilities? This action cannot be undone.`);
                    if (!confirmed) {
                        return;
                    }

                    bulkDeleteBtn.disabled = true;
                    bulkDeleteBtn.classList.add('opacity-70', 'cursor-not-allowed');

                    fetch(responsibilityBulkDestroyUrl, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ ids: selectedIds }),
                    })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Unable to bulk delete responsibilities.');
                            }

                            return response.json();
                        })
                        .then(() => {
                            selectedIds.forEach((id) => removeResponsibilityById(selectedPositionId, id));
                            setResponsibilitiesForPosition(selectedPositionId);
                            renderList();
                            markDraftDirty();
                        })
                        .catch(() => {
                            alert('Failed to delete checked responsibilities. Please try again.');
                        })
                        .finally(() => {
                            bulkDeleteBtn.disabled = false;
                            bulkDeleteBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                        });
                });
            }

            const setEditorFromHidden = () => {
                if (!quill) {
                    return;
                }
                const value = String(roleBriefInput.value || '').trim();
                if (!value) {
                    quill.root.innerHTML = '<p><br></p>';
                    return;
                }

                if (value.includes('<')) {
                    quill.root.innerHTML = value;
                    return;
                }

                const lines = value.split(/\r\n|\r|\n|,|;/).map((line) => line.trim()).filter(Boolean);
                quill.root.innerHTML = lines.length > 0
                    ? `<ul>${lines.map((line) => `<li>${line}</li>`).join('')}</ul>`
                    : value;
            };

            const syncRoleBriefInput = () => {
                if (!quill) {
                    return;
                }
                const html = quill.root.innerHTML.trim();
                roleBriefInput.value = html === '<p><br></p>' ? '' : html;
            };

            const collectDraftValues = () => {
                if (!form) {
                    return {};
                }

                syncRoleBriefInput();
                syncHiddenInput();
                syncLanguageLawTranslation();
                syncSalaryTotal();

                const values = {};
                form.querySelectorAll('input[name], select[name], textarea[name]').forEach((field) => {
                    if (!field.name || field.name === '_token') {
                        return;
                    }

                    if (field.type === 'checkbox') {
                        values[field.name] = field.checked;
                        return;
                    }

                    values[field.name] = field.value;
                });

                return values;
            };

            const saveDraft = () => {
                if (!draftDirty) {
                    return;
                }

                const payload = {
                    savedAt: new Date().toISOString(),
                    values: collectDraftValues(),
                };

                localStorage.setItem(draftStorageKey, JSON.stringify(payload));
                draftDirty = false;
                setDraftStatus(payload.savedAt);
            };

            const restoreDraft = () => {
                const rawDraft = localStorage.getItem(draftStorageKey);
                if (!rawDraft || !form) {
                    setDraftStatus(null);
                    return;
                }

                try {
                    const parsed = JSON.parse(rawDraft);
                    const values = parsed?.values || {};

                    Object.entries(values).forEach(([name, value]) => {
                        const field = form.elements.namedItem(name);
                        if (!field) {
                            return;
                        }

                        if (name === 'position_id') {
                            restoredDraftPositionId = String(value ?? '');
                        }

                        if (name === 'sub_division_id') {
                            restoredDraftSubDivisionId = String(value ?? '');
                        }

                        if (field instanceof RadioNodeList) {
                            return;
                        }

                        if (field.type === 'checkbox') {
                            field.checked = Boolean(value);
                            return;
                        }

                        field.value = String(value ?? '');
                    });

                    setDraftStatus(parsed?.savedAt || null);
                    draftDirty = false;
                } catch (_) {
                    setDraftStatus(null);
                }
            };

            const clearDraft = () => {
                localStorage.removeItem(draftStorageKey);
                draftDirty = false;
                setDraftStatus(null);
            };

            if (quill) {
                quill.on('text-change', syncRoleBriefInput);
                quill.on('text-change', markDraftDirty);
            }

            if (responsibilitySearchInput) {
                responsibilitySearchInput.addEventListener('input', () => {
                    responsibilitySearchTerm = normalizeResponsibilitySearch(responsibilitySearchInput.value);
                    renderList();
                });
            }

            restoreDraft();

            setEditorFromHidden();
            syncRoleBriefInput();

            const renderPositionsForDivision = () => {
                if (!positionSelect || !divisionSelect) {
                    return;
                }

                const selectedDivision = divisionSelect.value;
                const positions = positionsByDivision[selectedDivision] || [];
                const previousValue = positionSelect.value || restoredDraftPositionId || String(oldPositionId || '');

                positionSelect.innerHTML = '<option value="">Select position</option>';
                positions.forEach((position) => {
                    const option = document.createElement('option');
                    option.value = String(position.id);
                    option.textContent = position.name;
                    if (String(position.id) === String(previousValue)) {
                        option.selected = true;
                    }
                    positionSelect.appendChild(option);
                });

                if (positions.length === 0) {
                    positionSelect.value = '';
                }
            };

            const renderSubDivisionsForDivision = () => {
                if (!subDivisionSelect || !divisionSelect) {
                    return;
                }

                const selectedDivision = String(divisionSelect.value || '');
                const subDivisions = subDivisionsByDivision[selectedDivision] || [];
                const previousValue = String(subDivisionSelect.value || restoredDraftSubDivisionId || oldSubDivisionId || '');

                subDivisionSelect.innerHTML = '<option value="">Select sub-division</option>';
                subDivisions.forEach((subDivision) => {
                    const option = document.createElement('option');
                    option.value = String(subDivision.id);
                    option.textContent = subDivision.name;
                    if (String(subDivision.id) === previousValue) {
                        option.selected = true;
                    }
                    subDivisionSelect.appendChild(option);
                });

                if (subDivisions.length === 0) {
                    subDivisionSelect.value = '';
                }
            };

            const syncResponsibilityRoleSelect = () => {
                if (!responsibilityRoleSelect || !positionSelect) {
                    return;
                }

                responsibilityRoleSelect.value = String(positionSelect.value || '');
                responsibilityRoleSelect.disabled = true;
            };

            const initializeResponsibilitiesForCurrentPosition = () => {
                const selectedRoleId = String(positionSelect?.value || responsibilityRoleSelect?.value || '');
                setResponsibilitiesForPosition(selectedRoleId);

                if (!oldResponsibilitiesApplied) {
                    parseOldResponsibilities();
                    if (hiddenInput.value && hiddenInput.value !== oldRaw) {
                        applyResponsibilitiesFromRaw(hiddenInput.value);
                    }
                    if (!oldRaw && !hiddenInput.value) {
                        defaultAllChecked();
                    }
                    oldResponsibilitiesApplied = true;
                }

                renderList();
            };

            if (divisionSelect) {
                divisionSelect.addEventListener('change', () => {
                    if (subDivisionSelect) {
                        subDivisionSelect.value = '';
                    }
                    positionSelect.value = '';
                    renderSubDivisionsForDivision();
                    renderPositionsForDivision();
                    syncResponsibilityRoleSelect();
                    initializeResponsibilitiesForCurrentPosition();
                });
                renderSubDivisionsForDivision();
                renderPositionsForDivision();
                syncResponsibilityRoleSelect();
                initializeResponsibilitiesForCurrentPosition();
            }

            if (positionSelect) {
                positionSelect.addEventListener('change', () => {
                    syncResponsibilityRoleSelect();
                    initializeResponsibilitiesForCurrentPosition();
                });
            }

            if (subDivisionSelect) {
                subDivisionSelect.addEventListener('change', markDraftDirty);
            }

            const syncLanguageLawTranslation = () => {
                if (!languageLawSelect || !languageLawIdInput) {
                    return;
                }
                const selected = languageLawSelect.options[languageLawSelect.selectedIndex];
                languageLawIdInput.value = selected?.dataset.languageLawId || '';
            };

            if (languageLawSelect) {
                languageLawSelect.addEventListener('change', syncLanguageLawTranslation);
                syncLanguageLawTranslation();
            }

            const syncEndDateState = () => {
                if (!templateSelect || !endDateInput) {
                    return;
                }

                const isPermanent = templateSelect.value === 'permanent_pkwtt';
                endDateInput.disabled = isPermanent;
                endDateInput.required = !isPermanent;
                endDateInput.classList.toggle('bg-gray-50', isPermanent);
                endDateInput.classList.toggle('text-gray-400', isPermanent);

                if (isPermanent) {
                    endDateInput.dataset.previousValue = endDateInput.value;
                    endDateInput.value = '';
                } else if (!endDateInput.value && endDateInput.dataset.previousValue) {
                    endDateInput.value = endDateInput.dataset.previousValue;
                }
            };

            if (templateSelect) {
                templateSelect.addEventListener('change', syncEndDateState);
                syncEndDateState();
            }

            const syncBpjsComponentsVisibility = () => {
                if (!bpjsEmploymentSelect || !bpjsComponentsWrap) {
                    return;
                }
                bpjsComponentsWrap.style.display = bpjsEmploymentSelect.value === 'no' ? 'none' : 'grid';
            };

            if (bpjsEmploymentSelect) {
                bpjsEmploymentSelect.addEventListener('change', syncBpjsComponentsVisibility);
                syncBpjsComponentsVisibility();
            }

            if (form) {
                form.addEventListener('submit', () => {
                    syncRoleBriefInput();
                    draftDirty = true;
                    saveDraft();
                });

                form.querySelectorAll('input, select, textarea').forEach((field) => {
                    if (field.name !== '_token') {
                        field.addEventListener('input', markDraftDirty);
                        field.addEventListener('change', markDraftDirty);
                    }
                });
            }

            if (clearDraftBtn) {
                clearDraftBtn.addEventListener('click', clearDraft);
            }

            const formatCurrency = (value) => {
                const digits = String(value || '').replace(/[^\d]/g, '');
                if (!digits) return '';
                return new Intl.NumberFormat('id-ID').format(Number(digits));
            };

            const parseCurrency = (value) => {
                const digits = String(value || '').replace(/[^\d]/g, '');
                return digits ? Number(digits) : 0;
            };

            const syncSalaryTotal = () => {
                if (!salaryTotalInput) {
                    return;
                }

                const total = [salaryBaseInput, salaryAllowanceInput, foodAllowanceInput, transportAllowanceInput]
                    .reduce((sum, input) => sum + parseCurrency(input?.value || ''), 0);

                salaryTotalInput.value = total > 0 ? formatCurrency(String(total)) : '';
            };

            const currencyInputs = document.querySelectorAll('input[data-currency=\"idr\"]');
            currencyInputs.forEach((input) => {
                input.value = formatCurrency(input.value);
                input.addEventListener('input', () => {
                    input.value = formatCurrency(input.value);
                    syncSalaryTotal();
                });
            });

            syncSalaryTotal();
            window.setInterval(saveDraft, autosaveIntervalMs);
            window.addEventListener('beforeunload', () => {
                if (draftDirty) {
                    saveDraft();
                }
            });
        })();
    </script>
@endsection
