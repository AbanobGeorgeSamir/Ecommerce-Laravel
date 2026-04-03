@extends('layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.orders.index') }}" class="text-decoration-none small text-muted">
            <i class="bi bi-arrow-left me-1"></i> Back to Orders
        </a>
        <div class="d-flex justify-content-between align-items-end mt-2">
            <h1 class="fw-bold text-dark mb-0">Order #{{ $order->id }}</h1>
            <div class="text-muted">Placed on {{ $order->created_at->format('F d, Y at h:i A') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-0">Order Items</h5>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 small text-muted">Product</th>
                                <th class="small text-muted text-center">Qty</th>
                                <th class="small text-muted text-end">Price</th>
                                <th class="px-4 small text-muted text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr class="border-b">
                                <td class="px-4 py-2">
                                    <div class="fw-semibold text-dark">
                                        {{ optional($item->product)->name ?? 'Product removed' }}
                                    </div>
                                </td>
                                <td class="text-center px-4 py-2">
                                    {{ $item->quantity }}
                                </td>
                                <td class="text-end px-4 py-2">
                                    ${{ number_format($item->price, 2) }}
                                </td>
                                <td class="px-4 py-2 text-end fw-bold">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold py-3">Grand Total</td>
                                <td class="px-4 text-end fw-bold py-3 text-primary fs-5">${{ number_format($order->total_price, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Order Status</h5>
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf @method('PATCH')
                        <select name="status" class="form-select rounded-3 mb-3" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <p class="small text-muted mb-0"><i class="bi bi-info-circle me-1"></i> Changing status triggers update notifications.</p>
                    </form>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Customer Details</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold text-dark">{{ $order->user->name }}</div>
                            <div class="small text-muted">Customer ID: #{{ $order->user_id }}</div>
                        </div>
                    </div>
                    <hr class="text-muted opacity-25">
                    <div class="mb-2">
                        <div class="small text-muted text-uppercase fw-bold">Email</div>
                        <div>{{ $order->user->email }}</div>
                    </div>
                    <div>
                        <div class="small text-muted text-uppercase fw-bold">Shipping Address</div>
                        <div class="small">{{ $order->address ?? 'No address provided' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection