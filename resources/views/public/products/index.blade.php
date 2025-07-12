@extends('layouts.public')

@section('title', __('common.products_title') . ' - Soosan Cebotics')
@section('description', __('common.products_description'))

@section('page-header')
    <div class="container mt-2 mt-md-4 mb-3 mb-md-4">
        <div class="row">
            <div class="col-12">
                <h1 class="products-heading text-start text-center text-md-start" style="font-size: clamp(2rem, 5vw, 3.3rem); font-weight: 700; margin-bottom: 0.3rem;">
                    Hydraulic Breakers
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
<style>
    /* Custom styles for products page */
    :root {
        --primary-blue: #00548e;
        --accent-green: #b0d701;
        --light-gray: #f8f9fa;
        --border-color: #e5e7eb;
    }

    /* Progress bar */
    #pageProgressBar {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-blue), var(--accent-green));
        z-index: 9999;
        transition: width 0.3s ease;
        display: none;
    }

    /* Unit toggle buttons */
    .unit-toggle-group {
        background: #f1f5f9;
        border-radius: 0.5rem;
        padding: 0.25rem;
        display: flex;
        gap: 0.25rem;
    }

    .unit-toggle-btn {
        background: transparent;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        font-size: 0.875rem;
        color: #64748b;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .unit-toggle-btn.active {
        background: var(--primary-blue);
        color: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .unit-toggle-btn:hover:not(.active) {
        background: #b0d701;
        color: var(--primary-blue);
    }

    /* Search button */
    .search-btn {
        background: var(--primary-blue) !important;
        border-color: var(--primary-blue) !important;
        transition: all 0.2s ease;
    }

    .search-btn:hover {
        background: #b0d701 !important;
        border-color: #b0d701 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 84, 142, 0.3);
    }

    /* Filter styles */
    .filter-category-header {
        cursor: pointer;
        padding: 0.75rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
        border-radius: 0.375rem;
        margin: -0.25rem;
        padding-left: 0.25rem;
    }

    .filter-category-header:hover {
        background: #f8fafc;
    }

    .filter-arrow {
        transition: transform 0.2s ease;
        color: var(--primary-blue);
        font-weight: bold;
    }

    .filter-category-header.expanded .filter-arrow {
        transform: rotate(90deg);
    }

    .filter-options {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .filter-options.expanded {
        max-height: 500px;
        padding-top: 0.5rem;
    }

    .form-check-input:checked {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    .form-check-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 84, 142, 0.25);
    }

    /* Product cards */
    .product-card {
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-blue);
    }

    .copy-link-btn {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: rgba(0, 84, 142, 0.9);
        border: none;
        border-radius: 0.375rem;
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.2s ease;
        z-index: 2;
    }

    .product-card:hover .copy-link-btn {
        opacity: 1;
    }

    .copy-link-btn:hover {
        background: var(--accent-green);
        transform: scale(1.1);
    }

    /* Attribute styling */
    .attribute-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.25rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .attribute-row:last-child {
        border-bottom: none;
    }

    .attribute-label {
        font-size: 1rem;
        color: #64748b;
        font-weight: 500;
    }

    .attribute-value {
        font-size: 0.875rem;
        color: #1e293b;
        font-weight: 600;
        text-align: right;
    }

    /* Sort dropdown */
    .btn-outline-primary {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    /* Copy toast */
    .copy-toast {
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: var(--primary-blue);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s ease;
        z-index: 9999;
    }

    .copy-toast.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Mobile filter toggle */
    .mobile-filter-toggle {
        background: var(--primary-blue);
        border: none;
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .mobile-filter-toggle:hover {
        background: #003d6b;
    }

    /* Mobile filter overlay */
    .mobile-filter-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .mobile-filter-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .mobile-filter-sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 320px;
        height: 100vh;
        background: white;
        z-index: 1050;
        transition: left 0.3s ease;
        overflow-y: auto;
    }

    .mobile-filter-sidebar.show {
        left: 0;
    }

    .mobile-filter-header {
        background: var(--primary-blue);
        color: white;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Responsive grid */
    @media (max-width: 575.98px) {
        .products-grid .col-sm-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .product-card {
            width: 100% !important;
            max-width: 350px;
            margin: 0 auto;
        }
        
        .unit-toggle-btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }
        
        .search-btn .d-none {
            display: none !important;
        }
    }

    @media (max-width: 767.98px) {
        .sort-dropdown .dropdown-toggle {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .sort-dropdown .dropdown-toggle .d-none {
            display: none !important;
        }
    }

    @media (min-width: 992px) {
        .filter-sidebar {
            position: sticky;
            top: 2rem;
        }
    }

    /* Loading spinner */
    .spinner-border-primary {
        color: var(--primary-blue);
    }

    /* Pagination */
    .pagination .page-link {
        color: var(--primary-blue);
        border-color: #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-blue);
        color: #fff;
        border-color: var(--primary-blue);
    }

    .pagination .page-link:hover {
        color: #003d6b;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>

<div class="bg-light py-3 py-md-5">
    <div class="container">
        <!-- Search Section -->
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-10 col-lg-8">
                <form id="mainSearchForm" method="GET" action="{{ route('products.index') }}" autocomplete="off">
                    <div class="input-group shadow-sm rounded-pill" style="background: #fff;">
                        <input type="hidden" name="unit" value="{{ $unit }}">
                        <input type="text" name="search" id="search" 
                               class="form-control border-0 rounded-start-pill px-4 py-3" 
                               maxlength="100" 
                               value="{{ old('search', e($search ?? '')) }}" 
                               placeholder="Search by model, type, line, or specs..." 
                               style="font-size: 1.3rem; background: #fff;">
                        <button class="btn search-btn rounded-end-pill px-3 px-md-4 d-flex align-items-center" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 16 16" class="me-md-2">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Controls Row -->
        <div class="row align-items-center justify-content-between mb-4">
            <div class="col-12 col-md-auto mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3">
                    <!-- Unit Toggle -->
                    <div class="unit-toggle-group" role="group" aria-label="Unit Toggle">
                        <button type="button" class="unit-toggle-btn{{ $unit === 'si' ? ' active' : '' }}" id="siBtn">
                            <span class="d-none d-sm-inline">{{ __('common.si_units') }}</span>
                            <span class="d-inline d-sm-none">SI</span>
                        </button>
                        <button type="button" class="unit-toggle-btn{{ $unit === 'imperial' ? ' active' : '' }}" id="imperialBtn">
                            <span class="d-none d-sm-inline">{{ __('common.imperial_units') }}</span>
                            <span class="d-inline d-sm-none">IMP</span>
                        </button>
                    </div>
                    
                    <!-- Mobile Filter Toggle -->
                    <button type="button" class="mobile-filter-toggle d-lg-none" id="mobileFilterBtn">
                        <i class="fas fa-filter"></i>
                        <span class="d-none d-sm-inline">Filters</span>
                    </button>
                </div>
            </div>
            
            <div class="col-12 col-md-auto">
                <div class="dropdown sort-dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center gap-2" 
                            type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-sort"></i>
                        <span id="sortLabel" class="d-none d-md-inline">
                            @switch($sort ?? 'none')
                                @case('carrier-desc') Carrier (High to Low) @break
                                @case('carrier-asc') Carrier (Low to High) @break
                                @case('weight-desc') Weight (High to Low) @break
                                @case('weight-asc') Weight (Low to High) @break
                                @default Sort @break
                            @endswitch
                        </span>
                        <span class="d-inline d-md-none">Sort</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="none">
                            <i class="fas fa-ban me-2"></i>None (Default Order)
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="carrier-desc">
                            <i class="fas fa-arrow-down-wide-short me-2"></i>Applicable Carrier (High to Low)
                        </a></li>
                        <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="carrier-asc">
                            <i class="fas fa-arrow-up-short-wide me-2"></i>Applicable Carrier (Low to High)
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="weight-desc">
                            <i class="fas fa-arrow-down-wide-short me-2"></i>Operating Weight (High to Low)
                        </a></li>
                        <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="weight-asc">
                            <i class="fas fa-arrow-up-short-wide me-2"></i>Operating Weight (Low to High)
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row align-items-start">
            <!-- Desktop Filter Sidebar -->
            <div class="col-lg-3 mb-4 d-none d-lg-block">
                <form id="filterForm" method="GET" action="{{ route('products.index') }}">
                    <input type="hidden" name="unit" id="unitInput" value="{{ $unit }}">
                    <input type="hidden" name="sort" id="sortInput" value="{{ $sort ?? 'none' }}">
                    
                    <div class="card shadow-sm border-0 filter-sidebar">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-filter me-2"></i>{{ __('common.filter') }}
                                </h5>
                                <button type="button" id="resetFiltersBtn" 
                                        class="btn btn-link p-0 m-0" 
                                        title="{{ __('common.reset_filters') }}" 
                                        style="color: var(--primary-blue); font-size: 1.2rem;">
                                    <i class="fas fa-rotate-right"></i>
                                </button>
                            </div>
                            
                            @foreach ([
                                [__('common.line'), $lines, 'line'], 
                                [__('common.type'), $types, 'type'], 
                                [__('common.operating_weight'), $operating_weights, 'operating_weight'], 
                                [__('common.required_oil_flow'), $required_oil_flows, 'required_oil_flow'], 
                                [__('common.applicable_carrier'), $applicable_carriers, 'applicable_carrier']
                            ] as $i => [$label, $options, $name])
                                <div class="filter-category mb-3">
                                    <div class="filter-category-header" data-target="#filter-{{ $name }}">
                                        <label class="form-label fw-semibold mb-0" style="color: #374151;">{{ $label }}</label>
                                        <span class="filter-arrow"><i class="fas fa-chevron-up"></i></span>
                                    </div>
                                    <div id="filter-{{ $name }}" class="filter-options">
                                        @foreach ($options as $option)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input filter-checkbox" 
                                                       type="checkbox" 
                                                       name="{{ $name }}[]" 
                                                       value="{{ $option }}" 
                                                       id="{{ $name }}-{{ $option }}" 
                                                       {{ in_array($option, (array)request($name, [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $name }}-{{ $option }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if ($i < 4)
                                    <hr class="my-3" style="border-top: 1px solid var(--border-color); opacity: 0.5;">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <div id="productsGrid">
                    @if ($products->count() > 0)
                        <div class="row g-3 g-md-4 mb-4 products-grid">
                            @foreach ($products as $product)
                                <div class="col-sm-6 col-lg-4 d-flex justify-content-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark w-100">
                                        <div class="card h-100 product-card" style="min-height: 340px; max-width: 350px; margin: 0 auto;">
                                            @if (!empty($product->image_url))
                                                <div style="background: #fff; display: flex; align-items: center; justify-content: center; height: 200px; position: relative;">
                                                    <img src="{{ $product->image_url }}" 
                                                         alt="{{ $product->model_name }}" 
                                                         class="card-img-top" 
                                                         style="max-height: 180px; max-width: 100%; object-fit: contain; width: auto; height: auto;" 
                                                         loading="lazy">
                                                </div>
                                            @elseif (method_exists($product, 'getFirstMediaUrl'))
                                                <div style="background: #fff; display: flex; align-items: center; justify-content: center; height: 200px; position: relative;">
                                                    <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                                         alt="{{ $product->model_name }}" 
                                                         class="card-img-top" 
                                                         style="max-height: 180px; max-width: 100%; object-fit: contain; width: auto; height: auto;" 
                                                         loading="lazy">
                                                </div>
                                            @else
                                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                    <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                                </div>
                                            @endif
                                            
                                            <div class="card-body p-3">
                                                <h5 class="card-title mb-3" style="font-size: 1.5rem;; font-weight: 600;">
                                                    {{ $product->model_name }}
                                                </h5>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="attribute-row">
                                                        <span class="attribute-label">{{ __('common.operating_weight') }}:</span> 
                                                        <span class="attribute-value unit-operating-weight" data-lb="{{ $product->operating_weight }}">
                                                            {{ $product->operating_weight }} {{ __('common.unit_lb') }}
                                                        </span>
                                                    </li>
                                                    <li class="attribute-row">
                                                        <span class="attribute-label">{{ __('common.required_oil_flow') }}:</span> 
                                                        <span class="attribute-value">{{ $product->required_oil_flow }} {{ __('common.unit_gal_min') }}</span>
                                                    </li>
                                                    <li class="attribute-row">
                                                        <span class="attribute-label">{{ __('common.applicable_carrier') }}:</span> 
                                                        <span class="attribute-value unit-carrier" data-lb="{{ $product->applicable_carrier }}">
                                                            {{ $product->applicable_carrier }} {{ __('common.unit_lb') }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <button class="copy-link-btn" data-url="{{ route('products.show', $product->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="white" viewBox="0 0 16 16">
                                                    <path d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                                                    <path d="M2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H2zm0 1h8v7H2V6z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mb-4">
                            <div class="text-center text-muted small mb-3">
                                {{ __('common.showing_results', [
                                    'first' => $products->firstItem(),
                                    'last' => $products->lastItem(),
                                    'total' => $products->total()
                                ]) }}
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-search text-muted mb-3" style="font-size: 3rem;"></i>
                            <h3 class="h4 fw-semibold text-dark mb-2">{{ __('common.no_products_found') }}</h3>
                            <p class="text-muted mb-4">{{ __('common.try_adjusting_search') }}</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary" style="background: var(--primary-blue); border-color: var(--primary-blue);">
                                {{ __('common.view_all_products') }}
                            </a>
                        </div>
                    @endif
                </div>
                
                <div id="productsLoading" class="text-center py-5" style="display: none;">
                    <div class="spinner-border spinner-border-primary" role="status">
                        <span class="visually-hidden">{{ __('common.loading') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Filter Overlay -->
<div class="mobile-filter-overlay d-lg-none" id="mobileFilterOverlay"></div>

<!-- Mobile Filter Sidebar -->
<div class="mobile-filter-sidebar d-lg-none" id="mobileFilterSidebar">
    <div class="mobile-filter-header">
        <h5 class="mb-0 fw-bold">
            <i class="fas fa-filter me-2"></i>{{ __('common.filter') }}
        </h5>
        <button type="button" class="btn btn-link text-white p-0" id="closeMobileFilter">
            <i class="fas fa-times" style="font-size: 1.25rem;"></i>
        </button>
    </div>
    
    <div class="p-4">
        <form id="mobileFilterForm" method="GET" action="{{ route('products.index') }}">
            <input type="hidden" name="unit" value="{{ $unit }}">
            <input type="hidden" name="sort" value="{{ $sort ?? 'none' }}">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="fw-semibold">Active Filters</span>
                <button type="button" id="resetMobileFiltersBtn" 
                        class="btn btn-link p-0 m-0" 
                        style="color: var(--primary-blue);">
                    <i class="fas fa-rotate-right"></i> Reset
                </button>
            </div>
            
            @foreach ([
                [__('common.line'), $lines, 'line'], 
                [__('common.type'), $types, 'type'], 
                [__('common.operating_weight'), $operating_weights, 'operating_weight'], 
                [__('common.required_oil_flow'), $required_oil_flows, 'required_oil_flow'], 
                [__('common.applicable_carrier'), $applicable_carriers, 'applicable_carrier']
            ] as $i => [$label, $options, $name])
                <div class="filter-category mb-4">
                    <div class="filter-category-header" data-target="#mobile-filter-{{ $name }}">
                        <label class="form-label fw-semibold mb-0" style="color: #374151;">{{ $label }}</label>
                        <span class="filter-arrow">▶</span>
                    </div>
                    <div id="mobile-filter-{{ $name }}" class="filter-options">
                        @foreach ($options as $option)
                            <div class="form-check mb-2">
                                <input class="form-check-input mobile-filter-checkbox" 
                                       type="checkbox" 
                                       name="{{ $name }}[]" 
                                       value="{{ $option }}" 
                                       id="mobile-{{ $name }}-{{ $option }}" 
                                       {{ in_array($option, (array)request($name, [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobile-{{ $name }}-{{ $option }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($i < 4)
                    <hr class="my-3" style="border-top: 1px solid var(--border-color); opacity: 0.5;">
                @endif
            @endforeach
            
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary" style="background: var(--primary-blue); border-color: var(--primary-blue);">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>
</div>

<div id="pageProgressBar"></div>
<div id="copyToast" class="copy-toast">Link copied to clipboard</div>

@push('scripts')
<script>
    // Progress bar functionality
    function startProgressBar() {
        var bar = document.getElementById('pageProgressBar');
        if (!bar) return;
        bar.style.width = '0';
        bar.style.display = 'block';
        setTimeout(function() { bar.style.width = '60%'; }, 50);
    }
    
    function finishProgressBar() {
        var bar = document.getElementById('pageProgressBar');
        if (!bar) return;
        bar.style.width = '100%';
        setTimeout(function() { bar.style.display = 'none'; bar.style.width = '0'; }, 400);
    }

    // Mobile filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileFilterBtn = document.getElementById('mobileFilterBtn');
        const mobileFilterOverlay = document.getElementById('mobileFilterOverlay');
        const mobileFilterSidebar = document.getElementById('mobileFilterSidebar');
        const closeMobileFilter = document.getElementById('closeMobileFilter');

        function openMobileFilter() {
            mobileFilterOverlay.classList.add('show');
            mobileFilterSidebar.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileFilterFunc() {
            mobileFilterOverlay.classList.remove('show');
            mobileFilterSidebar.classList.remove('show');
            document.body.style.overflow = '';
        }

        if (mobileFilterBtn) {
            mobileFilterBtn.addEventListener('click', openMobileFilter);
        }

        if (closeMobileFilter) {
            closeMobileFilter.addEventListener('click', closeMobileFilterFunc);
        }

        if (mobileFilterOverlay) {
            mobileFilterOverlay.addEventListener('click', closeMobileFilterFunc);
        }

        // Sync mobile filters with desktop filters
        const mobileForm = document.getElementById('mobileFilterForm');
        if (mobileForm) {
            mobileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                closeMobileFilterFunc();
                
                // Copy mobile filter values to desktop form
                const desktopForm = document.getElementById('filterForm');
                const mobileCheckboxes = mobileForm.querySelectorAll('.mobile-filter-checkbox');
                
                // Clear desktop filters first
                desktopForm.querySelectorAll('.filter-checkbox').forEach(cb => cb.checked = false);
                
                // Apply mobile selections to desktop
                mobileCheckboxes.forEach(mobileCb => {
                    if (mobileCb.checked) {
                        const name = mobileCb.name;
                        const value = mobileCb.value;
                        const desktopCb = desktopForm.querySelector(`input[name="${name}"][value="${value}"]`);
                        if (desktopCb) {
                            desktopCb.checked = true;
                        }
                    }
                });
                
                // Trigger desktop form submission
                desktopForm.dispatchEvent(new Event('submit'));
            });
        }

        finishProgressBar();

        // AJAX update function
        function ajaxUpdate(url, formData) {
            var productsGrid = document.getElementById('productsGrid');
            var productsLoading = document.getElementById('productsLoading');
            startProgressBar();
            productsGrid.style.display = 'none';
            productsLoading.style.display = 'block';
            
            fetch(url + (formData ? ('?' + formData) : ''), {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
                credentials: 'same-origin',
                cache: 'no-store',
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newGrid = doc.getElementById('productsGrid');
                
                if (newGrid) {
                    productsGrid.innerHTML = newGrid.innerHTML;
                }
                
                productsGrid.style.display = '';
                productsLoading.style.display = 'none';
                finishProgressBar();
                convertUnits && convertUnits();
                
                if (window.history && window.history.pushState) {
                    let urlBase = url.split('?')[0];
                    let newUrl = urlBase + (formData ? ('?' + formData) : '');
                    window.history.pushState({}, '', newUrl);
                }
                
                afterAjaxUpdate && afterAjaxUpdate();
            })
            .catch(() => {
                productsGrid.style.display = '';
                productsLoading.style.display = 'none';
                finishProgressBar();
            });
        }

        // Unit toggle functionality
        const siBtn = document.getElementById('siBtn');
        const imperialBtn = document.getElementById('imperialBtn');
        const unitInput = document.getElementById('unitInput');
        
        if (siBtn) {
            siBtn.addEventListener('click', function() {
                unitInput.value = 'si';
                siBtn.classList.add('active');
                imperialBtn.classList.remove('active');
                convertUnits();
            });
        }
        
        if (imperialBtn) {
            imperialBtn.addEventListener('click', function() {
                unitInput.value = 'imperial';
                imperialBtn.classList.add('active');
                siBtn.classList.remove('active');
                convertUnits();
            });
        }

        // Filter form logic
        const filterForm = document.getElementById('filterForm');
        const checkboxes = filterForm?.querySelectorAll('.filter-checkbox') || [];
        const mainSearchForm = document.getElementById('mainSearchForm');
        const searchInput = document.getElementById('search');
        let debounceTimeout = null;

        // Debounced AJAX for filter checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                e.preventDefault();
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    if (filterForm) {
                        const formData = new FormData(filterForm);
                        const params = new URLSearchParams();
                        for (const [key, value] of formData) {
                            params.append(key, value);
                        }
                        ajaxUpdate(filterForm.action, params.toString());
                    }
                }, 250);
            });
        });

        // Search form AJAX
        if (mainSearchForm) {
            mainSearchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    const formData = new FormData(mainSearchForm);
                    const filterData = new FormData(filterForm);
                    for (const pair of filterData.entries()) {
                        if (!formData.has(pair[0])) {
                            formData.append(pair[0], pair[1]);
                        }
                    }
                    const params = new URLSearchParams();
                    for (const pair of formData.entries()) {
                        params.append(pair[0], pair[1]);
                    }
                    ajaxUpdate(mainSearchForm.action, params.toString());
                }, 200);
            });
        }

        if (searchInput) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    mainSearchForm.dispatchEvent(new Event('submit'));
                }
            });
        }

        // Unit conversion
        function convertUnits() {
            const isImperial = document.getElementById('imperialBtn')?.classList.contains('active');
            
            document.querySelectorAll('.unit-operating-weight').forEach(function(el) {
                const lb = parseFloat(el.dataset.lb);
                if (!isNaN(lb)) {
                    el.textContent = isImperial ? lb.toFixed(1) + ' lb' : (lb * 0.453592).toFixed(1) + ' kg';
                } else {
                    el.textContent = isImperial ? '- lb' : '- kg';
                }
            });
            
            document.querySelectorAll('.unit-oil-flow').forEach(function(el) {
                const galmin = el.dataset.galmin?.split('~') || [];
                if (galmin.length === 2) {
                    const min = parseFloat(galmin[0]);
                    const max = parseFloat(galmin[1]);
                    if (!isNaN(min) && !isNaN(max)) {
                        el.textContent = isImperial ? 
                            min.toFixed(1) + '~' + max.toFixed(1) + ' gal/min' : 
                            (min * 3.78541).toFixed(1) + '~' + (max * 3.78541).toFixed(1) + ' l/min';
                    } else {
                        el.textContent = isImperial ? '- gal/min' : '- l/min';
                    }
                } else if (galmin.length === 1) {
                    const val = parseFloat(galmin[0]);
                    if (!isNaN(val)) {
                        el.textContent = isImperial ? val.toFixed(1) + ' gal/min' : (val * 3.78541).toFixed(1) + ' l/min';
                    } else {
                        el.textContent = isImperial ? '- gal/min' : '- l/min';
                    }
                }
            });
            
            document.querySelectorAll('.unit-carrier').forEach(function(el) {
                const lb = el.dataset.lb?.split('~') || [];
                if (lb.length === 2) {
                    const min = parseFloat(lb[0]);
                    const max = parseFloat(lb[1]);
                    if (!isNaN(min) && !isNaN(max)) {
                        el.textContent = isImperial ? 
                            min.toLocaleString(undefined, { maximumFractionDigits: 1 }) + '~' + max.toLocaleString(undefined, { maximumFractionDigits: 1 }) + ' lb' : 
                            (min * 0.000453592).toFixed(1) + '~' + (max * 0.000453592).toFixed(1) + ' ton';
                    } else {
                        el.textContent = isImperial ? '- lb' : '- ton';
                    }
                } else if (lb.length === 1) {
                    const val = parseFloat(lb[0]);
                    if (!isNaN(val)) {
                        el.textContent = isImperial ? 
                            val.toLocaleString(undefined, { maximumFractionDigits: 1 }) + ' lb' : 
                            (val * 0.000453592).toFixed(1) + ' ton';
                    } else {
                        el.textContent = isImperial ? '- lb' : '- ton';
                    }
                }
            });
        }

        // Initialize unit conversion
        convertUnits();

        // Set initial unit state
        const currentUnit = '{{ $unit }}';
        if (currentUnit === 'imperial') {
            imperialBtn?.classList.add('active');
            siBtn?.classList.remove('active');
        } else {
            siBtn?.classList.add('active');
            imperialBtn?.classList.remove('active');
        }

        // Filter reset functionality
        const resetFiltersBtn = document.getElementById('resetFiltersBtn');
        const resetMobileFiltersBtn = document.getElementById('resetMobileFiltersBtn');
        
        function resetFilters() {
            filterForm?.querySelectorAll('.filter-checkbox').forEach(cb => { cb.checked = false; });
            mobileForm?.querySelectorAll('.mobile-filter-checkbox').forEach(cb => { cb.checked = false; });
            
            const params = new URLSearchParams();
            params.append('unit', unitInput?.value || 'imperial');
            if (filterForm) {
                ajaxUpdate(filterForm.action, params.toString());
            }
        }

        resetFiltersBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            resetFilters();
        });

        resetMobileFiltersBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            resetFilters();
        });

        // Filter category toggle
        document.querySelectorAll('.filter-category-header').forEach(header => {
            header.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const options = document.querySelector(targetId);
                const isExpanded = this.classList.contains('expanded');

                this.classList.toggle('expanded', !isExpanded);
                this.classList.toggle('collapsed', isExpanded);

                // Update chevron direction (up for expanded, down for collapsed)
                const chevron = this.querySelector('.filter-arrow i');
                if (chevron) {
                    chevron.classList.toggle('fa-chevron-up', !isExpanded);
                    chevron.classList.toggle('fa-chevron-down', isExpanded);
                }

                if (options) {
                    options.classList.toggle('collapsed', isExpanded);
                    options.classList.toggle('expanded', !isExpanded);
                }
            });
        });

        // Initialize filter categories as expanded
        function expandAllFilterCategories() {
            document.querySelectorAll('.filter-category-header').forEach(header => {
                header.classList.add('expanded');
                header.classList.remove('collapsed');
            });
            document.querySelectorAll('.filter-options').forEach(options => {
                options.classList.add('expanded');
                options.classList.remove('collapsed');
            });
        }

        expandAllFilterCategories();

        // Sort functionality
        document.querySelectorAll('.sort-option').forEach(function(option) {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const sortValue = this.dataset.sort;
                const sortInput = document.getElementById('sortInput');
                if (sortInput) {
                    sortInput.value = sortValue;
                }

                // Update label
                const sortLabel = document.getElementById('sortLabel');
                let labelText = 'Sort';
                switch (sortValue) {
                    case 'carrier-desc': labelText = 'Carrier (High to Low)'; break;
                    case 'carrier-asc': labelText = 'Carrier (Low to High)'; break;
                    case 'weight-desc': labelText = 'Weight (High to Low)'; break;
                    case 'weight-asc': labelText = 'Weight (Low to High)'; break;
                    default: labelText = 'Sort'; break;
                }
                if (sortLabel) sortLabel.textContent = labelText;

                // Update active state
                document.querySelectorAll('.sort-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');

                // Trigger form submission
                if (filterForm) {
                    const filterFormData = new FormData(filterForm);
                    const searchFormData = new FormData(mainSearchForm);
                    
                    for (const [key, value] of searchFormData.entries()) {
                        if (!filterFormData.has(key)) {
                            filterFormData.append(key, value);
                        }
                    }
                    
                    filterFormData.set('sort', sortValue);
                    
                    const params = new URLSearchParams();
                    for (const pair of filterFormData.entries()) {
                        params.append(pair[0], pair[1]);
                    }
                    
                    const urlBase = filterForm.action;
                    const newUrl = urlBase + (params.toString() ? ('?' + params.toString()) : '');
                    window.location = newUrl;
                }
            });
        });

        // Copy link functionality
        const copyButtons = document.querySelectorAll('.copy-link-btn');
        const copyToast = document.getElementById('copyToast');

        copyButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                
                const url = this.getAttribute('data-url');
                navigator.clipboard.writeText(url).then(() => {
                    copyToast?.classList.add('active');
                    setTimeout(() => {
                        copyToast?.classList.remove('active');
                    }, 2000);
                }).catch(err => {
                    console.error('Copy failed:', err);
                });
            });
        });

        // After AJAX update function
        function afterAjaxUpdate() {
            expandAllFilterCategories();
            convertUnits();
            
            // Re-attach copy link event listeners
            document.querySelectorAll('.copy-link-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const url = this.getAttribute('data-url');
                    navigator.clipboard.writeText(url).then(() => {
                        copyToast?.classList.add('active');
                        setTimeout(() => {
                            copyToast?.classList.remove('active');
                        }, 2000);
                    });
                });
            });
        }

        // Expose functions globally for reuse
        window.ajaxUpdate = ajaxUpdate;
        window.convertUnits = convertUnits;
        window.afterAjaxUpdate = afterAjaxUpdate;
    });
</script>
@endpush
@endsection