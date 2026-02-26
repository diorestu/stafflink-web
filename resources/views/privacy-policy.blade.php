<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Privacy Policy',
        'seoDescription' => 'Read the Privacy Policy describing how StaffLink collects and uses personal data.',
        'seoKeywords' => 'privacy policy, stafflink privacy, personal data policy',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-[#2e2e2e]" id="page-top">
    @include('partials.gtm-noscript')
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)]">
        <x-site-header />

        <main class="px-6 pb-24 pt-12 lg:px-10">
            <section class="mx-auto max-w-5xl space-y-8">
                <div class="rounded-[30px] bg-[#1f5f46] p-10 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)]" data-aos="fade-up">
                    <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]">Legal</p>
                    <h1 class="mt-4 text-4xl font-semibold">Privacy Policy</h1>
                    <p class="mt-4 max-w-3xl text-sm text-white/90">This policy explains how we collect, use, and protect your personal information.</p>
                </div>

                <article class="rounded-[24px] bg-white p-8 shadow-[0_16px_40px_rgba(31,95,70,0.1)] article-content" data-aos="fade-up">
                    <h2>1. Information We Collect</h2>
                    <p>We may collect personal information you provide directly, including name, email, phone number, company details, and recruitment/application data.</p>

                    <h2>2. How We Use Information</h2>
                    <p>We use data to deliver staffing services, process applications, respond to inquiries, schedule appointments, and improve our website and operations.</p>

                    <h2>3. Data Sharing</h2>
                    <p>We only share data when necessary for service delivery, legal compliance, or with trusted partners operating under confidentiality obligations.</p>

                    <h2>4. Data Retention</h2>
                    <p>We retain personal data only as long as necessary for business, legal, and recruitment purposes.</p>

                    <h2>5. Data Security</h2>
                    <p>We apply reasonable technical and organizational measures to protect personal data against unauthorized access, loss, or misuse.</p>

                    <h2>6. Your Rights</h2>
                    <p>You may request access, correction, or deletion of your personal data where applicable by contacting us.</p>

                    <h2>7. Policy Updates</h2>
                    <p>This Privacy Policy may be updated periodically. The latest version on this page will apply.</p>

                    <h2>8. Contact</h2>
                    <p>For privacy-related requests, please contact us via <a href="{{ route('contact') }}">Contact Us</a>.</p>
                </article>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
