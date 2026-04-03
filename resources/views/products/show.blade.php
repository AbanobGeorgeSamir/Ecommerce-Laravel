@extends('layouts.app')

@section('content')
<section class="store-card store-panel mb-5 fade-up">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Store</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4 g-xl-5 align-items-start">
        <div class="col-lg-6">
            <div class="product-media" style="aspect-ratio: 4 / 4.4;">
                @if ($product->image)
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-secondary">
                    <i class="bi bi-image fs-1 mb-2"></i>
                    <span>No image available</span>
                </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="product-badge">{{ $product->category?->name ?? 'General' }}</span>
                @if ($product->stock > 0)
                <span class="product-badge">{{ $product->stock }} ready to ship</span>
                @else
                <span class="badge text-bg-danger rounded-pill px-3 py-2">Currently sold out</span>
                @endif
            </div>

            <h1 class="display-6 fw-bold mb-3">{{ $product->name }}</h1>
            <p class="product-price mb-4">{{ $product->formatted_price }}</p>
            <p class="text-secondary fs-5 mb-4">{{ $product->description }}</p>

            <div class="store-soft-card p-4 mb-4">
                <div class="row g-3">
                    <div class="col-sm-4">
                        <div class="small text-uppercase fw-bold text-secondary mb-1">Availability</div>
                        <div class="fw-bold">{{ $product->stock > 0 ? 'In stock' : 'Unavailable' }}</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="small text-uppercase fw-bold text-secondary mb-1">Category</div>
                        <div class="fw-bold">{{ $product->category?->name ?? 'General' }}</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="small text-uppercase fw-bold text-secondary mb-1">SKU</div>
                        <div class="fw-bold">PRD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('cart.add') }}" method="POST" class="store-soft-card p-4">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div class="row g-3 align-items-end">
                    <div class="col-sm-4">
                        <label for="quantity" class="form-label fw-semibold">Quantity</label>
                        <input id="quantity" type="number" name="quantity" value="1" min="1" max="{{ max($product->stock, 1) }}" class="form-control store-field" @disabled($product->stock <= 0)>
                    </div>
                    <div class="col-sm-8 d-grid">
                        <button type="submit" class="btn store-btn-primary store-pill py-3 fw-bold" @disabled($product->stock <= 0)>
                                {{ $product->stock > 0 ? 'Add to cart' : 'Sold out' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section>
    <div class="section-heading">
        <div>
            <h2>You may also like</h2>
            <p>Products from the same category to keep browsing momentum going.</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse ($relatedProducts as $relatedProduct)
        <div class="col-sm-6 col-xl-3">
            <div class="store-soft-card store-panel product-card h-100">
                <a href="{{ route('products.show', $relatedProduct) }}" class="product-media d-block mb-3">
                    @if ($relatedProduct->image)
                    <img src="{{ asset('images/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}">
                    @else
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                        <i class="bi bi-image fs-1"></i>
                    </div>
                    @endif
                </a>
                <h3 class="h5 fw-bold mb-2">{{ $relatedProduct->name }}</h3>
                <p class="text-secondary mb-3">{{ \Illuminate\Support\Str::limit($relatedProduct->description, 72) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="product-price">{{ $relatedProduct->formatted_price }}</span>
                    <a href="{{ route('products.show', $relatedProduct) }}" class="btn store-btn-secondary store-pill px-3">View</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="store-empty">No related products are available yet.</div>
        </div>
        @endforelse
    </div>
</section>
@endsection