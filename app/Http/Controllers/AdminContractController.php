<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Division;
use App\Models\Position;
use App\Models\Responsibility;
use App\Models\SubDivision;
use App\Services\ContractNumberService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::latest()->paginate(20);

        return view('admin.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $divisions = Division::query()
            ->where('is_active', true)
            ->with(['positions' => fn ($q) => $q->where('is_active', true)->orderBy('name')])
            ->orderBy('name')
            ->get();

        $subDivisionsByDivision = SubDivision::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->groupBy('division_id')
            ->map(fn ($items) => $items->map(fn ($item) => [
                'id' => (int) $item->id,
                'name' => (string) $item->name,
            ])->values())
            ->toArray();

        $positionIds = $divisions
            ->flatMap(fn ($division) => $division->positions->pluck('id'))
            ->map(fn ($id) => (int) $id)
            ->values();

        $responsibilitiesByPosition = Responsibility::query()
            ->whereIn('position_id', $positionIds)
            ->orderBy('title_id')
            ->orderBy('title_en')
            ->get()
            ->groupBy('position_id')
            ->map(fn ($items) => $items->map(fn ($item) => [
                'id' => (int) $item->id,
                'position_id' => (int) $item->position_id,
                'title_id' => (string) $item->title_id,
                'description_id' => (string) ($item->description_id ?? ''),
                'title_en' => (string) $item->title_en,
                'description_en' => (string) ($item->description_en ?? ''),
            ])->values())
            ->toArray();

        $userRole = request()->user()?->role;

        return view('admin.contracts.create', [
            'templates' => $this->templates(),
            'divisions' => $divisions,
            'subDivisionsByDivision' => $subDivisionsByDivision,
            'responsibilitiesByPosition' => $responsibilitiesByPosition,
            'canCreateResponsibilities' => in_array($userRole, ['super_admin', 'admin'], true),
            'canEditResponsibilities' => $userRole === 'super_admin',
            'canSelectResponsibilities' => $userRole === 'super_admin',
        ]);
    }

    public function generate(Request $request): Response
    {
        $salaryBase = $this->normalizeCurrencyInput($request->input('salary_base'));
        $salaryAllowance = $this->normalizeCurrencyInput($request->input('salary_allowance'));
        $foodAllowance = $this->normalizeCurrencyInput($request->input('food_allowance'));
        $transportAllowance = $this->normalizeCurrencyInput($request->input('transport_allowance'));
        $isPermanentContract = $request->input('template') === 'permanent_pkwtt';

        $request->merge([
            'salary_total' => $this->sumCurrencyInputs([$salaryBase, $salaryAllowance, $foodAllowance, $transportAllowance]),
            'salary_base' => $salaryBase,
            'salary_allowance' => $salaryAllowance,
            'food_allowance' => $foodAllowance,
            'transport_allowance' => $transportAllowance,
            'end_date' => $isPermanentContract ? $request->input('start_date') : $request->input('end_date'),
            'bpjs_jht_enabled' => $request->boolean('bpjs_jht_enabled'),
            'bpjs_jkk_enabled' => $request->boolean('bpjs_jkk_enabled'),
            'bpjs_jkm_enabled' => $request->boolean('bpjs_jkm_enabled'),
            'bpjs_jp_enabled' => $request->boolean('bpjs_jp_enabled'),
            'bpjs_jkp_enabled' => $request->boolean('bpjs_jkp_enabled'),
        ]);

        $validated = $request->validate([
            'template' => ['required', 'in:fixed_term_pkwt,permanent_pkwtt'],
            'contract_number' => ['nullable', 'string', 'max:80'],
            'agreement_date' => ['required', 'date'],
            'company_name' => ['required', 'string', 'max:190'],
            'company_address' => ['required', 'string', 'max:255'],
            'division_id' => ['required', 'integer', 'exists:divisions,id'],
            'sub_division_id' => ['nullable', 'integer', 'exists:sub_divisions,id'],
            'employee_title' => ['required', 'string', 'in:Mr.,Mrs.,Miss'],
            'employee_name' => ['required', 'string', 'max:190'],
            'employee_birth_info' => ['nullable', 'string', 'max:190'],
            'employee_gender' => ['nullable', 'string', 'in:Male,Female,Other'],
            'employee_religion' => ['nullable', 'string', 'in:Islam,Christian,Catholic,Hindu,Buddhist,Confucian,Other'],
            'employee_address' => ['nullable', 'string', 'max:255'],
            'employee_id_number' => ['nullable', 'string', 'max:80'],
            'employee_phone' => ['nullable', 'string', 'max:50'],
            'employment_basis' => ['required', 'string', 'max:120'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'probation_months' => ['required', 'integer', 'min:0', 'max:12'],
            'notice_period_days' => ['required', 'integer', 'min:1', 'max:180'],
            'working_hours_per_day' => ['required', 'string', 'max:80'],
            'working_days_per_week' => ['required', 'integer', 'min:1', 'max:7'],
            'work_start_time' => ['required', 'string', 'max:40'],
            'work_end_time' => ['required', 'string', 'max:40'],
            'salary_total' => ['nullable', 'numeric', 'min:0'],
            'salary_base' => ['nullable', 'numeric', 'min:0'],
            'salary_allowance' => ['nullable', 'numeric', 'min:0'],
            'food_allowance' => ['nullable', 'numeric', 'min:0'],
            'transport_allowance' => ['nullable', 'numeric', 'min:0'],
            'bpjs_health_status' => ['nullable', 'in:yes,no'],
            'bpjs_employment_status' => ['nullable', 'in:yes,no'],
            'bpjs_jht_enabled' => ['nullable', 'boolean'],
            'bpjs_jkk_enabled' => ['nullable', 'boolean'],
            'bpjs_jkm_enabled' => ['nullable', 'boolean'],
            'bpjs_jp_enabled' => ['nullable', 'boolean'],
            'bpjs_jkp_enabled' => ['nullable', 'boolean'],
            'pay_day' => ['required', 'integer', 'min:1', 'max:31'],
            'role_brief_points' => ['nullable', 'string', 'max:6000'],
            'responsibilities' => ['nullable', 'string', 'max:20000'],
            'additional_terms' => ['nullable', 'string', 'max:4000'],
            'language_law' => ['nullable', 'string', 'max:255'],
            'language_law_id' => ['nullable', 'string', 'max:255'],
            'governing_law' => ['nullable', 'string', 'max:255'],
            'sign_employer_name' => ['required', 'string', 'max:190'],
            'sign_employee_name' => ['required', 'string', 'max:190'],
        ]);

        $selectedDivision = Division::query()->findOrFail((int) $validated['division_id']);
        $selectedPosition = Position::query()->findOrFail((int) $validated['position_id']);
        $selectedSubDivision = null;

        if ((int) $selectedPosition->division_id !== (int) $selectedDivision->id) {
            abort(422, 'Selected position does not belong to the selected division.');
        }

        if (! empty($validated['sub_division_id'])) {
            $selectedSubDivision = SubDivision::query()->findOrFail((int) $validated['sub_division_id']);
            if ((int) $selectedSubDivision->division_id !== (int) $selectedDivision->id) {
                abort(422, 'Selected sub-division does not belong to the selected division.');
            }
        }

        $data = [
            'selected_template' => $validated['template'],
            'contract_type_en' => $validated['template'] === 'fixed_term_pkwt' ? 'Fixed-Term (PKWT)' : 'Permanent (PKWTT)',
            'contract_type_id' => $validated['template'] === 'fixed_term_pkwt' ? 'Perjanjian Kerja Waktu Tertentu (PKWT)' : 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)',
            // 'contract_number' => trim((string) ($validated['contract_number'] ?? '')),
            'contract_number' =>  $validated['template'] === 'fixed_term_pkwt' ? ContractNumberService::generate('PKWT') : ContractNumberService::generate('PKWTT'),
            'agreement_date' => Carbon::parse($validated['agreement_date'])->format('F j, Y'),
            'agreement_date_id' => Carbon::parse($validated['agreement_date'])->locale('id')->translatedFormat('j F Y'),
            'company_name' => trim((string) $validated['company_name']),
            'company_address' => trim((string) $validated['company_address']),
            'division' => trim((string) $selectedDivision->name),
            'sub_division' => trim((string) ($selectedSubDivision?->name ?? '')),
            'first_party_name' => trim((string) $validated['sign_employer_name']),
            'first_party_position' => 'Director',
            'first_party_address' => trim((string) $validated['company_address']),
            'employer_name' => trim((string) $validated['company_name']),
            'employee_title' => $validated['employee_title'],
            'employee_name' => trim((string) $validated['employee_name']),
            'employee_birth_info' => trim((string) ($validated['employee_birth_info'] ?? '')),
            'employee_gender' => trim((string) ($validated['employee_gender'] ?? '')),
            'employee_religion' => trim((string) ($validated['employee_religion'] ?? '')),
            'employee_address' => trim((string) ($validated['employee_address'] ?? '')),
            'employee_id_number' => trim((string) ($validated['employee_id_number'] ?? '')),
            'employee_phone' => trim((string) ($validated['employee_phone'] ?? '')),
            'employment_basis' => trim((string) $validated['employment_basis']),
            'position_title' => trim((string) $selectedPosition->name),
            'start_date' => Carbon::parse($validated['start_date'])->format('F j, Y'),
            'start_date_id' => Carbon::parse($validated['start_date'])->locale('id')->translatedFormat('j F Y'),
            'end_date' => Carbon::parse($validated['end_date'])->format('F j, Y'),
            'end_date_id' => Carbon::parse($validated['end_date'])->locale('id')->translatedFormat('j F Y'),
            'probation_months' => (int) $validated['probation_months'],
            'notice_period_days' => (int) $validated['notice_period_days'],
            'working_hours_per_day' => trim((string) $validated['working_hours_per_day']),
            'working_days_per_week' => (int) $validated['working_days_per_week'],
            'work_start_time' => trim((string) $validated['work_start_time']),
            'work_end_time' => trim((string) $validated['work_end_time']),
            'salary_total' => $this->formatIdr((float) $validated['salary_total']),
            'salary_base' => isset($validated['salary_base']) ? $this->formatIdr((float) $validated['salary_base']) : null,
            'salary_allowance' => isset($validated['salary_allowance']) ? $this->formatIdr((float) $validated['salary_allowance']) : null,
            'food_allowance' => isset($validated['food_allowance']) ? $this->formatIdr((float) $validated['food_allowance']) : null,
            'transport_allowance' => isset($validated['transport_allowance']) ? $this->formatIdr((float) $validated['transport_allowance']) : null,
            'bpjs_health_status' => $validated['bpjs_health_status'] ?? 'yes',
            'bpjs_employment_status' => $validated['bpjs_employment_status'] ?? 'yes',
            'bpjs_jht_enabled' => (bool) ($validated['bpjs_jht_enabled'] ?? true),
            'bpjs_jkk_enabled' => (bool) ($validated['bpjs_jkk_enabled'] ?? true),
            'bpjs_jkm_enabled' => (bool) ($validated['bpjs_jkm_enabled'] ?? true),
            'bpjs_jp_enabled' => (bool) ($validated['bpjs_jp_enabled'] ?? true),
            'bpjs_jkp_enabled' => (bool) ($validated['bpjs_jkp_enabled'] ?? true),
            'pay_day' => (int) $validated['pay_day'],
            'role_brief_points' => trim((string) ($validated['role_brief_points'] ?? '')),
            'responsibilities' => trim((string) ($validated['responsibilities'] ?? '')),
            'additional_terms' => trim((string) ($validated['additional_terms'] ?? '')),
            'language_law' => trim((string) ($validated['language_law'] ?? 'English text shall prevail')),
            'language_law_id' => trim((string) ($validated['language_law_id'] ?? 'teks Bahasa Inggris yang berlaku')),
            'governing_law' => trim((string) ($validated['governing_law'] ?? 'Republic of Indonesia')),
            'sign_employer_name' => trim((string) $validated['sign_employer_name']),
            'sign_employee_name' => trim((string) $validated['sign_employee_name']),
            'logo_image' => $this->imageDataUri(public_path('images/logo.png')),
            'header_image' => $this->imageDataUri(public_path('images/contracts/letterhead-header.png')),
            'footer_image' => $this->imageDataUri(public_path('images/contracts/letterhead-footer.png')),
        ];

        $formData = array_merge($validated, [
            'contract_number' => $data['contract_number'],
            'division' => $selectedDivision->name,
            'sub_division' => $selectedSubDivision?->name,
            'position_title' => $selectedPosition->name,
        ]);

        // Save contract to database
        Contract::create([
            'contract_number' => $data['contract_number'],
            'template' => $validated['template'],
            'division_id' => (int) $validated['division_id'],
            'employee_name' => $validated['employee_name'],
            'employee_title' => $validated['employee_title'],
            'employee_id_number' => $validated['employee_id_number'] ?? null,
            'position_title' => $selectedPosition->name,
            'employment_basis' => $validated['employment_basis'],
            'company_name' => $validated['company_name'],
            'employer_name' => $validated['company_name'],
            'first_party_name' => $validated['sign_employer_name'],
            'agreement_date' => $validated['agreement_date'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'salary_total' => (float) $validated['salary_total'],
            'salary_base' => isset($validated['salary_base']) ? (float) $validated['salary_base'] : null,
            'salary_allowance' => isset($validated['salary_allowance']) ? (float) $validated['salary_allowance'] : null,
            'food_allowance' => isset($validated['food_allowance']) ? (float) $validated['food_allowance'] : null,
            'transport_allowance' => isset($validated['transport_allowance']) ? (float) $validated['transport_allowance'] : null,
            'form_data' => $formData,
        ]);

        return redirect()
            ->route('admin.contracts.index')
            ->with('success', 'Contract submitted successfully. Download the PDF from the actions column.');
    }

    public function preview(Request $request): Response
    {
        $template = (string) $request->query('template', 'fixed_term_pkwt');
        if (! in_array($template, ['fixed_term_pkwt', 'permanent_pkwtt'], true)) {
            $template = 'fixed_term_pkwt';
        }

        $today = Carbon::now();
        $isFixedTerm = $template === 'fixed_term_pkwt';

        $data = [
            'selected_template' => $template,
            'contract_type_en' => $isFixedTerm ? 'Fixed-Term (PKWT)' : 'Permanent (PKWTT)',
            'contract_type_id' => $isFixedTerm ? 'Perjanjian Kerja Waktu Tertentu (PKWT)' : 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)',
            'contract_number' => 'PREVIEW/HR/'.strtoupper($today->format('M')).'/'.$today->format('Y'),
            'agreement_date' => $today->format('F j, Y'),
            'agreement_date_id' => $today->locale('id')->translatedFormat('j F Y'),
            'company_name' => 'PT Staff Link Solutions',
            'company_address' => 'Jl. Drupadi 1, No. 20, Seminyak, Bali',
            'first_party_name' => 'Vida R.',
            'first_party_position' => 'Director',
            'first_party_address' => 'Seminyak, Bali',
            'employer_name' => 'Staff Link Solutions',
            'employee_title' => 'Miss',
            'employee_name' => 'Sample Employee',
            'employee_birth_info' => 'Denpasar, 15/08/2000',
            'employee_gender' => 'Female',
            'employee_religion' => 'Muslim',
            'employee_address' => 'Seminyak, Bali',
            'employee_id_number' => '1234567890123456',
            'employee_phone' => '+62 812 0000 0000',
            'employment_basis' => $isFixedTerm ? 'Full Time' : 'Full Time',
            'sub_division' => 'Operations',
            'position_title' => 'HR & Finance Manager',
            'start_date' => $today->copy()->addDays(7)->format('F j, Y'),
            'start_date_id' => $today->copy()->addDays(7)->locale('id')->translatedFormat('j F Y'),
            'end_date' => $isFixedTerm ? $today->copy()->addYear()->format('F j, Y') : $today->copy()->addDays(7)->format('F j, Y'),
            'end_date_id' => $isFixedTerm ? $today->copy()->addYear()->locale('id')->translatedFormat('j F Y') : $today->copy()->addDays(7)->locale('id')->translatedFormat('j F Y'),
            'probation_months' => 3,
            'notice_period_days' => 30,
            'working_hours_per_day' => '7 hours 30 minutes',
            'working_days_per_week' => 6,
            'work_start_time' => '08.30 WITA',
            'work_end_time' => '17.00 WITA',
            'salary_total' => $this->formatIdr(6000000),
            'salary_base' => $this->formatIdr(3800000),
            'salary_allowance' => $this->formatIdr(2000000),
            'food_allowance' => $this->formatIdr(200000),
            'transport_allowance' => $this->formatIdr(300000),
            'bpjs_health_status' => 'yes',
            'bpjs_employment_status' => 'yes',
            'bpjs_jht_enabled' => true,
            'bpjs_jkk_enabled' => true,
            'bpjs_jkm_enabled' => true,
            'bpjs_jp_enabled' => true,
            'bpjs_jkp_enabled' => true,
            'pay_day' => 1,
            'role_brief_points' => "<ul><li>Coordinate daily staffing schedule.</li><li>Maintain accurate payment and invoice records.</li><li>Respond quickly to client operational requests.</li></ul>",
            'responsibilities' => json_encode([
                [
                    'title_id' => 'Interaksi dengan Klien',
                    'description_id' => 'Berinteraksi dengan keluarga terkait pembayaran, pemesanan, dan koordinasi layanan.',
                    'title_en' => 'Client Engagement',
                    'description_en' => 'Engage with families regarding payments, bookings, and service coordination.',
                ],
                [
                    'title_id' => 'Onboarding Staf',
                    'description_id' => 'Menangani proses onboarding staf baru untuk Perusahaan dan mitra bisnis.',
                    'title_en' => 'Staff Onboarding',
                    'description_en' => 'Handle onboarding of new staff for the Company and business partners.',
                ],
                [
                    'title_id' => 'Penagihan & Pelacakan Pembayaran',
                    'description_id' => 'Membuat invoice akurat, menerbitkan tepat waktu, dan memantau pembayaran masuk.',
                    'title_en' => 'Invoicing & Payment Tracking',
                    'description_en' => 'Generate accurate invoices, ensure timely issuance, and track incoming payments.',
                ],
            ], JSON_UNESCAPED_UNICODE),
            'additional_terms' => '',
            'language_law' => 'English text shall prevail',
            'language_law_id' => 'teks Bahasa Inggris yang berlaku',
            'governing_law' => 'Republic of Indonesia',
            'sign_employer_name' => 'Vida R.',
            'sign_employee_name' => 'Sample Employee',
            'logo_image' => $this->imageDataUri(public_path('images/logo.png')),
            'header_image' => $this->imageDataUri(public_path('images/contracts/letterhead-header.png')),
            'footer_image' => $this->imageDataUri(public_path('images/contracts/letterhead-footer.png')),
        ];

        $pdf = $this->buildContractPdf($data);

        return $pdf->stream('contract-template-preview.pdf');
    }

    public function regenerate(Contract $contract): Response
    {
        $formData = $contract->form_data;

        $isFixedTerm = ($formData['template'] ?? '') === 'fixed_term_pkwt';

        $data = [
            'selected_template' => $formData['template'] ?? 'permanent_pkwtt',
            'contract_type_en' => $isFixedTerm ? 'Fixed-Term (PKWT)' : 'Permanent (PKWTT)',
            'contract_type_id' => $isFixedTerm ? 'Perjanjian Kerja Waktu Tertentu (PKWT)' : 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)',
            'contract_number' => $contract->contract_number,
            'agreement_date' => Carbon::parse($formData['agreement_date'])->format('F j, Y'),
            'agreement_date_id' => Carbon::parse($formData['agreement_date'])->locale('id')->translatedFormat('j F Y'),
            'company_name' => $formData['company_name'] ?? '',
            'company_address' => $formData['company_address'] ?? '',
            'first_party_name' => $formData['first_party_name'] ?? ($formData['sign_employer_name'] ?? ''),
            'first_party_position' => $formData['first_party_position'] ?? 'Director',
            'first_party_address' => $formData['first_party_address'] ?? ($formData['company_address'] ?? ''),
            'employer_name' => $formData['employer_name'] ?? ($formData['company_name'] ?? ''),
            'employee_title' => $formData['employee_title'] ?? 'Mr.',
            'employee_name' => $formData['employee_name'] ?? '',
            'employee_birth_info' => $formData['employee_birth_info'] ?? '',
            'employee_gender' => $formData['employee_gender'] ?? '',
            'employee_religion' => $formData['employee_religion'] ?? '',
            'employee_address' => $formData['employee_address'] ?? '',
            'employee_id_number' => $formData['employee_id_number'] ?? '',
            'employee_phone' => $formData['employee_phone'] ?? '',
            'employment_basis' => $formData['employment_basis'] ?? '',
            'position_title' => $formData['position_title'] ?? '',
            'start_date' => Carbon::parse($formData['start_date'])->format('F j, Y'),
            'start_date_id' => Carbon::parse($formData['start_date'])->locale('id')->translatedFormat('j F Y'),
            'end_date' => Carbon::parse($formData['end_date'])->format('F j, Y'),
            'end_date_id' => Carbon::parse($formData['end_date'])->locale('id')->translatedFormat('j F Y'),
            'probation_months' => (int) ($formData['probation_months'] ?? 0),
            'notice_period_days' => (int) ($formData['notice_period_days'] ?? 30),
            'working_hours_per_day' => $formData['working_hours_per_day'] ?? '',
            'working_days_per_week' => (int) ($formData['working_days_per_week'] ?? 6),
            'work_start_time' => $formData['work_start_time'] ?? '',
            'work_end_time' => $formData['work_end_time'] ?? '',
            'salary_total' => $this->formatIdr((float) ($formData['salary_total'] ?? 0)),
            'salary_base' => isset($formData['salary_base']) ? $this->formatIdr((float) $formData['salary_base']) : null,
            'salary_allowance' => isset($formData['salary_allowance']) ? $this->formatIdr((float) $formData['salary_allowance']) : null,
            'food_allowance' => isset($formData['food_allowance']) ? $this->formatIdr((float) $formData['food_allowance']) : null,
            'transport_allowance' => isset($formData['transport_allowance']) ? $this->formatIdr((float) $formData['transport_allowance']) : null,
            'bpjs_health_status' => $formData['bpjs_health_status'] ?? 'yes',
            'bpjs_employment_status' => $formData['bpjs_employment_status'] ?? 'yes',
            'bpjs_jht_enabled' => (bool) ($formData['bpjs_jht_enabled'] ?? true),
            'bpjs_jkk_enabled' => (bool) ($formData['bpjs_jkk_enabled'] ?? true),
            'bpjs_jkm_enabled' => (bool) ($formData['bpjs_jkm_enabled'] ?? true),
            'bpjs_jp_enabled' => (bool) ($formData['bpjs_jp_enabled'] ?? true),
            'bpjs_jkp_enabled' => (bool) ($formData['bpjs_jkp_enabled'] ?? true),
            'division' => $formData['division'] ?? optional($contract->division)->name ?? '',
            'sub_division' => $formData['sub_division'] ?? '',
            'pay_day' => (int) ($formData['pay_day'] ?? 1),
            'role_brief_points' => $formData['role_brief_points'] ?? '',
            'responsibilities' => $formData['responsibilities'] ?? '',
            'additional_terms' => $formData['additional_terms'] ?? '',
            'language_law' => $formData['language_law'] ?? 'English text shall prevail',
            'language_law_id' => $formData['language_law_id'] ?? 'teks Bahasa Inggris yang berlaku',
            'governing_law' => $formData['governing_law'] ?? 'Republic of Indonesia',
            'sign_employer_name' => $formData['sign_employer_name'] ?? '',
            'sign_employee_name' => $formData['sign_employee_name'] ?? '',
            'logo_image' => $this->imageDataUri(public_path('images/logo.png')),
            'header_image' => $this->imageDataUri(public_path('images/contracts/letterhead-header.png')),
            'footer_image' => $this->imageDataUri(public_path('images/contracts/letterhead-footer.png')),
        ];

        $pdf = $this->buildContractPdf($data);

        return $pdf->download(Str::slug($contract->contract_number).'.pdf');
    }

    public function storeResponsibility(Request $request): JsonResponse
    {
        $this->ensureCanCreateResponsibilities($request);

        $validated = $request->validate([
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'title_id' => ['required', 'string', 'max:255'],
            'description_id' => ['nullable', 'string', 'max:2000'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string', 'max:2000'],
        ]);

        $responsibility = Responsibility::create([
            'position_id' => (int) $validated['position_id'],
            'title_id' => trim((string) $validated['title_id']),
            'description_id' => trim((string) ($validated['description_id'] ?? '')),
            'title_en' => trim((string) $validated['title_en']),
            'description_en' => trim((string) ($validated['description_en'] ?? '')),
        ]);

        return response()->json([
            'ok' => true,
            'item' => [
                'id' => (int) $responsibility->id,
                'position_id' => (int) $responsibility->position_id,
                'title_id' => (string) $responsibility->title_id,
                'description_id' => (string) ($responsibility->description_id ?? ''),
                'title_en' => (string) $responsibility->title_en,
                'description_en' => (string) ($responsibility->description_en ?? ''),
            ],
        ]);
    }

    public function destroyResponsibility(Responsibility $responsibility): JsonResponse
    {
        $this->ensureSuperAdminCanManageResponsibilities(request());

        $responsibility->delete();

        return response()->json(['ok' => true]);
    }

    public function updateResponsibility(Request $request, Responsibility $responsibility): JsonResponse
    {
        $this->ensureSuperAdminCanManageResponsibilities($request);

        $validated = $request->validate([
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'title_id' => ['required', 'string', 'max:255'],
            'description_id' => ['nullable', 'string', 'max:2000'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string', 'max:2000'],
        ]);

        $responsibility->update([
            'position_id' => (int) $validated['position_id'],
            'title_id' => trim((string) $validated['title_id']),
            'description_id' => trim((string) ($validated['description_id'] ?? '')),
            'title_en' => trim((string) $validated['title_en']),
            'description_en' => trim((string) ($validated['description_en'] ?? '')),
        ]);

        return response()->json([
            'ok' => true,
            'item' => [
                'id' => (int) $responsibility->id,
                'position_id' => (int) $responsibility->position_id,
                'title_id' => (string) $responsibility->title_id,
                'description_id' => (string) ($responsibility->description_id ?? ''),
                'title_en' => (string) $responsibility->title_en,
                'description_en' => (string) ($responsibility->description_en ?? ''),
            ],
        ]);
    }

    public function bulkDestroyResponsibilities(Request $request): JsonResponse
    {
        $this->ensureSuperAdminCanManageResponsibilities($request);

        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:responsibilities,id'],
        ]);

        $deletedCount = Responsibility::query()
            ->whereIn('id', $validated['ids'])
            ->delete();

        return response()->json([
            'ok' => true,
            'deleted_count' => $deletedCount,
        ]);
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }

    private function templates(): array
    {
        return [
            'fixed_term_pkwt' => 'Fixed Term / PKWT',
            'permanent_pkwtt' => 'Permanent / PKWTT',
        ];
    }

    private function ensureCanCreateResponsibilities(Request $request): void
    {
        abort_unless(in_array($request->user()?->role, ['super_admin', 'admin'], true), 403, 'Only admins can create responsibilities.');
    }

    private function ensureSuperAdminCanManageResponsibilities(Request $request): void
    {
        abort_unless($request->user()?->role === 'super_admin', 403, 'Only super admins can manage responsibilities.');
    }

    private function formatIdr(float $amount): string
    {
        return 'IDR '.number_format($amount, 0, ',', '.');
    }

    private function imageDataUri(string $path): ?string
    {
        if (! is_file($path)) {
            return null;
        }

        $contents = file_get_contents($path);
        if ($contents === false) {
            return null;
        }

        $mime = mime_content_type($path) ?: 'image/png';

        return 'data:'.$mime.';base64,'.base64_encode($contents);
    }

    private function buildContractPdf(array $data)
    {
        return Pdf::loadView('admin.contracts.pdf.employment-contract', [
            'data' => $data,
        ])->setPaper('a4')->setOptions([
            'defaultFont' => 'bookantiquapdf',
        ]);
    }

    private function normalizeCurrencyInput(mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }

        $raw = trim((string) $value);
        if ($raw === '') {
            return null;
        }

        $normalized = preg_replace('/[^\d]/', '', $raw);

        return $normalized === '' ? null : $normalized;
    }

    private function sumCurrencyInputs(array $values): string
    {
        $total = 0;

        foreach ($values as $value) {
            $total += (int) ($value ?? 0);
        }

        return (string) $total;
    }

}
