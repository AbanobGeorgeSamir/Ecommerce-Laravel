@extends('layouts.app')

@section('content')
@php
$total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
@endphp

<div class="row g-4 g-lg-5 fade-up">
    <div class="col-lg-7">
        <div class="store-card store-panel">
            <div class="section-heading mb-4">
                <div>
                    <h1 class="h2">Checkout</h1>
                    <p>Confirm your shipping details and place your order with confidence.</p>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger rounded-4 border-0 mb-4">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Full name</label>
                        <input id="name" name="name" class="form-control store-field" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input id="email" type="email" name="email" class="form-control store-field" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label fw-semibold">Shipping address</label>
                        <textarea id="address" name="address" rows="4" class="form-control store-field" required>{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="store-soft-card p-4 mt-4">
                    <div class="d-flex gap-3 align-items-start">
                        <i class="bi bi-shield-check fs-4 text-primary"></i>
                        <div>
                            <h2 class="h6 fw-bold mb-1">Protected order flow</h2>
                            <p class="mb-0 text-secondary">Stock is checked again when you place the order, so the final checkout remains accurate.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3 mt-4">
                    <a href="{{ route('cart.index') }}" class="btn store-btn-secondary store-pill px-4 py-3">Back to cart</a>
                    <button type="submit" id="submit-btn" class="btn store-btn-primary store-pill px-4 py-3 fw-bold">Complete purchase</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="store-card store-panel sticky-top" style="top: 6rem;">
            <h2 class="h4 fw-bold mb-4">Order summary</h2>
            <div class="d-grid gap-3 mb-4">
                @foreach ($cart as $item)
                <div class="store-summary-item py-0">
                    <div>
                        <div class="fw-semibold">{{ $item['name'] }}</div>
                        <div class="small text-secondary">Qty {{ $item['quantity'] }}</div>
                    </div>
                    <strong>${{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                </div>
                @endforeach
            </div>
            <div class="store-summary-item">
                <span class="text-secondary">Subtotal</span>
                <strong>${{ number_format($total, 2) }}</strong>
            </div>
            <div class="store-summary-item">
                <span class="text-secondary">Shipping</span>
                <strong class="text-success">Free</strong>
            </div>
            <div class="store-summary-item fs-5">
                <span class="fw-bold">Total due</span>
                <strong>${{ number_format($total, 2) }}</strong>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('checkout-form')?.addEventListener('submit', function() {
        const button = document.getElementById('submit-btn');

        if (!button) {
            return;
        }

        button.disabled = true;
        button.textContent = 'Processing order...';
    });
</script>
@endsection