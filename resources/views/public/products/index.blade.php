@extends('layouts.public')

@section('title', __('common.products_title') . ' - Soosan Cebotics')
@section('description', __('common.products_description'))

@section('page-header')
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-12 col-lg-8">
                <h1 class="products-heading text-start" style="font-size:3rem; font-weight:700; color:#002147; margin-bottom: 0.5rem;">Hydraulic Breakers</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom-products.css') }}">
<div class="bg-light py-5">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <form id="mainSearchForm" method="GET" action="{{ route('products.index') }}" autocomplete="off">
                    <div class="input-group shadow rounded-pill" style="width: 100%; background: #fff;">
                        <input type="hidden" name="unit" value="{{ $unit }}">
                        <input type="text" name="search" id="search" class="form-control border-0 rounded-0 rounded-start-pill px-4 py-3" maxlength="100" value="{{ old('search', e($search ?? '')) }}" placeholder="Search by model, type, line, or specs..." style="font-size: 1.2rem; background: #fff;">
                        <button class="btn search-btn rounded-end-pill px-4 d-flex align-items-center" type="submit" style="background:#002147; color:#fff; border:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 16 16" class="me-2" style="vertical-align:middle;"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="unit-toggle-group ms-3" role="group" aria-label="Unit Toggle">
                    <button type="button" class="unit-toggle-btn{{ $unit === 'si' ? ' active' : '' }}" id="siBtn">{{ __('common.si_units') }}</button>
                    <button type="button" class="unit-toggle-btn{{ $unit === 'imperial' ? ' active' : '' }}" id="imperialBtn">{{ __('common.imperial_units') }}</button>
                </div>
            </div>
            <div class="flex-grow-1 d-none d-lg-block"></div>
        </div>
        <!-- Filter Sidebar -->
        <div class="row products-layout-row align-items-start">
            <div class="col-lg-3 mb-4">
                <form id="filterForm" method="GET" action="{{ route('products.index') }}">
                    <input type="hidden" name="unit" id="unitInput" value="{{ $unit }}">
                    <input type="hidden" name="sort" id="sortInput" value="{{ $sort ?? 'none' }}">
                    <div class="card p-3 mb-3 shadow-sm border-0" style="margin-top: 51px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">{{ __('common.filter') }}</h5>
                            <button type="button" id="resetFiltersBtn" class="btn btn-link p-0 m-0 text-primary" title="{{ __('common.reset_filters') }}" style="font-size: 1.3rem;">
                                <i class="fas fa-rotate-right"></i>
                            </button>
                        </div>
                        <!-- Filter Options with Expandable Categories -->
                        @foreach ([
                            [__('common.line'), $lines, 'line'], 
                            [__('common.type'), $types, 'type'], 
                            [__('common.operating_weight'), $operating_weights, 'operating_weight'], 
                            [__('common.required_oil_flow'), $required_oil_flows, 'required_oil_flow'], 
                            [__('common.applicable_carrier'), $applicable_carriers, 'applicable_carrier']
                        ] as $i => [$label, $options, $name])
                            <div class="filter-category mb-4">
                                <div class="filter-category-header" data-target="#filter-{{ $name }}">
                                    <span class="filter-arrow">▶</span>
                                    <label class="form-label fw-semibold mb-0">{{ $label }}</label>
                                </div>
                                <div id="filter-{{ $name }}" class="filter-options">
                                    @foreach ($options as $option)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input filter-checkbox" type="checkbox" name="{{ $name }}[]" value="{{ $option }}" id="{{ $name }}-{{ $option }}" {{ in_array($option, (array)request($name, [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $name }}-{{ $option }}">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if ($i < 4)
                                <hr class="my-2" style="border-top: 1.5px solid #e5e7eb; opacity: 0.7;">
                            @endif
                        @endforeach
                    </div>
                </form>
            </div>
            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div></div>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center gap-2" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-sort"></i>
                            <span id="sortLabel">
                                @switch($sort ?? 'none')
                                    @case('carrier-desc') Applicable Carrier (High to Low) @break
                                    @case('carrier-asc') Applicable Carrier (Low to High) @break
                                    @case('weight-desc') Operating Weight (High to Low) @break
                                    @case('weight-asc') Operating Weight (Low to High) @break
                                    @default None (Default)
                                @endswitch
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="none"><i class="fas fa-ban me-2"></i>None (Default Order)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="carrier-desc"><i class="fas fa-arrow-down-wide-short me-2"></i>Applicable Carrier (High to Low)</a></li>
                            <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="carrier-asc"><i class="fas fa-arrow-up-short-wide me-2"></i>Applicable Carrier (Low to High)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="weight-desc"><i class="fas fa-arrow-down-wide-short me-2"></i>Operating Weight (High to Low)</a></li>
                            <li><a class="dropdown-item d-flex align-items-center sort-option" href="#" data-sort="weight-asc"><i class="fas fa-arrow-up-short-wide me-2"></i>Operating Weight (Low to High)</a></li>
                        </ul>
                    </div>
                </div>
                <div id="productsGrid">
                    @if ($products->count() > 0)
                        <div class="row g-4 mb-4">
                            @foreach ($products as $product)
                                <div class="col-sm-6 col-lg-4 d-flex justify-content-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                        <div class="card h-100 product-card shadow-sm border- interactive-card" style="min-height: 340px; width: 320px;">
                                            @if (!empty($product->image_url))
                                                <div style="background: #fff; display: flex; align-items: center; justify-content: center; height: 200px;">
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" class="card-img-top" style="max-height: 180px; max-width: 100%; object-fit: contain; width: auto; height: auto;" loading="lazy">
                                                </div>
                                            @elseif (method_exists($product, 'getFirstMediaUrl'))
                                                <div style="background: #fff; display: flex; align-items: center; justify-content: center; height: 200px;">
                                                    <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->model_name }}" class="card-img-top" style="max-height: 180px; max-width: 100%; object-fit: contain; width: auto; height: auto;" loading="lazy">
                                                </div>
                                            @else
                                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                    <span class="text-muted">{{ __('common.no_image') }}</span>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title mb-2" style="font-size: 1.6rem;">{{ $product->model_name }}</h5>
                                                <ul class="list-unstyled mb-0 flex-column">
                                                    <li class="attribute-row"><span class="attribute-label">{{ __('common.operating_weight') }}:</span> <span class="attribute-value unit-operating-weight" data-lb="{{ $product->operating_weight }}">{{ $product->operating_weight }} {{ __('common.unit_lb') }}</span></li>
                                                    <li class="attribute-row"><span class="attribute-label">{{ __('common.required_oil_flow') }}:</span> <span class="attribute-value">{{ $product->required_oil_flow }} {{ __('common.unit_gal_min') }}</span></li>
                                                    <li class="attribute-row"><span class="attribute-label">{{ __('common.applicable_carrier') }}:</span> <span class="attribute-value unit-carrier" data-lb="{{ $product->applicable_carrier }}">{{ $product->applicable_carrier }} {{ __('common.unit_lb') }}</span></li>
                                                </ul>
                                            </div>
                                            <button class="copy-link-btn" data-url="{{ route('products.show', $product->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 16 16">
                                                    <path d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                                                    <path d="M2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H2zm0 1h8v7H2V6z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <div class="text-center text-muted small mb-2">
                                {{ __('common.showing_results', [
                                    'first' => $products->firstItem(),
                                    'last' => $products->lastItem(),
                                    'total' => $products->total()
                                ]) }}
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h3 class="h4 fw-semibold text-dark mb-2">{{ __('common.no_products_found') }}</h3>
                            <p class="text-muted mb-4">{{ __('common.try_adjusting_search') }}</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('common.view_all_products') }}</a>
                        </div>
                    @endif
                </div>
                <div id="productsLoading" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status"><span class="visually-hidden">{{ __('common.loading') }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pageProgressBar"></div>
<div id="copyToast" class="copy-toast">Link copied to clipboard</div>
@push('scripts')
<script>
    // Top progress bar logic
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

    // Show progress bar on filter/sort submit
    var filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function() {
            startProgressBar();
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        finishProgressBar();

        // AJAX integration for progress bar
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
        const newTotal = doc.getElementById('totalProducts');
        if (newGrid) {
            productsGrid.innerHTML = newGrid.innerHTML;
        }
        if (newTotal) {
            document.getElementById('totalProducts').textContent = newTotal.textContent;
        }
        productsGrid.style.display = '';
        productsLoading.style.display = 'none';
        finishProgressBar();
        convertUnits && convertUnits();
        // Update the browser URL to reflect the current query params
        if (window.history && window.history.pushState) {
            let urlBase = url.split('?')[0];
            let newUrl = urlBase + (formData ? ('?' + formData) : '');
            window.history.pushState({}, '', newUrl);
        }
        // After DOM update, re-attach all event listeners and restore UI state
        afterAjaxUpdate && afterAjaxUpdate();
    })
    .catch(() => {
        productsGrid.style.display = '';
        productsLoading.style.display = 'none';
        finishProgressBar();
    });
    }
        // Toggle logic
        const siBtn = document.getElementById('siBtn');
        const imperialBtn = document.getElementById('imperialBtn');
        const unitInput = document.getElementById('unitInput');
        siBtn.addEventListener('click', function() {
            unitInput.value = 'si';
            siBtn.classList.add('active');
            imperialBtn.classList.remove('active');
            document.getElementById('filterForm').dispatchEvent(new Event('submit'));
        });
        imperialBtn.addEventListener('click', function() {
            unitInput.value = 'imperial';
            imperialBtn.classList.add('active');
            siBtn.classList.remove('active');
            document.getElementById('filterForm').dispatchEvent(new Event('submit'));
        });

        // AJAX filter logic
        const filterForm = document.getElementById('filterForm');
        const checkboxes = filterForm.querySelectorAll('.filter-checkbox');
        const productsGrid = document.getElementById('productsGrid');
        const productsLoading = document.getElementById('productsLoading');
        const mainSearchForm = document.getElementById('mainSearchForm');
        const searchInput = document.getElementById('search');
        let debounceTimeout = null;

        function ajaxUpdate(url, formData) {
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
                const newTotal = doc.getElementById('totalProducts');
                if (newGrid) {
                    productsGrid.innerHTML = newGrid.innerHTML;
                }
                if (newTotal) {
                    document.getElementById('totalProducts').textContent = newTotal.textContent;
                }
                productsGrid.style.display = '';
                productsLoading.style.display = 'none';
                convertUnits();
                attachPaginationAjax();
                focusFirstCard();
            })
            .catch(() => {
                productsGrid.style.display = '';
                productsLoading.style.display = 'none';
            });
        }

        // Debounced AJAX for filter checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                e.preventDefault();
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    const formData = new FormData(filterForm);
                    const params = new URLSearchParams();
                    for (const [key, value] of formData) {
                        params.append(key, value);
                    }
                    ajaxUpdate(filterForm.action, params.toString());
                }, 250);
            });
        });

        // AJAX for pagination
        function attachPaginationAjax() {
            productsGrid.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = new URL(this.getAttribute('href'), window.location.origin);
                    const filterFormData = new FormData(filterForm);
                    const searchFormData = new FormData(mainSearchForm);
                    for (const [key, value] of searchFormData.entries()) {
                        if (!filterFormData.has(key)) {
                            filterFormData.append(key, value);
                        }
                    }
                    const page = url.searchParams.get('page');
                    if (page) {
                        filterFormData.set('page', page);
                    }
                    const params = new URLSearchParams();
                    for (const pair of filterFormData.entries()) {
                        params.append(pair[0], pair[1]);
                    }
                    ajaxUpdate(filterForm.action, params.toString());
                });
            });
        }
        attachPaginationAjax();

        // AJAX for search bar
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
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                mainSearchForm.dispatchEvent(new Event('submit'));
            }
        });

        // Dynamic unit conversion
        function convertUnits() {
            const isImperial = document.getElementById('imperialBtn').classList.contains('active');
            document.querySelectorAll('.unit-operating-weight').forEach(function(el) {
                const lb = parseFloat(el.dataset.lb);
                if (!isNaN(lb)) {
                    el.textContent = isImperial ? lb.toFixed(1) + ' lb' : (lb * 0.453592).toFixed(1) + ' kg';
                } else {
                    el.textContent = isImperial ? '- lb' : '- kg';
                }
            });
            document.querySelectorAll('.unit-oil-flow').forEach(function(el) {
                const galmin = el.dataset.galmin.split('~');
                if (galmin.length === 2) {
                    const min = parseFloat(galmin[0]);
                    const max = parseFloat(galmin[1]);
                    if (!isNaN(min) && !isNaN(max)) {
                        el.textContent = isImperial ? min.toFixed(1) + '~' + max.toFixed(1) + ' gal/min' : (min * 3.78541).toFixed(1) + '~' + (max * 3.78541).toFixed(1) + ' l/min';
                    } else {
                        el.textContent = isImperial ? '- gal/min' : '- l/min';
                    }
                } else {
                    const val = parseFloat(galmin[0]);
                    if (!isNaN(val)) {
                        el.textContent = isImperial ? val.toFixed(1) + ' gal/min' : (val * 3.78541).toFixed(1) + ' l/min';
                    } else {
                        el.textContent = isImperial ? '- gal/min' : '- l/min';
                    }
                }
            });
            document.querySelectorAll('.unit-carrier').forEach(function(el) {
                const lb = el.dataset.lb.split('~');
                if (lb.length === 2) {
                    const min = parseFloat(lb[0]);
                    const max = parseFloat(lb[1]);
                    if (!isNaN(min) && !isNaN(max)) {
                        el.textContent = isImperial ? min.toLocaleString(undefined, { maximumFractionDigits: 1 }) + '~' + max.toLocaleString(undefined, { maximumFractionDigits: 1 }) + ' lb' : (min * 0.000453592).toFixed(1) + '~' + (max * 0.000453592).toFixed(1) + ' ton';
                    } else {
                        el.textContent = isImperial ? '- lb' : '- ton';
                    }
                } else {
                    const val = parseFloat(lb[0]);
                    if (!isNaN(val)) {
                        el.textContent = isImperial ? val.toLocaleString(undefined, { maximumFractionDigits: 1 }) + ' lb' : (val * 0.000453592).toFixed(1) + ' ton';
                    } else {
                        el.textContent = isImperial ? '- lb' : '- ton';
                    }
                }
            });
        }
        convertUnits();
        siBtn.addEventListener('click', convertUnits);
        imperialBtn.addEventListener('click', convertUnits);

        // Set initial unit state
        if ('{{ $unit }}' === 'imperial') {
            imperialBtn.classList.add('active');
            siBtn.classList.remove('active');
        } else {
            siBtn.classList.add('active');
            imperialBtn.classList.remove('active');
        }
        convertUnits();

        // Filter reset logic
        document.getElementById('resetFiltersBtn').addEventListener('click', function(e) {
            e.preventDefault();
            filterForm.querySelectorAll('.filter-checkbox').forEach(cb => { cb.checked = false; });
            const params = new URLSearchParams();
            params.append('unit', unitInput.value);
            ajaxUpdate(filterForm.action, params.toString());
        });

        // Accessibility: focus first product card after AJAX
        function focusFirstCard() {
            const firstCard = productsGrid.querySelector('.product-card');
            if (firstCard) {
                firstCard.setAttribute('tabindex', '-1');
                firstCard.focus({ preventScroll: true });
            }
        }

        // Filter category toggle logic
        document.querySelectorAll('.filter-category-header').forEach(header => {
            header.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const options = document.querySelector(targetId);
                const isExpanded = this.classList.contains('expanded');
                this.classList.toggle('expanded', !isExpanded);
                this.classList.toggle('collapsed', isExpanded);
                options.classList.toggle('collapsed', isExpanded);
                options.classList.toggle('expanded', !isExpanded);
            });
        });

        // Initialize filter categories
        document.querySelectorAll('.filter-category').forEach(category => {
            const header = category.querySelector('.filter-category-header');
            const options = category.querySelector('.filter-options');
            header.classList.add('collapsed');
            options.classList.add('collapsed');
        });

        // Similar products carousel scroll logic
        const similarCarousel = document.getElementById('similarProductsCarousel');
        const rightArrow = document.getElementById('carouselRightArrow');
        if (similarCarousel && rightArrow) {
            rightArrow.addEventListener('click', function() {
                similarCarousel.scrollBy({ left: 320, behavior: 'smooth' });
            });
        }
    });

        document.querySelectorAll('.sort-option').forEach(function(option) {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            const sortValue = this.dataset.sort;
            document.getElementById('sortInput').value = sortValue;
            // Update label immediately
            const sortLabel = document.getElementById('sortLabel');
            let labelText = 'None (Default Order)';
            switch (sortValue) {
                case 'carrier-desc': labelText = 'Applicable Carrier (High to Low)'; break;
                case 'carrier-asc': labelText = 'Applicable Carrier (Low to High)'; break;
                case 'weight-desc': labelText = 'Operating Weight (High to Low)'; break;
                case 'weight-asc': labelText = 'Operating Weight (Low to High)'; break;
            }
            if (sortLabel) sortLabel.textContent = labelText;
            // Update active class in dropdown
            document.querySelectorAll('.sort-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            // Gather all filter and search params for AJAX
            const filterForm = document.getElementById('filterForm');
            const mainSearchForm = document.getElementById('mainSearchForm');
            const filterFormData = new FormData(filterForm);
            const searchFormData = new FormData(mainSearchForm);
            for (const [key, value] of searchFormData.entries()) {
                if (!filterFormData.has(key)) {
                    filterFormData.append(key, value);
                }
            }
            const params = new URLSearchParams();
            for (const pair of filterFormData.entries()) {
                params.append(pair[0], pair[1]);
            }
            // Use the same AJAX update logic as filters/search
            if (typeof ajaxUpdate === 'function') {
                ajaxUpdate(filterForm.action, params.toString());
            }
        });
    });

    // Ensure sort label and active state update after AJAX update
    function updateSortLabelAndActive() {
        const sortInput = document.getElementById('sortInput');
        const sortLabel = document.getElementById('sortLabel');
        let labelText = 'None (Default Order)';
        switch (sortInput.value) {
            case 'carrier-desc': labelText = 'Applicable Carrier (High to Low)'; break;
            case 'carrier-asc': labelText = 'Applicable Carrier (Low to High)'; break;
            case 'weight-desc': labelText = 'Operating Weight (High to Low)'; break;
            case 'weight-asc': labelText = 'Operating Weight (Low to High)'; break;
        }
        if (sortLabel) sortLabel.textContent = labelText;
        document.querySelectorAll('.sort-option').forEach(opt => {
            opt.classList.toggle('active', opt.dataset.sort === sortInput.value);
        });
    }

    // Expand all filter categories by default
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

    document.addEventListener('DOMContentLoaded', function() {
        expandAllFilterCategories();
        updateSortLabelAndActive();
        // Attach sort click handlers on first load
        document.querySelectorAll('.sort-option').forEach(function(option) {
            option.onclick = null;
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const sortValue = this.dataset.sort;
                document.getElementById('sortInput').value = sortValue;
                // Update label immediately
                const sortLabel = document.getElementById('sortLabel');
                let labelText = 'None (Default Order)';
                switch (sortValue) {
                    case 'carrier-desc': labelText = 'Applicable Carrier (High to Low)'; break;
                    case 'carrier-asc': labelText = 'Applicable Carrier (Low to High)'; break;
                    case 'weight-desc': labelText = 'Operating Weight (High to Low)'; break;
                    case 'weight-asc': labelText = 'Operating Weight (Low to High)'; break;
                }
                if (sortLabel) sortLabel.textContent = labelText;
                document.querySelectorAll('.sort-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                // Gather all filter and search params for AJAX
                const filterForm = document.getElementById('filterForm');
                const mainSearchForm = document.getElementById('mainSearchForm');
                const filterFormData = new FormData(filterForm);
                const searchFormData = new FormData(mainSearchForm);
                for (const [key, value] of searchFormData.entries()) {
                    if (!filterFormData.has(key)) {
                        filterFormData.append(key, value);
                    }
                }
                // Always include sort value
                filterFormData.set('sort', sortValue);
                const params = new URLSearchParams();
                for (const pair of filterFormData.entries()) {
                    params.append(pair[0], pair[1]);
                }
                // Instead of AJAX, trigger a real navigation with all params in the URL
                const urlBase = filterForm.action;
                const newUrl = urlBase + (params.toString() ? ('?' + params.toString()) : '');
                window.location = newUrl;
            });
        });
    });

    // After every AJAX update, restore expanded filter categories and sort label
    function afterAjaxUpdate() {
        expandAllFilterCategories();
        updateSortLabelAndActive();
        // Re-attach sort click handlers
        document.querySelectorAll('.sort-option').forEach(function(option) {
            option.onclick = null;
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const sortValue = this.dataset.sort;
                document.getElementById('sortInput').value = sortValue;
                // Update label immediately
                const sortLabel = document.getElementById('sortLabel');
                let labelText = 'None (Default Order)';
                switch (sortValue) {
                    case 'carrier-desc': labelText = 'Applicable Carrier (High to Low)'; break;
                    case 'carrier-asc': labelText = 'Applicable Carrier (Low to High)'; break;
                    case 'weight-desc': labelText = 'Operating Weight (High to Low)'; break;
                    case 'weight-asc': labelText = 'Operating Weight (Low to High)'; break;
                }
                if (sortLabel) sortLabel.textContent = labelText;
                document.querySelectorAll('.sort-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                // Gather all filter and search params for AJAX
                const filterForm = document.getElementById('filterForm');
                const mainSearchForm = document.getElementById('mainSearchForm');
                const filterFormData = new FormData(filterForm);
                const searchFormData = new FormData(mainSearchForm);
                for (const [key, value] of searchFormData.entries()) {
                    if (!filterFormData.has(key)) {
                        filterFormData.append(key, value);
                    }
                }
                // Always include sort value
                filterFormData.set('sort', sortValue);
                const params = new URLSearchParams();
                for (const pair of filterFormData.entries()) {
                    params.append(pair[0], pair[1]);
                }
                // Instead of AJAX, trigger a real navigation with all params in the URL
                const urlBase = filterForm.action;
                const newUrl = urlBase + (params.toString() ? ('?' + params.toString()) : '');
                window.location = newUrl;
            });
        });
        // Re-attach pagination and focus logic if needed
        attachPaginationAjax && attachPaginationAjax();
        focusFirstCard && focusFirstCard();
    }
    // Copy link functionality
    document.addEventListener('DOMContentLoaded', function () {
            const copyButtons = document.querySelectorAll('.copy-link-btn');
            const copyToast = document.getElementById('copyToast');

            copyButtons.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    navigator.clipboard.writeText(url).then(() => {
                        // Show toast
                        copyToast.classList.add('active');

                        // Hide after 2 seconds
                        setTimeout(() => {
                            copyToast.classList.remove('active');
                        }, 2000);
                    }).catch(err => {
                        console.error('Copy failed:', err);
                    });
                });
            });
        });

</script>
@endpush
@endsection