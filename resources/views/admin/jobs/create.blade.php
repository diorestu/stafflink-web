@extends('admin.layout')

@section('page-title', 'Add New Job')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Job Details</h3>
            </div>
            <form action="{{ route('admin.jobs.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                        placeholder="e.g. Senior Software Engineer">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Job Description *</label>
                        <button type="button" id="ai-generate-description" class="hidden inline-flex items-center gap-2 bg-[#287854] hover:bg-[#1f5f46] text-white text-xs px-3 py-2 rounded-md font-medium">
                            <svg id="ai-generate-description-spinner" class="hidden w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle class="opacity-30" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span id="ai-generate-description-label">Fill with AI</span>
                        </button>
                    </div>
                    <textarea name="description" id="description" rows="8" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                        placeholder="Describe the role, responsibilities, and requirements...">{{ old('description') }}</textarea>
                    <p id="ai-generate-description-message" class="mt-2 text-xs text-gray-500 hidden"></p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                        <select name="country" id="country" required data-selected="{{ old('country') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                            <option value="">Select country</option>
                        </select>
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                        <select name="state" id="state" required data-selected="{{ old('state') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                            <option value="">Select state</option>
                        </select>
                        @error('state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                            <option value="full-time" {{ old('type') === 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ old('type') === 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ old('type') === 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="salary_range" class="block text-sm font-medium text-gray-700 mb-2">Salary Range</label>
                        <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="e.g. $80,000 - $120,000">
                        @error('salary_range')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.jobs.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2 rounded-lg font-medium">
                        Create Job
                    </button>
                </div>
            </form>
        </div>
    </div>
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
            if (!countrySelect || !stateSelect || !titleInput || !descriptionInput || !aiButton || !aiMessage || !aiButtonLabel || !aiSpinner) return;
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
                const url = "{{ route('admin.locations.db.states') }}" + '?country=' + encodeURIComponent(countryName);
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
                    return;
                }

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
                    }
                } catch (error) {
                    console.error(error);
                }
            };

            countrySelect.addEventListener('change', () => {
                loadStatesForCountry();
            });
            titleInput.addEventListener('input', toggleAiButton);
            aiButton.addEventListener('click', generateDescription);

            init();
            toggleAiButton();
        })();
    </script>
@endsection
