<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | {{ config('app.name', 'Laravel Store') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="admin-shell">
        <div class="container-fluid">
            <div class="row">
                <aside class="col-lg-3 col-xl-2 admin-sidebar px-3 px-md-4 py-4">
                    <div class="d-flex align-items-center gap-3 mb-5">
                        <div class="rounded-4 bg-white bg-opacity-10 p-3">
                            <i class="bi bi-grid-1x2-fill fs-4"></i>
                        </div>
                        <div>
                            <div class="store-brand small text-white-50 mb-1">{{ config('app.name', 'Laravel Store') }}</div>
                            <div class="fw-bold fs-5">Admin Console</div>
                        </div>
                    </div>

                    <div class="nav flex-column gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam me-2"></i>Products
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-tags me-2"></i>Categories
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-receipt-cutoff me-2"></i>Orders
                        </a>
                    </div>

                    <div class="mt-5 pt-4 border-top border-light border-opacity-10">
                        <div class="d-grid gap-2">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="bi bi-shop me-2"></i>Return to Store
                            </a>
                            <a href="{{ route('profile.edit') }}" class="nav-link">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start">
                                    <i class="bi bi-box-arrow-right me-2"></i>Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </aside>

                <main class="col-lg-9 col-xl-10 px-0">
                    <header class="admin-topbar px-4 px-lg-5 py-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center">
                            <div>
                                <p class="text-uppercase small fw-bold text-secondary mb-2">Administration</p>
                                <h1 class="h3 fw-bold mb-1">@yield('page_title', 'Dashboard')</h1>
                                <p class="text-secondary mb-0">Stay on top of catalog quality, orders, and revenue in one workspace.</p>
                            </div>
                            <div class="store-soft-card px-3 py-2 d-inline-flex align-items-center gap-3">
                                <div class="rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center" style="width: 2.75rem; height: 2.75rem;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                                    <div class="small text-secondary">Administrator</div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <section class="px-4 px-lg-5 py-4 py-lg-5">
                        @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 px-4 py-3 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 px-4 py-3 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                        @endif

                        @yield('content')
                    </section>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>