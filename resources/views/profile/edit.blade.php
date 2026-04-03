<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-uppercase tracking-[0.2em] text-slate-500 text-xs font-bold mb-2">{{ __('Account settings') }}</p>
            <h2 class="text-3xl font-bold text-slate-900">{{ __('My Account') }}</h2>
            <p class="mt-2 text-slate-600">{{ __('Review your profile details, recent orders, and security settings in one place.') }}</p>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-6xl space-y-6">
            <div class="grid gap-6 xl:grid-cols-[0.92fr_1.08fr]">
                <div class="space-y-6">
                    <section class="overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white shadow-sm">
                        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-brand-deep px-6 py-7 text-white sm:px-8">
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/15 text-2xl font-bold uppercase">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-white/70">{{ $user->isAdmin() ? 'Administrator' : 'Customer Account' }}</p>
                                        <h3 class="mt-2 text-2xl font-bold">{{ $user->name }}</h3>
                                        <p class="mt-1 text-sm text-white/80">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <a href="{{ $user->isAdmin() ? route('admin.dashboard') : route('orders.index') }}" class="inline-flex items-center justify-center rounded-full bg-white px-4 py-3 text-sm font-bold text-slate-900 transition hover:bg-slate-100">
                                    <i class="bi bi-arrow-up-right-circle me-2"></i>
                                    {{ $user->isAdmin() ? 'Open admin dashboard' : 'Open my orders' }}
                                </a>
                            </div>
                        </div>

                        <div class="grid gap-4 px-6 py-6 sm:grid-cols-2 sm:px-8">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Orders placed') }}</p>
                                <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($user->orders_count) }}</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Total spent') }}</p>
                                <p class="mt-2 text-3xl font-bold text-slate-900">${{ number_format($totalSpent, 2) }}</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Member since') }}</p>
                                <p class="mt-2 text-lg font-bold text-slate-900">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Email status') }}</p>
                                <p class="mt-2 inline-flex items-center rounded-full px-3 py-1 text-sm font-bold {{ $user->email_verified_at ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                    <i class="bi {{ $user->email_verified_at ? 'bi-patch-check' : 'bi-envelope-exclamation' }} me-2"></i>
                                    {{ $user->email_verified_at ? __('Verified') : __('Needs verification') }}
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-[1.75rem] border border-slate-200/80 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">{{ __('Recent activity') }}</p>
                                <h3 class="mt-2 text-2xl font-bold text-slate-900">{{ __('Recent orders') }}</h3>
                            </div>
                            <a href="{{ $user->isAdmin() ? route('admin.orders.index') : route('orders.index') }}" class="inline-flex items-center text-sm font-bold text-brand hover:text-brand-deep">
                                {{ $user->isAdmin() ? __('Manage all orders') : __('View all orders') }}
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>

                        <div class="mt-6 space-y-3">
                            @forelse ($recentOrders as $order)
                            <a href="{{ $user->isAdmin() ? route('admin.orders.show', $order) : route('orders.show', $order) }}" class="flex flex-col gap-3 rounded-3xl border border-slate-200 px-4 py-4 text-decoration-none transition hover:border-slate-300 hover:bg-slate-50 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">#{{ $order->id }}</p>
                                    <p class="mt-1 text-sm text-slate-600">{{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}</p>
                                </div>
                                <div class="flex flex-col gap-2 text-sm sm:items-end">
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 font-bold text-slate-700">{{ ucfirst($order->status) }}</span>
                                    <span class="font-bold text-slate-900">${{ number_format($order->total_price, 2) }}</span>
                                </div>
                            </a>
                            @empty
                            <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-5 py-10 text-center">
                                <h4 class="text-xl font-bold text-slate-900">{{ __("No orders yet") }}</h4>
                                <p class="mt-2 text-slate-600">{{ __('Your purchases will appear here as soon as you place your first order.') }}</p>
                                <a href="{{ route('products.index') }}" class="mt-5 inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-700">
                                    {{ __('Start shopping') }}
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </section>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[1.75rem] border border-slate-200/80 bg-white p-6 shadow-sm sm:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="rounded-[1.75rem] border border-slate-200/80 bg-white p-6 shadow-sm sm:p-8">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="rounded-[1.75rem] border border-red-100 bg-white p-6 shadow-sm sm:p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>