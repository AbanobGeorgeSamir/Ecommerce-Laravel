<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-bold text-brand hover:text-brand-deep">
                <i class="bi bi-arrow-left me-2"></i>
                {{ __('Back to my orders') }}
            </a>
            <h2 class="mt-4 text-3xl font-bold text-slate-900">{{ __('Order') }} #{{ $order->id }}</h2>
            <p class="mt-2 text-slate-600">{{ __('Placed on') }} {{ $order->created_at->format('F d, Y \\a\\t h:i A') }}</p>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <h3 class="text-xl font-bold text-slate-900">{{ __('Order items') }}</h3>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach ($order->items as $item)
                        <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-lg font-bold text-slate-900">{{ optional($item->product)->name ?? __('Product removed') }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ __('Quantity') }}: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-sm sm:text-right">
                                <p class="text-slate-600">{{ __('Unit price') }}: ${{ number_format($item->price, 2) }}</p>
                                <p class="mt-1 text-lg font-bold text-slate-900">${{ number_format($item->subtotal, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-[1.75rem] border border-slate-200/80 bg-white p-6 shadow-sm sm:p-8">
                        <h3 class="text-xl font-bold text-slate-900">{{ __('Summary') }}</h3>

                        <div class="mt-6 space-y-4">
                            <div class="flex items-center justify-between rounded-3xl bg-slate-50 px-4 py-4">
                                <span class="text-sm font-bold uppercase tracking-[0.14em] text-slate-500">{{ __('Status') }}</span>
                                <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between rounded-3xl bg-slate-50 px-4 py-4">
                                <span class="text-sm font-bold uppercase tracking-[0.14em] text-slate-500">{{ __('Items') }}</span>
                                <span class="text-lg font-bold text-slate-900">{{ $order->items->sum('quantity') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-3xl bg-slate-50 px-4 py-4">
                                <span class="text-sm font-bold uppercase tracking-[0.14em] text-slate-500">{{ __('Total') }}</span>
                                <span class="text-lg font-bold text-slate-900">${{ number_format($order->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[1.75rem] border border-slate-200/80 bg-white p-6 shadow-sm sm:p-8">
                        <h3 class="text-xl font-bold text-slate-900">{{ __('Delivery details') }}</h3>

                        <div class="mt-6 space-y-4 text-sm text-slate-600">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Name') }}</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">{{ $order->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Email') }}</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">{{ $order->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Address') }}</p>
                                <p class="mt-2 whitespace-pre-line text-base font-semibold text-slate-900">{{ $order->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>