<header class="sticky top-0 z-50 px-6 pt-6" data-aos="fade-down">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-8 rounded-full bg-white/95 px-10 py-4 shadow-[0_14px_34px_rgba(31,95,70,0.2)] backdrop-blur">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="StaffLink logo" class="h-14 w-auto" draggable="false" />
        </div>
        <nav class="hidden items-center gap-6 text-sm text-[#4a4a45] lg:flex">
            <a href="{{ url('/') }}" class="transition hover:text-[#1b1b18]">Home</a>
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    About us
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-4 hidden w-72 rounded-2xl bg-white p-6 text-sm text-[#2e2e2e] shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-dropdown-menu>
                    <div class="space-y-4">
                        <a href="{{ route('who-we-are') }}" class="block transition hover:text-[#287854]">Who We Are</a>
                        <a href="{{ route('what-we-offer') }}" class="block transition hover:text-[#287854]">What We Offer</a>
                        <a href="{{ route('our-people-your-dream-team') }}" class="block transition hover:text-[#287854]">Our People, Your Dream Team</a>
                        <a href="{{ route('our-purpose-business-principles') }}" class="block transition hover:text-[#287854]">Our Purpose &amp; Business Principles</a>
                        <a href="{{ route('blog') }}" class="block transition hover:text-[#287854]">Blog</a>
                    </div>
                </div>
            </div>
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    Services
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-6 hidden w-[760px] rounded-3xl bg-white p-6 shadow-[0_24px_60px_rgba(31,95,70,0.18)]" data-dropdown-menu>
                    <div class="grid gap-8 md:grid-cols-[220px_1fr]" data-tabs>
                        <div class="space-y-3 text-sm text-[#2e2e2e]">
                            <button class="w-full rounded-xl px-4 py-3 text-left font-semibold text-[#287854] transition hover:bg-[#e6f1ec]" data-tab="airport">
                                Airport Services
                            </button>
                            <button class="w-full rounded-xl px-4 py-3 text-left font-semibold text-[#2e2e2e] transition hover:bg-[#e6f1ec]" data-tab="sectors">
                                Sectors
                            </button>
                            <button class="w-full rounded-xl px-4 py-3 text-left font-semibold text-[#2e2e2e] transition hover:bg-[#e6f1ec]" data-tab="roles">
                                Roles
                            </button>
                            <button class="w-full rounded-xl px-4 py-3 text-left font-semibold text-[#2e2e2e] transition hover:bg-[#e6f1ec]" data-tab="get-started">
                                Get Started
                            </button>
                            <button class="w-full rounded-xl px-4 py-3 text-left font-semibold text-[#2e2e2e] transition hover:bg-[#e6f1ec]" data-tab="traditional">
                                Traditional Recruitment
                            </button>
                        </div>
                        <div>
                            <div class="rounded-2xl bg-white px-6 py-6 shadow-[0_20px_40px_rgba(31,95,70,0.12)]" data-tab-panel="airport">
                                <div class="flex items-center gap-3 text-sm font-semibold text-[#2e2e2e]">
                                    <svg class="h-5 w-5 text-[#287854]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M2 16l20-4-10-4-2-6-2 2 2 5-8 3" />
                                    </svg>
                                    Airport Services
                                </div>
                                <p class="mt-3 text-sm text-[#6b6b66]">Ramp support, passenger handling, and logistics teams ready for global operations.</p>
                            </div>
                            <div class="hidden rounded-2xl bg-white px-6 py-6 shadow-[0_20px_40px_rgba(31,95,70,0.12)]" data-tab-panel="sectors">
                                <div class="flex items-center gap-3 text-sm font-semibold text-[#2e2e2e]">
                                    <svg class="h-5 w-5 text-[#287854]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3 21h18" />
                                        <path d="M5 21V7l7-4 7 4v14" />
                                        <path d="M9 21v-4h6v4" />
                                    </svg>
                                    Sectors
                                </div>
                                <p class="mt-3 text-sm text-[#6b6b66]">Specialized staffing for healthcare, hospitality, engineering, and more.</p>
                            </div>
                            <div class="hidden rounded-2xl bg-white px-6 py-6 shadow-[0_20px_40px_rgba(31,95,70,0.12)]" data-tab-panel="roles">
                                <div class="flex items-center gap-3 text-sm font-semibold text-[#2e2e2e]">
                                    <svg class="h-5 w-5 text-[#287854]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M7 9h10l-1 11H8L7 9z" />
                                        <path d="M9 9V7a3 3 0 0 1 6 0v2" />
                                    </svg>
                                    Roles
                                </div>
                                <p class="mt-3 text-sm text-[#6b6b66]">From frontline teams to leadership placements, we cover critical roles.</p>
                            </div>
                            <div class="hidden rounded-2xl bg-white px-6 py-6 shadow-[0_20px_40px_rgba(31,95,70,0.12)]" data-tab-panel="get-started">
                                <div class="flex items-center gap-3 text-sm font-semibold text-[#2e2e2e]">
                                    <svg class="h-5 w-5 text-[#287854]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 20l4-4" />
                                        <path d="M5 12l7-7 7 7-7 7-7-7z" />
                                    </svg>
                                    Get Started
                                </div>
                                <p class="mt-3 text-sm text-[#6b6b66]">Share your requirements and launch a tailored staffing plan quickly.</p>
                            </div>
                            <div class="hidden rounded-2xl bg-white px-6 py-6 shadow-[0_20px_40px_rgba(31,95,70,0.12)]" data-tab-panel="traditional">
                                <div class="flex items-center gap-3 text-sm font-semibold text-[#2e2e2e]">
                                    <svg class="h-5 w-5 text-[#287854]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M7 3h7l4 4v14H7z" />
                                        <path d="M14 3v4h4" />
                                        <path d="M9 12h6" />
                                        <path d="M9 16h6" />
                                    </svg>
                                    Traditional Recruitment
                                </div>
                                <p class="mt-3 text-sm text-[#6b6b66]">Full-cycle recruitment and managed services for high-volume hiring.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="transition hover:text-[#1b1b18]">Contact Us</a>
            <a href="{{ route('jobs.index') }}" class="transition hover:text-[#1b1b18]">Jobs</a>
            <div class="relative" data-dropdown>
                <button class="flex items-center gap-2 transition hover:text-[#1b1b18]" data-dropdown-trigger>
                    User
                    <svg class="h-3 w-3" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 1l5 5 5-5" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full mt-4 hidden w-44 rounded-2xl bg-white p-4 text-sm text-[#2e2e2e] shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-dropdown-menu>
                    <div class="space-y-3">
                        <a href="#" class="block transition hover:text-[#287854]">Sign In</a>
                        <a href="#" class="block transition hover:text-[#287854]">Register</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="flex items-center gap-3">
            <a href="{{ route('applications.create') }}" class="hidden rounded-full border border-[#b28b2e] px-4 py-2 text-sm font-semibold text-[#b28b2e] transition hover:bg-[#b28b2e] hover:text-white lg:inline-flex">Apply now</a>
            <a href="{{ route('appointments.create') }}" class="rounded-full bg-[#287854] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1f5f46]">Free Consultation</a>
        </div>
    </div>
</header>
