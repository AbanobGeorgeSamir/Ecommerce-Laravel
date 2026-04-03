@extends('layouts.admin-layout')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="fw-bold text-dark mb-1">Categories</h1>
      <p class="text-muted mb-0">Manage your store product groupings</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-pill px-4">
      <i class="bi bi-plus-lg me-1"></i> Add Category
    </a>
  </div>

  @if(session('success'))
  <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
    {{ session('success') }}
  </div>
  @endif

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
          <tr>
            <th class="px-4 py-3 text-uppercase small fw-bold text-muted">Name</th>
            <th class="py-3 text-uppercase small fw-bold text-muted">Slug</th>
            <th class="py-3 text-uppercase small fw-bold text-muted text-center">Products</th>
            <th class="px-4 py-3 text-uppercase small fw-bold text-muted text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $category)
          <tr>
            <td class="px-4">
              <span class="fw-bold text-dark">{{ $category->name }}</span>
              <div class="small text-muted text-truncate" style="max-width: 200px;">{{ $category->description ?? 'No description' }}</div>
            </td>
            <td><code>/{{ $category->slug }}</code></td>
            <td class="text-center">
              <span class="badge bg-primary-soft text-primary rounded-pill px-3">
                {{ $category->products_count }} items
              </span>
            </td>
            <td class="px-4 text-end">
              <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-light rounded-3">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-light text-danger rounded-3">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center py-5 text-muted">No categories found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($categories->hasPages())
    <div class="card-footer bg-white border-0 py-3">
      {{ $categories->links() }}
    </div>
    @endif
  </div>
</div>
@endsection