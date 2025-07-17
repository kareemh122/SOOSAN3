@extends('layouts.admin')

@section('title', __('sold-products.sale_details'))
@section('page-title', __('sold-products.sale_details'))

@section('content')
<style>
    /* Clean Dashboard-Aligned Styling */
    .sold-products-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1f2937;
    }

    /* Page Header */
    .sold-products-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin: -1rem -1rem 2rem -1rem;
        border-radius: 0 0 2rem 2rem;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }

    .sold-products-header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    /* Clean Cards */
    .sold-products-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(229, 231, 235, 0.6);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .sold-products-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    /* Clean Buttons */
    .sold-products-btn {
        background: #667eea;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .sold-products-btn:hover {
        background: #5a6fd8;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .sold-products-btn-warning {
        background: #f59e0b;
    }

    .sold-products-btn-warning:hover {
        background: #d97706;
    }

    .sold-products-btn-danger {
        background: #ef4444;
    }

    .sold-products-btn-danger:hover {
        background: #dc2626;
    }

    .sold-products-btn-secondary {
        background: #6b7280;
    }

    .sold-products-btn-secondary:hover {
        background: #4b5563;
    }

    /* Product Icon */
    .sale-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto 1.5rem;
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
    }

    /* Info Rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row:hover {
        background-color: rgba(102, 126, 234, 0.05);
        padding-left: 1rem;
        padding-right: 1rem;
        border-radius: 8px;
    }

    .info-label {
        font-weight: 600;
        color: #4b5563;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        color: #1f2937;
        text-align: right;
        font-weight: 500;
    }

    /* Warranty Badges */
    .warranty-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .warranty-active {
        background: #10b981;
        color: white;
    }

    .warranty-expired {
        background: #ef4444;
        color: white;
    }

    /* Progress Bar */
    .progress {
        height: 12px;
        border-radius: 10px;
        background: #e5e7eb;
        overflow: hidden;
    }

    .progress-bar {
        background: #10b981;
        transition: width 0.6s ease;
    }

    .btn-group {
        gap: 1rem;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .sold-products-container {
            padding: 0.75rem;
        }

        .sold-products-header {
            margin: -0.75rem -0.75rem 1.5rem -0.75rem;
            padding: 1.5rem 0;
        }

        .sold-products-header-content {
            flex-direction: column;
            text-align: center;
            padding: 0 1rem;
            gap: 1rem;
        }

        .sale-icon {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .sold-products-card .card-body,
        .sold-products-card .card-header {
            padding: 1.5rem;
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

        .sold-products-btn {
            width: 100%;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .sold-products-header {
            margin: -0.5rem -0.5rem 1rem -0.5rem;
            padding: 1rem 0;
        }

        .sale-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .sold-products-card {
            margin-bottom: 1rem;
        }

        .sold-products-card .card-body,
        .sold-products-card .card-header {
            padding: 1rem;
        }

        .info-row {
            padding: 0.5rem 0;
        }

        .warranty-badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }

        .sold-products-btn {
            padding: 0.625rem 1rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 375px) {
        .sold-products-header {
            padding: 0.75rem 0;
        }

        .sale-icon {
            width: 70px;
            height: 70px;
            font-size: 1.75rem;
        }

        .sold-products-card .card-body,
        .sold-products-card .card-header {
            padding: 0.75rem;
        }

        .sold-products-btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }
    }

    /* Desktop and Tablet Optimization */
    @media (min-width: 768px) and (max-width: 1024px) {
        .sale-icon {
            width: 110px;
            height: 110px;
            font-size: 2.75rem;
        }
    }
</style>

<div class="sold-products-container">
    <!-- Page Header -->
    <div class="sold-products-header">
        <div class="sold-products-header-content">
            <div>
                <h1 class="h2 mb-2">{{ __('sold-products.sale_details') }}</h1>
                <p class="mb-0 opacity-75">{{ __('sold-products.complete_information') }}</p>
            </div>
            <div class="btn-group">
                <a href="{{ route('admin.sold-products.edit', $soldProduct) }}" class="sold-products-btn sold-products-btn-warning">
                    <i class="fas fa-edit me-2"></i>
                    <span class="d-none d-sm-inline">{{ __('sold-products.edit_sale') }}</span>
                    <span class="d-sm-none">{{ __('sold-products.edit_sale') }}</span>
                </a>
                <a href="{{ route('admin.sold-products.index') }}" class="sold-products-btn sold-products-btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    <span class="d-none d-sm-inline">{{ __('sold-products.back_to_sales') }}</span>
                    <span class="d-sm-none">{{ __('sold-products.back_to_sales') }}</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 1rem; border: none; box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="sold-products-card">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="text-center">
                        <div class="sale-icon">
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
                            <span class="info-value">{{ $soldProduct->sale_date ? $soldProduct->sale_date->locale(app()->getLocale())->translatedFormat('j F Y') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-calendar-check text-success"></i>
                                {{ __('sold-products.warranty_start') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->warranty_start_date ? $soldProduct->warranty_start_date->locale(app()->getLocale())->translatedFormat('j F Y') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-calendar-times text-danger"></i>
                                {{ __('sold-products.warranty_end') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->warranty_end_date ? $soldProduct->warranty_end_date->locale(app()->getLocale())->translatedFormat('j F Y') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-clock text-info"></i>
                                {{ __('sold-products.created') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->created_at ? $soldProduct->created_at->locale(app()->getLocale())->translatedFormat('j F Y H:i') : __('sold-products.na') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="fas fa-edit text-warning"></i>
                                {{ __('sold-products.updated') }}:
                            </span>
                            <span class="info-value">{{ $soldProduct->updated_at ? $soldProduct->updated_at->locale(app()->getLocale())->translatedFormat('j F Y H:i') : __('sold-products.na') }}</span>
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
            <div class="sold-products-card">
                <div class="card-header bg-white border-bottom p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        {{ __('sold-products.quick_actions') }}
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.sold-products.edit', $soldProduct) }}" class="sold-products-btn sold-products-btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            {{ __('sold-products.edit_sale') }}
                        </a>
                        
                        @if($soldProduct->product)
                            <a href="{{ route('admin.products.show', $soldProduct->product) }}" class="sold-products-btn sold-products-btn-secondary">
                                <i class="fas fa-cube me-2"></i>
                                {{ __('sold-products.view_product') }}
                            </a>
                        @endif
                        
                        @if($soldProduct->owner)
                            <a href="{{ route('admin.owners.show', $soldProduct->owner) }}" class="sold-products-btn sold-products-btn-secondary">
                                <i class="fas fa-user me-2"></i>
                                {{ __('sold-products.view_owner') }}
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.sold-products.destroy', $soldProduct) }}" class="d-inline" 
                              onsubmit="return confirm('{{ __('sold-products.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="sold-products-btn sold-products-btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>
                                {{ __('sold-products.delete_sale') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if($soldProduct->warranty_start_date && $soldProduct->warranty_end_date)
            <div class="sold-products-card">
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
                        $daysRemaining = $isActive ? (int) $now->diffInDays($warrantyEnd) : 0;
                        $totalDays = (int) $warrantyStart->diffInDays($warrantyEnd);
                        $daysUsed = (int) $warrantyStart->diffInDays($now);
                        $percentage = $totalDays > 0 ? min(100, round(($daysUsed / $totalDays) * 100)) : 0;
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
                        {{ $warrantyStart->locale(app()->getLocale())->translatedFormat('j F Y') }} - {{ $warrantyEnd->locale(app()->getLocale())->translatedFormat('j F Y') }}
                    </small>
                </div>
            </div>
        </div>
        @endif

            @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                <div class="sold-products-card">
                    <div class="card-header bg-white border-bottom p-3">
                        <h5 class="mb-0">
                            <i class="fas fa-cog me-2"></i>
                            {{ __('sold-products.warranty_management') }}
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        @if(!$soldProduct->warranty_voided)
                            <button type="button" class="sold-products-btn sold-products-btn-danger w-100" data-bs-toggle="modal" data-bs-target="#voidWarrantyModal">
                                <i class="fas fa-ban me-2"></i>
                                <span class="d-none d-sm-inline">{{ __('sold-products.void_sale') }}</span>
                                <span class="d-sm-none">{{ __('Void') }}</span>
                            </button>
                    @else
                        <div class="alert alert-warning" style="border-radius: 1rem; margin: 0;">
                            <div class="text-center">
                                <i class="fas fa-ban me-2"></i>
                                <strong>{{ __('sold-products.warranty_voided') }}</strong>
                            </div>
                            <hr>
                            <small>
                                <strong>{{ __('sold-products.voided_by') }}:</strong> {{ optional($soldProduct->warrantyVoidedBy)->name ?? '-' }}<br>
                                <strong>{{ __('sold-products.voided_at') }}:</strong> {{ $soldProduct->warranty_voided_at ? $soldProduct->warranty_voided_at->locale(app()->getLocale())->translatedFormat('j F Y H:i') : '-' }}<br>
                                <strong>{{ __('sold-products.voided_reason') }}:</strong> {{ $soldProduct->warranty_void_reason }}
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress bar animation
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        const targetWidth = progressBar.style.width;
        progressBar.style.width = '0%';
        
        setTimeout(() => {
            progressBar.style.width = targetWidth;
        }, 1000);
    }

    // Enhanced button interactions for mobile
    if (window.innerWidth <= 768) {
        const buttons = document.querySelectorAll('.sold-products-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    }

    // Touch feedback for mobile devices
    if ('ontouchstart' in window) {
        document.querySelectorAll('.sold-products-card, .sold-products-btn').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = (this.style.transform || '') + ' scale(0.98)';
            });
            
            element.addEventListener('touchend', function() {
                this.style.transform = this.style.transform.replace(' scale(0.98)', '');
            });
        });
    }
});
</script>
@endsection