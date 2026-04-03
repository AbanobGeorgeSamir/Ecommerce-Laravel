@extends('layouts.admin-layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item active">Product Details</li>
            </ol>
        </nav>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-light d-flex align-items-center justify-content-center border-end">
                        @if($product->image && file_exists(public_path('images/'.$product->image)))
                        <img src="{{ asset('images/'.$product->image) }}" class="img-fluid p-3" style="max-height: 400px; object-fit: contain;">
                        @else
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-image display-1 opacity-25"></i>
                            <p class="small mt-2">No Image Uploaded</p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-3">
                                @if($product->stock > 0)
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 small mb-2">In Stock</span>
                                @else
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 small mb-2">Out of Stock</span>
                                @endif
                                <h2 class="fw-bold text-dark mb-1">{{ $product->name }}</h2>
                                <h3 class="text-primary fw-bold mb-4">${{ number_format($product->price, 2) }}</h3>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold text-muted small text-uppercase tracking-wider d-block mb-2">Description</label>
                                <p class="text-secondary lh-lg">{{ $product->description }}</p>
                            </div>

                            <div class="d-flex gap-2 pt-3 border-top">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                    <i class="bi bi-pencil-square me-2"></i> Edit Product
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Permanently delete this product?')" class="btn btn-link text-danger text-decoration-none px-3">
                                        <i class="bi bi-trash3 me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Inventory & Meta</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">Current Stock</span>
                        <span class="fw-bold small {{ $product->stock <= 5 ? 'text-danger' : 'text-dark' }}">
                            {{ $product->stock }} Units
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">System ID</span>
                        <span class="fw-semibold small">#PROD-{{ $product->id }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">Created On</span>
                        <span class="fw-semibold small">{{ $product->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">Last Modified</span>
                        <span class="fw-semibold small text-end">{{ $product->updated_at->diffForHumans() }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-0">
                        <span class="text-muted small">Slug</span>
                        <code class="small text-primary">{{ $product->slug ?? Str::slug($product->name) }}</code>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-primary rounded-4 text-white shadow-sm">
                <h6 class="fw-bold mb-2">Quick Stats</h6>
                <p class="small opacity-75">Status: <strong>{{ $product->stock > 0 ? 'Available' : 'Unavailable' }}</strong></p>
                <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                    <div class="progress-bar bg-white"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection