<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-uppercase tracking-[0.2em] text-slate-500 text-xs font-bold mb-2">{{ __('Private orders') }}</p>
            <h2 class="text-3xl font-bold text-slate-900">{{ __('My Orders') }}</h2>
            <p class="mt-2 text-slate-600">{{ __('Review every order in a private space tied to your own account only.') }}</p>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @if ($orders->isNotEmpty())
            <div class="overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ __('Order history') }}</h3>
                            <p class="mt-1 text-sm text-slate-600">{{ __('Only orders belonging to your account are shown here.') }}</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-700">
                            {{ __('Continue shopping') }}
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Order') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Placed') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Items') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Status') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Total') }}</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.18em] text-slate-500">{{ __('Details') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-6 py-5 text-sm font-semibold text-slate-900">#{{ $order->id }}</td>
                                <td class="px-6 py-5 text-sm text-slate-600">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-5 text-sm text-slate-600">{{ $order->items_count }}</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-slate-900">${{ number_format($order->total_price, 2) }}</td>
                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center rounded-full border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                                        <i class="bi bi-eye me-2"></i>
                                        {{ __('View') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($orders->hasPages())
            <div class="rounded-[1.5rem] border border-slate-200/80 bg-white px-6 py-5 shadow-sm">
                {{ $orders->links() }}
            </div>
            @endif
            @else
            <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-white px-6 py-12 text-center shadow-sm">
                <h3 class="text-2xl font-bold text-slate-900">{{ __("You haven't placed any orders yet.") }}</h3>
                <p class="mt-3 text-slate-600">{{ __('Browse the latest products and your future orders will appear in this private orders area automatically.') }}</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center rounded-full bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-700">
                    {{ __('Go shopping') }}
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>