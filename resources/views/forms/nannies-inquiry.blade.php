<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Wedding Nanny Service Inquiry Form',
        'seoDescription' => 'Submit a nanny service inquiry for wedding childcare support in Bali.',
        'seoKeywords' => 'nanny inquiry form, wedding childcare, bali nanny service',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />

        <main class="px-6 pb-24 pt-12">
            <section class="mx-auto max-w-4xl space-y-8">
                @php
                    $prefillWedding = $prefillWedding ?? null;
                    $eventToken = $eventToken ?? '';
                @endphp
                <div class="rounded-[30px] bg-[#708868] p-8 text-white shadow-[0_20px_50px_rgba(112,136,104,0.28)] sm:p-10"
                    data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e6f0e1]">Wedding Childcare Form</p>
                    <h1 class="mt-4 text-3xl font-semibold leading-tight sm:text-4xl">
                        Wedding Nanny Service Inquiry Form
                    </h1>
                    <p class="mt-4 text-sm leading-relaxed text-white/90">
                        Please fill out this form to book professional childcare during the wedding weekend.
                    </p>
                    <p class="mt-3 rounded-2xl border border-white/20 bg-white/10 p-4 text-sm leading-relaxed text-white/90">
                        Note: The wedding ceremony is adults-only. The hosts are kindly subsidizing the first hour of service per family during the ceremony. Any additional hours or services at your accommodation are to be paid directly to the nanny team.
                    </p>
                </div>

                <div class="rounded-[28px] bg-white p-7 shadow-[0_20px_50px_rgba(31,95,70,0.12)] sm:p-8" data-aos="fade-up"
                    data-aos-delay="120">
                    <form class="grid gap-8" method="POST" action="{{ route('forms.nannies-inquiry.store') }}" data-nannies-inquiry-form>
                        @csrf
                        @if ($prefillWedding)
                            <div class="rounded-2xl border border-[#d7e8df] bg-[#f6faf8] p-4 text-sm text-[#1f5f46]">
                                Wedding details are pre-filled by the host.
                            </div>
                        @endif
                        <section class="space-y-4">
                            <h2 class="text-xl font-semibold text-[#1b1b18]">1. Wedding Details</h2>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="wedding_couple_names">Wedding of (Bride and Groom's Full Names)</label>
                                <input id="wedding_couple_names" name="wedding_couple_names" type="text" required
                                    value="{{ old('wedding_couple_names', $prefillWedding['wedding_couple_names'] ?? '') }}"
                                    placeholder="Example: Sarah Johnson & Michael Lee"
                                    @if ($prefillWedding) readonly @endif
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none {{ $prefillWedding ? 'bg-[#f7faf8] text-[#4b5b53]' : '' }}">
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="grid gap-2">
                                    <label class="text-sm font-semibold" for="wedding_date">Wedding Date</label>
                                    <input id="wedding_date" name="wedding_date" type="date" required
                                        value="{{ old('wedding_date', $prefillWedding['wedding_date'] ?? '') }}"
                                        @if ($prefillWedding) readonly @endif
                                        class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none {{ $prefillWedding ? 'bg-[#f7faf8] text-[#4b5b53]' : '' }}">
                                </div>
                                <div class="grid gap-2">
                                    <label class="text-sm font-semibold" for="wedding_start_time">Wedding Start Time</label>
                                    <input id="wedding_start_time" name="wedding_start_time" type="time" required
                                        value="{{ old('wedding_start_time', $prefillWedding['wedding_start_time'] ?? '') }}"
                                        @if ($prefillWedding) readonly @endif
                                        class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none {{ $prefillWedding ? 'bg-[#f7faf8] text-[#4b5b53]' : '' }}">
                                </div>
                            </div>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="wedding_location_address">Wedding Location Address</label>
                                <textarea id="wedding_location_address" name="wedding_location_address" rows="2" required
                                    placeholder="Full address of the wedding location"
                                    @if ($prefillWedding) readonly @endif
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none {{ $prefillWedding ? 'bg-[#f7faf8] text-[#4b5b53]' : '' }}">{{ old('wedding_location_address', $prefillWedding['wedding_location_address'] ?? '') }}</textarea>
                            </div>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="wedding_venue_name">Hotel / Villa Name of Venue (Optional)</label>
                                <input id="wedding_venue_name" name="wedding_venue_name" type="text"
                                    value="{{ old('wedding_venue_name', $prefillWedding['wedding_venue_name'] ?? '') }}"
                                    placeholder="Example: The Ritz-Carlton Bali"
                                    @if ($prefillWedding) readonly @endif
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none {{ $prefillWedding ? 'bg-[#f7faf8] text-[#4b5b53]' : '' }}">
                            </div>
                        </section>

                        <section class="space-y-4">
                            <h2 class="text-xl font-semibold text-[#1b1b18]">2. Parent / Guardian Information</h2>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="guardian_name">Full Name</label>
                                <input id="guardian_name" name="guardian_name" type="text" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="guardian_phone">Phone Number / WhatsApp</label>
                                <div class="grid grid-cols-[130px_1fr] gap-2">
                                    <input id="guardian_country_code" name="guardian_country_code" type="text" required
                                        value="+61"
                                        placeholder="+61"
                                        class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <input id="guardian_phone_local" name="guardian_phone_local" type="text" required
                                        placeholder="Phone number"
                                        class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                </div>
                                <input id="guardian_phone" name="guardian_phone" type="hidden">
                            </div>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="guardian_email">Email Address</label>
                                <input id="guardian_email" name="guardian_email" type="email" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                        </section>

                        <section class="space-y-4">
                            <h2 class="text-xl font-semibold text-[#1b1b18]">3. Child(ren) Details</h2>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="children_count">Number of Children</label>
                                <select id="children_count" name="children_count" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled selected>Select number of children</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4+">4+</option>
                                </select>
                            </div>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="nannies_required">Number of Nannies Needed</label>
                                <select id="nannies_required" name="nannies_required" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                    <option value="" disabled selected>Select number of nannies</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5+">5+</option>
                                </select>
                            </div>

                            <div class="space-y-3" data-children-rows></div>
                            <div class="hidden rounded-xl border border-[#dfe8e3] bg-[#f7faf8] px-4 py-3 text-xs text-[#5a5a55]"
                                data-children-plus-note>
                                For more than 4 children, add remaining child details in the Additional Hours field below.
                            </div>
                        </section>

                        <section class="space-y-4">
                            <h2 class="text-xl font-semibold text-[#1b1b18]">4. Service Requirements</h2>

                            <div class="rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] p-4">
                                <p class="text-sm font-semibold text-[#1f5f46]">Accommodation Location</p>
                                <div class="mt-3 space-y-2">
                                    <label class="flex items-start gap-3 text-sm">
                                        <input type="radio" class="mt-1 h-4 w-4 border-[#b6cbc0] text-[#287854] focus:ring-[#287854]"
                                            name="accommodation_location_option" value="wedding" required
                                            data-accommodation-location-option>
                                        <span>At the wedding</span>
                                    </label>
                                    <label class="flex items-start gap-3 text-sm">
                                        <input type="radio" class="mt-1 h-4 w-4 border-[#b6cbc0] text-[#287854] focus:ring-[#287854]"
                                            name="accommodation_location_option" value="prior" required
                                            data-accommodation-location-option>
                                        <span>Prior to the wedding</span>
                                    </label>
                                </div>
                                <div class="mt-3 hidden grid gap-2" data-accommodation-detail-wrap>
                                    <label class="text-sm font-semibold" for="accommodation_detail">Detail Location</label>
                                    <input id="accommodation_detail" name="accommodation_detail" type="text"
                                        placeholder="Please input detail location"
                                        data-accommodation-detail-input
                                        class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                </div>
                            </div>

                            <div class="rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] p-4">
                                <p class="text-sm font-semibold text-[#1f5f46]">Wedding Ceremony Service (Subsidized)</p>
                                <div class="mt-3 space-y-2">
                                    <label class="flex items-start gap-3 text-sm">
                                        <input type="radio" class="mt-1 h-4 w-4 border-[#b6cbc0] text-[#287854] focus:ring-[#287854]"
                                            name="ceremony_service_choice" value="yes" required data-ceremony-choice>
                                        <span>Yes, I would like to use the 1-hour subsidized service during the ceremony.</span>
                                    </label>
                                    <label class="flex items-start gap-3 text-sm">
                                        <input type="radio" class="mt-1 h-4 w-4 border-[#b6cbc0] text-[#287854] focus:ring-[#287854]"
                                            name="ceremony_service_choice" value="no" required data-ceremony-choice>
                                        <span>No, i will pay by myself.</span>
                                    </label>
                                </div>
                            </div>

                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="additional_hours">Additional Hours Needed (Optional)</label>
                                <textarea id="additional_hours" name="additional_hours" rows="3"
                                    placeholder="Please list specific dates and times you would like to book a nanny outside of the subsidized hour."
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"></textarea>
                            </div>
                        </section>

                        <section class="space-y-4">
                            <h2 class="text-xl font-semibold text-[#1b1b18]">5. Agreement</h2>
                            <p class="text-sm font-semibold text-[#1f5f46]">Payment Acknowledgement</p>

                            <label class="flex items-start gap-3 rounded-xl border border-[#dfe8e3] bg-[#f7faf8] p-4 text-sm">
                                <input type="radio" class="mt-1 h-4 w-4 border-[#b6cbc0] text-[#287854] focus:ring-[#287854]"
                                    name="payment_acknowledgement" value="agreed" required>
                                <span>
                                    I understand this booking is NOT confirmed until i make full payment.
                                </span>
                            </label>
                        </section>

                        <div class="flex flex-wrap gap-3 pt-2">
                            <button type="submit"
                                class="inline-flex rounded-full bg-[#287854] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#1f5f46]">
                                Submit Inquiry
                            </button>
                            <a href="{{ route('contact') }}"
                                class="inline-flex rounded-full border border-[#287854] px-6 py-3 text-sm font-semibold text-[#287854] transition hover:bg-[#ecf7f1]">
                                Contact Us
                            </a>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <x-site-footer />
    </div>

    @once
        <script>
            (() => {
                const form = document.querySelector('[data-nannies-inquiry-form]');
                if (!form) return;

                const childrenCountSelect = form.querySelector('#children_count');
                const childrenRowsContainer = form.querySelector('[data-children-rows]');
                const childrenPlusNote = form.querySelector('[data-children-plus-note]');
                const guardianCountryCodeInput = form.querySelector('#guardian_country_code');
                const guardianPhoneLocalInput = form.querySelector('#guardian_phone_local');
                const guardianPhoneInput = form.querySelector('#guardian_phone');
                const accommodationOptions = Array.from(form.querySelectorAll('[data-accommodation-location-option]'));
                const accommodationDetailWrap = form.querySelector('[data-accommodation-detail-wrap]');
                const accommodationDetailInput = form.querySelector('[data-accommodation-detail-input]');
                const ceremonyChoices = Array.from(form.querySelectorAll('[data-ceremony-choice]'));

                const normalize = (value) => String(value || '').trim();
                const toChildCount = (value) => {
                    if (value === '4+') return 4;
                    const parsed = Number.parseInt(value, 10);
                    if (Number.isNaN(parsed) || parsed < 1) return 0;
                    return parsed;
                };

                const createChildRow = (index) => {
                    const row = document.createElement('div');
                    row.className = 'rounded-xl border border-[#dfe8e3] bg-[#f7faf8] p-4 space-y-3';
                    row.dataset.childRow = String(index);
                    row.innerHTML = `
                        <p class="text-sm font-semibold text-[#1f5f46]">Child ${index}</p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="child_name_${index}">Name</label>
                                <input id="child_name_${index}" name="child_name[]" type="text" required
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                            <div class="grid gap-2">
                                <label class="text-sm font-semibold" for="child_age_${index}">Age</label>
                                <input id="child_age_${index}" name="child_age[]" type="text" required
                                    placeholder="Example: 3 years old"
                                    class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                            </div>
                        </div>
                        <div class="grid gap-2">
                            <label class="text-sm font-semibold" for="child_special_${index}">Special Requirements</label>
                            <textarea id="child_special_${index}" name="child_special_requirement[]" rows="2"
                                placeholder="Allergies, routines, or medical notes"
                                class="w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"></textarea>
                        </div>
                    `;
                    return row;
                };

                const renderChildrenRows = () => {
                    if (!childrenCountSelect || !childrenRowsContainer || !childrenPlusNote) return;

                    const selected = normalize(childrenCountSelect.value);
                    const count = toChildCount(selected);

                    childrenRowsContainer.innerHTML = '';

                    if (count > 0) {
                        for (let i = 1; i <= count; i++) {
                            childrenRowsContainer.appendChild(createChildRow(i));
                        }
                    }

                    childrenPlusNote.classList.toggle('hidden', selected !== '4+');
                };

                if (childrenCountSelect) {
                    childrenCountSelect.addEventListener('change', renderChildrenRows);
                    renderChildrenRows();
                }

                const syncAccommodationDetailState = () => {
                    if (!accommodationDetailWrap || !accommodationDetailInput) return;

                    const selectedAccommodation = accommodationOptions.find((option) => option.checked)?.value || '';
                    const isPriorToWedding = selectedAccommodation === 'prior';

                    accommodationDetailWrap.classList.toggle('hidden', !isPriorToWedding);
                    accommodationDetailInput.required = isPriorToWedding;

                    if (!isPriorToWedding) {
                        accommodationDetailInput.value = '';
                    }
                };

                accommodationOptions.forEach((option) => {
                    option.addEventListener('change', syncAccommodationDetailState);
                });
                syncAccommodationDetailState();

                const syncGuardianPhone = () => {
                    if (!guardianPhoneInput) return;
                    const countryCode = normalize(guardianCountryCodeInput?.value || '');
                    const phoneLocal = normalize(guardianPhoneLocalInput?.value || '');
                    guardianPhoneInput.value = [countryCode, phoneLocal].filter(Boolean).join(' ');
                };

                guardianCountryCodeInput?.addEventListener('input', syncGuardianPhone);
                guardianPhoneLocalInput?.addEventListener('input', syncGuardianPhone);
                syncGuardianPhone();

                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    syncGuardianPhone();

                    if (!form.reportValidity()) {
                        return;
                    }

                    const data = new FormData(form);
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton?.textContent || 'Submit Inquiry';

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.textContent = 'Submitting...';
                    }

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: data,
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        });
                        const payload = await response.json();

                        if (!response.ok) {
                            const message = payload?.errors
                                ? Object.values(payload.errors).flat().join('\n')
                                : (payload?.message || 'Failed to submit inquiry.');
                            alert(message);
                            return;
                        }

                        if (payload?.whatsapp_url) {
                            window.open(payload.whatsapp_url, '_blank', 'noopener');
                        }

                        alert('Inquiry submitted successfully. We will continue via WhatsApp.');
                        form.reset();
                        renderChildrenRows();
                        syncAccommodationDetailState();
                        ceremonyChoices.forEach((item) => {
                            item.checked = false;
                        });
                    } catch (error) {
                        alert('Failed to submit inquiry. Please try again.');
                    } finally {
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.textContent = originalButtonText;
                        }
                    }
                });
            })();
        </script>
    @endonce
</body>

</html>
