@extends('layouts.public')

@section('title', __('common.coverage_results') . ' - Soosan Cebotics')
@section('description', __('common.equipment_information') . ' ' . ($soldProduct->serial_number ?? 'N/A'))

@push('styles')
<style>
    :root {
        --primary-blue: #00548e;
        --accent-green: #b0d701;
        --gradient-primary: linear-gradient(135deg, #00548e 0%, #0066a3 100%);
        --gradient-accent: linear-gradient(135deg, #b0d701 0%, #9bc600 100%);
        --gradient-success: linear-gradient(135deg, #34C759 0%, #28A745 100%);
        --gradient-warning: linear-gradient(135deg, #FF9500 0%, #FF8C00 100%);
        --gradient-danger: linear-gradient(135deg, #FF3B30 0%, #DC3545 100%);
        --shadow-primary: 0 20px 60px rgba(0, 84, 142, 0.15);
        --shadow-hover: 0 30px 80px rgba(0, 84, 142, 0.25);
        --border-radius: 24px;
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated Background */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 80%, rgba(0, 84, 142, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(176, 215, 1, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(0, 84, 142, 0.04) 0%, transparent 50%);
        z-index: -1;
        animation: backgroundFloat 25s ease-in-out infinite;
    }

    @keyframes backgroundFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-30px) rotate(2deg); }
        66% { transform: translateY(15px) rotate(-2deg); }
    }

    /* Result Header */
    .result-header {
        background: var(--gradient-primary);
        color: white;
        padding: 4rem 0 2rem;
        position: relative;
        overflow: hidden;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }

    .result-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)" /></svg>');
        opacity: 0.3;
        animation: gridMove 40s linear infinite;
    }

    @keyframes gridMove {
        0% { transform: translate(0, 0); }
        100% { transform: translate(60px, 60px); }
    }

    .result-header > * {
        position: relative;
        z-index: 2;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        color: white;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition);
    }

    .back-button:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        transform: translateX(-8px) scale(1.05);
        box-shadow: 0 8px 32px rgba(255, 255, 255, 0.2);
    }

    .serial-display {
        font-family: 'SF Mono', Monaco, 'Cascadia Code', monospace;
        background: rgba(255, 255, 255, 0.15);
        padding: 0.75rem 1.5rem;
        border-radius: 16px;
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: 2px;
        margin: 0 1rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: serialGlow 3s ease-in-out infinite alternate;
    }

    @keyframes serialGlow {
        0% { box-shadow: 0 0 20px rgba(176, 215, 1, 0.3); }
        100% { box-shadow: 0 0 40px rgba(176, 215, 1, 0.6); }
    }

    /* Unit Toggle */
    .unit-toggle-custom {
        display: inline-flex;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(176, 215, 1, 0.5);
        overflow: hidden;
        backdrop-filter: blur(10px);
        transition: var(--transition);
        margin-left: 1rem;
    }

    .unit-toggle-custom:focus-within {
        border-color: var(--accent-green);
        box-shadow: 0 0 0 4px rgba(176, 215, 1, 0.2);
    }

    .unit-btn {
        border: none;
        outline: none;
        background: transparent;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .unit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--gradient-accent);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .unit-btn.active::before,
    .unit-btn:hover::before {
        left: 0;
    }

    .unit-btn.active,
    .unit-btn:hover {
        color: var(--primary-blue);
        transform: scale(1.05);
    }

    /* Main Container */
    .main-container {
        margin-top: -60px;
        position: relative;
        z-index: 10;
    }

    /* Coverage Cards */
    .coverage-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-primary);
        padding: 3rem;
        margin-bottom: 2rem;
        margin-top: 1.2rem;
        border: 2px solid rgba(0, 84, 142, 0.1);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .coverage-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(176, 215, 1, 0.05), transparent);
        transition: left 0.8s ease;
    }

    .coverage-card:hover::before {
        left: 100%;
    }

    .coverage-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
        border-color: var(--accent-green);
    }

    /* PDF Download Button */
    .pdf-download-btn {
        position: absolute;
        top: 0.8rem;
        right: 2rem;
        z-index: 10;
        background: var(--gradient-danger);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        box-shadow: 0 4px 16px rgba(255, 59, 48, 0.3);
    }

    .pdf-download-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 32px rgba(255, 59, 48, 0.4);
        background: var(--gradient-accent);
        color: var(--primary-blue);
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 1rem 2rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 1.125rem;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        animation: badgeGlow 4s ease-in-out infinite alternate;
    }

    .status-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .status-badge:hover::before {
        left: 100%;
    }

    .status-badge.valid {
        background: var(--gradient-success);
        color: white;
    }

    .status-badge.expiringsoon {
        background: var(--gradient-warning);
        color: white;
    }

    .status-badge.expired {
        background: var(--gradient-danger);
        color: white;
    }

    .status-badge.unknown {
        background: linear-gradient(135deg, #8E8E93 0%, #6C757D 100%);
        color: white;
    }

    @keyframes badgeGlow {
        0% { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); }
        100% { box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3); }
    }

    /* Product Image */
    .product-image {
        max-height: 400px;
        width: 100%;
        object-fit: contain;
        border-radius: 20px;
        background: #f8fafc;
        padding: 2rem;
        transition: var(--transition);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .product-image:hover {
        transform: scale(1.05) rotate(2deg);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
    }

    /* Specifications Table */
    .specs-table {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }

    .specs-table th {
        background: #eee;
        color: black;
        font-weight: 700;
        padding: 1.25rem 1.5rem;
        border: none;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .specs-table th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: #ccc;
        opacity: 0.2;
    }

    .specs-table td {
        padding: 1.25rem 1.5rem;
        border: none;
        border-bottom: 1px solid #f0f0f0;
        color: #374151;
        font-weight: 600;
        transition: var(--transition);
    }

    .specs-table tr:hover td {
        background: rgba(0, 84, 142, 0.05);
        transform: translateX(4px);
    }

    .specs-table tr:last-child td {
        border-bottom: none;
    }

    /* Section Titles */
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 3px;
        background: var(--gradient-accent);
        border-radius: 2px;
        margin-left: 1rem;
    }

    .section-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }

    .section-icon:hover {
        transform: scale(1.1) rotate(10deg);
    }

    .section-icon.product {
        background: var(--gradient-primary);
    }

    .section-icon.warranty {
        background: var(--gradient-success);
    }

    .section-icon.owner {
        background: var(--gradient-warning);
    }

    /* Warranty Progress */
    .warranty-progress {
        background: #e9ecef;
        border-radius: 12px;
        height: 20px;
        margin: 1.5rem 0;
        overflow: hidden;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 2px solid #dee2e6;
        position: relative;
    }

    .warranty-progress::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: progressShine 3s ease-in-out infinite;
    }

    @keyframes progressShine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .warranty-progress-bar {
        height: 100%;
        border-radius: 10px;
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .warranty-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: barShine 2s ease-in-out infinite;
    }

    @keyframes barShine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .warranty-progress-bar.valid {
        background: var(--gradient-success);
    }

    .warranty-progress-bar.expiring {
        background: var(--gradient-warning);
    }

    .warranty-progress-bar.expired {
        background: var(--gradient-danger);
    }

    /* No Result Card */
    .no-result-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 4rem 3rem;
        text-align: center;
        box-shadow: var(--shadow-primary);
        border: 2px solid rgba(255, 59, 48, 0.1);
    }

    .no-result-icon {
        width: 100px;
        height: 100px;
        border-radius: 25px;
        background: var(--gradient-danger);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 2rem;
        animation: iconPulse 3s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Unit Value Transitions */
    .unit-value {
        transition: opacity 0.3s ease;
    }

    /* Floating Elements */
    .floating-element {
        position: fixed;
        opacity: 0.05;
        animation: float 25s ease-in-out infinite;
        pointer-events: none;
        z-index: -1;
    }

    .floating-element:nth-child(1) {
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
        top: 30%;
        right: 5%;
        animation-delay: 8s;
    }

    .floating-element:nth-child(3) {
        bottom: 20%;
        left: 10%;
        animation-delay: 16s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-40px) rotate(120deg); }
        66% { transform: translateY(20px) rotate(240deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .result-header {
            padding: 3rem 0 2rem;
        }
        
        .coverage-card {
            padding: 2rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .pdf-download-btn {
            position: static;
            margin-bottom: 1rem;
            width: 100%;
            justify-content: center;
        }
        
        .section-title {
            font-size: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .section-title::after {
            width: 100%;
            margin-left: 0;
        }
        
        .specs-table th,
        .specs-table td {
            padding: 1rem;
        }
        
        .serial-display {
            margin: 1rem 0;
            font-size: 1rem;
        }
        
        .unit-toggle-custom {
            margin: 1rem 0 0 0;
        }
    }

    /* Entrance Animations */
    .animate-in {
        opacity: 0;
        transform: translateY(40px);
        animation: slideInUp 0.8s ease-out forwards;
    }

    .animate-in:nth-child(1) { animation-delay: 0.1s; }
    .animate-in:nth-child(2) { animation-delay: 0.2s; }
    .animate-in:nth-child(3) { animation-delay: 0.3s; }
    .animate-in:nth-child(4) { animation-delay: 0.4s; }

    @keyframes slideInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
@php
// Force SI mode as default
$unit = 'si';
@endphp

<!-- Floating Background Elements -->
<div class="floating-element">
    <i class="fas fa-cog" style="font-size: 4rem; color: var(--primary-blue);"></i>
</div>
<div class="floating-element">
    <i class="fas fa-shield-alt" style="font-size: 3.5rem; color: var(--accent-green);"></i>
</div>
<div class="floating-element">
    <i class="fas fa-chart-line" style="font-size: 3rem; color: var(--primary-blue);"></i>
</div>

<!-- Result Header -->
<section class="result-header">
    <div class="container">
        <a href="{{ route('serial-lookup.index') }}" class="back-button">
            <i class="fas fa-arrow-left me-2"></i>
            {{ __('common.back_to_serial_lookup') }}
        </a>
        @if($soldProduct && $soldProduct->product)
            <div class="text-center mb-4">
                <h1 class="h2 mb-3" style="font-weight: 800; font-size: 2.5rem;">{{ $soldProduct->product->model_name }}</h1>
                <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 mb-3">
                    <span class="text-white-50 fs-5">{{ __('common.serial_number') }}:</span>
                    <span class="serial-display">{{ $soldProduct->serial_number }}</span>
                    <div class="unit-toggle-custom" tabindex="0">
                        <button type="button" class="unit-btn si-btn{{ $unit === 'si' ? ' active' : '' }}" id="siBtn">SI</button>
                        <button type="button" class="unit-btn imperial-btn{{ $unit === 'si' ? '' : ' active' }}" id="imperialBtn">Imperial</button>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                    <div class="d-flex align-items-center gap-2 bg-white bg-opacity-10 px-3 py-2 rounded-pill">
                        <i class="fas fa-check-circle text-success"></i>
                        <span>Verified Equipment</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 bg-white bg-opacity-10 px-3 py-2 rounded-pill">
                        <i class="fas fa-database text-info"></i>
                        <span>Complete Records</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 bg-white bg-opacity-10 px-3 py-2 rounded-pill">
                        <i class="fas fa-shield-check text-warning"></i>
                        <span>Warranty Tracked</span>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center">
                <h1 class="h2 mb-3" style="font-weight: 800;">{{ __('common.coverage_results') }}</h1>
            </div>
        @endif
    </div>
</section>

<!-- Main Content -->
<div class="container main-container">
    @if($soldProduct && $soldProduct->product)
        <!-- Product Specifications Card -->
        <div class="coverage-card animate-in" style="position: relative;">
            <button type="button"
                class="pdf-download-btn"
                id="pdfBtn"
                data-model_name="{{ $soldProduct->product->model_name ?? '-' }}"
                data-line="{{ $soldProduct->product->line ?? '-' }}"
                data-type="{{ $soldProduct->product->type ?? '-' }}"
                data-image_url="{{ $soldProduct->product->image_url ? asset($soldProduct->product->image_url) : asset('images/fallback.webp') }}"
            >
                <i class="fas fa-download" aria-hidden="true"></i> Download PDF
            </button>
            
            <div class="section-title mb-4">
                <div class="section-icon product">
                    <i class="fas fa-cogs"></i>
                </div>
                {{ __('common.product_details') }}
            </div>
            
            <div class="row align-items-stretch">
                <div class="col-lg-4 text-center mb-4 mb-lg-0 d-flex align-items-stretch">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-radius: 20px; min-height: 450px; border: 2px solid rgba(0, 84, 142, 0.1);">
                        <img src="{{ $soldProduct->product->image_url ?? asset('images/fallback.webp') }}" 
                             alt="{{ $soldProduct->product->model_name }}" 
                             class="product-image w-100 h-100" 
                             style="object-fit: contain; max-height: 400px;">
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="table-responsive w-100">
                        <table class="table specs-table mb-0">
                            <tbody>
                                @php
                                    function display_range_unit_pair_lbft_default($val, $unit_si, $unit_imp, $conv_si = null) {
                                        if (is_string($val) && strpos($val, '~') !== false) {
                                            [$min, $max] = array_map('trim', explode('~', $val));
                                            if (is_numeric($min) && is_numeric($max)) {
                                                $imp = $min . ' ~ ' . $max . ' ' . $unit_imp;
                                                $si = $conv_si ? $conv_si($min) . ' ~ ' . $conv_si($max) . ' ' . $unit_si : $min . ' ~ ' . $max . ' ' . $unit_si;
                                                return ['si' => $si, 'imp' => $imp];
                                            }
                                        } elseif (is_numeric($val)) {
                                            $imp = $val . ' ' . $unit_imp;
                                            $si = $conv_si ? $conv_si($val) . ' ' . $unit_si : $val . ' ' . $unit_si;
                                            return ['si' => $si, 'imp' => $imp];
                                        }
                                        return ['si' => '- ' . $unit_si, 'imp' => '- ' . $unit_imp];
                                    }
                                    $mode = $unit === 'si' ? 'si' : 'imp';
                                    $product = $soldProduct->product;
                                    $specs = [
                                        ['label' => __('common.model_name'), 'icon' => 'fa-barcode', 'value' => ['si' => $product->model_name, 'imp' => $product->model_name]],
                                        ['label' => __('common.line'), 'icon' => 'fa-layer-group', 'value' => ['si' => $product->line, 'imp' => $product->line]],
                                        ['label' => __('common.type'), 'icon' => 'fa-cube', 'value' => ['si' => $product->type, 'imp' => $product->type]],
                                        ['label' => __('common.body_weight'), 'icon' => 'fa-weight-hanging', 'value' => display_range_unit_pair_lbft_default($product->body_weight, 'kg', __('common.unit_lb'), fn($v) => number_format($v * 0.453592, 1))],
                                        ['label' => __('common.operating_weight'), 'icon' => 'fa-balance-scale', 'value' => display_range_unit_pair_lbft_default($product->operating_weight, 'kg', __('common.unit_lb'), fn($v) => number_format($v * 0.453592, 1))],
                                        ['label' => __('common.overall_length'), 'icon' => 'fa-ruler-horizontal', 'value' => display_range_unit_pair_lbft_default($product->overall_length, 'mm', __('common.unit_in'), fn($v) => number_format($v * 25.4, 1))],
                                        ['label' => __('common.overall_width'), 'icon' => 'fa-ruler-combined', 'value' => display_range_unit_pair_lbft_default($product->overall_width, 'mm', __('common.unit_in'), fn($v) => number_format($v * 25.4, 1))],
                                        ['label' => __('common.overall_height'), 'icon' => 'fa-ruler-vertical', 'value' => display_range_unit_pair_lbft_default($product->overall_height, 'mm', __('common.unit_in'), fn($v) => number_format($v * 25.4, 1))],
                                        ['label' => __('common.required_oil_flow'), 'icon' => 'fa-tint', 'value' => display_range_unit_pair_lbft_default($product->required_oil_flow, 'l/min', __('common.unit_gal_min'), fn($v) => number_format($v * 3.78541, 1))],
                                        ['label' => __('common.operating_pressure'), 'icon' => 'fa-tachometer-alt', 'value' => display_range_unit_pair_lbft_default($product->operating_pressure, 'kgf/cm²', __('common.unit_psi'), fn($v) => number_format($v * 0.070307, 1))],
                                        ['label' => __('common.impact_rate'), 'icon' => 'fa-bolt', 'value' => $product->impact_rate ? display_range_unit_pair_lbft_default($product->impact_rate, __('common.unit_bpm'), __('common.unit_bpm')) : ['si' => '- ' . __('common.unit_bpm'), 'imp' => '- ' . __('common.unit_bpm')]],
                                        ['label' => __('common.impact_rate_soft_rock'), 'icon' => 'fa-bolt', 'value' => $product->impact_rate_soft_rock ? display_range_unit_pair_lbft_default($product->impact_rate_soft_rock, __('common.unit_bpm'), __('common.unit_bpm')) : ['si' => '- ' . __('common.unit_bpm'), 'imp' => '- ' . __('common.unit_bpm')]],
                                        ['label' => __('common.hose_diameter'), 'icon' => 'fa-grip-lines', 'value' => $product->hose_diameter ? (
                                            is_numeric($product->hose_diameter)
                                                ? display_range_unit_pair_lbft_default($product->hose_diameter, 'mm', __('common.unit_in'), fn($v) => number_format($v * 25.4, 2))
                                                : ['si' => $product->hose_diameter . ' ' . __('common.unit_in'), 'imp' => $product->hose_diameter . ' ' . __('common.unit_in')]
                                        ) : ['si' => '- mm', 'imp' => '- ' . __('common.unit_in')]],
                                        ['label' => __('common.rod_diameter'), 'icon' => 'fa-grip-lines-vertical', 'value' => $product->rod_diameter ? display_range_unit_pair_lbft_default($product->rod_diameter, 'mm', __('common.unit_in'), fn($v) => number_format($v * 25.4, 1)) : ['si' => '- mm', 'imp' => '- ' . __('common.unit_in')]],
                                        ['label' => __('common.applicable_carrier'), 'icon' => 'fa-truck', 'value' => display_range_unit_pair_lbft_default($product->applicable_carrier, 'ton', __('common.unit_lb'), fn($v) => number_format($v * 0.000453592, 1))],
                                    ];
                                @endphp
                                @foreach($specs as $spec)
                                    <tr>
                                        <th><i class="fas {{ $spec['icon'] }} me-2"></i>{{ $spec['label'] }}</th>
                                        <td>
                                            <span class="unit-value" data-si="{{ $spec['value']['si'] }}" data-imperial="{{ $spec['value']['imp'] }}">{{ $unit === 'si' ? $spec['value']['si'] : $spec['value']['imp'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Owner Information Card -->
        @if($soldProduct->owner)
        <div class="coverage-card animate-in">
            <div class="section-title">
                <div class="section-icon owner">
                    <i class="fas fa-user-circle"></i>
                </div>
                {{ __('common.owner_details') }}
            </div>
            <div class="table-responsive">
                <table class="table specs-table mb-0">
                    <tbody>
                        <tr><th><i class="fas fa-user me-2"></i>{{ __('common.name') }}</th><td>{{ $soldProduct->owner->name }}</td></tr>
                        <tr><th><i class="fas fa-building me-2"></i>{{ __('common.company') }}</th><td>{{ $soldProduct->owner->company ?? '-' }}</td></tr>
                        <tr><th><i class="fas fa-flag me-2"></i>{{ __('common.country') }}</th><td>{{ $soldProduct->owner->country ?? '-' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Warranty Status Card -->
        <div class="coverage-card animate-in">
            <div class="section-title mb-4">
                <div class="section-icon warranty">
                    <i class="fas fa-shield-alt"></i>
                </div>
                {{ __('common.warranty_coverage') }}
            </div>
            @if($soldProduct->warranty_voided)
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <span class="status-badge expired">
                                <i class="fas fa-ban me-2"></i>
                                {{ __('common.warranty_voided') }}
                            </span>
                        </div>
                        <p class="mb-3 fs-5">
                            <strong>{{ __('common.warranty_voided_at') }}</strong> 
                            {{ $soldProduct->warranty_voided_at ? $soldProduct->warranty_voided_at->format('F j, Y H:i') : '-' }}
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="warranty-visual">
                            <i class="fas fa-ban" style="font-size: 5rem; color: #FF3B30; animation: iconPulse 3s ease-in-out infinite;"></i>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $purchaseDate = $soldProduct->sale_date ? $soldProduct->sale_date->format('F j, Y') : '-';
                    $warrantyStart = $soldProduct->warranty_start_date ? $soldProduct->warranty_start_date->format('F j, Y') : '-';
                    $warrantyEnd = $soldProduct->warranty_end_date ? $soldProduct->warranty_end_date->format('F j, Y') : '-';
                    $now = now();
                    $status = __('common.valid');
                    $daysLeft = $soldProduct->warranty_end_date ? $now->diffInDays($soldProduct->warranty_end_date, false) : null;
                    if ($soldProduct->warranty_end_date && $now->gt($soldProduct->warranty_end_date)) {
                        $status = __('common.warranty_expired_status');
                    } elseif ($soldProduct->warranty_end_date && $daysLeft <= 180 && $daysLeft > 0) {
                        $status = __('common.warranty_expiring_soon');
                    }
                    $totalDays = $soldProduct->warranty_start_date && $soldProduct->warranty_end_date ? $soldProduct->warranty_start_date->diffInDays($soldProduct->warranty_end_date) : 0;
                    $progressPercentage = $totalDays > 0 && $daysLeft > 0 ? max(0, ($daysLeft / $totalDays) * 100) : 0;
                    $progressClass = $status === __('common.valid') ? 'valid' : ($status === __('common.warranty_expiring_soon') ? 'expiring' : 'expired');
                @endphp
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <span class="status-badge {{ strtolower(str_replace(' ', '', $status)) }}">
                                @if($status === __('common.valid'))
                                    <i class="fas fa-check-circle me-2"></i>
                                @elseif($status === __('common.warranty_expiring_soon'))
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                @elseif($status === __('common.warranty_expired_status'))
                                    <i class="fas fa-times-circle me-2"></i>
                                @endif
                                {{ $status }}
                            </span>
                        </div>
                        <p class="mb-3 fs-5">
                            <strong>{{ __('common.warranty_expires') }}</strong> {{ $warrantyEnd }}
                            @if($daysLeft !== null && $daysLeft > 0 && $status !== __('common.warranty_expired_status'))
                                <span class="text-muted">({{ is_numeric($daysLeft) ? round($daysLeft) : $daysLeft }} {{ __('common.days_remaining') }})</span>
                            @endif
                        </p>
                        <div class="warranty-progress">
                            <div class="warranty-progress-bar {{ $progressClass }}" style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        <div class="mt-4 d-flex flex-wrap gap-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-shopping-cart" style="color: var(--accent-green);"></i>
                                <strong>{{ __('common.purchase_date') }}:</strong> {{ $purchaseDate }}
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-play-circle" style="color: var(--accent-green);"></i>
                                <strong>{{ __('common.warranty_start') }}:</strong> {{ $warrantyStart }}
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-check" style="color: var(--accent-green);"></i>
                                <strong>{{ __('common.warranty_end') }}:</strong> {{ $warrantyEnd }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="warranty-visual">
                            <i class="fas fa-{{ $status === __('common.valid') ? 'shield-check' : ($status === __('common.warranty_expiring_soon') ? 'shield-alt' : 'shield-times') }}" 
                               style="font-size: 5rem; color: {{ $status === __('common.valid') ? '#34C759' : ($status === __('common.warranty_expiring_soon') ? '#FF9500' : '#FF3B30') }}; animation: iconPulse 3s ease-in-out infinite;"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <!-- No Result Found -->
        <div class="no-result-card animate-in">
            <div class="no-result-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="h4 mb-4" style="color: var(--primary-blue); font-weight: 800;">No Equipment Found</h3>
            <p class="text-muted mb-4 fs-5">
                We couldn't find any equipment matching the serial number you entered. 
                Please double-check the serial number and try again.
            </p>
            <a href="{{ route('serial-lookup.index') }}" class="btn btn-lg" style="background: var(--gradient-primary); color: white; border-radius: 16px; padding: 1rem 2rem; font-weight: 700; text-decoration: none; transition: var(--transition);">
                <i class="fas fa-arrow-left me-2"></i>
                Try Another Search
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Unit toggle functionality with enhanced animations
    const siBtn = document.getElementById('siBtn');
    const imperialBtn = document.getElementById('imperialBtn');
    const unitValues = document.querySelectorAll('.unit-value');

    if (siBtn && imperialBtn) {
        siBtn.classList.add('active');
        imperialBtn.classList.remove('active');
        switchUnits('si');

        siBtn.addEventListener('click', function () {
            if (!this.classList.contains('active')) {
                this.classList.add('active');
                imperialBtn.classList.remove('active');
                switchUnits('si');
            }
        });

        imperialBtn.addEventListener('click', function () {
            if (!this.classList.contains('active')) {
                this.classList.add('active');
                siBtn.classList.remove('active');
                switchUnits('imperial');
            }
        });
    }

    function switchUnits(unit) {
        unitValues.forEach((element, index) => {
            const value = element.getAttribute(`data-${unit}`);
            if (value) {
                // Staggered animation for smooth transition
                setTimeout(() => {
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(-10px)';
                    
                    setTimeout(() => {
                        element.textContent = value;
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, 150);
                }, index * 50);
            }
        });
    }

    // Enhanced scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 200);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe animated elements
    document.querySelectorAll('.coverage-card, .no-result-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(card);
    });

const pdfBtn = document.getElementById('pdfBtn');
if (pdfBtn) {
    pdfBtn.addEventListener('click', generatePdf);
}

function generatePdf() {
    if (!window.jspdf) {
        alert('jsPDF is missing.');
        return;
    }

    pdfBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating PDF...';
    pdfBtn.disabled = true;

    const productName = pdfBtn?.dataset.model_name || '-';
    const productLine = pdfBtn?.dataset.line || '-';
    const productType = pdfBtn?.dataset.type || '-';
    const productImgUrl = pdfBtn?.dataset.image_url || (window.location.origin + '/images/fallback.webp');

    const doc = new window.jspdf.jsPDF({ unit: 'pt', format: 'a4' });
    const pageWidth = doc.internal.pageSize.getWidth();

    // ---------------------- UTILITIES -------------------------
    function loadImage(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = url;
        });
    }

    function extractTableData() {
        const specsRows = [];
        const specsTable = document.querySelector('.specs-table');
        if (specsTable) {
            let rowIndex = 0;
            specsTable.querySelectorAll('tbody tr').forEach(row => {
                rowIndex++;
                if (rowIndex <= 3) return;
                const label = row.querySelector('th')?.innerText || '-';
                const span = row.querySelector('td span.unit-value');
                const siValue = span ? (span.dataset.si || '-') : '-';
                const lbftValue = span ? (span.dataset.imperial || '-') : '-';
                specsRows.push([label, siValue, lbftValue]);
            });
        }
        return specsRows;
    }

    function getWarrantyData() {
        const rows = [];
        const card = document.querySelectorAll('.coverage-card')[2];
        if (card) {
            const voidedElem = card.querySelector('.status-badge.expired, .fa-ban');
            if (voidedElem) {
                const status = voidedElem.textContent.trim() || '-';
                const voidedAtElem = card.querySelector('strong');
                let voidedAt = '-';
                if (voidedAtElem?.nextSibling?.textContent) {
                    voidedAt = voidedAtElem.nextSibling.textContent.trim();
                }
                rows.push(['Status', status]);
                rows.push(['Voided At', voidedAt]);
            } else {
                const get = (sel) => card.querySelector(sel)?.parentElement?.innerText?.split(':')[1]?.trim() || '-';
                const purchaseDate = get('.fa-shopping-cart');
                const warrantyStart = get('.fa-play-circle');
                const warrantyEnd = get('.fa-calendar-check');
                const status = card.querySelector('.status-badge')?.textContent.trim() || '-';
                const daysRemaining = card.querySelector('.text-muted')?.textContent.replace(/[^0-9]/g, '') || '-';
                rows.push(['Purchase Date', purchaseDate]);
                rows.push(['Warranty Start', warrantyStart]);
                rows.push(['Warranty End', warrantyEnd]);
                rows.push(['Status', status]);
                rows.push(['Days Remaining', daysRemaining]);
            }
        }
        return rows;
    }

    function getOwnerData() {
        const rows = [];
        const card = document.querySelectorAll('.coverage-card')[1];
        if (card) {
            const get = (icon) => card.querySelector(icon)?.parentElement?.nextElementSibling?.innerText || '-';
            rows.push(['Name', get('.fa-user')]);
            rows.push(['Company', get('.fa-building')]);
            rows.push(['Country', get('.fa-flag')]);
        }
        return rows;
    }

    // ---------------------- IMAGE LOAD + DRAW -------------------------
    Promise.all([
        loadImage(window.location.origin + '/images/logo2.png'),
        loadImage(productImgUrl)
    ])
        .then(([logoImg, productImg]) => {
            // HEADER
            doc.setFillColor(0, 84, 142);
            doc.rect(0, 0, pageWidth, 140, 'F');
            doc.setTextColor(255, 255, 255);
            doc.setFontSize(24);
            doc.setFont('helvetica', 'bold');
            doc.text('Equipment Coverage Report', 40, 80);
            doc.setFontSize(16);
            doc.setFont('helvetica', 'normal');
            doc.text(productName, 40, 110);

            // Add logo
            doc.addImage(logoImg, 'PNG', pageWidth - 180, 30, 150, 100);

            let y = 160;

            // Add product image and info
            doc.addImage(productImg, 'PNG', 40, y, 150, 120);
            doc.setTextColor(0, 0, 0);
            doc.setFontSize(14);
            doc.setFont('helvetica', 'bold');
            doc.text('Model: ' + productName, 210, y + 20);
            doc.text('Line: ' + productLine, 210, y + 50);
            doc.text('Type: ' + productType, 210, y + 80);

            // Tables
            renderAllTables(y + 140);
        })
        .catch(() => {
            renderAllTables(160);
        });

    // ---------------------- RENDER ALL TABLES -------------------------
    function renderAllTables(startY) {
        const specsRows = extractTableData();
        const ownerRows = getOwnerData();
        const warrantyRows = getWarrantyData();

        const tableMargin = { left: 40, right: 40 };
        let y = startY + 40;

        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(0, 84, 142);
        doc.text('Technical Specifications', 40, y);

        doc.autoTable({
            startY: y + 10,
            head: [['Specification', 'SI', 'Imperial']],
            body: specsRows,
            theme: 'grid',
            headStyles: {
                fillColor: [0, 84, 142],
                textColor: [255, 255, 255]
            },
            styles: {
                font: 'helvetica',
                fontSize: 10,
                cellPadding: 8
            },
            alternateRowStyles: { fillColor: [248, 250, 252] },
            margin: tableMargin
        });

        y = doc.lastAutoTable.finalY + 40;

        doc.setTextColor(0, 84, 142);
        doc.text('Owner Information', 40, y);

        doc.autoTable({
            startY: y + 10,
            head: [['Attribute', 'Value']],
            body: ownerRows,
            theme: 'grid',
            headStyles: {
                fillColor: [0, 84, 142],
                textColor: [255, 255, 255]
            },
            styles: {
                font: 'helvetica',
                fontSize: 10,
                cellPadding: 8
            },
            alternateRowStyles: { fillColor: [248, 250, 252] },
            margin: tableMargin
        });

        y = doc.lastAutoTable.finalY + 40;

        doc.setTextColor(0, 84, 142);
        doc.text('Warranty Information', 40, y);

        doc.autoTable({
            startY: y + 10,
            head: [['Attribute', 'Value']],
            body: warrantyRows,
            theme: 'grid',
            headStyles: {
                fillColor: [0, 84, 142],
                textColor: [255, 255, 255]
            },
            styles: {
                font: 'helvetica',
                fontSize: 10,
                cellPadding: 8
            },
            alternateRowStyles: { fillColor: [248, 250, 252] },
            margin: tableMargin
        });

        // Footer
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(10);
            doc.setTextColor(128, 128, 128);
            doc.text('Generated on ' + new Date().toLocaleDateString(), 40, doc.internal.pageSize.getHeight() - 30);
            doc.text('Page ' + i + ' of ' + pageCount, pageWidth - 80, doc.internal.pageSize.getHeight() - 30);
        }

        // Finish
        const timestamp = new Date().toISOString().slice(0, 10);
        doc.save(`equipment-coverage-${productLine}-${productType}-${timestamp}.pdf`);
        pdfBtn.innerHTML = '<i class="fas fa-download me-2"></i>Download PDF';
        pdfBtn.disabled = false;
    }
}




    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + P for PDF download
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            if (pdfBtn) pdfBtn.click();
        }
        
        // Ctrl/Cmd + U for unit toggle
        if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
            e.preventDefault();
            if (siBtn && imperialBtn) {
                if (siBtn.classList.contains('active')) {
                    imperialBtn.click();
                } else {
                    siBtn.click();
                }
            }
        }
    });
});
</script>
@endpush