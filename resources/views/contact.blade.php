<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('partials.gtag-head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('partials.seo-meta', [
            'seoTitle' => \App\Models\SiteSetting::siteName().' | Contact Us',
            'seoDescription' => 'Contact StaffLink Solutions to discuss staffing, recruitment, and consultation services for your business.',
            'seoKeywords' => 'contact staffing agency, stafflink contact, recruitment consultation',
        ])

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
        @php($wording = \App\Support\PageWording::for('contact'))
        <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
            <x-site-header />
            <main class="px-6 pb-24 pt-12">
                <section class="mx-auto max-w-6xl space-y-12">
                    <div class="overflow-hidden rounded-[32px] bg-[#1f5f46] text-white shadow-[0_20px_60px_rgba(31,95,70,0.2)]"
                        data-aos="fade-up">
                        <div class="relative overflow-hidden p-8 lg:p-7">
                            <div class="pr-0 lg:pr-56">
                                <h2 class="text-4xl font-semibold">Get in Touch</h2>
                                <p class="mt-3 text-sm text-white/85">
                                    Start solving your staffing issue and start saving money today.
                                </p>
                                <a href="{{ route('appointments.create') }}"
                                    class="mt-5 inline-flex rounded-full border border-[#b28b2e] px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-[#b28b2e]">
                                    Get a Free Consultation Today
                                </a>
                            </div>
                            <div class="pointer-events-none absolute -bottom-3 right-0 lg:-bottom-4">
                                <img src="{{ asset('images/single_img.webp') }}" alt="Get in touch"
                                    class="h-56 w-auto object-contain lg:h-60" draggable="false" loading="lazy" />
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-12 lg:grid-cols-[1fr_1.1fr]">
                        <div data-aos="fade-up">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#b28b2e]">{{ $wording['badge'] ?? 'Contact us' }}</p>
                            <h1 class="mt-4 text-4xl font-semibold">{{ $wording['title'] ?? 'Contact us' }}</h1>
                            <p class="mt-6 text-sm text-[#6b6b66]">
                                Are you new to our site and interested in learning more about our comprehensive global outsourcing
                                solutions?
                            </p>
                            <p class="mt-4 text-sm text-[#6b6b66]">
                                Are you a current client of Stafflink Solutions and want to send us your questions, feedback and
                                suggestions?
                            </p>
                            <p class="mt-4 text-sm text-[#6b6b66]">{{ $wording['subtitle'] ?? 'Simply fill out the form, and we’ll promptly respond to your enquiry.' }}</p>

                            <div class="mt-10 space-y-5 text-sm text-[#2e2e2e]">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#e6f1ec] text-[#287854]">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5">
                                            <path d="M4 4h16v16H4z" />
                                            <path d="M4 4l8 7 8-7" />
                                        </svg>
                                    </span>
                                    <a href="mailto:info@stafflink.pro" class="text-sm font-semibold">info@stafflink.pro</a>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#e6f1ec] text-[#287854]">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5">
                                            <path d="M5 4h4l2 5-2 2a12 12 0 0 0 6 6l2-2 5 2v4a2 2 0 0 1-2 2 16 16 0 0 1-14-14 2 2 0 0 1 2-2" />
                                        </svg>
                                    </span>
                                    <span class="text-sm font-semibold">+6285739660906</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#e6f1ec] text-[#287854]">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5">
                                            <path d="M12 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            <path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z" />
                                        </svg>
                                    </span>
                                    <span class="text-sm font-semibold">Seminyak, Bali</span>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]" data-aos="fade-up" data-aos-delay="150">
                            @if (session('success'))
                                <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" class="grid gap-5 sm:grid-cols-2">
                                @csrf
                                <div class="hidden" aria-hidden="true">
                                    <label for="website">Website</label>
                                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="text-sm font-semibold">Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"
                                        required />
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="text-sm font-semibold">Business Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="your@company.com"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"
                                        required />
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="text-sm font-semibold">Contact Number <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="(000) 000-0000"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"
                                        required />
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="text-sm font-semibold">Company Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Your Company"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"
                                        required />
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="text-sm font-semibold">Company Size <span class="text-red-500">*</span></label>
                                    <select name="company_size"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none"
                                        required>
                                        <option value="">Select company size</option>
                                        <option value="1-10 Employees" @selected(old('company_size') === '1-10 Employees')>1-10 Employees</option>
                                        <option value="11-50 Employees" @selected(old('company_size') === '11-50 Employees')>11-50 Employees</option>
                                        <option value="51-200 Employees" @selected(old('company_size') === '51-200 Employees')>51-200 Employees</option>
                                        <option value="201-500 Employees" @selected(old('company_size') === '201-500 Employees')>201-500 Employees</option>
                                        <option value="500+ Employees" @selected(old('company_size') === '500+ Employees')>500+ Employees</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="text-sm font-semibold">Preferred Time To Call</label>
                                    <select name="preferred_call_time"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">
                                        <option value="">No preference</option>
                                        <option value="9:00 AM" @selected(old('preferred_call_time') === '9:00 AM')>9:00 AM</option>
                                        <option value="10:00 AM" @selected(old('preferred_call_time') === '10:00 AM')>10:00 AM</option>
                                        <option value="11:00 AM" @selected(old('preferred_call_time') === '11:00 AM')>11:00 AM</option>
                                        <option value="1:00 PM" @selected(old('preferred_call_time') === '1:00 PM')>1:00 PM</option>
                                        <option value="3:00 PM" @selected(old('preferred_call_time') === '3:00 PM')>3:00 PM</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-1">
                                    <label class="text-sm font-semibold">Best Day &amp; Time to Call You</label>
                                    <input type="date" name="preferred_call_date" value="{{ old('preferred_call_date') }}"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none" />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="text-sm font-semibold">Message</label>
                                    <textarea name="message" placeholder="Message" rows="4"
                                        class="mt-2 w-full rounded-xl border border-[#d1d5db] px-4 py-3 text-sm focus:border-[#287854] focus:outline-none">{{ old('message') }}</textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <button type="submit"
                                        class="mt-2 w-full rounded-full bg-[#b28b2e] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#9b7829]">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-lg" data-aos="fade-up">
                        <div class="h-[400px] w-full">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.053958613446!2d115.16522599999999!3d-8.686418999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd247e6799ea107%3A0x11e082e1a331687!2sStaff%20Link!5e0!3m2!1sid!2sid!4v1771912308980!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </section>
            </main>
            <x-site-footer />
        </div>
        <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3" data-aos="fade-up">
            <button
                type="button"
                class="flex h-12 w-12 items-center justify-center rounded-full border border-[#b28b2e] bg-white text-[#b28b2e] shadow-lg transition hover:bg-[#b28b2e] hover:text-white"
                data-scroll-top
                aria-label="Move to top"
            >
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    aria-hidden="true">
                    <path d="M12 19V5" />
                    <path d="M6 11l6-6 6 6" />
                </svg>
            </button>
            <a
                href="https://wa.me/6285739660906"
                class="group relative flex h-16 w-16 items-center justify-center overflow-visible rounded-full bg-transparent transition"
                aria-label="WhatsApp Chat"
            >
                <img src="{{ asset('images/64px-WhatsApp.svg.png') }}" alt="WhatsApp" class="h-full w-full object-contain" draggable="false" loading="lazy" />
                <span class="pointer-events-none absolute right-full mr-3 flex items-center gap-2 whitespace-nowrap rounded-full bg-[#287854] px-4 py-2 text-[11px] font-semibold tracking-tight text-white shadow-lg opacity-0 transition duration-300 ease-out translate-x-6 scale-x-105 origin-right group-hover:translate-x-0 group-hover:opacity-100">
                    Click here to chat
                </span>
            </a>
        </div>
</body>
</html>
