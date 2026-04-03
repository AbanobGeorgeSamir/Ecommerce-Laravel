@extends('layouts.app')

@section('content')
<section class="store-card store-panel fade-up">
    <div class="row g-4 align-items-center">
        <div class="col-lg-7">
            <p class="hero-kicker mb-3">
                <i class="bi bi-compass"></i>
                About the store
            </p>
            <h1 class="display-6 fw-bold mb-3">Built to make ecommerce feel clearer on both sides of the screen.</h1>
            <p class="fs-5 text-secondary mb-4">This storefront focuses on the essentials easier product discovery, a calmer cart and checkout flow, and an admin area that keeps inventory and orders visible without extra noise.</p>
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="store-soft-card p-4 h-100">
                        <h2 class="h5 fw-bold">For shoppers</h2>
                        <p class="mb-0 text-secondary">Better product context, simpler actions, and clearer pricing and stock signals.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="store-soft-card p-4 h-100">
                        <h2 class="h5 fw-bold">For admins</h2>
                        <p class="mb-0 text-secondary">A stronger operational view of products, categories, orders, and revenue.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="store-soft-card store-panel">
                <h2 class="h4 fw-bold mb-4">What changed</h2>
                <div class="d-grid gap-3">
                    <div class="d-flex gap-3">
                        <i class="bi bi-layout-text-sidebar-reverse text-primary fs-4"></i>
                        <span>Shared layouts now feel cohesive across storefront, auth, and admin screens.</span>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="bi bi-arrow-repeat text-primary fs-4"></i>
                        <span>Product routing and cart interactions are more consistent and reliable.</span>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="bi bi-brush text-primary fs-4"></i>
                        <span>Inline clutter and app comments were reduced so maintenance is easier.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection