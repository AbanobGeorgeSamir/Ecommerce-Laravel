@extends('layouts.admin-layout')

@section('page_title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="store-card store-panel admin-metric h-100">
            <div class="metric-icon mb-4" style="background: rgba(31, 111, 120, 0.12); color: var(--store-primary);">
                <i class="bi bi-box-seam fs-4"></i>
            </div>
            <p class="text-uppercase small fw-bold text-secondary mb-2">Products</p>
            <h2 class="display-6 fw-bold mb-2">{{ number_format($stats['products_count']) }}</h2>
            <p class="mb-0 text-secondary">Keep your catalog fresh and accurate.</p>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="store-card store-panel admin-metric h-100">
            <div class="metric-icon mb-4" style="background: rgba(242, 184, 128, 0.2); color: #9a5b18;">
                <i class="bi bi-tags fs-4"></i>
            </div>
            <p class="text-uppercase small fw-bold text-secondary mb-2">Categories</p>
            <h2 class="display-6 fw-bold mb-2">{{ number_format($stats['categories_count']) }}</h2>
            <p class="mb-0 text-secondary">Organize inventory into clearer browsing paths.</p>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="store-card store-panel admin-metric h-100">
            <div class="metric-icon mb-4" style="background: rgba(24, 32, 48, 0.08); color: #182030;">
                <i class="bi bi-receipt-cutoff fs-4"></i>
            </div>
            <p class="text-uppercase small fw-bold text-secondary mb-2">Orders</p>
            <h2 class="display-6 fw-bold mb-2">{{ number_format($stats['orders_count']) }}</h2>
            <p class="mb-0 text-secondary">Monitor fulfillment and status changes.</p>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="store-card store-panel admin-metric h-100">
            <div class="metric-icon mb-4" style="background: rgba(82, 183, 136, 0.16); color: #2b7a51;">
                <i class="bi bi-currency-dollar fs-4"></i>
            </div>
            <p class="text-uppercase small fw-bold text-secondary mb-2">Revenue</p>
            <h2 class="display-6 fw-bold mb-2">${{ number_format($stats['revenue'], 2) }}</h2>
            <p class="mb-0 text-secondary">Delivered orders converted into revenue.</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="store-card store-panel h-100">
            <div class="section-heading mb-4">
                <div>
                    <h2 class="h3 mb-2">Quick actions</h2>
                    <p>Take the most common admin actions without leaving the dashboard.</p>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('admin.products.create') }}" class="category-card h-100">
                        <div class="icon-wrap mb-3"><i class="bi bi-plus-lg"></i></div>
                        <h3 class="h5 fw-bold mb-2">Add product</h3>
                        <p class="text-secondary mb-0">Create a new catalog item and publish it faster.</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.categories.create') }}" class="category-card h-100">
                        <div class="icon-wrap mb-3"><i class="bi bi-folder-plus"></i></div>
                        <h3 class="h5 fw-bold mb-2">Add category</h3>
                        <p class="text-secondary mb-0">Shape how shoppers browse the storefront.</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.orders.index') }}" class="category-card h-100">
                        <div class="icon-wrap mb-3"><i class="bi bi-truck"></i></div>
                        <h3 class="h5 fw-bold mb-2">Review orders</h3>
                        <p class="text-secondary mb-0">Update statuses and keep customers informed.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="store-card store-panel h-100">
            <p class="text-uppercase small fw-bold text-secondary mb-2">Snapshot</p>
            <h2 class="h3 fw-bold mb-3">Store health looks solid.</h2>
            <p class="text-secondary mb-4">Inventory, orders, and revenue are all visible from one place so you can react quickly when something changes.</p>
            <div class="d-grid gap-3">
                <div class="store-soft-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Catalog coverage</span>
                        <span>{{ number_format($stats['products_count']) }} items</span>
                    </div>
                </div>
                <div class="store-soft-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Customer accounts</span>
                        <span>{{ number_format($stats['users_count']) }} users</span>
                    </div>
                </div>
                <div class="store-soft-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Delivered revenue</span>
                        <span>${{ number_format($stats['revenue'], 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection