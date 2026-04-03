@extends('layouts.app')

@section('content')
<section class="store-card store-panel fade-up">
    <div class="row g-4">
        <div class="col-lg-6">
            <p class="hero-kicker mb-3">
                <i class="bi bi-envelope-paper"></i>
                Contact
            </p>
            <h1 class="display-6 fw-bold mb-3">Need help with an order or product?</h1>
            <p class="fs-5 text-secondary mb-4">Reach the store directly for product questions, order support, or follow-up from the admin side.</p>
            <div class="d-grid gap-3">
                <div class="store-soft-card p-4">
                    <div class="small text-uppercase fw-bold text-secondary mb-1">Email</div>
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=samirabanob848@gmail.com" target="_blank" rel="noreferrer" class="fw-bold text-decoration-none d-inline-flex align-items-center gap-2">
                        <span>samirabanob848@gmail.com</span>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                    <div class="small text-secondary mt-2">Opens Gmail compose directly.</div>
                </div>
                <div class="store-soft-card p-4">
                    <div class="small text-uppercase fw-bold text-secondary mb-1">Phone</div>
                    <a href="tel:+201068992594" class="fw-bold text-decoration-none d-inline-flex align-items-center gap-2">
                        <span>+20 106 899 2594</span>
                        <i class="bi bi-telephone-outbound"></i>
                    </a>
                    <div class="small text-secondary mt-2">Tap to call on mobile or call-enabled devices.</div>
                </div>
                <div class="store-soft-card p-4">
                    <div class="small text-uppercase fw-bold text-secondary mb-1">Hours</div>
                    <div class="fw-bold">Sunday to Thursday, 9:00 AM to 6:00 PM</div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="store-soft-card store-panel h-100">
                <h2 class="h4 fw-bold mb-4">Support priorities</h2>
                <div class="d-grid gap-3">
                    <div class="d-flex gap-3">
                        <i class="bi bi-truck text-primary fs-4"></i>
                        <div>
                            <div class="fw-bold">Order tracking</div>
                            <p class="mb-0 text-secondary">Questions about status changes, shipping, or delivery updates.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="bi bi-arrow-counterclockwise text-primary fs-4"></i>
                        <div>
                            <div class="fw-bold">Cart and checkout help</div>
                            <p class="mb-0 text-secondary">Need help with stock limits, cart issues, or placing an order.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                        <div>
                            <div class="fw-bold">Product details</div>
                            <p class="mb-0 text-secondary">Availability, category questions, or information before purchase.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 rounded-4 border border-primary-subtle bg-white p-4">
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=samirabanob848@gmail.com" target="_blank" rel="noreferrer" class="btn store-btn-primary store-pill px-4">
                            <i class="bi bi-envelope-heart me-2"></i>
                            Email via Gmail
                        </a>
                        <a href="tel:+201068992594" class="btn store-btn-secondary store-pill px-4">
                            <i class="bi bi-telephone me-2"></i>
                            Call now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection