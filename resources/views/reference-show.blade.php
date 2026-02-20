<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => 'Reference Info | '.\App\Models\SiteSetting::siteName(),
        'seoDescription' => 'Reference information page.',
        'seoRobots' => 'noindex, nofollow',
        'seoStructuredData' => false,
    ])
    @vite(['resources/css/app.css'])
</head>

<body class="text-[#2e2e2e]">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)] px-6 py-10">
        <div class="mx-auto max-w-3xl rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]">
            <p class="text-xs uppercase tracking-[0.25em] text-[#287854]">Reference Contact</p>
            <h1 class="mt-3 text-3xl font-semibold text-[#1b1b18]">Candidate Reference Information</h1>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 text-sm">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#6b6b66]">Applicant</p>
                    <p class="mt-1 font-semibold">{{ $application->full_name }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#6b6b66]">Position</p>
                    <p class="mt-1 font-semibold">{{ $application->position_title }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#6b6b66]">Reference Name</p>
                    <p class="mt-1 font-semibold">{{ $application->reference_name ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#6b6b66]">Company</p>
                    <p class="mt-1 font-semibold">{{ $application->reference_company ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#6b6b66]">Phone</p>
                    <p class="mt-1 font-semibold">{{ $application->reference_phone ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#6b6b66]">Email</p>
                    <p class="mt-1 font-semibold">{{ $application->reference_email ?: '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
