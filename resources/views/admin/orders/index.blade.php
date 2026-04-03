@extends('layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Orders</h1>
            <p class="text-muted mb-0">Manage customer purchases and fulfillment</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-uppercase small fw-bold text-muted">Order ID</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Customer</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Date</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Total</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                        <th class="px-4 py-3 text-uppercase small fw-bold text-muted text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-4 fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $order->user->name }}</div>
                            <div class="small text-muted">{{ $order->user->email }}</div>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="fw-bold">${{ number_format($order->total_price, 2) }}</td>
                        <td>
                            @php
                            $statusClass = match($order->status) {
                            'pending' => 'bg-warning-soft text-warning',
                            'processing' => 'bg-info-soft text-info',
                            'shipped' => 'bg-primary-soft text-primary',
                            'delivered' => 'bg-success-soft text-success',
                            'cancelled' => 'bg-danger-soft text-danger',
                            default => 'bg-light text-muted',
                            };
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 text-uppercase small">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-4 text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-light rounded-3 px-3">
                                <i class="bi bi-eye me-1"></i> View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection