@extends('layouts.app')

@section('content')
<section class="store-hero p-4 p-lg-5 mb-5 fade-up">
    <div class="row align-items-center gy-4 hero-grid">
        <div class="col-lg-7">
            <p class="hero-kicker mb-3">
                <i class="bi bi-stars"></i>
                Modern essentials for everyday living
            </p>
            <h1 class="display-4 fw-bold mb-3">A cleaner storefront for discovering products you actually want to keep.</h1>
            <p class="fs-5 text-white-50 mb-4">Browse fresh arrivals, filter by category, and move from discovery to checkout with less friction and clearer feedback.</p>
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}" class="btn store-btn-primary store-pill px-4 py-3 fw-bold">Shop the collection</a>
                <a href="#categories" class="btn store-btn-secondary store-pill px-4 py-3 fw-bold">Explore categories</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="store-card store-panel">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="metric-chip w-100 justify-content-center">
                            <i class="bi bi-box-seam"></i>
                            <span>{{ $featuredProducts->count() }} featured picks</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="metric-chip w-100 justify-content-center">
                            <i class="bi bi-tags"></i>
                            <span>{{ $categories->count() }} live categories</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-grid gap-3">
                    @foreach ($newArrivals->take(2) as $product)
                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none">
                        <div class="store-soft-card p-3">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="rounded-4 overflow-hidden bg-light flex-shrink-0" style="width: 88px; height: 88px;">
                                    @if ($product->image)
                                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                                        <i class="bi bi-image fs-3"></i>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="small text-uppercase text-secondary fw-bold mb-1">{{ $product->category?->name ?? 'Collection' }}</p>
                                    <h3 class="h6 fw-bold mb-1">{{ $product->name }}</h3>
                                    <p class="mb-0 text-dark fw-bold">{{ $product->formatted_price }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section id="categories" class="mb-5">
    <div class="section-heading">
        <div>
            <h2>Shop by category</h2>
            <p>Jump straight into the sections customers use most.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn store-btn-secondary store-pill px-3">See all products</a>
    </div>

    <div class="row g-3">
        @forelse ($categories as $category)
        <div class="col-sm-6 col-lg-4">
            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="category-card h-100">
                <div class="icon-wrap mb-3">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <h3 class="h5 fw-bold mb-2">{{ $category->name }}</h3>
                <p class="text-secondary mb-0">{{ $category->description ?: 'Curated products organised around what customers are shopping for right now.' }}</p>
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="store-empty">No categories are available yet.</div>
        </div>
        @endforelse
    </div>
</section>

<section class="mb-5">
    <div class="section-heading">
        <div>
            <h2>Fresh arrivals</h2>
            <p>New additions ready to browse and add to cart.</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse ($newArrivals as $product)
        <div class="col-sm-6 col-xl-3">
            <div class="store-card store-panel product-card h-100">
                <a href="{{ route('products.show', $product) }}" class="product-media d-block mb-3">
                    @if ($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                        <i class="bi bi-image fs-1"></i>
                    </div>
                    @endif
                </a>
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                    <span class="product-badge">{{ $product->category?->name ?? 'General' }}</span>
                    @if ($product->stock > 0)
                    <span class="small text-secondary">{{ $product->stock }} in stock</span>
                    @else
                    <span class="badge text-bg-danger rounded-pill">Sold out</span>
                    @endif
                </div>
                <h3 class="h5 fw-bold mb-2">{{ $product->name }}</h3>
                <p class="text-secondary mb-4">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                <div class="mt-auto d-flex justify-content-between align-items-center gap-3">
                    <span class="product-price">{{ $product->formatted_price }}</span>
                    @if ($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn store-btn-primary store-pill px-3">Add to cart</button>
                    </form>
                    @else
                    <a href="{{ route('products.show', $product) }}" class="btn store-btn-secondary store-pill px-3">View details</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="store-empty">No products are available yet.</div>
        </div>
        @endforelse
    </div>
</section>

<section>
    <div class="section-heading">
        <div>
            <h2>More to explore</h2>
            <p>Popular in-stock items with stronger inventory coverage.</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse ($featuredProducts as $product)
        <div class="col-md-6 col-xl-3">
            <div class="store-soft-card store-panel info-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="product-badge">{{ $product->category?->name ?? 'Store pick' }}</span>
                    <span class="small text-secondary">Ready to ship</span>
                </div>
                <h3 class="h5 fw-bold">{{ $product->name }}</h3>
                <p class="text-secondary">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <span class="product-price">{{ $product->formatted_price }}</span>
                    <a href="{{ route('products.show', $product) }}" class="btn store-btn-secondary store-pill px-3">View</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="store-empty">Featured products will appear here once inventory is available.</div>
        </div>
        @endforelse
    </div>
</section>
@endsection