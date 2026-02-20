<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — {{ \App\Models\SiteSetting::siteName() }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">    @vite(['resources/css/app.css'])
</head>

<body
    class="flex min-h-screen items-center justify-center bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
    <div class="w-full max-w-md px-6">
        <div class="rounded-3xl bg-white px-8 py-10 shadow-[0_30px_80px_rgba(31,95,70,0.15)]">
            <div class="mb-8 text-center">
                <img src="{{ asset('images/logo.webp') }}" alt="StaffLink" class="mx-auto h-14 w-auto" loading="lazy" />
                <h1 class="mt-4 text-2xl font-semibold text-[#2e2e2e]">Admin Login</h1>
                <p class="mt-1 text-sm text-[#6b6b66]">Sign in to manage your website content</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-[#2e2e2e]">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-xl border border-[#d7d9e4] px-4 py-3 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20"
                        placeholder="admin@stafflink.pro" />
                </div>
                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-[#2e2e2e]">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full rounded-xl border border-[#d7d9e4] px-4 py-3 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20"
                        placeholder="••••••••" />
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 rounded border-[#d7d9e4] text-[#287854] focus:ring-[#287854]/20" />
                    <label for="remember" class="text-sm text-[#6b6b66]">Remember me</label>
                </div>
                <button type="submit"
                    class="w-full rounded-xl bg-[#287854] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1f5f46]">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>

</html>
