@extends('layouts.admin-layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Edit #{{ $product->id }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-soft text-primary p-3 rounded-3 me-3">
                                <i class="bi bi-pencil-square fs-3"></i>
                            </div>
                            <h2 class="fw-bold mb-0">Edit Product</h2>
                        </div>
                        <span class="badge bg-light text-muted p-2">Last Updated: {{ $product->updated_at->diffForHumans() }}</span>
                    </div>

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Product Name</label>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        value="{{ old('name', $product->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Category</label>
                                    <select name="category_id" class="form-select form-control-lg @error('category_id') is-invalid @enderror" required>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold text-muted small text-uppercase">Price ($)</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-white border-end-0">$</span>
                                            <input type="number" step="0.01" name="price"
                                                class="form-control border-start-0 @error('price') is-invalid @enderror"
                                                value="{{ old('price', $product->price) }}" required>
                                        </div>
                                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold text-muted small text-uppercase">Stock Quantity</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-box-seam"></i>
                                            </span>
                                            <input type="number" name="stock"
                                                class="form-control border-start-0 @error('stock') is-invalid @enderror"
                                                value="{{ old('stock', $product->stock) }}" required>
                                        </div>
                                        @error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        rows="6" required>{{ old('description', $product->description) }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-4 bg-light rounded-4 border border-dashed h-100">
                                    <label class="form-label fw-bold text-muted small text-uppercase d-block mb-3">Product Media</label>

                                    @if($product->image && file_exists(public_path('images/' . $product->image)))
                                    <div class="mb-4 text-center">
                                        <p class="small text-muted mb-2">Current Preview</p>
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('images/' . $product->image) }}"
                                                class="img-thumbnail rounded-3 shadow-sm"
                                                style="max-height: 200px; width: auto; object-fit: cover;">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="mb-0">
                                        <label class="form-label small fw-semibold">Upload New Image</label>
                                        <input type="file" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror">

                                        <div class="form-text x-small mt-2">
                                            <i class="bi bi-info-circle me-1"></i> Leave blank to keep current image.
                                        </div>
                                        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                                <i class="bi bi-cloud-check me-2"></i> Update Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-link text-muted px-4 text-decoration-none">
                                Cancel Changes
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection