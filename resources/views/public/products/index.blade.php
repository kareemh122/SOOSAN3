@extends('layouts.public')

@section('title', 'Drilling Equipment Products - Soosan Cebotics')
@section('description', 'Browse our comprehensive range of drilling equipment and machinery.')

@section('content')
<div class="bg-light py-5">
    <div class="container">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1 class="display-6 fw-bold text-dark mb-0">Products</h1>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="unitToggle" {{ $unit === 'imperial' ? 'checked' : '' }}>
                <label class="form-check-label" for="unitToggle">SI / lb-ft</label>
            </div>
        </div>
        <!-- Centered Search Bar with improved styling and icon -->
        <form id="mainSearchForm" method="GET" action="{{ route('products.index') }}" class="d-flex justify-content-center mb-4" autocomplete="off">
            <div class="input-group shadow rounded-pill" style="max-width: 500px; background: #fff;">
                <span class="input-group-text bg-white border-0 rounded-start-pill px-3" style="font-size: 1.3rem; color: #888;">
                    <i class="bi bi-search"></i>
                </span>
                <input type="hidden" name="unit" value="{{ $unit }}">
                <input type="text" name="search" id="search" class="form-control border-0 rounded-0 rounded-end-pill px-3 py-2" maxlength="100" value="{{ old('search', e($search ?? '')) }}" placeholder="Enter product model name" style="font-size: 1.1rem; background: #fff;">
                <button class="btn btn-primary rounded-end-pill px-4" type="submit" style="font-weight: 500;">
                    Search
                </button>
            </div>
        </form>
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3 mb-4">
                <form id="filterForm" method="GET" action="{{ route('products.index') }}">
                    <input type="hidden" name="unit" id="unitInput" value="{{ $unit }}">
                    <div class="card p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Filter</h5>
                            <a href="{{ route('products.index', ['unit' => $unit]) }}" class="text-secondary" title="Reset Filters" style="font-size: 1.2rem;">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </div>
                        <!-- Line Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Line</label>
                            @foreach ($lines as $line)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="line[]" value="{{ $line }}" id="line-{{ $line }}" {{ in_array($line, (array)request('line', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="line-{{ $line }}">{{ $line }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!-- Type Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Type</label>
                            @foreach ($types as $type)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="type[]" value="{{ $type }}" id="type-{{ $type }}" {{ in_array($type, (array)request('type', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="type-{{ $type }}">{{ $type }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!-- Operating Weight Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Operating Weight</label>
                            @foreach ($operating_weights as $weight)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="operating_weight[]" value="{{ $weight }}" id="weight-{{ $weight }}" {{ in_array($weight, (array)request('operating_weight', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="weight-{{ $weight }}">{{ $weight }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!-- Required Oil Flow Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Required Oil Flow</label>
                            @foreach ($required_oil_flows as $flow)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="required_oil_flow[]" value="{{ $flow }}" id="flow-{{ $flow }}" {{ in_array($flow, (array)request('required_oil_flow', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flow-{{ $flow }}">{{ $flow }}</label>
                                </div>
                            @endforeach
                        </div>
                        <!-- Applicable Carrier Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Applicable Carrier</label>
                            @foreach ($applicable_carriers as $carrier)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="applicable_carrier[]" value="{{ $carrier }}" id="carrier-{{ $carrier }}" {{ in_array($carrier, (array)request('applicable_carrier', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="carrier-{{ $carrier }}">{{ $carrier }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </form>
            </div>
            <!-- Products Grid -->
            <div class="col-lg-9">
                @if ($products->count() > 0)
                    <div class="row g-4 mb-4">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card h-100 product-card">
                                    @if (!empty($product->image_url))
                                        <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                                    @elseif (method_exists($product, 'getFirstMediaUrl'))
                                        <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->model_name }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                            <span class="text-muted">No Image</span>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title fw-semibold mb-2">{{ $product->model_name }}</h5>
                                        <ul class="list-unstyled mb-0">
                                            <li><strong>Operating Weight:</strong> <span class="unit-operating-weight" data-kg="{{ $product->operating_weight }}">{{ $product->operating_weight }} kg</span></li>
                                            <li><strong>Required Oil Flow:</strong> <span class="unit-oil-flow" data-lmin="{{ $product->required_oil_flow }}">{{ $product->required_oil_flow }} l/min</span></li>
                                            <li><strong>Applicable Carrier:</strong> <span class="unit-carrier" data-ton="{{ $product->applicable_carrier }}">{{ $product->applicable_carrier }} ton</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <h3 class="h4 fw-semibold text-dark mb-2">No products found</h3>
                        <p class="text-muted mb-4">Try adjusting your search criteria or browse all categories.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // Auto-submit form on filter change
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filterForm');
        const checkboxes = form.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                form.submit();
            });
        });
        // SI/lb-ft toggle
        const unitToggle = document.getElementById('unitToggle');
        const unitInput = document.getElementById('unitInput');
        unitToggle.addEventListener('change', function() {
            unitInput.value = unitToggle.checked ? 'imperial' : 'si';
            form.submit();
        });
        // Dynamic unit conversion
        function convertUnits() {
            const isImperial = unitToggle.checked;
            document.querySelectorAll('.unit-operating-weight').forEach(function(el) {
                const kg = parseFloat(el.dataset.kg);
                if (!isNaN(kg)) {
                    el.textContent = isImperial ? (kg * 2.20462).toFixed(0) + ' lb' : kg + ' kg';
                }
            });
            document.querySelectorAll('.unit-oil-flow').forEach(function(el) {
                const lmin = el.dataset.lmin.split('~');
                if (lmin.length === 2) {
                    const min = parseFloat(lmin[0]);
                    const max = parseFloat(lmin[1]);
                    if (!isNaN(min) && !isNaN(max)) {
                        el.textContent = isImperial ? (min * 0.264172).toFixed(1) + '~' + (max * 0.264172).toFixed(1) + ' gal/min' : min + '~' + max + ' l/min';
                    }
                } else {
                    const val = parseFloat(lmin[0]);
                    if (!isNaN(val)) {
                        el.textContent = isImperial ? (val * 0.264172).toFixed(1) + ' gal/min' : val + ' l/min';
                    }
                }
            });
            document.querySelectorAll('.unit-carrier').forEach(function(el) {
                const ton = el.dataset.ton.split('~');
                if (ton.length === 2) {
                    const min = parseFloat(ton[0]);
                    const max = parseFloat(ton[1]);
                    if (!isNaN(min) && !isNaN(max)) {
                        el.textContent = isImperial ? (min * 2204.62).toLocaleString() + '~' + (max * 2204.62).toLocaleString() + ' lb' : min + '~' + max + ' ton';
                    }
                } else {
                    const val = parseFloat(ton[0]);
                    if (!isNaN(val)) {
                        el.textContent = isImperial ? (val * 2204.62).toLocaleString() + ' lb' : val + ' ton';
                    }
                }
            });
        }
        convertUnits();
        unitToggle.addEventListener('change', convertUnits);
        // Only submit search on button click or Enter
        const mainSearchForm = document.getElementById('mainSearchForm');
        const searchInput = document.getElementById('search');
        mainSearchForm.addEventListener('submit', function(e) {
            // Allow submit
        });
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                mainSearchForm.submit();
            }
        });
    });
</script>
@endpush
@endsection
