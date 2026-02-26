<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Apply Now',
        'seoDescription' => 'Apply for career opportunities through StaffLink Solutions and connect with employers looking for top talent.',
        'seoKeywords' => 'job application, apply now, stafflink careers, recruitment application',
    ])
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"></noscript>

    <style>
        .select2-container .select2-selection--single {
            height: 48px;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 46px;
            padding-left: 1rem;
            color: #2e2e2e;
            font-size: 14px;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 46px;
            right: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6b7280;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            overflow: hidden;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    @php($wording = \App\Support\PageWording::for('application'))
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-8 pb-24 pt-12">
            <section class="mx-auto max-w-5xl space-y-8">
                <div class="rounded-[30px] bg-[#1f5f46] p-10 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)]"
                    data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">{{ $wording['badge'] ?? 'Careers' }}</p>
                    <h1 class="mt-4 text-4xl font-semibold">{{ $wording['title'] ?? 'Apply now' }}</h1>
                    <p class="mt-4 max-w-2xl text-sm text-white/85">
                        {{ $wording['subtitle'] ?? 'Please complete this form and upload your required documents. Your application will be sent to careers@stafflink.pro and securely saved in our database for recruitment processing.' }}
                    </p>
                    <p class="mt-3 max-w-2xl text-sm text-white/90">
                        Fields marked with <span class="font-semibold">*</span> are required. Optional submissions include Cover Letter file,
                        Portfolio file, and an Attachment Link.
                    </p>
                </div>

                <div class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up"
                    data-aos-delay="100">
                    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data"
                        class="grid gap-4">
                        @csrf

                        <input type="hidden" name="career_job_id"
                            value="{{ old('career_job_id', $selectedJob?->id) }}">

                        <div class="mb-2 rounded-2xl border border-[#e4eadf] bg-[#f8fbf8] px-4 py-3">
                            <p class="text-sm font-semibold text-[#1f5f46]">Part 1 - Primary Information</p>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Full Name *</label>
                            <div>
                                <input name="full_name" value="{{ old('full_name') }}" type="text" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Email *</label>
                            <div>
                                <input name="email" value="{{ old('email') }}" type="email" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Phone *</label>
                            <div>
                                <input name="phone" value="{{ old('phone') }}" type="text" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Age *</label>
                            <div>
                                <input name="age" value="{{ old('age') }}" type="number" min="16"
                                    max="75" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                @error('age')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Religion *</label>
                            <div>
                                <select name="religion" required
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('religion'), [null, ''], true))>Select religion</option>
                                    <option value="Islam" @selected(old('religion') === 'Islam')>Islam</option>
                                    <option value="Christan" @selected(old('religion') === 'Christan')>Christan</option>
                                    <option value="Catholic" @selected(old('religion') === 'Catholic')>Catholic</option>
                                    <option value="Buddha" @selected(old('religion') === 'Buddha')>Buddha</option>
                                    <option value="Hindu" @selected(old('religion') === 'Hindu')>Hindu</option>
                                    <option value="Konghucu" @selected(old('religion') === 'Konghucu')>Konghucu</option>
                                </select>
                                @error('religion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Address *</label>
                            <div>
                                <textarea name="address" rows="3" required
                                    placeholder="Street, district, city, province"
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Position Title Applying For *</label>
                            <div>
                                <input name="position_title"
                                    value="{{ old('position_title', $selectedJob?->title) }}"
                                    type="text"
                                    @if($selectedJob) readonly @else required @endif
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                @if($selectedJob)
                                    <p class="mt-1 text-xs text-[#6b6b66]">Auto-filled from selected job posting.</p>
                                @endif
                                @error('position_title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded-2xl border border-[#e4eadf] bg-[#f8fbf8] p-4">
                            <p class="text-sm font-semibold text-[#1f5f46]">Reference Contact *</p>
                            <p class="mt-1 text-xs text-[#6b6b66]">Please provide one professional reference.</p>
                            <div class="mt-3 grid gap-4">
                                <div class="grid gap-2 sm:grid-cols-[240px_minmax(0,1fr)] sm:items-center">
                                    <label class="text-sm font-semibold">Reference Name *</label>
                                    <div>
                                        <input name="reference_name" value="{{ old('reference_name') }}" type="text" required
                                            class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    </div>
                                    @error('reference_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid gap-2 sm:grid-cols-[240px_minmax(0,1fr)] sm:items-center">
                                    <label class="text-sm font-semibold">Company *</label>
                                    <div>
                                        <input name="reference_company" value="{{ old('reference_company') }}" type="text" required
                                            class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    </div>
                                    @error('reference_company')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid gap-2 sm:grid-cols-[240px_minmax(0,1fr)] sm:items-center">
                                    <label class="text-sm font-semibold">Phone Number *</label>
                                    <div>
                                        <input name="reference_phone" value="{{ old('reference_phone') }}" type="text" required
                                            class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    </div>
                                    @error('reference_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid gap-2 sm:grid-cols-[240px_minmax(0,1fr)] sm:items-center">
                                    <label class="text-sm font-semibold">Email *</label>
                                    <div>
                                        <input name="reference_email" value="{{ old('reference_email') }}" type="email" required
                                            class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    </div>
                                    @error('reference_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 mt-2 rounded-2xl border border-[#e4eadf] bg-[#f8fbf8] px-4 py-3">
                            <p class="text-sm font-semibold text-[#1f5f46]">Part 2 - Additional Questions</p>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Can you speak English? *</label>
                            <div>
                                <select name="speaks_english" id="speaks_english" required
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('speaks_english'), [null, ''], true))>Select</option>
                                    <option value="yes" @selected(old('speaks_english') === 'yes')>Yes</option>
                                    <option value="no" @selected(old('speaks_english') === 'no')>No</option>
                                </select>
                                @error('speaks_english')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div id="english-level-wrap" class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">English Level</label>
                            <div>
                                <select name="english_level"
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('english_level'), [null, ''], true))>Select level</option>
                                    <option value="basic" @selected(old('english_level') === 'basic')>Basic</option>
                                    <option value="intermediate" @selected(old('english_level') === 'intermediate')>Intermediate</option>
                                    <option value="advanced" @selected(old('english_level') === 'advanced')>Advanced</option>
                                    <option value="fluent" @selected(old('english_level') === 'fluent')>Fluent</option>
                                </select>
                                @error('english_level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Willing to travel for work? *</label>
                            <div>
                                <select name="willing_to_travel" required
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('willing_to_travel'), [null, ''], true))>Select</option>
                                    <option value="yes" @selected(old('willing_to_travel') === 'yes')>Yes</option>
                                    <option value="no" @selected(old('willing_to_travel') === 'no')>No</option>
                                </select>
                                @error('willing_to_travel')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Do you have a motorbike? *</label>
                            <div>
                                <select name="has_motorbike" required
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('has_motorbike'), [null, ''], true))>Select</option>
                                    <option value="yes" @selected(old('has_motorbike') === 'yes')>Yes</option>
                                    <option value="no" @selected(old('has_motorbike') === 'no')>No</option>
                                </select>
                                @error('has_motorbike')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Do you have a passport? *</label>
                            <div>
                                <select name="has_passport" required
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('has_passport'), [null, ''], true))>Select</option>
                                    <option value="yes" @selected(old('has_passport') === 'yes')>Yes</option>
                                    <option value="no" @selected(old('has_passport') === 'no')>No</option>
                                </select>
                                @error('has_passport')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Can you drive a car? *</label>
                            <div>
                                <select name="can_drive_car" required
                                    class="js-enhanced-select w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled @selected(in_array(old('can_drive_car'), [null, ''], true))>Select</option>
                                    <option value="yes" @selected(old('can_drive_car') === 'yes')>Yes</option>
                                    <option value="no" @selected(old('can_drive_car') === 'no')>No</option>
                                </select>
                                @error('can_drive_car')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @php
                            $customQuestions = collect($selectedJob?->custom_questions ?? [])
                                ->map(fn ($q) => trim((string) $q))
                                ->filter(fn ($q) => $q !== '')
                                ->values();
                        @endphp

                        @if ($customQuestions->isNotEmpty())
                            <div class="rounded-2xl border border-[#e4eadf] bg-[#f8fbf8] p-4">
                                <p class="text-sm font-semibold text-[#1f5f46]">Custom Questions *</p>
                                <p class="mt-1 text-xs text-[#6b6b66]">These are required for this position.</p>
                                <div class="mt-3 grid gap-4">
                                    @foreach ($customQuestions as $idx => $question)
                                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-start">
                                            <input type="hidden" name="custom_questions[]" value="{{ $question }}">
                                            <label class="text-sm font-semibold">{{ $question }} *</label>
                                            <div>
                                                <textarea name="custom_answers[]" rows="3" required
                                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">{{ old("custom_answers.$idx") }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('custom_answers')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div class="mb-2 mt-2 rounded-2xl border border-[#e4eadf] bg-[#f8fbf8] px-4 py-3">
                            <p class="text-sm font-semibold text-[#1f5f46]">Part 3 - Attachments</p>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Resume (PDF only - max 4MB) *</label>
                            <div>
                                <input name="resume" type="file" accept=".pdf" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-[#e6f1ec] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#1f5f46]">
                                @error('resume')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">ID / KTP (PDF/JPG/PNG - max 4MB) *</label>
                            <div>
                                <input name="id_ktp" type="file" accept=".pdf,.jpg,.jpeg,.png" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-[#e6f1ec] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#1f5f46]">
                                @error('id_ktp')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">SKCK (PDF/JPG/PNG - max 4MB) *</label>
                            <div>
                                <input name="skck" type="file" accept=".pdf,.jpg,.jpeg,.png" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-[#e6f1ec] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#1f5f46]">
                                @error('skck')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Cover Letter File (Optional)</label>
                            <div>
                                <input name="cover_letter_file" type="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-[#e6f1ec] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#1f5f46]">
                                @error('cover_letter_file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Portfolio File (Optional)</label>
                            <div>
                                <input name="portfolio_file" type="file" accept=".pdf,.jpg,.jpeg,.png,.zip,.rar,.doc,.docx,.ppt,.pptx"
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-[#e6f1ec] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#1f5f46]">
                                @error('portfolio_file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-[260px_minmax(0,1fr)] sm:items-center">
                            <label class="text-sm font-semibold">Attachment Link (Google Drive) (Optional)</label>
                            <div>
                                <input name="attachment_link" value="{{ old('attachment_link') }}" type="url"
                                    placeholder="https://drive.google.com/..."
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                @error('attachment_link')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9b7829]">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
        <x-site-footer />
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script>
        window.addEventListener('load', () => {
            const speaksEnglish = document.getElementById('speaks_english');
            const englishLevelWrap = document.getElementById('english-level-wrap');

            const toggleEnglishLevel = () => {
                if (!speaksEnglish || !englishLevelWrap) return;
                englishLevelWrap.classList.toggle('hidden', speaksEnglish.value !== 'yes');
            };

            speaksEnglish?.addEventListener('change', toggleEnglishLevel);

            if (window.jQuery && window.jQuery.fn.select2) {
                window.jQuery('.js-enhanced-select').select2({
                    width: '100%',
                });
                window.jQuery('#speaks_english').on('change', toggleEnglishLevel);
            }

            toggleEnglishLevel();
        });
    </script>
</body>

</html>
