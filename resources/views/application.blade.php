<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'StaffLink') }} - Apply Now</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Google+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />
        <main class="px-8 pb-24 pt-12">
            <section class="mx-auto max-w-5xl space-y-8">
                <div class="rounded-[30px] bg-[#1f5f46] p-10 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)]"
                    data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Careers</p>
                    <h1 class="mt-4 text-4xl font-semibold">Apply now</h1>
                    <p class="mt-4 max-w-2xl text-sm text-white/85">
                        Complete this form and attach your resume. Your application is sent to careers@stafflink.pro and
                        saved in our database for future CRM integration.
                    </p>
                </div>

                <div class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up"
                    data-aos-delay="100">
                    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data"
                        class="grid gap-5 sm:grid-cols-2">
                        @csrf

                        <div class="sm:col-span-2">
                            <label class="text-sm font-semibold">Full Name</label>
                            <input name="full_name" value="{{ old('full_name') }}" type="text" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Email</label>
                            <input name="email" value="{{ old('email') }}" type="email" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Phone</label>
                            <input name="phone" value="{{ old('phone') }}" type="text" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Age</label>
                            <input name="age" value="{{ old('age') }}" type="number" min="16"
                                max="75" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Religion</label>
                            <select name="religion" required
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select religion</option>
                                <option value="Islam" @selected(old('religion') === 'Islam')>Islam</option>
                                <option value="Christan" @selected(old('religion') === 'Christan')>Christan</option>
                                <option value="Catholic" @selected(old('religion') === 'Catholic')>Catholic</option>
                                <option value="Buddha" @selected(old('religion') === 'Buddha')>Buddha</option>
                                <option value="Hindu" @selected(old('religion') === 'Hindu')>Hindu</option>
                                <option value="Konghucu" @selected(old('religion') === 'Konghucu')>Konghucu</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Province</label>
                            <input name="province" value="{{ old('province') }}" type="text" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">City</label>
                            <input name="city" value="{{ old('city') }}" type="text" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Can you speak English?</label>
                            <select name="speaks_english" id="speaks_english" required
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select</option>
                                <option value="yes" @selected(old('speaks_english') === 'yes')>Yes</option>
                                <option value="no" @selected(old('speaks_english') === 'no')>No</option>
                            </select>
                        </div>

                        <div id="english-level-wrap">
                            <label class="text-sm font-semibold">English Level</label>
                            <select name="english_level"
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select level</option>
                                <option value="basic" @selected(old('english_level') === 'basic')>Basic</option>
                                <option value="intermediate" @selected(old('english_level') === 'intermediate')>Intermediate</option>
                                <option value="advanced" @selected(old('english_level') === 'advanced')>Advanced</option>
                                <option value="fluent" @selected(old('english_level') === 'fluent')>Fluent</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Willing to travel for work?</label>
                            <select name="willing_to_travel" required
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select</option>
                                <option value="yes" @selected(old('willing_to_travel') === 'yes')>Yes</option>
                                <option value="no" @selected(old('willing_to_travel') === 'no')>No</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Do you have a motorbike?</label>
                            <select name="has_motorbike" required
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select</option>
                                <option value="yes" @selected(old('has_motorbike') === 'yes')>Yes</option>
                                <option value="no" @selected(old('has_motorbike') === 'no')>No</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Do you have a passport?</label>
                            <select name="has_passport" required
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select</option>
                                <option value="yes" @selected(old('has_passport') === 'yes')>Yes</option>
                                <option value="no" @selected(old('has_passport') === 'no')>No</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Can you drive a car?</label>
                            <select name="can_drive_car" required
                                class="js-enhanced-select mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                <option value="">Select</option>
                                <option value="yes" @selected(old('can_drive_car') === 'yes')>Yes</option>
                                <option value="no" @selected(old('can_drive_car') === 'no')>No</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="text-sm font-semibold">Position Title Applying For</label>
                            <input name="position_title" value="{{ old('position_title') }}" type="text" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="text-sm font-semibold">Resume (PDF only - max 4MB)</label>
                            <input name="resume" type="file" accept=".pdf" required
                                class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none file:mr-4 file:rounded-lg file:border-0 file:bg-[#e6f1ec] file:px-3 file:py-2 file:text-sm file:font-semibold file:text-[#1f5f46]">
                        </div>

                        <div class="sm:col-span-2">
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

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        (() => {
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
        })();
    </script>
</body>

</html>
