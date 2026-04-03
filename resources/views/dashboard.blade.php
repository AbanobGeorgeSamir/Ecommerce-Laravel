<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-uppercase tracking-[0.2em] text-slate-500 text-xs font-bold mb-2">Customer dashboard</p>
            <h2 class="text-3xl font-bold text-slate-900">{{ __('Order History') }}</h2>
            <p class="mt-2 text-slate-600">{{ __('Track your recent purchases and keep an eye on order status in one place.') }}</p>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
            $orders = auth()->user()->orders()->latest()->get();
            @endphp

            @if ($orders->isNotEmpty())
            <div class="overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Order</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Placed</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-6 py-5 text-sm font-semibold text-slate-900">#{{ $order->id }}</td>
                                <td class="px-6 py-5 text-sm text-slate-600">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-slate-900">${{ number_format($order->total_price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-white px-6 py-12 text-center shadow-sm">
                <h3 class="text-2xl font-bold text-slate-900">{{ __("You haven't placed any orders yet.") }}</h3>
                <p class="mt-3 text-slate-600">{{ __('Browse the latest products and your future orders will show up here automatically.') }}</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-700">
                    {{ __('Go Shopping') }}
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>