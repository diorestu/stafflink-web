<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => '403 - Forbidden | '.\App\Models\SiteSetting::siteName(),
        'seoDescription' => 'You do not have permission to access this page.',
        'seoRobots' => 'noindex, nofollow',
        'seoStructuredData' => false,
    ])
    <style>
        :root {
            --green-dark: #1f5f46;
            --green-mid: #287854;
            --gold: #b28b2e;
            --cream: #f4efe0;
            --ink: #1b1b18;
            --muted: #5f6d66;
            --bg: #f3f5f4;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top, #ffffff 0%, #f4f5f3 52%, #e6f1ec 100%);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .card {
            width: 100%;
            max-width: 720px;
            background: #fff;
            border: 1px solid #d9e4df;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 24px 58px rgba(31, 95, 70, 0.18);
        }
        .head {
            background: var(--green-dark);
            border-top: 6px solid var(--gold);
            color: #fff;
            text-align: center;
            padding: 26px 24px 22px;
        }
        .head img { width: 146px; max-width: 100%; height: auto; }
        .label {
            margin: 14px 0 0;
            font-size: 12px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #e9d29d;
        }
        .code {
            margin: 10px 0 0;
            font-size: 42px;
            line-height: 1;
            font-weight: 800;
        }
        .body {
            padding: 26px 24px;
            text-align: center;
        }
        h1 {
            margin: 0;
            font-size: 26px;
            line-height: 1.25;
        }
        p {
            margin: 12px auto 0;
            max-width: 520px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
        }
        .actions {
            margin-top: 22px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 999px;
            padding: 11px 18px;
            font-size: 13px;
            font-weight: 700;
            transition: 0.2s ease;
        }
        .btn-primary {
            background: var(--green-mid);
            color: #fff;
            border: 1px solid var(--green-mid);
        }
        .btn-primary:hover { background: var(--green-dark); }
        .btn-secondary {
            background: #fff;
            color: var(--green-dark);
            border: 1px solid #b7d4c6;
        }
        .btn-secondary:hover { background: #f3faf6; }
        .foot {
            border-top: 1px solid #e5eeea;
            background: var(--cream);
            color: #5e4a1f;
            text-align: center;
            font-size: 12px;
            padding: 11px 16px;
        }
    </style>
</head>
<body>
    @include('partials.gtm-noscript')
    <main class="card">
        <header class="head">
            <img src="{{ asset('images/logo.webp') }}" alt="StaffLink logo" loading="lazy">
            <p class="label">Access Restricted</p>
            <p class="code">403</p>
        </header>
        <section class="body">
            <h1>You do not have permission to access this page.</h1>
            <p>
                Your account may not have the required role for this action.
                Please return to the previous page or contact the administrator.
            </p>
            <div class="actions">
                <a class="btn btn-primary" href="{{ url('/') }}">Back to Homepage</a>
                <a class="btn btn-secondary" href="{{ url('/contact') }}">Contact Support</a>
            </div>
        </section>
        <footer class="foot">Staff Link</footer>
    </main>
</body>
</html>
