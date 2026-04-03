<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ecommerce') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="store-shell d-flex flex-column min-vh-100">
        @include('layouts.navigation')

        @isset($header)
        <section class="container py-4 py-lg-5">
            <div class="store-card store-panel fade-up">
                {{ $header }}
            </div>
        </section>
        @endisset

        <main class="flex-grow-1 py-4 py-lg-5">
            <div class="container">
                @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 px-4 py-3 mb-4 fade-up">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger border-0 shadow-sm rounded-4 px-4 py-3 mb-4 fade-up">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                @if (isset($slot))
                {{ $slot }}
                @else
                @yield('content')
                @endif
            </div>
        </main>

        <footer class="store-footer mt-auto">
            <div class="container py-5">
                <div class="row g-4 align-items-center">

                    <div class="col-lg-5">
                        <p class="store-brand mb-2">{{ config('app.name', 'Ecommerce') }}</p>
                        <h2 class="h4 text-white fw-bold mb-3">
                            Designed for easier discovery, faster checkout, and a calmer shopping flow.
                        </h2>
                        <p class="mb-0">
                            Browse thoughtfully curated products, manage your cart in seconds,
                            and keep every order in one place.
                        </p>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <p class="text-uppercase small fw-bold text-white-50 mb-3">Explore</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('home') }}">Storefront</a>
                            <a href="{{ route('products.index') }}">Products</a>
                            <a href="{{ route('about') }}">About</a>
                            <a href="{{ route('contact') }}">Contact</a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="store-soft-card store-panel h-100">
                            <p class="text-uppercase small fw-bold text-secondary mb-3">
                                Why customers stay
                            </p>

                            <div class="d-grid gap-2">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="bi bi-truck text-primary"></i>
                                    <span>Fast delivery updates and clear order states</span>
                                </div>

                                <div class="d-flex gap-2 align-items-center">
                                    <i class="bi bi-shield-check text-primary"></i>
                                    <span>Protected checkout experience with stock validation</span>
                                </div>

                                <div class="d-flex gap-2 align-items-center">
                                    <i class="bi bi-stars text-primary"></i>
                                    <span>Sharper browsing with category and search filters</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pt-4 mt-4 border-top border-light border-opacity-10 d-flex flex-column flex-md-row gap-2 justify-content-between small">
                    <span>&copy; {{ now()->year }} Ecommerce. All rights reserved.</span>
                    <span>Built with Laravel for a smoother storefront and admin workflow.</span>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>