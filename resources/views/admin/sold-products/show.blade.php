@extends('layouts.admin')

@section('title', __('sold-products.sale_details'))
@section('page-title', __('sold-products.sale_details'))

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        --warning-gradient: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        --danger-gradient: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        --secondary-gradient: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        --border-radius: 1rem;
        --border-radius-sm: 0.5rem;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
        --card-shadow-hover: 0 15px 40px rgba(0,0,0,0.15);
    }

    .modern-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modern-page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,197.3C960,213,1056,203,1152,170.7C1248,139,1344,85,1392,58.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
    }

    .modern-card {
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: none;
        margin-bottom: 2rem;
        overflow: hidden;
        transition: var(--transition);
    }

    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-shadow-hover);
    }

    .modern-btn {
        background: var(--primary-gradient);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: fit-content;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    .modern-btn-secondary {
        background: var(--secondary-gradient);
    }

    .modern-btn-warning {
        background: var(--warning-gradient);
    }

    .modern-btn-danger {
        background: var(--danger-gradient);
    }

    .sale-icon-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: var(--success-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto 1.5rem;
        box-shadow: 0 15px 40px rgba(40, 167, 69, 0.3);
        transition: var(--transition);
    }

    .sale-icon-large:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 50px rgba(40, 167, 69, 0.4);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
        transition: var(--transition);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row:hover {
        background-color: #f8f9fa;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-radius: var(--border-radius-sm);
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        color: #6c757d;
        text-align: right;
        flex-shrink: 0;
    }

    .warranty-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: var(--transition);
    }

    .warranty-badge:hover {
        transform: scale(1.05);
    }

    .warranty-active {
        background: var(--success-gradient);
        color: white;
    }

    .warranty-expired {
        background: var(--danger-gradient);
        color: white;
    }

    .warranty-expiring {
        background: var(--warning-gradient);
        color: white;
    }

    .progress {
        height: 12px;
        border-radius: 10px;
        background: #e9ecef;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    /* Mobile-specific styles */
    @media (max-width: 768px) {
        .modern-page-header {
            padding: 2rem 0;
            margin: -1rem -1rem 1.5rem;
        }

        .modern-page-header .row > div {
            text-align: center;
            margin-bottom: 1rem;
        }

        .modern-page-header .col-md-4 {
            text-align: center !important;
        }

        .modern-page-header h1 {
            font-size: 1.5rem;
        }

        .modern-page-header p {
            font-size: 0.9rem;
        }

        .sale-icon-large {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .modern-card .card-body {
            padding: 1rem;
        }

        .modern-card .card-header {
            padding: 1rem;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
            padding: 0.75rem 0;
        }

        .info-value {
            text-align: left;
            margin-left: 1rem;
        }

        .modern-btn {
            width: 100%;
            justify-content: center;
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        .btn-group .modern-btn {
            margin-bottom: 0;
        }

        /* Mobile button text adjustments */
        .mobile-text-short {
            display: none;
        }

        .mobile-text-full {
            display: inline;
        }
    }

    @media (max-width: 576px) {
        .modern-page-header {
            margin: -0.5rem -0.5rem 1rem;
            padding: 1.5rem 0;
        }

        .sale-icon-large {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .modern-card {
            margin-bottom: 1rem;
        }

        .info-row {
            padding: 0.5rem 0;
        }

        .warranty-badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }

        .modern-btn {
            padding: 0.625rem 1rem;
            font-size: 0.8rem;
        }

        /* Show shorter text on very small screens */
        .mobile-text-short {
            display: inline;
        }

        .mobile-text-full {
            display: none;
        }
    }

    @media (max-width: 375px) {
        .modern-page-header {
            padding: 1rem 0;
        }

        .sale-icon-large {
            width: 70px;
            height: 70px;
            font-size: 1.75rem;
        }

        .modern-card .card-body,
        .modern-card .card-header {
            padding: 0.75rem;
        }

        .modern-btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }
    }

    /* Tablet specific styles */
    @media (min-width: 768px) and (max-width: 1024px) {
        .modern-page-header {
            padding: 2.5rem 0;
        }

        .sale-icon-large {
            width: 110px;
            height: 110px;
            font-size: 2.75rem;
        }

        .modern-btn {
            padding: 0.75rem 1.25rem;
        }
    }

    /* Animation classes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-stagger {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-stagger:nth-child(1) { animation-delay: 0.1s; }
    .animate-stagger:nth-child(2) { animation-delay: 0.2s; }
    .animate-stagger:nth-child(3) { animation-delay: 0.3s; }
    .animate-stagger:nth-child(4) { animation-delay: 0.4s; }
    .animate-stagger:nth-child(5) { animation-delay: 0.5s; }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .modern-btn:hover,
        .modern-card:hover,
        .info-row:hover {
            transform: none;
        }

        .modern-btn:active {
            transform: scale(0.95);
        }

        .modern-card:active {
            transform: scale(0.98);
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        * {
            transition: none !important;
            animation: none !important;
        }
    }
</style>

<!-- Page Header -->
<div class="modern-page-header animate-fade-in-up">
    <div class="container-fluid position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">{{ __('sold-products.sale_details') }}</h1>
                <p class="mb-0 opacity-75">{{ __('sold-products.complete_information') }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="btn-group">
                    <a href="{{ route('admin.sold-products.edit', $soldProduct) }}" class="modern-btn modern-btn-warning">
                        <i class="fas fa-edit me-2"></i>
                        <span class="mobile-text-full">{{ __('sold-products.edit_sale') }}</span>
                        <span class="mobile-text-short">{{ __('sold-products.edit_sale') }}</span>
                    </a>
                    <a href="{{ route('admin.sold-products.index') }}" class="modern-btn modern-btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        <span class="mobile-text-full">{{ __('sold-products.back_to_sales') }}</span>
                        <span class="mobile-text-short">{{ __('sold-products.back_to_sales') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show animate-fade-in-up" role="alert" style="border-radius: 1rem; border: none; box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-8">
        <div class="modern-card animate-stagger">
            <div class="card-header bg-white border-bottom p-4">
                <div class="text-center">
                    <div class="sale-icon-large">
                        @if($soldProduct->product && $soldProduct->product->image_url)
                            <img src="{{ $soldProduct->product->image_url }}" alt="{{ $soldProduct->product->model_name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        @else
                            <i class="fas fa-shopping-cart"></i>
                        @endif
                    </div>
                    <h3 class="mb-1">{{ __('sold-products.sale_number', ['id' => $soldProduct->id]) }}</h3>
                    <p class="text-muted mb-0">{{ $soldProduct->product->model_name ?? __('sold-products.na') }}</p>
                    <div class="mt-3">
                        @if($soldProduct->warranty_voided)
                            <span class="warranty-badge warranty-expired">
                                <i class="fas fa-ban"></i>
                                {{ __('sold-products.warranty_voided') }}
                            </span>
                        @elseif($soldProduct->isUnderWarranty())
                            <span class="warranty-badge warranty-active">
                                <i class="fas fa-shield-alt"></i>
                                {{ __('sold-products.under_warranty') }}
                            </span>
                        @else
                            <span class="warranty-badge warranty-expired">
                                <i class="fas fa-shield-alt"></i>
                                {{ __('sold-products.warranty_expired') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-box text-primary"></i>
                                {{ __('sold-products.product') }}:
                            </span>
                            <span class="info-value">
                                @if($soldProduct->product)
                                    <a href="{{ route('admin.products.show', $soldProduct->product) }}" class="text-decoration-none">
                                        {{ $soldProduct->product->model_name }}
                                    </a>
                                @else
                                    {{ __('sold-products.na') }}
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-user text-info"></i>
                                {{ __('sold-products.owner') }}:
                            </span>
                            <span class="info-value">
                                @if($soldProduct->owner)
                                    <a href="{{ route('admin.owners.show', $soldProduct->owner) }}" class="text-decoration-none">
                                        {{ $soldProduct->owner->name }}
                                    </a>
                                @else
                                    {{ __('sold-products.na') }}
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-user-tie text-secondary"></i>
                                {{ __('sold-products.employee') }}:
                            </span>
                            <span class="info-value">
                                @if($soldProduct->employee)
                                    {{ $soldProduct->employee->name }} ({{ ucfirst($soldProduct->employee->role) }})
                                @else
                                    {{ __('sold-products.na') }}
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-barcode text-warning"></i>
                                {{ __('sold-products.serial_number') }}:
                            </span>
                            <span class="info-value">
                                <strong>{{ $soldProduct->serial_number }}</strong>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-dollar-sign text-success"></i>
                                {{ __('sold-products.purchase_price') }}:
                            </span>
                            <span class="info-value">
                                <strong class="text-success">${{ number_format($soldProduct->purchase_price ?? 0, 2) }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-calendar text-primary"></i>
                                {{ __('sold-products.sale_date') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->sale_date ? $soldProduct->sale_date->format('M d, Y') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-calendar-check text-success"></i>
                                {{ __('sold-products.warranty_start') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->warranty_start_date ? $soldProduct->warranty_start_date->format('M d, Y') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-calendar-times text-danger"></i>
                                {{ __('sold-products.warranty_end') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->warranty_end_date ? $soldProduct->warranty_end_date->format('M d, Y') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-clock text-info"></i>
                                {{ __('sold-products.created') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->created_at ? $soldProduct->created_at->format('M d, Y H:i') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-edit text-warning"></i>
                                {{ __('sold-products.updated') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->updated_at ? $soldProduct->updated_at->format('M d, Y H:i') : __('sold-products.na') }}</span>
                        </div>
                    </div>
                </div>

                @if($soldProduct->notes)
                <div class="mt-4">
                    <h6 class="info-label mb-3">
                        <i class="fas fa-sticky-note text-warning me-2"></i>
                        {{ __('sold-products.additional_notes') }}:
                    </h6>
                    <div class="p-3" style="background: #f8f9fa; border-radius: 0.75rem; border-left: 4px solid #667eea;">
                        {{ $soldProduct->notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="modern-card animate-stagger">
            <div class="card-header bg-white border-bottom p-3">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    {{ __('sold-products.quick_actions') }}
                </h5>
            </div>
            <div class="card-body p-3">
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.sold-products.edit', $soldProduct) }}" class="modern-btn modern-btn-warning">
                        <i class="fas fa-edit me-2"></i>
                        {{ __('sold-products.edit_sale') }}
                    </a>
                    
                    @if($soldProduct->product)
                        <a href="{{ route('admin.products.show', $soldProduct->product) }}" class="modern-btn modern-btn-secondary">
                            <i class="fas fa-cube me-2"></i>
                            {{ __('sold-products.view_product') }}
                        </a>
                    @endif
                    
                    @if($soldProduct->owner)
                        <a href="{{ route('admin.owners.show', $soldProduct->owner) }}" class="modern-btn modern-btn-secondary">
                            <i class="fas fa-user me-2"></i>
                            {{ __('sold-products.view_owner') }}
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.sold-products.destroy', $soldProduct) }}" class="d-inline" 
                          onsubmit="return confirm('{{ __('sold-products.confirm_delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="modern-btn modern-btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>
                            {{ __('sold-products.delete_sale') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if($soldProduct->warranty_start_date && $soldProduct->warranty_end_date)
        <div class="modern-card animate-stagger">
            <div class="card-header bg-white border-bottom p-3">
                <h5 class="mb-0">
                    <i class="fas fa-shield-alt me-2"></i>
                    {{ __('sold-products.warranty_information') }}
                </h5>
            </div>
            <div class="card-body p-3">
                <div class="text-center">
                    @php
                        $warrantyStart = $soldProduct->warranty_start_date;
                        $warrantyEnd = $soldProduct->warranty_end_date;
                        $now = now();
                        $isActive = $now->between($warrantyStart, $warrantyEnd);
                        $daysRemaining = $isActive ? $now->diffInDays($warrantyEnd) : 0;
                        $totalDays = $warrantyStart->diffInDays($warrantyEnd);
                        $daysUsed = $warrantyStart->diffInDays($now);
                        $percentage = $totalDays > 0 ? min(100, ($daysUsed / $totalDays) * 100) : 0;
                    @endphp
                    
                    @if($isActive)
                        <div class="warranty-badge warranty-active mb-3">
                            <i class="fas fa-shield-alt"></i>
                            {{ __('sold-products.active_warranty') }}
                        </div>
                        <p class="mb-2"><strong>{{ __('sold-products.days_remaining', ['days' => $daysRemaining]) }}</strong></p>
                        <div class="progress mb-3">
                            <div class="progress-bar" style="width: {{ $percentage }}%; background: var(--success-gradient);" role="progressbar"></div>
                        </div>
                    @else
                        <div class="warranty-badge warranty-expired mb-3">
                            <i class="fas fa-shield-alt"></i>
                            {{ __('sold-products.warranty_expired') }}
                        </div>
                        @if($now < $warrantyStart)
                            <p class="text-muted">{{ __('sold-products.warranty_not_started') }}</p>
                        @else
                            <p class="text-muted">{{ __('sold-products.expired_time_ago', ['time' => $warrantyEnd->diffForHumans()]) }}</p>
                        @endif
                    @endif
                    
                    <small class="text-muted d-block">
                        {{ $warrantyStart->format('M d, Y') }} - {{ $warrantyEnd->format('M d, Y') }}
                    </small>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
            <div class="modern-card animate-stagger">
                <div class="card-header bg-white border-bottom p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-cog me-2"></i>
                        {{ __('sold-products.warranty_management') }}
                    </h5>
                </div>
                <div class="card-body p-3">
                    @if(!$soldProduct->warranty_voided)
                        <button type="button" class="modern-btn modern-btn-danger w-100" data-bs-toggle="modal" data-bs-target="#voidWarrantyModal">
                            <i class="fas fa-ban me-2"></i>
                            <span class="mobile-text-full">{{ __('sold-products.void_sale') }}</span>
                            <span class="mobile-text-short">{{ __('sold-products.void_sale') }}</span>
                        </button>
                    @else
                        <div class="alert alert-warning" style="border-radius: 1rem; margin: 0;">
                            <div class="text-center">
                                <i class="fas fa-ban me-2"></i>
                                <strong>Warranty Voided</strong>
                            </div>
                            <hr>
                            <small>
                                <strong>Voided by:</strong> {{ optional($soldProduct->warrantyVoidedBy)->name ?? '-' }}<br>
                                <strong>Date:</strong> {{ $soldProduct->warranty_voided_at ? $soldProduct->warranty_voided_at->format('M d, Y H:i') : '-' }}<br>
                                <strong>Reason:</strong> {{ $soldProduct->warranty_void_reason }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Void Warranty Modal -->
<div class="modal fade" id="voidWarrantyModal" tabindex="-1" aria-labelledby="voidWarrantyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: var(--border-radius);">
            <form method="POST" action="{{ route('admin.sold-products.void-warranty', $soldProduct) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="voidWarrantyModalLabel">
                        <i class="fas fa-ban me-2"></i>
                        Void Warranty
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="warranty_void_reason" class="form-label">Reason for voiding <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="warranty_void_reason" name="warranty_void_reason" rows="4" required style="border-radius: var(--border-radius-sm);"></textarea>
                    </div>
                    <div class="alert alert-warning" style="border-radius: var(--border-radius-sm);">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This action cannot be undone. The warranty will be permanently voided for this device.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-ban me-2"></i>
                        Confirm Void
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on load
    const animatedElements = document.querySelectorAll('.animate-stagger');
    animatedElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Progress bar animation
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        const targetWidth = progressBar.style.width;
        progressBar.style.width = '0%';
        
        setTimeout(() => {
            progressBar.style.width = targetWidth;
        }, 1000);
    }

    // Smooth scroll for mobile
    if (window.innerWidth <= 768) {
        const buttons = document.querySelectorAll('.modern-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Add ripple effect for mobile
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.6);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }

    // Touch feedback for mobile devices
    if ('ontouchstart' in window) {
        document.querySelectorAll('.modern-card, .modern-btn').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = this.style.transform.replace('translateY(-2px)', '') + ' scale(0.98)';
            });
            
            element.addEventListener('touchend', function() {
                this.style.transform = this.style.transform.replace(' scale(0.98)', '');
            });
        });
    }

    // Enhanced info row interactions
    document.querySelectorAll('.info-row').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});

// Add ripple animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection