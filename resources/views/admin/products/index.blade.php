@extends('layouts.admin-layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Product Management</h1>
            <p class="text-muted mb-0">Browse, edit, and manage your store's inventory.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-4 rounded-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
    @endif
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th class="ps-4 py-3" style="width: 80px;">ID</th>
                        <th style="width: 100px;">Preview</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-4 text-muted small">#{{ $product->id }}</td>
                        <td>
                            <div class="rounded-3 border bg-white d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; overflow: hidden;">
                                @if($product->image && file_exists(public_path('images/' . $product->image)))
                                <img src="{{ asset('images/' . $product->image) }}"
                                    class="w-100 h-100 object-fit-cover"
                                    alt="{{ $product->name }}">
                                @else
                                <div class="text-center text-muted">
                                    <i class="bi bi-image fs-4"></i>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                            <div class="text-muted small">Slug: {{ $product->slug }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border rounded-pill px-3">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="fw-bold text-primary">
                            ${{ number_format($product->price, 2) }}
                        </td>
                        <td>
                            @if($product->stock > 10)
                            <span class="text-success small fw-semibold">{{ $product->stock }} in stock</span>
                            @elseif($product->stock > 0)
                            <span class="text-warning small fw-semibold">Low: {{ $product->stock }} left</span>
                            @else
                            <span class="text-danger small fw-semibold">Out of stock</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-white btn-sm px-3 border-end" title="Edit">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-white btn-sm px-3"
                                        onclick="return confirm('Delete this product? This will also remove the image file.')" title="Delete">
                                        <i class="bi bi-trash3 text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-box2 display-4 mb-3 d-block opacity-25"></i>
                                <p class="mb-0">No products found. Start by adding a new one!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="small text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}</span>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .object-fit-cover {
        object-fit: cover;
    }

    .btn-white {
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .btn-white:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection