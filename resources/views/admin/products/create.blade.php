@extends('layouts.admin-layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Add New Product</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-success-soft text-success p-3 rounded-3 me-3">
                            <i class="bi bi-plus-circle fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0">Create New Product</h2>
                            <p class="text-muted mb-0">Fill in the details to add a product to your inventory.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Product Name</label>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="e.g. iPhone 15 Pro" value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Category</label>
                                    <select name="category_id" class="form-select form-control-lg @error('category_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                                placeholder="0.00" value="{{ old('price') }}" required>
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
                                                placeholder="0" value="{{ old('stock', 0) }}" required>
                                        </div>
                                        @error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-bold text-muted small text-uppercase">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        rows="5" placeholder="Describe the product features..." required>{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-4 bg-light rounded-4 border border-dashed h-100 d-flex flex-column justify-content-center text-center">
                                    <label class="form-label fw-bold text-muted small text-uppercase d-block mb-3">Product Media</label>

                                    <div class="mb-3">
                                        <i class="bi bi-cloud-arrow-up display-4 text-muted"></i>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label small fw-semibold">Select Image File</label>
                                        <input type="file" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror" required>
                                        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <p class="x-small text-muted mt-3 mb-0">
                                        <i class="bi bi-shield-check"></i> Files are stored in <strong>public/images</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-5">
                            <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                                <i class="bi bi-check-lg me-2"></i> Save Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-link text-muted px-4 text-decoration-none">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection