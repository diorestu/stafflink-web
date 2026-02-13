<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - {{ \App\Models\SiteSetting::siteName() }} CMS</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        @keyframes stafflink-toast-pop {
            0% {
                opacity: 0;
                transform: translateY(-10px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .stafflink-toast {
            box-shadow: 0 10px 30px rgba(31, 95, 70, 0.12) !important;
            animation: stafflink-toast-pop 260ms ease-out;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- WordPress-style Sidebar -->
        <aside class="w-64 bg-[#1f5f46] text-white flex-shrink-0">
            <div class="p-6">
                <h1 class="text-lg font-bold">StaffLink CMS</h1>
            </div>
            <nav class="mt-6 text-[80%]">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-6 py-3 hover:bg-[#287854] {{ request()->routeIs('admin.dashboard') ? 'bg-[#287854] border-l-4 border-[#b28b2e]' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <div class="mt-4">
                    <p class="px-6 text-[10px] uppercase text-white/60 font-semibold mb-2">Content</p>
                    <a href="{{ route('admin.pages.index') }}"
                        class="flex items-center px-6 py-3 hover:bg-[#287854] {{ request()->routeIs('admin.pages.*') ? 'bg-[#287854] border-l-4 border-[#b28b2e]' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-6m-8-8h8m0 0v8m0-8L10 14" />
                        </svg>
                        Pages
                    </a>
                    <a href="{{ route('admin.jobs.index') }}"
                        class="flex items-center px-6 py-3 hover:bg-[#287854] {{ request()->routeIs('admin.jobs.*') ? 'bg-[#287854] border-l-4 border-[#b28b2e]' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Careers
                    </a>
                    <a href="{{ route('admin.appointments.index') }}"
                        class="flex items-center px-6 py-3 hover:bg-[#287854] {{ request()->routeIs('admin.appointments.*') ? 'bg-[#287854] border-l-4 border-[#b28b2e]' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>
                        Appointments
                    </a>
                </div>

                <div class="mt-4">
                    <p class="px-6 text-[10px] uppercase text-white/60 font-semibold mb-2">Settings</p>
                    <a href="{{ route('admin.header-footer.edit') }}"
                        class="flex items-center px-6 py-3 hover:bg-[#287854] {{ request()->routeIs('admin.header-footer.*') ? 'bg-[#287854] border-l-4 border-[#b28b2e]' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Header and Footer
                    </a>
                    <a href="{{ url('/') }}" target="_blank"
                        class="flex items-center px-6 py-3 hover:bg-[#287854]">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        View Website
                    </a>
                </div>
            </nav>

            <div class="absolute bottom-0 w-64 border-t border-white/10 bg-[#1b553f]/80 px-5 py-4">
                <div class="flex items-center justify-between rounded-xl bg-white/5 px-3 py-2">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-full bg-[#b28b2e] flex items-center justify-center text-xs font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="text-xs font-medium truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-md p-1 text-white/70 hover:bg-white/10 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v8m-5.66-5.66a8 8 0 1011.32 0" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-8">
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
<script>
    (() => {
        if (!window.Toastify) return;

        const success = @json(session('success'));
        const error = @json(session('error'));
        const info = @json(session('info'));
        const warnings = @json(session('warning'));
        const errors = @json($errors->all());

        const showToast = (text, type = 'success') => {
            if (!text) return;
            Toastify({
                text,
                duration: 4000,
                gravity: 'top',
                position: 'center',
                close: true,
                stopOnFocus: true,
                className: 'stafflink-toast',
                style: {
                    background: '#ffffff',
                    color: '#1b1b18',
                    border: '1px solid #287854',
                    borderRadius: '20px',
                },
            }).showToast();
        };

        showToast(success, 'success');
        showToast(error, 'error');
        showToast(info, 'info');
        showToast(warnings, 'warning');
        (errors || []).forEach((msg) => showToast(msg, 'error'));
    })();
</script>

</html>
