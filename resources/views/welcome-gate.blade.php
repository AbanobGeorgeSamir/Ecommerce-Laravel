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
    <div class="store-shell d-flex flex-column">
        <nav class="navbar navbar-expand-lg store-navbar">
            <div class="container py-2">
                <a class="navbar-brand store-brand text-dark" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel Store') }}
                </a>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="btn store-btn-secondary store-pill px-3">Log In</a>
                    <a href="{{ route('register') }}" class="btn store-btn-primary store-pill px-3">Create Account</a>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1 py-4 py-lg-5">
            <div class="container">
                <section class="store-hero p-4 p-lg-5 mt-lg-4">
                    <div class="row gy-5 align-items-center hero-grid">
                        <div class="col-lg-7">
                            <p class="hero-kicker mb-3">
                                <i class="bi bi-lightning-charge-fill"></i>
                                Better browsing starts here
                            </p>
                            <h1 class="display-3 fw-bold mb-3">A sharper Laravel storefront with smoother shopping and account flows.</h1>
                            <p class="fs-5 text-white-50 mb-4">Browse the store as a guest, sign in to manage orders, or create an account for faster checkout and a cleaner customer dashboard.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('register') }}" class="btn store-btn-primary store-pill px-4 py-3 fw-bold">Create account</a>
                                <a href="{{ route('login') }}" class="btn store-btn-secondary store-pill px-4 py-3 fw-bold">Sign in</a>
                                <a href="{{ route('home') }}" class="btn btn-link text-white text-decoration-none fw-bold">Browse as guest</a>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="store-card store-panel">
                                <div class="d-grid gap-3">
                                    <div class="store-soft-card p-4">
                                        <div class="d-flex gap-3">
                                            <i class="bi bi-search fs-3 text-primary"></i>
                                            <div>
                                                <h2 class="h5 fw-bold mb-1">Cleaner discovery</h2>
                                                <p class="mb-0 text-secondary">Search products, filter by category, and move through the catalog with less clutter.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-soft-card p-4">
                                        <div class="d-flex gap-3">
                                            <i class="bi bi-bag-check fs-3 text-primary"></i>
                                            <div>
                                                <h2 class="h5 fw-bold mb-1">Smoother checkout</h2>
                                                <p class="mb-0 text-secondary">Clearer cart controls, live totals, and stock validation right before order placement.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-soft-card p-4">
                                        <div class="d-flex gap-3">
                                            <i class="bi bi-speedometer2 fs-3 text-primary"></i>
                                            <div>
                                                <h2 class="h5 fw-bold mb-1">Improved admin flow</h2>
                                                <p class="mb-0 text-secondary">A calmer dashboard for managing products, categories, and orders in one place.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>