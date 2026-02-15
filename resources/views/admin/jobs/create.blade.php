@extends('admin.layout')

@section('page-title', 'Add New Job')

@section('content')
    <div class="max-w-5xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-8 py-6 border-b bg-gray-50/60 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-900">Create New Job</h3>
                <p class="text-sm text-gray-500 mt-1">Fill out the details below to publish a new vacancy.</p>
            </div>
            <form action="{{ route('admin.jobs.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <section class="space-y-4">
                    <div>
                        <h4 class="text-sm font-semibold tracking-wide text-gray-500 uppercase">Basic Information</h4>
                    </div>
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="e.g. Senior Software Engineer">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                <section class="space-y-4">
                    <div>
                        <h4 class="text-sm font-semibold tracking-wide text-gray-500 uppercase">Description</h4>
                    </div>
                    <div class="bg-gray-50 border border-gray-100 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Job Description
                                *</label>
                            <button type="button" id="ai-generate-description"
                                class="hidden inline-flex items-center gap-2 bg-[#287854] hover:bg-[#1f5f46] text-white text-xs px-3 py-2 rounded-md font-medium">
                                <svg id="ai-generate-description-spinner" class="hidden w-4 h-4 animate-spin"
                                    viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <circle class="opacity-30" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                    </path>
                                </svg>
                                <span id="ai-generate-description-label">Fill with AI</span>
                            </button>
                        </div>
                        <textarea name="description" id="description" rows="10" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="Describe the role, responsibilities, and requirements...">{{ old('description') }}</textarea>
                        <p id="ai-generate-description-message" class="mt-2 text-xs text-gray-500 hidden"></p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                <section class="space-y-4">
                    <div>
                        <h4 class="text-sm font-semibold tracking-wide text-gray-500 uppercase">Location and Type</h4>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                            <select name="country" id="country" required data-selected="{{ old('country') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select country</option>
                            </select>
                            @error('country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                            <select name="state" id="state" required data-selected="{{ old('state') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="">Select state</option>
                            </select>
                            @error('state')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                            <select name="type" id="type" required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="full-time" {{ old('type') === 'full-time' ? 'selected' : '' }}>Full-time
                                </option>
                                <option value="part-time" {{ old('type') === 'part-time' ? 'selected' : '' }}>Part-time
                                </option>
                                <option value="contract" {{ old('type') === 'contract' ? 'selected' : '' }}>Contract
                                </option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" id="status" required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent bg-white">
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published
                                </option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="space-y-4">
                    <div>
                        <h4 class="text-sm font-semibold tracking-wide text-gray-500 uppercase">Salary Range</h4>
                    </div>
                    <div class="border border-gray-100 rounded-lg p-4 bg-gray-50">
                        <div class="space-y-3">
                            <div class="salary-dual-slider py-1">
                                <div class="salary-slider-wrap">
                                    <div class="salary-track-base"></div>
                                    <div id="salary_track_active" class="salary-track-active"></div>
                                    <input type="range" id="minimum_salary_slider" min="0" max="50000000"
                                        step="500000" value="{{ old('minimum_salary', 5000000) }}"
                                        class="salary-range-input salary-range-min">
                                    <input type="range" id="maximum_salary_slider" min="0" max="50000000"
                                        step="500000" value="{{ old('maximum_salary', 10000000) }}"
                                        class="salary-range-input salary-range-max">
                                </div>
                                <div
                                    class="mt-3 flex justify-between text-[34px] leading-none font-semibold text-gray-600">
                                    <span>Min</span>
                                    <span>Max</span>
                                </div>
                                <input type="hidden" name="minimum_salary" id="minimum_salary_input"
                                    value="{{ old('minimum_salary', 5000000) }}">
                                <input type="hidden" name="maximum_salary" id="maximum_salary_input"
                                    value="{{ old('maximum_salary', 10000000) }}">
                            </div>

                            <p class="text-sm font-medium text-gray-700">
                                Selected Range: <span id="salary_range_preview" class="text-[#1f5f46]"></span>
                            </p>
                            <p class="text-sm text-gray-600">
                                Min: IDR <span id="minimum_salary_value"></span> | Max: IDR <span
                                    id="maximum_salary_value"></span>
                            </p>

                            @error('minimum_salary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('maximum_salary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.jobs.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2.5 rounded-lg font-medium">
                        Create Job
                    </button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .salary-slider-wrap {
            position: relative;
            height: 32px;
        }

        .salary-track-base,
        .salary-track-active {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 2px;
            border-radius: 9999px;
        }

        .salary-track-base {
            width: 100%;
            background: #d5d9df;
        }

        .salary-track-active {
            background: #72abd6;
            box-shadow: 0 0 12px rgba(114, 171, 214, 0.45);
        }

        .salary-range-input {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            margin: 0;
            background: transparent;
            pointer-events: none;
            transform: translateY(-50%);
            -webkit-appearance: none;
            appearance: none;
        }

        .salary-range-input::-webkit-slider-thumb {
            pointer-events: auto;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2px solid #dde1e6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(114, 171, 214, 0.18);
            cursor: pointer;
            margin-top: -12px;
            -webkit-appearance: none;
            appearance: none;
        }

        .salary-range-input::-moz-range-thumb {
            pointer-events: auto;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2px solid #dde1e6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(114, 171, 214, 0.18);
            cursor: pointer;
        }

        .salary-range-input::-webkit-slider-runnable-track {
            background: transparent;
            height: 2px;
        }

        .salary-range-input::-moz-range-track {
            background: transparent;
            height: 2px;
        }
    </style>
    <script>
        (() => {
            const countrySelect = document.getElementById('country');
            const stateSelect = document.getElementById('state');
            const titleInput = document.getElementById('title');
            const descriptionInput = document.getElementById('description');
            const aiButton = document.getElementById('ai-generate-description');
            const aiMessage = document.getElementById('ai-generate-description-message');
            const aiButtonLabel = document.getElementById('ai-generate-description-label');
            const aiSpinner = document.getElementById('ai-generate-description-spinner');
            const minimumSalarySlider = document.getElementById('minimum_salary_slider');
            const maximumSalarySlider = document.getElementById('maximum_salary_slider');
            const minimumSalaryInput = document.getElementById('minimum_salary_input');
            const maximumSalaryInput = document.getElementById('maximum_salary_input');
            const minimumSalaryValue = document.getElementById('minimum_salary_value');
            const maximumSalaryValue = document.getElementById('maximum_salary_value');
            const salaryRangePreview = document.getElementById('salary_range_preview');
            const salaryTrackActive = document.getElementById('salary_track_active');
            if (!countrySelect || !stateSelect || !titleInput || !descriptionInput || !aiButton || !aiMessage || !
                aiButtonLabel || !aiSpinner || !minimumSalarySlider || !maximumSalarySlider || !minimumSalaryInput || !
                maximumSalaryInput || !minimumSalaryValue || !maximumSalaryValue || !salaryRangePreview || !
                salaryTrackActive) return;
            let aiLoadingDots = null;

            const selectedCountry = countrySelect.dataset.selected || '';
            const selectedState = stateSelect.dataset.selected || '';

            const setOptions = (el, options, placeholder, selected = '') => {
                el.innerHTML = `<option value="">${placeholder}</option>`;
                options.forEach((opt) => {
                    const option = document.createElement('option');
                    option.value = opt.value;
                    option.textContent = opt.label;
                    if (selected && selected === opt.value) option.selected = true;
                    el.appendChild(option);
                });
            };

            const setStateLoading = (isLoading, placeholder = 'Select state') => {
                stateSelect.disabled = isLoading;
                if (isLoading) {
                    stateSelect.innerHTML = `<option value="">${placeholder}</option>`;
                }
            };

            const fetchCountries = async () => {
                const res = await fetch("{{ route('admin.locations.db.countries') }}", {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Failed to load countries');
                return res.json();
            };

            const fetchStates = async (countryName) => {
                const url = "{{ route('admin.locations.db.states') }}" + '?country=' + encodeURIComponent(
                    countryName);
                const res = await fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Failed to load states');
                return res.json();
            };

            const loadStatesForCountry = async (preferredState = '') => {
                if (!countrySelect.value) {
                    setOptions(stateSelect, [], 'Select state');
                    stateSelect.disabled = true;
                    return;
                }

                setStateLoading(true, 'Loading states...');
                const states = await fetchStates(countrySelect.value);
                const options = states.map((item) => ({
                    value: item.name,
                    label: item.name
                }));
                const hasPreferred = options.some((item) => item.value === preferredState);
                if (preferredState && !hasPreferred) {
                    options.unshift({
                        value: preferredState,
                        label: preferredState
                    });
                }
                setOptions(stateSelect, options, 'Select state', preferredState);
                stateSelect.disabled = false;
            };

            const setAiMessage = (text, isError = false) => {
                aiMessage.textContent = text;
                aiMessage.classList.toggle('hidden', !text);
                aiMessage.classList.toggle('text-red-600', isError);
                aiMessage.classList.toggle('text-gray-500', !isError);
            };

            const setAiLoadingState = (isLoading) => {
                aiButton.disabled = isLoading;
                aiButton.classList.toggle('opacity-60', isLoading);
                aiButton.classList.toggle('cursor-not-allowed', isLoading);
                aiSpinner.classList.toggle('hidden', !isLoading);
                aiButtonLabel.textContent = isLoading ? 'Generating...' : 'Fill with AI';

                if (aiLoadingDots) {
                    clearInterval(aiLoadingDots);
                    aiLoadingDots = null;
                }

                if (isLoading) {
                    let dots = 1;
                    aiLoadingDots = setInterval(() => {
                        setAiMessage(`Generating description${'.'.repeat(dots)}`);
                        dots = dots >= 3 ? 1 : dots + 1;
                    }, 350);
                }
            };

            const toggleAiButton = () => {
                aiButton.classList.toggle('hidden', titleInput.value.trim() === '');
            };

            const formatNumber = (value) => Number(value).toLocaleString('en-US');

            const syncSalarySliderState = (source) => {
                let min = Number(minimumSalarySlider.value);
                let max = Number(maximumSalarySlider.value);

                if (min > max) {
                    if (source === 'min') {
                        max = min;
                        maximumSalarySlider.value = String(max);
                    } else {
                        min = max;
                        minimumSalarySlider.value = String(min);
                    }
                }

                minimumSalaryValue.textContent = formatNumber(min);
                maximumSalaryValue.textContent = formatNumber(max);
                salaryRangePreview.textContent = `IDR ${formatNumber(min)} - ${formatNumber(max)}`;
                minimumSalaryInput.value = String(min);
                maximumSalaryInput.value = String(max);

                const sliderMin = Number(minimumSalarySlider.min);
                const sliderMax = Number(minimumSalarySlider.max);
                const leftPercent = ((min - sliderMin) / (sliderMax - sliderMin)) * 100;
                const rightPercent = ((max - sliderMin) / (sliderMax - sliderMin)) * 100;

                salaryTrackActive.style.left = `${leftPercent}%`;
                salaryTrackActive.style.width = `${Math.max(rightPercent - leftPercent, 0)}%`;
                minimumSalarySlider.style.zIndex = min >= max - 500000 ? '5' : '4';
            };

            const generateDescription = async () => {
                const title = titleInput.value.trim();
                if (title === '') return;

                if (descriptionInput.value.trim() !== '') {
                    const shouldReplace = confirm('Replace current job description with AI generated content?');
                    if (!shouldReplace) return;
                }

                setAiLoadingState(true);

                try {
                    const res = await fetch("{{ route('admin.jobs.ai-description') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            title,
                            type: document.getElementById('type')?.value || null,
                            country: countrySelect.value || null,
                            state: stateSelect.value || null
                        })
                    });

                    const data = await res.json();
                    if (!res.ok) {
                        throw new Error(data.message || 'Failed to generate description');
                    }

                    descriptionInput.value = data.description || '';
                    setAiMessage('Description generated successfully.');
                } catch (error) {
                    setAiMessage(error.message, true);
                } finally {
                    setAiLoadingState(false);
                }
            };

            const init = async () => {
                try {
                    setStateLoading(true);
                    const countries = await fetchCountries();
                    const countryOptions = countries.map((item) => ({
                        value: item.name,
                        label: item.name
                    }));

                    const hasSelectedCountry = countryOptions.some((item) => item.value === selectedCountry);
                    if (selectedCountry && !hasSelectedCountry) {
                        countryOptions.unshift({
                            value: selectedCountry,
                            label: selectedCountry
                        });
                    }

                    setOptions(countrySelect, countryOptions, 'Select country', selectedCountry);

                    if (selectedCountry) {
                        await loadStatesForCountry(selectedState);
                    } else {
                        stateSelect.disabled = true;
                    }
                } catch (error) {
                    console.error(error);
                    setStateLoading(true, 'Unable to load states');
                }
            };

            countrySelect.addEventListener('change', () => {
                loadStatesForCountry();
            });
            titleInput.addEventListener('input', toggleAiButton);
            aiButton.addEventListener('click', generateDescription);
            minimumSalarySlider.addEventListener('input', () => syncSalarySliderState('min'));
            maximumSalarySlider.addEventListener('input', () => syncSalarySliderState('max'));

            init();
            toggleAiButton();
            syncSalarySliderState();
        })();
    </script>
@endsection
