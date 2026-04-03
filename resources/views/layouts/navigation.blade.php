@php
$user = auth()->user();
$isAdmin = $user?->is_admin ?? false;
$storefrontRoute = $isAdmin ? route('admin.dashboard') : route('home');
$ordersRoute = $isAdmin ? route('admin.orders.index') : route('orders.index');
@endphp

<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex justify-between h-16 items-center">
            <a href="{{ $storefrontRoute }}" class="flex items-center gap-2 text-decoration-none">
                <span class="bg-primary text-white rounded-md flex items-center justify-center w-9 h-9">
                    <i class="bi bi-bag-heart-fill"></i>
                </span>
                <span class="font-bold text-gray-800 text-lg">Ecommerce</span>
            </a>

            <div class="hidden sm:flex space-x-8 items-center">
                <a href="{{ $storefrontRoute }}" class="nav-link-breeze flex items-center gap-2">
                    <i class="bi bi-shop"></i>
                    Storefront
                </a>

                <a href="{{ route('products.index') }}" class="nav-link-breeze flex items-center gap-2">
                    <i class="bi bi-grid"></i>
                    Products
                </a>

                <a href="{{ route('about') }}" class="nav-link-breeze flex items-center gap-2">
                    <i class="bi bi-info-circle"></i>
                    About
                </a>

                <a href="{{ route('contact') }}" class="nav-link-breeze flex items-center gap-2">
                    <i class="bi bi-envelope"></i>
                    Contact
                </a>

                @auth
                <a href="{{ $ordersRoute }}" class="nav-link-breeze flex items-center gap-2">
                    <i class="bi bi-receipt-cutoff"></i>
                    Orders
                </a>

                @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="nav-link-breeze flex items-center gap-2">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                @endif
                @endauth
            </div>

            <div class="hidden sm:flex items-center gap-4">
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-gray-700 hover:text-primary transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary rounded-md px-4 py-2 text-sm">
                    Register
                </a>
                @endguest

                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 text-sm text-red-600 hover:text-red-800">
                        Logout
                    </button>
                </form>
                @endauth
            </div>

            <button class="sm:hidden" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <i class="bi bi-list text-2xl"></i>
            </button>
        </div>
    </div>

    <div class="collapse sm:hidden px-4 pb-4" id="mobileMenu">
        <div class="flex flex-col gap-3 mt-3">
            <a href="{{ $storefrontRoute }}" class="nav-link-breeze flex items-center gap-2">Storefront</a>
            <a href="{{ route('products.index') }}" class="nav-link-breeze flex items-center gap-2">Products</a>
            <a href="{{ route('about') }}" class="nav-link-breeze flex items-center gap-2">About</a>
            <a href="{{ route('contact') }}" class="nav-link-breeze flex items-center gap-2">Contact</a>

            @auth
            <a href="{{ $ordersRoute }}" class="nav-link-breeze flex items-center gap-2">Orders</a>

            @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="nav-link-breeze flex items-center gap-2">Dashboard</a>
            @endif

            <a href="{{ route('cart.index') }}" class="nav-link-breeze flex items-center gap-2">Cart</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link-breeze text-left w-full text-red-600">Logout</button>
            </form>
            @endauth

            @guest
            <hr>
            <a href="{{ route('login') }}" class="nav-link-breeze">Login</a>
            <a href="{{ route('register') }}" class="nav-link-breeze text-primary font-semibold">Register</a>
            @endguest
        </div>
    </div>
</nav>
<style>
    .nav-link-breeze {
        font-size: 0.9rem;
        color: #6b7280;
        padding: 6px 4px;
        border-bottom: 2px solid transparent;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .nav-link-breeze:hover {
        color: #111827;
        border-color: #e5e7eb;
    }

    .active-link {
        color: #2563eb !important;
        border-bottom: 2px solid #2563eb;
        font-weight: 600;
    }
</style>