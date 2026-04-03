@extends('layouts.admin-layout')

@section('content')
<div class="container-fluid">
  <div class="mb-4">
    <a href="{{ route('admin.categories.index') }}" class="text-decoration-none small text-muted">
      <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
    <h1 class="fw-bold text-dark mt-2">New Category</h1>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('admin.categories.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-bold small text-muted text-uppercase">Category Name</label>
            <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Smart Home">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold small text-muted text-uppercase">Description (Optional)</label>
            <textarea name="description" rows="4" class="form-control rounded-3" placeholder="Briefly describe what goes in this category...">{{ old('description') }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary rounded-pill px-5">Save Category</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection