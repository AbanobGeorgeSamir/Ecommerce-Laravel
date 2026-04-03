@extends('layouts.app')

@section('content')
<section class="mb-4 mb-lg-5 fade-up">
    <div class="section-heading">
        <div>
            <h1 class="display-6 fw-bold mb-2">Explore the collection</h1>
            <p>Use search and category filters to narrow in on what fits best.</p>
        </div>
        @auth
        @if (auth()->user()->is_admin)
        <a href="{{ route('admin.products.create') }}" class="btn store-btn-primary store-pill px-4">Add product</a>
        @endif
        @endauth
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="store-filter">
        <div class="row g-3 align-items-end">
            <div class="col-md-6">
                <label for="search" class="form-label fw-semibold">Search products</label>
                <input id="search" name="search" type="text" class="form-control" value="{{ request('search') }}" placeholder="Search by product name">
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label fw-semibold">Category</label>
                <select id="category" name="category" class="form-select">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category')===$category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn store-btn-primary py-3">Apply</button>
            </div>
        </div>
    </form>
</section>

<section>
    <div class="row g-4">
        @forelse ($products as $product)
        <div class="col-sm-6 col-lg-4 col-xl-3">
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
                    <span class="product-badge">{{ $product->category?->name ?? 'Uncategorized' }}</span>
                    @if ($product->stock <= 0)
                        <span class="badge text-bg-danger rounded-pill">Sold out</span>
                        @elseif ($product->stock <= 5)
                            <span class="badge text-bg-warning rounded-pill">Only {{ $product->stock }} left</span>
                            @else
                            <span class="small text-secondary">{{ $product->stock }} in stock</span>
                            @endif
                </div>

                <h2 class="h5 fw-bold mb-2">{{ $product->name }}</h2>
                <p class="text-secondary mb-4">{{ \Illuminate\Support\Str::limit($product->description, 88) }}</p>

                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="product-price">{{ $product->formatted_price }}</span>
                        <a href="{{ route('products.show', $product) }}" class="text-decoration-none fw-semibold">Details</a>
                    </div>

                    @if ($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="d-grid">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn store-btn-primary store-pill py-3">Add to cart</button>
                    </form>
                    @else
                    <a href="{{ route('products.show', $product) }}" class="btn store-btn-secondary store-pill w-100 py-3">View product</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="store-empty">
                <i class="bi bi-search fs-1 d-block mb-3 text-secondary"></i>
                <h2 class="h4 fw-bold mb-2">No products matched your filters</h2>
                <p class="text-secondary mb-4">Try a broader search or clear the category filter to see more results.</p>
                <a href="{{ route('products.index') }}" class="btn store-btn-primary store-pill px-4">Reset filters</a>
            </div>
        </div>
        @endforelse
    </div>

    @if ($products->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
    @endif
</section>
@endsection