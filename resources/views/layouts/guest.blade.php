<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Store') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="auth-shell">
        <section class="auth-showcase d-flex align-items-center">
            <div class="auth-copy-card p-4 p-lg-5">
                <a href="{{ route('home') }}" class="d-inline-flex align-items-center gap-3 text-decoration-none text-dark mb-5">
                    <x-application-logo class="w-16 h-16 fill-current text-[color:var(--store-primary)]" />
                    <div>
                        <div class="store-brand small mb-1">{{ config('app.name', 'Laravel Store') }}</div>
                        <div class="text-secondary">Elegant ecommerce built with Laravel.</div>
                    </div>
                </a>

                <p class="hero-kicker mb-4">
                    <span class="rounded-circle bg-white" style="width: 0.5rem; height: 0.5rem;"></span>
                    Seamless shopping journey
                </p>
                <h1 class="display-5 fw-bold mb-3">Make every sign-in and checkout step feel lighter.</h1>
                <p class="fs-5 text-secondary mb-5">Explore curated products, save time with a cleaner dashboard, and place orders with clearer feedback at every step.</p>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="auth-stat h-100">
                            <div class="small text-uppercase fw-bold text-secondary mb-2">Browsing</div>
                            <div class="fw-bold fs-4 mb-1">Faster product discovery</div>
                            <p class="mb-0 text-secondary">Search, categories, and better product visibility across the store.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="auth-stat h-100">
                            <div class="small text-uppercase fw-bold text-secondary mb-2">Confidence</div>
                            <div class="fw-bold fs-4 mb-1">Cleaner checkout flow</div>
                            <p class="mb-0 text-secondary">Stock-aware cart actions and clearer order summaries before purchase.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="auth-panel d-flex align-items-center justify-content-center p-4 p-lg-5">
            <div class="w-full max-w-md rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-2xl backdrop-blur sm:p-8">
                {{ $slot }}
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>