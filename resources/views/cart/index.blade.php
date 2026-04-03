@extends('layouts.app')

@section('content')
<section class="mb-4 mb-lg-5 fade-up">
    <div class="section-heading">
        <div>
            <h1 class="display-6 fw-bold mb-2">Your cart</h1>
            <p>Review quantities, remove items, and confirm your total before checkout.</p>
        </div>
        <span class="product-badge">{{ count($cart) }} {{ \Illuminate\Support\Str::plural('item', count($cart)) }}</span>
    </div>
</section>

@php
$total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
@endphp

@if (count($cart))
<div class="row g-4">
    <div class="col-lg-8">
        <div class="store-card store-panel">
            <div class="d-grid gap-3">
                @foreach ($cart as $id => $item)
                @php
                $subtotal = $item['price'] * $item['quantity'];
                @endphp
                <div class="store-soft-card p-3 p-lg-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="rounded-4 overflow-hidden bg-light flex-shrink-0" style="width: 84px; height: 84px;">
                                    @if (!empty($item['image']))
                                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                                        <i class="bi bi-image fs-3"></i>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <h2 class="h5 fw-bold mb-1">{{ $item['name'] }}</h2>
                                    <p class="mb-2 text-secondary">{{ '$' . number_format($item['price'], 2) }} each</p>
                                    @if (!empty($item['slug']))
                                    <a href="{{ route('products.show', $item['slug']) }}" class="text-decoration-none fw-semibold">View product</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2 justify-content-md-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" name="action" value="decrease" class="btn store-btn-secondary store-pill px-3">-</button>
                                <span class="fw-bold px-3">{{ $item['quantity'] }}</span>
                                <button type="submit" name="action" value="increase" class="btn store-btn-secondary store-pill px-3">+</button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-between justify-content-md-end align-items-center gap-3">
                                <span class="product-price mb-0">${{ number_format($subtotal, 2) }}</span>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <a href="{{ route('products.index') }}" class="btn store-btn-secondary store-pill px-4">Continue shopping</a>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none fw-semibold">Clear cart</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="store-card store-panel sticky-top" style="top: 6rem;">
            <h2 class="h4 fw-bold mb-4">Order summary</h2>
            <div class="store-summary-item">
                <span class="text-secondary">Subtotal</span>
                <strong>${{ number_format($total, 2) }}</strong>
            </div>
            <div class="store-summary-item">
                <span class="text-secondary">Shipping</span>
                <strong class="text-success">Free</strong>
            </div>
            <div class="store-summary-item fs-5">
                <span class="fw-bold">Total</span>
                <strong>${{ number_format($total, 2) }}</strong>
            </div>
            <a href="{{ route('checkout') }}" class="btn store-btn-primary store-pill w-100 py-3 fw-bold mt-4">Proceed to checkout</a>
        </div>
    </div>
</div>
@else
<div class="store-empty">
    <i class="bi bi-bag-x fs-1 d-block mb-3 text-secondary"></i>
    <h2 class="h4 fw-bold mb-2">Your cart is empty</h2>
    <p class="text-secondary mb-4">Add a few products and they’ll appear here with a live total and quick quantity controls.</p>
    <a href="{{ route('products.index') }}" class="btn store-btn-primary store-pill px-4">Start shopping</a>
</div>
@endif
@endsection