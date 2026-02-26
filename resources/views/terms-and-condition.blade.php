<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Terms & Condition',
        'seoDescription' => 'Read the Terms & Condition for using StaffLink services and website.',
        'seoKeywords' => 'terms and condition, stafflink terms, website terms',
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
                    <h1 class="mt-4 text-4xl font-semibold">Terms & Condition</h1>
                    <p class="mt-4 max-w-3xl text-sm text-white/90">By using this website and our services, you agree to the terms below.</p>
                </div>

                <article class="rounded-[24px] bg-white p-8 shadow-[0_16px_40px_rgba(31,95,70,0.1)] article-content" data-aos="fade-up">
                    <h2>1. Use of Website</h2>
                    <p>This website is provided for general information about StaffLink services. You agree to use it lawfully and not misuse any content or functionality.</p>

                    <h2>2. Service Information</h2>
                    <p>We strive to keep all service and vacancy information accurate, but details can change at any time without prior notice.</p>

                    <h2>3. Intellectual Property</h2>
                    <p>All content on this website, including text, graphics, logos, and design elements, remains the property of StaffLink or its licensors unless stated otherwise.</p>

                    <h2>4. Limitation of Liability</h2>
                    <p>StaffLink is not liable for any direct or indirect loss arising from use of this website, except where required by applicable law.</p>

                    <h2>5. External Links</h2>
                    <p>This website may contain links to third-party websites. We are not responsible for the content, terms, or privacy practices of those websites.</p>

                    <h2>6. Changes to Terms</h2>
                    <p>We may update these Terms & Condition from time to time. Continued use of the website means you accept the latest version.</p>

                    <h2>7. Contact</h2>
                    <p>For legal or policy questions, please contact us via <a href="{{ route('contact') }}">Contact Us</a>.</p>
                </article>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
