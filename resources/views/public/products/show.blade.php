@extends('layouts.public')

@section('title', $product->model_name . ' - Soosan Cebotics')
@section('description', 'View details and specifications for ' . $product->model_name)

@section('content')
<style>
/* Enhanced Product Show Page Styles */
:root {
    --primary-blue: #00548e;
    --accent-green: #b0d701;
    --text-dark: #1a1a1a;
    --text-light: #6b7280;
    --bg-light: #f8fafc;
    --bg-white: #ffffff;
    --border-light: #e2e8f0;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
    --shadow-xl: 0 20px 25px rgba(0,0,0,0.1);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --border-radius: 12px;
}

/* Main Container */
.product-container {
    background: linear-gradient(135deg, var(--bg-light) 0%, white 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

/* Product Image Container */
.product-image-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.product-image-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-blue), var(--accent-green));
    opacity: 0;
    transition: var(--transition);
}

.product-image-container:hover::before {
    opacity: 1;
}

.product-image-container:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-blue);
}

.product-image-container img {
    transition: var(--transition);
}

.product-image-container:hover img {
    transform: scale(1.02);
}

/* Product Badge */
.product-badge {
    background: linear-gradient(135deg, var(--primary-blue) 0%, #003d6b 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
}

/* Product Title */
.product-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 2rem;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

/* Specs Cards */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.spec-card {
    background: white;
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius);
    padding: 1.5rem 1rem;
    text-align: center;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.spec-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-blue), var(--accent-green));
    transform: scaleX(0);
    transition: var(--transition);
}

.spec-card:hover::before {
    transform: scaleX(1);
}

.spec-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-blue);
}

.spec-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-blue);
    margin-bottom: 0.5rem;
    transition: var(--transition);
}

.spec-label {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Action Buttons */
.action-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 3rem;
}

.action-btn {
    padding: 1rem 1.5rem;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    border: 2px solid;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: var(--transition);
}

.action-btn:hover::before {
    left: 100%;
}

.btn-share {
    background: white;
    color: var(--primary-blue);
    border-color: var(--primary-blue);
}

.btn-share:hover {
    background: var(--primary-blue);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-pdf {
    background: white;
    color: #dc3545;
    border-color: #dc3545;
}

.btn-pdf:hover {
    background: #dc3545;
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-csv {
    background: white;
    color: #198754;
    border-color: #198754;
}

.btn-csv:hover {
    background: #198754;
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Specifications Section */
.specifications-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
    margin-top: 3rem;
}

.specifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-light);
}

.specifications-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

/* Unit Toggle */
.unit-toggle {
    display: flex;
    background: white;
    border-radius: 50px;
    box-shadow: var(--shadow-sm);
    border: 2px solid var(--border-light);
    overflow: hidden;
}

.unit-toggle .btn {
    border: none;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    border-radius: 0;
}

.unit-toggle .btn:first-child {
    border-radius: 50px 0 0 50px;
}

.unit-toggle .btn:last-child {
    border-radius: 0 50px 50px 0;
}

.unit-toggle .btn-primary {
    background: var(--primary-blue);
    color: white;
}

.unit-toggle .btn-outline-primary {
    background: white;
    color: var(--primary-blue);
    border-color: transparent;
}

.unit-toggle .btn-outline-primary:hover {
    background: var(--accent-green);
    color: white;
}

/* Specifications Table */
.specifications-table {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
}

.specifications-table th {
    background: linear-gradient(135deg, var(--primary-blue) 0%, #003d6b 100%);
    color: white;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border: none;
    width: 40%;
}

.specifications-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border-light);
    background: white;
    transition: var(--transition);
}

.specifications-table tr:last-child td {
    border-bottom: none;
}

.specifications-table tr:hover td {
    background: var(--bg-light);
}

.unit-value {
    font-weight: 600;
    color: var(--text-dark);
    transition: var(--transition);
}

.unit-value.updating {
    opacity: 0.6;
    transform: scale(0.95);
}

/* Similar Products Section */
.similar-products-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
    margin-top: 3rem;
}

.similar-products-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 2rem;
}

/* Carousel */
.carousel-container {
    position: relative;
    overflow: hidden;
    border-radius: var(--border-radius);
    background: var(--bg-light);
    padding: 1rem;
}

.carousel-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: var(--primary-blue);
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    z-index: 10;
    box-shadow: var(--shadow-md);
}

.carousel-arrow:hover {
    background: var(--accent-green);
    transform: translateY(-50%) scale(1.1);
    box-shadow: var(--shadow-lg);
}

.carousel-arrow.prev {
    left: -25px;
}

.carousel-arrow.next {
    right: -25px;
}

.carousel-track {
    display: flex;
    gap: 1.5rem;
    transition: transform 0.4s ease;
    padding: 1rem 0;
}

/* Product Cards in Carousel */
.carousel-product-card {
    flex: 0 0 320px;
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: var(--transition);
    text-decoration: none;
    color: inherit;
}

.carousel-product-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-blue);
    text-decoration: none;
    color: inherit;
}

.carousel-product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-blue), var(--accent-green));
    opacity: 0;
    transition: var(--transition);
}

.carousel-product-card:hover::before {
    opacity: 1;
}

.carousel-image-container {
    height: 200px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    border-bottom: 1px solid var(--border-light);
}

.carousel-image-container img {
    max-height: 180px;
    max-width: 100%;
    object-fit: contain;
    transition: var(--transition);
}

.carousel-product-card:hover .carousel-image-container img {
    transform: scale(1.05);
}

.carousel-card-body {
    padding: 1.5rem;
}

.carousel-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.carousel-specs-list {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}

.carousel-spec-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-light);
    font-size: 0.875rem;
}

.carousel-spec-item:last-child {
    border-bottom: none;
}

.carousel-spec-label {
    color: var(--text-light);
    font-weight: 500;
}

.carousel-spec-value {
    color: var(--text-dark);
    font-weight: 600;
}

.carousel-view-btn {
    width: 100%;
    padding: 0.75rem;
    background: white;
    color: var(--primary-blue);
    border: 2px solid var(--primary-blue);
    border-radius: var(--border-radius);
    font-weight: 600;
    transition: var(--transition);
    text-decoration: none;
    display: block;
    text-align: center;
}

.carousel-view-btn:hover {
    background: var(--primary-blue);
    color: white;
    text-decoration: none;
}

/* Carousel Indicators */
.carousel-indicators {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}

.carousel-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid var(--primary-blue);
    background: transparent;
    cursor: pointer;
    transition: var(--transition);
}

.carousel-indicator.active {
    background: var(--primary-blue);
}

.carousel-indicator:hover {
    background: var(--accent-green);
    border-color: var(--accent-green);
}

/* Toast Notification */
.copy-toast {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: var(--primary-blue);
    color: white;
    padding: 1rem 2rem;
    border-radius: var(--border-radius);
    font-weight: 600;
    box-shadow: var(--shadow-lg);
    transform: translateY(100px);
    opacity: 0;
    transition: var(--transition);
    z-index: 1000;
}

.copy-toast.active {
    transform: translateY(0);
    opacity: 1;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .specs-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    
    .carousel-arrow {
        width: 40px;
        height: 40px;
    }
    
    .carousel-arrow.prev {
        left: -20px;
    }
    
    .carousel-arrow.next {
        right: -20px;
    }
}

@media (max-width: 768px) {
    .product-container {
        padding: 1rem 0;
    }
    
    .product-title {
        font-size: 2rem;
    }
    
    .specs-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .specifications-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .specifications-table th,
    .specifications-table td {
        padding: 0.75rem;
    }
    
    .carousel-container {
        padding: 0.5rem;
    }
    
    .carousel-product-card {
        flex: 0 0 280px;
    }
    
    .carousel-arrow {
        display: none;
    }
    
    .copy-toast {
        bottom: 1rem;
        right: 1rem;
        left: 1rem;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .product-title {
        font-size: 1.75rem;
    }
    
    .specifications-section,
    .similar-products-section {
        padding: 1rem;
    }
    
    .carousel-product-card {
        flex: 0 0 240px;
    }
    
    .unit-toggle .btn {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
}

/* Animation for fade-in effect */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeIn 0.6s ease-out;
}

/* Loading animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.loading {
    animation: pulse 1.5s ease-in-out infinite;
}
</style>

<div class="product-container">
    <div class="container py-4">
        <div class="row g-5 align-items-start">
            <!-- Product Image -->
            <div class="col-lg-6">
                <div class="product-image-container fade-in" style="min-height: 420px; display: flex; align-items: center; justify-content: center; padding: 2rem;">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" style="max-width: 100%; max-height: 500px; object-fit: contain;" loading="lazy">
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-image" style="font-size: 4rem; opacity: 0.3;"></i>
                            <p class="mt-3 mb-0">{{ __('common.no_image') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="product-badge">
                    {{ $product->category->name ?? __('common.product_category') }}
                </div>
                
                <h1 class="product-title">{{ $product->model_name }}</h1>

                <!-- Quick Specs Grid -->
                <div class="specs-grid">
                    <div class="spec-card">
                        <div class="spec-value">
                            @php
                                $ow = $product->operating_weight;
                                $ow_si = $ow ? number_format($ow * 0.45359237, 1) . ' kg' : '- kg';
                                $ow_imperial = $ow ? number_format($ow, 1) . ' lb' : '- lb';
                            @endphp
                            <span class="unit-value" data-si="{{ $ow_si }}" data-imperial="{{ $ow_imperial }}">{{ $ow_si }}</span>
                        </div>
                        <div class="spec-label">{{ __('common.operating_weight') }}</div>
                    </div>
                    
                    <div class="spec-card">
                        <div class="spec-value">
                            @php
                                $rof = $product->required_oil_flow;
                                if ($rof === null || $rof === '') {
                                    $rof_si = '- l/min';
                                    $rof_imperial = '- gal/min';
                                } elseif (preg_match('/^([\d.]+)~([\d.]+)/', $rof, $m)) {
                                    $rof_si = number_format($m[1] * 3.785411784, 1) . ' ~ ' . number_format($m[2] * 3.785411784, 1) . ' l/min';
                                    $rof_imperial = number_format($m[1], 1) . ' ~ ' . number_format($m[2], 1) . ' gal/min';
                                } elseif (is_numeric($rof)) {
                                    $rof_si = number_format($rof * 3.785411784, 1) . ' l/min';
                                    $rof_imperial = number_format($rof, 1) . ' gal/min';
                                } else {
                                    $rof_si = '- l/min';
                                    $rof_imperial = '- gal/min';
                                }
                            @endphp
                            <span class="unit-value" data-si="{{ $rof_si }}" data-imperial="{{ $rof_imperial }}">{{ $rof_si }}</span>
                        </div>
                        <div class="spec-label">{{ __('common.required_oil_flow') }}</div>
                    </div>
                    
                    <div class="spec-card">
                        <div class="spec-value">
                            @php
                                $ac = $product->applicable_carrier;
                                if ($ac === null || $ac === '') {
                                    $ac_si = '- ton';
                                    $ac_imperial = '- lb';
                                } elseif (preg_match('/^([\d.]+)~([\d.]+)/', $ac, $m)) {
                                    $ac_si = number_format($m[1] * 0.00045359237, 1) . ' ~ ' . number_format($m[2] * 0.00045359237, 1) . ' ton';
                                    $ac_imperial = number_format($m[1], 1) . ' ~ ' . number_format($m[2], 1) . ' lb';
                                } elseif (is_numeric($ac)) {
                                    $ac_si = number_format($ac * 0.00045359237, 1) . ' ton';
                                    $ac_imperial = number_format($ac, 1) . ' lb';
                                } else {
                                    $ac_si = '- ton';
                                    $ac_imperial = '- lb';
                                }
                            @endphp
                            <span class="unit-value" data-si="{{ $ac_si }}" data-imperial="{{ $ac_imperial }}">{{ $ac_si }}</span>
                        </div>
                        <div class="spec-label">{{ __('common.applicable_carrier') }}</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" class="action-btn btn-share" id="shareBtn">
                        <i class="fas fa-share-alt"></i>
                        Share
                    </button>
                    <button type="button" class="action-btn btn-pdf" id="pdfBtn">
                        <i class="fas fa-file-pdf"></i>
                        Download PDF
                    </button>
                    <button type="button" class="action-btn btn-csv" id="csvBtn">
                        <i class="fas fa-file-csv"></i>
                        Download CSV
                    </button>
                </div>
            </div>
        </div>

        <!-- Specifications Section -->
        <div class="specifications-section">
            <div class="specifications-header">
                <h3 class="specifications-title">{{ __('common.specifications') }}</h3>
                <div class="unit-toggle btn-group" role="group" aria-label="Unit Toggle">
                    <button type="button" class="btn btn-primary active" id="siBtn">{{ __('common.si') }}</button>
                    <button type="button" class="btn btn-outline-primary" id="imperialBtn">{{ __('common.imperial') }}</button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table specifications-table">
                    <tbody>
                        @php
                            function nf1($v) {
                                return is_numeric($v) ? number_format($v, 1, '.', ',') : $v;
                            }

                            function spec_row($val, $factor, $si_unit, $imp_unit) {
                                if ($val === null || $val === '' || $val === '-') {
                                    return ['- ' . $si_unit, '- ' . $imp_unit];
                                }
                                if (preg_match('/^([\d.]+)~([\d.]+)/', $val, $m)) {
                                    $si_min = nf1($m[1] * $factor);
                                    $si_max = nf1($m[2] * $factor);
                                    return ["$si_min ~ $si_max $si_unit", nf1($m[1]) . ' ~ ' . nf1($m[2]) . " $imp_unit"];
                                }
                                if (preg_match('/^(\d+)\/(\d+)$/', trim($val), $m)) {
                                    $dec = $m[1] / $m[2];
                                    return [nf1($dec * $factor) . " $si_unit", $val . " $imp_unit"];
                                }
                                if (is_numeric($val)) {
                                    return [nf1($val * $factor) . " $si_unit", nf1($val) . " $imp_unit"];
                                }
                                return [$val . " $si_unit", $val . " $imp_unit"];
                            }

                            function bpm_row($val) {
                                $dash = '- BPM';
                                if ($val === null || $val === '' || $val === '-') return [$dash, $dash];
                                if (preg_match('/^([\d.]+)~([\d.]+)/', $val, $m)) {
                                    return [nf1($m[1]) . ' ~ ' . nf1($m[2]) . ' BPM', nf1($m[1]) . ' ~ ' . nf1($m[2]) . ' BPM'];
                                }
                                if (is_numeric($val)) return [nf1($val) . ' BPM', nf1($val) . ' BPM'];
                                return [$val . ' BPM', $val . ' BPM'];
                            }

                            function hose_row($val) {
                                if ($val === null || $val === '' || $val === '-') return ['- in', '- in'];
                                return ["$val in", "$val in"];
                            }

                            function op_row($val) {
                                $si_unit = 'kgf/cm²'; $imp_unit = 'lb-ft';
                                if ($val === null || $val === '' || $val === '-') return ['- ' . $si_unit, '- ' . $imp_unit];
                                if (preg_match('/^([\d.,]+)~([\d.,]+)/', $val, $m)) {
                                    $si_min = nf1(floatval(str_replace([','], [''], $m[1])) * 0.070307);
                                    $si_max = nf1(floatval(str_replace([','], [''], $m[2])) * 0.070307);
                                    return ["$si_min ~ $si_max $si_unit", nf1($m[1]) . ' ~ ' . nf1($m[2]) . " $imp_unit"];
                                }
                                if (is_numeric(str_replace([','], [''], $val))) {
                                    $si = nf1(floatval(str_replace([','], [''], $val)) * 0.070307);
                                    return ["$si $si_unit", nf1($val) . " $imp_unit"];
                                }
                                return [$val . ' ' . $si_unit, $val . ' ' . $imp_unit];
                            }

                            [$bw_si, $bw_imp] = spec_row($product->body_weight, 0.45359237, 'kg', 'lb');
                            [$ow_si, $ow_imp] = spec_row($product->operating_weight, 0.45359237, 'kg', 'lb');
                            [$ol_si, $ol_imp] = spec_row($product->overall_length, 25.4, 'mm', 'in');
                            [$owd_si, $owd_imp] = spec_row($product->overall_width, 25.4, 'mm', 'in');
                            [$oh_si, $oh_imp] = spec_row($product->overall_height, 25.4, 'mm', 'in');
                            [$rof_si, $rof_imp] = spec_row($product->required_oil_flow, 3.785411784, 'l/min', 'gal/min');
                            [$op_si, $op_imp] = op_row($product->operating_pressure);
                            [$ir_si, $ir_imp] = bpm_row($product->impact_rate_std);
                            [$irsr_si, $irsr_imp] = bpm_row($product->impact_rate_soft_rock);
                            [$hd_si, $hd_imp] = hose_row($product->hose_diameter);
                            [$rd_si, $rd_imp] = spec_row($product->rod_diameter, 25.4, 'mm', 'in');
                            [$ac_si, $ac_imp] = spec_row($product->applicable_carrier, 0.00045359237, 'ton', 'lb');
                        @endphp
                        <tr><th>{{ __('common.body_weight') }}</th><td><span class="unit-value" data-si="{{ $bw_si }}" data-imperial="{{ $bw_imp }}">{{ $bw_si }}</span></td></tr>
                        <tr><th>{{ __('common.operating_weight') }}</th><td><span class="unit-value" data-si="{{ $ow_si }}" data-imperial="{{ $ow_imp }}">{{ $ow_si }}</span></td></tr>
                        <tr><th>{{ __('common.overall_length') }}</th><td><span class="unit-value" data-si="{{ $ol_si }}" data-imperial="{{ $ol_imp }}">{{ $ol_si }}</span></td></tr>
                        <tr><th>{{ __('common.overall_width') }}</th><td><span class="unit-value" data-si="{{ $owd_si }}" data-imperial="{{ $owd_imp }}">{{ $owd_si }}</span></td></tr>
                        <tr><th>{{ __('common.overall_height') }}</th><td><span class="unit-value" data-si="{{ $oh_si }}" data-imperial="{{ $oh_imp }}">{{ $oh_si }}</span></td></tr>
                        <tr><th>{{ __('common.required_oil_flow') }}</th><td><span class="unit-value" data-si="{{ $rof_si }}" data-imperial="{{ $rof_imp }}">{{ $rof_si }}</span></td></tr>
                        <tr><th>{{ __('common.operating_pressure') }}</th><td><span class="unit-value" data-si="{{ $op_si }}" data-imperial="{{ $op_imp }}">{{ $op_si }}</span></td></tr>
                        <tr><th>{{ __('common.impact_rate_std_mode') }}</th><td><span class="unit-value" data-si="{{ $ir_si }}" data-imperial="{{ $ir_imp }}">{{ $ir_si }}</span></td></tr>
                        <tr><th>{{ __('common.impact_rate_soft_rock_label') }}</th><td><span class="unit-value" data-si="{{ $irsr_si }}" data-imperial="{{ $irsr_imp }}">{{ $irsr_si }}</span></td></tr>
                        <tr><th>{{ __('common.hose_diameter') }}</th><td><span class="unit-value" data-si="{{ $hd_si }}" data-imperial="{{ $hd_imp }}">{{ $hd_si }}</span></td></tr>
                        <tr><th>{{ __('common.rod_diameter') }}</th><td><span class="unit-value" data-si="{{ $rd_si }}" data-imperial="{{ $rd_imp }}">{{ $rd_si }}</span></td></tr>
                        <tr><th>{{ __('common.applicable_carrier') }}</th><td><span class="unit-value" data-si="{{ $ac_si }}" data-imperial="{{ $ac_imp }}">{{ $ac_si }}</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@php
    $similarProducts = \App\Models\Product::where(function($q) use ($product) {
        if ($product->type) $q->orWhere('type', $product->type);
    })
    ->where('id', '!=', $product->id)
    ->limit(12)
    ->get();
@endphp

@if($similarProducts->count())
<div class="container">
    <div class="similar-products-section">
        <h3 class="similar-products-title">{{ __('common.similar_products') }}</h3>
        
        <div class="carousel-container">
            <button id="carouselPrevBtn" class="carousel-arrow prev" style="display: none;">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <button id="carouselNextBtn" class="carousel-arrow next">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div id="similarProductsCarousel" class="carousel-track">
                @foreach($similarProducts as $sim)
                <a href="{{ route('products.show', $sim->id) }}" class="carousel-product-card">
                    <div class="carousel-image-container">
                        @if($sim->image_url)
                            <img src="{{ $sim->image_url }}" alt="{{ $sim->model_name }}" loading="lazy">
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-image" style="font-size: 2rem; opacity: 0.3;"></i>
                                <p class="mt-2 mb-0 small">{{ __('common.no_image') }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="carousel-card-body">
                        <h5 class="carousel-card-title">{{ $sim->model_name }}</h5>
                        
                        <ul class="carousel-specs-list">
                            <li class="carousel-spec-item">
                                <span class="carousel-spec-label">{{ __('common.operating_weight') }}:</span>
                                <span class="carousel-spec-value">
                                    @if($sim->operating_weight !== null && $sim->operating_weight !== '')
                                        {{ number_format($sim->operating_weight, 1) }} {{ __('common.unit_lb') }}
                                    @else
                                        - {{ __('common.unit_lb') }}
                                    @endif
                                </span>
                            </li>
                            <li class="carousel-spec-item">
                                <span class="carousel-spec-label">{{ __('common.required_oil_flow') }}:</span>
                                <span class="carousel-spec-value">
                                    @if($sim->required_oil_flow !== null && $sim->required_oil_flow !== '')
                                        @if(preg_match('/^([\d.]+)~([\d.]+)/', $sim->required_oil_flow, $m))
                                            {{ number_format($m[1], 1) }}~{{ number_format($m[2], 1) }} {{ __('common.unit_gal_min') }}
                                        @elseif(is_numeric($sim->required_oil_flow))
                                            {{ number_format($sim->required_oil_flow, 1) }} {{ __('common.unit_gal_min') }}
                                        @else
                                            {{ $sim->required_oil_flow }} {{ __('common.unit_gal_min') }}
                                        @endif
                                    @else
                                        - {{ __('common.unit_gal_min') }}
                                    @endif
                                </span>
                            </li>
                            <li class="carousel-spec-item">
                                <span class="carousel-spec-label">{{ __('common.applicable_carrier') }}:</span>
                                <span class="carousel-spec-value">
                                    @if($sim->applicable_carrier !== null && $sim->applicable_carrier !== '')
                                        @if(preg_match('/^([\d.]+)~([\d.]+)/', $sim->applicable_carrier, $m))
                                            {{ number_format($m[1], 1) }}~{{ number_format($m[2], 1) }} {{ __('common.unit_lb') }}
                                        @elseif(is_numeric($sim->applicable_carrier))
                                            {{ number_format($sim->applicable_carrier, 1) }} {{ __('common.unit_lb') }}
                                        @else
                                            {{ $sim->applicable_carrier }} {{ __('common.unit_lb') }}
                                        @endif
                                    @else
                                        - {{ __('common.unit_lb') }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                        
                        <div class="carousel-view-btn">
                            {{ __('common.view_details') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        
        <div class="carousel-indicators">
            @for($i = 0; $i < ceil($similarProducts->count() / 3); $i++)
                <button class="carousel-indicator {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></button>
            @endfor
        </div>
    </div>
</div>
@endif

<div id="copyToast" class="copy-toast">Link copied to clipboard!</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Unit toggle functionality
    const siBtn = document.getElementById('siBtn');
    const imperialBtn = document.getElementById('imperialBtn');
    const unitValues = document.querySelectorAll('.unit-value');

    function setUnit(mode) {
        unitValues.forEach(el => el.classList.add('updating'));
        setTimeout(() => {
            unitValues.forEach(el => {
                el.textContent = el.dataset[mode];
                el.classList.remove('updating');
            });
        }, 150);

        siBtn.classList.toggle('active', mode === 'si');
        imperialBtn.classList.toggle('active', mode === 'imperial');
        
        if (mode === 'si') {
            siBtn.classList.remove('btn-outline-primary');
            siBtn.classList.add('btn-primary');
            imperialBtn.classList.remove('btn-primary');
            imperialBtn.classList.add('btn-outline-primary');
        } else {
            imperialBtn.classList.remove('btn-outline-primary');
            imperialBtn.classList.add('btn-primary');
            siBtn.classList.remove('btn-primary');
            siBtn.classList.add('btn-outline-primary');
        }
    }

    if (siBtn && imperialBtn) {
        siBtn.addEventListener('click', () => setUnit('si'));
        imperialBtn.addEventListener('click', () => setUnit('imperial'));
        setUnit('si');
    }

    // Carousel functionality
    const carousel = document.getElementById('similarProductsCarousel');
    const prevBtn = document.getElementById('carouselPrevBtn');
    const nextBtn = document.getElementById('carouselNextBtn');
    const indicators = document.querySelectorAll('.carousel-indicator');
    
    if (carousel && prevBtn && nextBtn) {
        let currentSlide = 0;
        const cardWidth = 320 + 24; // card width + gap
        const visibleCards = window.innerWidth >= 992 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
        const totalCards = carousel.children.length;
        const maxSlide = Math.max(0, Math.ceil(totalCards / visibleCards) - 1);

        function updateCarousel() {
            const translateX = -(currentSlide * cardWidth * visibleCards);
            carousel.style.transform = `translateX(${translateX}px)`;
            
            prevBtn.style.display = currentSlide > 0 ? 'flex' : 'none';
            nextBtn.style.display = currentSlide < maxSlide ? 'flex' : 'none';
            
            indicators.forEach((ind, i) => {
                ind.classList.toggle('active', i === currentSlide);
            });
        }

        function nextSlide() {
            if (currentSlide < maxSlide) {
                currentSlide++;
                updateCarousel();
            }
        }

        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateCarousel();
            }
        }

        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);
        
        indicators.forEach((ind, i) => {
            ind.addEventListener('click', () => {
                currentSlide = parseInt(ind.getAttribute('data-slide'), 10);
                updateCarousel();
            });
        });

        updateCarousel();
        
        window.addEventListener('resize', () => {
            const newVisibleCards = window.innerWidth >= 992 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
            updateCarousel();
        });
    }

    // Share functionality
    const shareBtn = document.getElementById('shareBtn');
    if (shareBtn) {
        shareBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const url = window.location.href;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    showToast('{{ __("common.link_copied") }}');
                }).catch(err => {
                    console.error('Clipboard API failed:', err);
                    fallbackCopyTextToClipboard(url);
                    showToast('{{ __("common.link_copied") }}');
                });
            } else {
                fallbackCopyTextToClipboard(url);
                showToast('{{ __("common.link_copied") }}');
            }
        });
    }

    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.opacity = '0';
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
        } catch (err) {
            console.error('Fallback copy failed:', err);
        }
        document.body.removeChild(textArea);
    }

    // Product data for PDF/CSV generation
    const productData = {
        model_name: "{{ $product->model_name }}",
        line: "{{ $product->type ?? '-' }}",
        type: "{{ $product->type ?? '-' }}",
        body_weight: "{{ $product->body_weight ?? '-' }}",
        operating_weight: "{{ $product->operating_weight ?? '-' }}",
        overall_length: "{{ $product->overall_length ?? '-' }}",
        overall_width: "{{ $product->overall_width ?? '-' }}",
        overall_height: "{{ $product->overall_height ?? '-' }}",
        required_oil_flow: "{{ $product->required_oil_flow ?? '-' }}",
        operating_pressure: "{{ $product->operating_pressure ?? '-' }}",
        impact_rate: "{{ $product->impact_rate_std ?? '-' }}",
        impact_rate_soft_rock: "{{ $product->impact_rate_soft_rock ?? '-' }}",
        hose_diameter: "{{ $product->hose_diameter ?? '-' }}",
        rod_diameter: "{{ $product->rod_diameter ?? '-' }}",
        applicable_carrier: "{{ $product->applicable_carrier ?? '-' }}"
    };

    // PDF Download functionality
    const downloadPdfBtn = document.querySelector('#pdfBtn');
    if (downloadPdfBtn) {
        downloadPdfBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ unit: 'pt', format: 'a4' });
            const pageWidth = doc.internal.pageSize.getWidth();
            let y = 36;

            // Logo at top right
            const logoUrl = window.location.origin + '/images/logo2.png';
            const drawLogo = (cb) => {
                const img = new window.Image();
                img.crossOrigin = 'anonymous';
                img.onload = function () {
                    doc.addImage(img, 'PNG', pageWidth - 156, 24, 125, 90);
                    cb();
                };
                img.onerror = function () { cb(); };
                img.src = logoUrl;
            };

            drawLogo(() => {
                doc.setFontSize(20);
                doc.setFont('helvetica', 'bold');
                doc.text(`${productData.model_name} Specifications`, pageWidth / 2, y + 65, { align: 'center' });
                y += 100;

                // Product image and info
                const imgUrl = "{{ $product->image_url ? asset($product->image_url) : asset('images/fallback.webp') }}";
                if (imgUrl) {
                    const img = new window.Image();
                    img.crossOrigin = 'anonymous';
                    img.onload = function () {
                        doc.addImage(img, 'PNG', 40, y, 130, 100);
                        doc.setFontSize(14);
                        doc.setFont('helvetica', 'normal');
                        let infoY = y + 10;
                        doc.text('Model Name: ' + productData.model_name, 180, infoY);
                        doc.text('Line: ' + (productData.line && productData.line !== '-' ? productData.line : 'SB Line'), 180, infoY + 26);
                        doc.text('Type: ' + (productData.type && productData.type !== '-' ? productData.type : 'TR-F'), 180, infoY + 52);
                        renderTable(y + 110);
                    };
                    img.onerror = function () { renderTable(y); };
                    img.src = imgUrl;
                } else {
                    renderTable(y);
                }

                function renderTable(startY) {
                    let tableY = startY + 40;
                    doc.setFontSize(14);
                    doc.setFont('helvetica', 'bold');
                    doc.text('Product Specifications', 40, tableY);
                    
                    const tableData = [
                        ['Attribute', 'SI', 'Imperial'],
                        ['Body Weight', convertToSI('body_weight', productData.body_weight), formatImperial('body_weight', productData.body_weight)],
                        ['Operating Weight', convertToSI('operating_weight', productData.operating_weight), formatImperial('operating_weight', productData.operating_weight)],
                        ['Overall Length', convertToSI('overall_length', productData.overall_length), formatImperial('overall_length', productData.overall_length)],
                        ['Overall Width', convertToSI('overall_width', productData.overall_width), formatImperial('overall_width', productData.overall_width)],
                        ['Overall Height', convertToSI('overall_height', productData.overall_height), formatImperial('overall_height', productData.overall_height)],
                        ['Required Oil Flow', convertToSI('required_oil_flow', productData.required_oil_flow), formatImperial('required_oil_flow', productData.required_oil_flow)],
                        ['Operating Pressure', convertToSI('operating_pressure', productData.operating_pressure), formatImperial('operating_pressure', productData.operating_pressure)],
                        ['Impact Rate (STD Mode)', convertToSI('impact_rate', productData.impact_rate), formatImperial('impact_rate', productData.impact_rate)],
                        ['Impact Rate (Soft Rock)', convertToSI('impact_rate_soft_rock', productData.impact_rate_soft_rock), formatImperial('impact_rate_soft_rock', productData.impact_rate_soft_rock)],
                        ['Hose Diameter', formatImperial('hose_diameter', productData.hose_diameter), formatImperial('hose_diameter', productData.hose_diameter)],
                        ['Rod Diameter', convertToSI('rod_diameter', productData.rod_diameter), formatImperial('rod_diameter', productData.rod_diameter)],
                        ['Applicable Carrier', convertToSI('applicable_carrier', productData.applicable_carrier), formatImperial('applicable_carrier', productData.applicable_carrier)],
                    ];
                    
                    doc.autoTable({
                        startY: tableY + 8,
                        head: [tableData[0]],
                        body: tableData.slice(1),
                        theme: 'grid',
                        headStyles: { fillColor: [0, 84, 142] },
                        styles: { font: 'helvetica', fontSize: 11 },
                        margin: { left: 40, right: 40 }
                    });
                    
                    const now = new Date();
                    doc.setFontSize(12);
                    doc.text(`Generated on: ${now.toLocaleString('en-US', {
                        month: 'long', day: '2-digit', year: 'numeric',
                        hour: '2-digit', minute: '2-digit', hour12: true
                    })} EEST`, pageWidth / 2, doc.lastAutoTable.finalY + 18, { align: 'center' });
                    
                    doc.save(`${productData.model_name}_specifications.pdf`);
                    showToast('PDF Download Started');
                }
            });
        });
    }

    // CSV Download functionality
    const downloadCsvBtn = document.querySelector('#csvBtn');
    if (downloadCsvBtn) {
        downloadCsvBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const attributes = [
                { label: 'Body Weight', key: 'body_weight' },
                { label: 'Operating Weight', key: 'operating_weight' },
                { label: 'Overall Length', key: 'overall_length' },
                { label: 'Overall Width', key: 'overall_width' },
                { label: 'Overall Height', key: 'overall_height' },
                { label: 'Required Oil Flow', key: 'required_oil_flow' },
                { label: 'Operating Pressure', key: 'operating_pressure' },
                { label: 'Impact Rate (STD Mode)', key: 'impact_rate' },
                { label: 'Impact Rate (Soft Rock)', key: 'impact_rate_soft_rock' },
                { label: 'Hose Diameter', key: 'hose_diameter' },
                { label: 'Rod Diameter', key: 'rod_diameter' },
                { label: 'Applicable Carrier', key: 'applicable_carrier' }
            ];

            const header = ["Attribute Name", "SI", "Imperial"];

            const rows = attributes.map(attr => {
                const rawValue = productData[attr.key]?.trim();
                if (!rawValue || rawValue === '-') return [attr.label, '-', '-'];
                const imperial = formatImperial(attr.key, rawValue);
                const si = convertToSI(attr.key, rawValue, imperial);
                return [attr.label, si, imperial];
            });

            const csvLines = [
                `"Hydraulic Breaker Specifications - ${productData.model_name}","",""`,
                `"Model Name","${productData.model_name}"`,
                `"Line","${productData.line && productData.line !== '-' ? productData.line : 'SB Line'}"`,
                `"Type","${productData.type && productData.type !== '-' ? productData.type : 'TR-F'}"`,
                "",
                header.join(","),
                ...rows.map(row => row.map(cell => `"${cell.replace(/"/g, '""')}"`).join(','))
            ];

            const blob = new Blob([csvLines.join('\n')], { type: 'text/csv;charset=utf-8;' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${productData.model_name}_specifications.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
            showToast('CSV Download Started');
        });
    }

    // Helper functions for unit conversion
    function formatImperial(type, value) {
        if (!value || value === '-') return '-';
        if (value.includes('~') || value.includes('-')) {
            const [min, max] = value.split(/~|-/).map(v => v.trim());
            return `${number_format(min, 1)} - ${number_format(max, 1)} ${getImperialUnit(type)}`;
        }
        return `${number_format(value, 1)} ${getImperialUnit(type)}`;
    }

    function getImperialUnit(type) {
        switch (type) {
            case 'body_weight':
            case 'operating_weight':
            case 'applicable_carrier': return 'lb';
            case 'overall_length':
            case 'overall_width':
            case 'overall_height':
            case 'hose_diameter': return 'in';
            case 'rod_diameter': return 'in';
            case 'required_oil_flow': return 'gal/min';
            case 'operating_pressure': return 'psi';
            case 'impact_rate':
            case 'impact_rate_soft_rock': return 'BPM';
            default: return '';
        }
    }

    function convertToSI(type, value, imperial) {
        if (!value || value === '-') return '-';
        const toFormatted = (val, factor, unit) => isNaN(val) ? '-' : number_format(val * factor, 1) + ' ' + unit;
        const isRange = value.includes('~') || value.includes('-');
        const tryParseFloat = str => parseFloat(str.trim());

        if (isRange) {
            const [minRaw, maxRaw] = value.split(/~|-/);
            const min = tryParseFloat(minRaw);
            const max = tryParseFloat(maxRaw);
            switch (type) {
                case 'required_oil_flow': return `${number_format(min * 3.785411784, 1)} - ${number_format(max * 3.785411784, 1)} l/min`;
                case 'operating_pressure': return `${number_format(min * 0.0703069578296, 1)} - ${number_format(max * 0.0703069578296, 1)} kgf/cm²`;
                case 'applicable_carrier': return `${number_format(min * 0.00045359237, 1)} - ${number_format(max * 0.00045359237, 1)} ton`;
                case 'impact_rate': 
                case 'impact_rate_soft_rock': return `${number_format(min, 1)} - ${number_format(max, 1)} BPM`;
                default: return value;
            }
        }

        const num = tryParseFloat(value);
        switch (type) {
            case 'body_weight':
            case 'operating_weight': return toFormatted(num, 0.45359237, 'kg');
            case 'overall_length':
            case 'overall_width':
            case 'overall_height':
            case 'rod_diameter': return toFormatted(num, 25.4, 'mm');
            case 'hose_diameter': return imperial || '-';
            case 'required_oil_flow': return toFormatted(num, 3.785411784, 'l/min');
            case 'operating_pressure': return `${number_format(num * 0.0703069578296, 1)} kgf/cm²`;
            case 'applicable_carrier': return toFormatted(num, 0.00045359237, 'ton');
            case 'impact_rate':
            case 'impact_rate_soft_rock': return `${number_format(num, 1)} BPM`;
            default: return value;
        }
    }

    function number_format(number, decimals) {
        const n = !isFinite(+number) ? 0 : +number;
        return Number(n).toFixed(decimals).toString();
    }

    function showToast(message) {
        const toast = document.getElementById('copyToast');
        if (toast) {
            toast.textContent = message;
            toast.classList.add('active');
            setTimeout(() => {
                toast.classList.remove('active');
            }, 2000);
        }
    }
});
</script>
@endpush