@extends('layouts.public')

@section('title', __('common.coverage_results') . ' - Soosan Cebotics')
@section('description', __('common.equipment_information') . ' ' . ($soldProduct->serial_number ?? 'N/A'))

@push('styles')
<style>
    :root {
        --apple-blue: #007AFF;
        --apple-green: #34C759;
        --apple-red: #FF3B30;
        --apple-orange: #FF9500;
        --apple-gray: #8E8E93;
        --apple-light-gray: #F2F2F7;
        --apple-dark: #1D1D1F;
        --apple-secondary: #86868B;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .result-header {
        background: linear-gradient(135deg, var(--apple-dark) 0%, #2c2c2e 100%);
        color: white;
        padding: 40px 0 20px;
        position: relative;
        overflow: hidden;
    }

    .result-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="smallGrid" width="8" height="8" patternUnits="userSpaceOnUse"><path d="M 8 0 L 0 0 0 8" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23smallGrid)" /></svg>');
        opacity: 0.3;
        z-index: 1;
    }

    .result-header > * {
        position: relative;
        z-index: 2;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        color: var(--apple-blue);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 20px;
        padding: 8px 16px;
        border-radius: 20px;
        background: rgba(0, 122, 255, 0.1);
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background: rgba(0, 122, 255, 0.2);
        color: var(--apple-blue);
        transform: translateX(-4px);
    }

    .serial-display {
        font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', Consolas, monospace;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 1.1rem;
        letter-spacing: 1px;
        margin: 0 8px;
        backdrop-filter: blur(10px);
    }

    .unit-toggle {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 4px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .unit-toggle .btn {
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        background: transparent;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.3s ease;
    }

    .unit-toggle .btn.active {
        background: white;
        color: var(--apple-dark);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .main-container {
        margin-top: -40px;
        position: relative;
        z-index: 10;
    }

    .coverage-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-bottom: 24px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .coverage-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 12px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.5px;
    }

    .status-badge.valid {
        background: linear-gradient(135deg, var(--apple-green) 0%, #28A745 100%);
        color: white;
    }

    .status-badge.expiringsoon {
        background: linear-gradient(135deg, var(--apple-orange) 0%, #FF8C00 100%);
        color: white;
    }

    .status-badge.expired {
        background: linear-gradient(135deg, var(--apple-red) 0%, #DC3545 100%);
        color: white;
    }

    .status-badge.unknown {
        background: linear-gradient(135deg, var(--apple-gray) 0%, #6C757D 100%);
        color: white;
    }

    .product-image {
        max-height: 300px;
        width: 100%;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        background: var(--apple-light-gray);
        padding: 20px;
    }

    .specs-table {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .specs-table th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        font-weight: 600;
        color: var(--apple-dark);
        padding: 16px 20px;
        border: none;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .specs-table td {
        padding: 16px 20px;
        border: none;
        border-bottom: 1px solid #f0f0f0;
        color: var(--apple-secondary);
        font-weight: 500;
    }

    .specs-table tr:last-child td {
        border-bottom: none;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--apple-dark);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }

    .section-icon.product {
        background: linear-gradient(135deg, var(--apple-blue) 0%, #0051D5 100%);
    }

    .section-icon.warranty {
        background: linear-gradient(135deg, var(--apple-green) 0%, #28A745 100%);
    }

    .section-icon.owner {
        background: linear-gradient(135deg, var(--apple-orange) 0%, #FF8C00 100%);
    }

    .no-result-card {
        background: white;
        border-radius: 24px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .no-result-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--apple-red) 0%, #DC3545 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: 0 auto 20px;
    }

    .warranty-progress {
        background: #e9ecef;
        border-radius: 10px;
        height: 8px;
        overflow: hidden;
        margin: 16px 0;
    }

    .warranty-progress-bar {
        height: 100%;
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    .warranty-progress-bar.valid {
        background: linear-gradient(90deg, var(--apple-green) 0%, #28A745 100%);
    }

    .warranty-progress-bar.expiring {
        background: linear-gradient(90deg, var(--apple-orange) 0%, #FF8C00 100%);
    }

    .warranty-progress-bar.expired {
        background: linear-gradient(90deg, var(--apple-red) 0%, #DC3545 100%);
    }

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

    .animate-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @media (max-width: 768px) {
        .coverage-card {
            padding: 24px;
            margin-bottom: 16px;
        }
        
        .section-title {
            font-size: 1.5rem;
        }
        
        .specs-table th,
        .specs-table td {
            padding: 12px 16px;
        }
    }
</style>
@endpush

@section('content')
@php
// Force SI mode as default
$unit = 'si';
@endphp
<!-- Result Header -->
<section class="result-header">
    <div class="container">
        <a href="{{ route('serial-lookup.index') }}" class="back-button">
            <i class="fas fa-arrow-left me-2"></i>
            {{ __('common.back_to_serial_lookup') }}
        </a>
        @if($soldProduct && $soldProduct->product)
            <div class="text-center mb-4">
                <h1 class="h2 mb-3">{{ $soldProduct->product->model_name }}</h1>
                <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 mb-3">
                    <span class="text-muted">{{ __('common.serial_number') }}:</span>
                    <span class="serial-display">{{ $soldProduct->serial_number }}</span>
                    <div class="unit-toggle-custom ms-3" tabindex="0">
    <button type="button" class="unit-btn si-btn{{ $unit === 'si' ? ' active' : '' }}" id="siBtn">SI</button>
    <button type="button" class="unit-btn imperial-btn{{ $unit === 'si' ? '' : ' active' }}" id="imperialBtn">Imperial</button>
</div>
<style>
    .unit-toggle-custom {
        display: inline-flex;
        border-radius: 16px;
        background: #f8f9fa;
        border: 1.5px solid #b0d701;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,84,142,0.07);
        transition: border-color 0.25s;
        outline: none;
    }
    .unit-toggle-custom:focus-within {
        border-color: #00548e;
    }
    .unit-btn {
        border: none;
        outline: none;
        background: transparent;
        color: #00548e;
        font-weight: 700;
        font-size: 1.07rem;
        padding: 8px 24px;
        transition: background 0.22s, color 0.22s, box-shadow 0.22s;
        cursor: pointer;
        border-radius: 0;
    }
    .unit-btn.active, 
    .unit-btn:focus {
        background: #00548e;
        color: #fff;
        box-shadow: 0 2px 8px rgba(176,215,1,0.13);
        z-index: 2;
    }
    .unit-btn:hover:not(.active) {
        background: #e5e7eb;
        background-color: #b0d701;
    }
</style>
                </div>
            </div>
            <div style="height: 32px;"></div>
        @else
            <div class="text-center">
                <h1 class="h2 mb-3">{{ __('common.coverage_results') }}</h1>
            </div>
        @endif
    </div>
</section>

<!-- Main Content -->
<div class="container main-container">
    @if($soldProduct && $soldProduct->product)
        <!-- Product Specifications Card -->
        <div class="coverage-card animate-in mb-4 mt-20" style="position:relative;">
    <button type="button"
        class="btn btn-outline-danger"
        id="pdfBtn"
        style="position:absolute;top:28px;right:32px;z-index:10;display:inline-flex;align-items:center;font-weight:600;gap:8px;border-radius:8px;"
        data-model_name="{{ $soldProduct->product->model_name ?? '-' }}"
        data-line="{{ $soldProduct->product->line ?? '-' }}"
        data-type="{{ $soldProduct->product->type ?? '-' }}"
        data-image_url="{{ $soldProduct->product->image_url ? asset($soldProduct->product->image_url) : asset('images/fallback.webp') }}"
>
        <i class="fas fa-arrow-down me-2" aria-hidden="true"></i> Download PDF
    </button>
            <div class="section-title mb-3">
                <div class="section-icon product">
                    <i class="fas fa-cogs"></i>
                </div>
                {{ __('common.product_details') }}
            </div>
            <div class="row align-items-stretch">
                <div class="col-lg-4 text-center mb-4 mb-lg-0 d-flex align-items-stretch">
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: #f8f9fa; border-radius: 16px; min-height: 420px;">
                        <img src="{{ $soldProduct->product->image_url ?? asset('images/fallback.webp') }}" alt="{{ $soldProduct->product->model_name }}" class="product-image w-100 h-100" style="object-fit:contain; max-height:380px;">
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
                                        <th><i class="fas {{ $spec['icon'] }} me-2 text-secondary"></i>{{ $spec['label'] }}</th>
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
        <div class="coverage-card animate-in mb-4">
            <div class="section-title">
                <div class="section-icon owner">
                    <i class="fas fa-user-circle"></i>
                </div>
                {{ __('common.owner_details') }}
            </div>
            <div class="table-responsive">
                <table class="table specs-table mb-0">
                    <tbody>
                        <tr><th><i class="fas fa-user me-2 text-secondary"></i>{{ __('common.name') }}</th><td>{{ $soldProduct->owner->name }}</td></tr>
                        <tr><th><i class="fas fa-building me-2 text-secondary"></i>{{ __('common.company') }}</th><td>{{ $soldProduct->owner->company ?? '-' }}</td></tr>
                        <tr><th><i class="fas fa-flag me-2 text-secondary"></i>{{ __('common.country') }}</th><td>{{ $soldProduct->owner->country ?? '-' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    <!-- Warranty Status Card (restored style) -->
    <div class="coverage-card animate-in">
            <div class="section-title mb-3" style="font-size:1.5rem;">
                <div class="section-icon warranty">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <span style="font-size:1.25em; font-weight:600; vertical-align:middle;">{{ __('common.warranty_coverage') }}</span>
            </div>
            @if($soldProduct->warranty_voided)
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="status-badge expired" style="font-size:1.2em; background: linear-gradient(135deg, var(--apple-red) 0%, #DC3545 100%);">
                                <i class="fas fa-ban me-2"></i>
                                {{ __('common.warranty_voided') }}
                            </span>
                        </div>
                        <p class="mb-2" style="font-size:1.1em;">
                            
                            <strong>{{ __('common.warranty_voided_at') }}</strong> {{ $soldProduct->warranty_voided_at ? $soldProduct->warranty_voided_at->format('F j, Y H:i') : '-' }}
                        </p>
                       
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="warranty-visual">
                            <i class="fas fa-ban text-danger" style="font-size: 4rem;"></i>
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
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="status-badge {{ strtolower(str_replace(' ', '', $status)) }}" style="font-size:1.2em;">
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
                        <p class="mb-2" style="font-size:1.1em;">
                            <strong>{{ __('common.warranty_expires') }}</strong> {{ $warrantyEnd }}
                            @if($daysLeft !== null && $daysLeft > 0 && $status !== __('common.warranty_expired_status'))
                                <span class="text-muted">({{ is_numeric($daysLeft) ? round($daysLeft) : $daysLeft }} {{ __('common.days_remaining') }})</span>
                            @endif
                        </p>
                        <div class="warranty-progress">
                            <div class="warranty-progress-bar {{ $progressClass }}" style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        <div class="mt-3" style="font-size:1.08em;">
                            <span class="me-3"><i class="fas fa-shopping-cart me-1 text-secondary"></i><strong>{{ __('common.purchase_date') }}:</strong> {{ $purchaseDate }}</span>
                            <span class="me-3"><i class="fas fa-play-circle me-1 text-secondary"></i><strong>{{ __('common.warranty_start') }}:</strong> {{ $warrantyStart }}</span>
                            <span><i class="fas fa-calendar-check me-1 text-secondary"></i><strong>{{ __('common.warranty_end') }}:</strong> {{ $warrantyEnd }}</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="warranty-visual">
                            <i class="fas fa-{{ $status === __('common.valid') ? 'shield-check text-success' : ($status === __('common.warranty_expiring_soon') ? 'shield-alt text-warning' : 'shield-times text-danger') }}" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
</div>
   
                </div>
                <div class="col-md-4 text-center">
                    <div class="warranty-visual">
                        <i class="fas fa-{{ $status === __('common.valid') ? 'shield-check text-success' : ($status === __('common.warranty_expiring_soon') ? 'shield-alt text-warning' : 'shield-times text-danger') }}" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- No Result Found -->
        <div class="no-result-card animate-in">
            <div class="no-result-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="h4 mb-3">No Equipment Found</h3>
            <p class="text-muted mb-4">
                We couldn't find any equipment matching the serial number you entered. 
                Please double-check the serial number and try again.
            </p>
            <a href="{{ route('serial-lookup.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>
                Try Another Search
            </a>
        </div>
    @endif
</div>
<style>
    .warranty-progress {
        background: #e9ecef;
        border-radius: 8px;
        height: 18px;
        min-height: 18px;
        margin-bottom: 0.75rem;
        overflow: visible;
        box-shadow: 0 2px 10px 0 rgba(0,84,142,0.09);
        border: 1.5px solid #e0e0e0;
        position: relative;
    }
    .warranty-progress-bar {
        height: 100%;
        min-width: 2.5%;
        border-radius: 8px;
        transition: width 1.2s cubic-bezier(0.4,0,0.2,1), background 0.4s;
        box-shadow: 0 1px 6px 0 rgba(0,84,142,0.07);
        position: absolute;
        left: 0; top: 0;
    }
    .warranty-progress-bar.valid {
        background: #34C759;
    }
    .warranty-progress-bar.expiring {
        background: #FFA500;
    }
    .warranty-progress-bar.expired {
        background: #FF3B30;
    }
</style> 
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
                unitValues.forEach(element => {
                    const value = element.getAttribute(`data-${unit}`);
                    if (value) {
                        element.style.opacity = '0';
                        setTimeout(() => {
                            element.textContent = value;
                            element.style.opacity = '1';
                        }, 150);
                    }
                });
            }

            // Animate elements on scroll
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

            document.querySelectorAll('.coverage-card, .no-result-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(card);
            });

            // PDF Download Logic
            const pdfBtn = document.getElementById('pdfBtn');
            if (pdfBtn) {
                pdfBtn.addEventListener('click', generatePdf);
            }

            function generatePdf() {
                if (!window.jspdf) {
                    alert('jsPDF library is missing. Please check the script order.');
                    return;
                }

                // Fetch product info from data attributes on the PDF button for reliability
                const pdfBtn = document.getElementById('pdfBtn');
                const productName = pdfBtn?.dataset.model_name || '-';
                const productLine = pdfBtn?.dataset.line || '-';
                const productType = pdfBtn?.dataset.type || '-';
                let productImgUrl = pdfBtn?.dataset.image_url || (window.location.origin + '/images/fallback.webp');

                const doc = new window.jspdf.jsPDF({ unit: 'pt', format: 'a4' });
                const pageWidth = doc.internal.pageSize.getWidth();
                let y = 36;


                // Build specs table (EXCLUDE model name, line, type)
                const specsRows = [];
                const specsTable = document.querySelector('.specs-table');
                if (specsTable) {
                    let rowIndex = 0;
                    specsTable.querySelectorAll('tbody tr').forEach(row => {
                        rowIndex++;
                        // skip first 3 rows (model name, line, type)
                        if (rowIndex <= 3) return;
                        const label = row.querySelector('th')?.innerText || '-';
                        const span = row.querySelector('td span.unit-value');
                        const siValue = span ? (span.dataset.si || '-') : '-';
                        const lbftValue = span ? (span.dataset.imperial || '-') : '-';
                        specsRows.push([label, siValue, lbftValue]);
                    });
                } else {
                    specsRows.push(['-', '-', '-']);
                }
                const specsHead = [['Specification', 'SI', 'lb-ft']];

                // Warranty Info (robust extraction for all cases, no redundancy)
                const warrantyRows = [];
                const warrantyCard = document.querySelectorAll('.coverage-card')[2];
                if (warrantyCard) {
                    // Voided warranty
                    const voidedElem = warrantyCard.querySelector('.status-badge.expired, .fa-ban');
                    if (voidedElem) {
                        const status = voidedElem.textContent.trim() || '-';
                        const voidedAtElem = warrantyCard.querySelector('strong');
                        let voidedAt = '-';
                        if (voidedAtElem && voidedAtElem.nextSibling && voidedAtElem.nextSibling.textContent) {
                            voidedAt = voidedAtElem.nextSibling.textContent.trim();
                        }
                        warrantyRows.push(['Status', status]);
                        warrantyRows.push(['Voided At', voidedAt]);
                    } else {
                        // Normal warranty
                        const purchaseDate = warrantyCard.querySelector('.fa-shopping-cart')?.parentElement?.innerText?.split(':')[1]?.trim() || '-';
                        const warrantyStart = warrantyCard.querySelector('.fa-play-circle')?.parentElement?.innerText?.split(':')[1]?.trim() || '-';
                        const warrantyEnd = warrantyCard.querySelector('.fa-calendar-check')?.parentElement?.innerText?.split(':')[1]?.trim() || '-';
                        const statusElem = warrantyCard.querySelector('.status-badge');
                        const status = statusElem ? statusElem.textContent.trim() : '-';
                        let daysRemaining = '-';
                        const daysElem = warrantyCard.querySelector('.text-muted');
                        if (daysElem) {
                            daysRemaining = daysElem.textContent.replace(/[^0-9]/g, '').trim();
                        }
                        warrantyRows.push(['Purchase Date', purchaseDate]);
                        warrantyRows.push(['Warranty Start', warrantyStart]);
                        warrantyRows.push(['Warranty End', warrantyEnd]);
                        warrantyRows.push(['Status', status]);
                        warrantyRows.push(['Days Remaining', daysRemaining]);
                    }
                } else {
                    warrantyRows.push(['Purchase Date', '-']);
                    warrantyRows.push(['Warranty Start', '-']);
                    warrantyRows.push(['Warranty End', '-']);
                    warrantyRows.push(['Status', '-']);
                    warrantyRows.push(['Days Remaining', '-']);
                }

                // Owner Info (unchanged)
                const ownerRows = [];
                const ownerCard = document.querySelectorAll('.coverage-card')[1];
                if (ownerCard) {
                    const name = ownerCard.querySelector('.fa-user')?.parentElement?.nextElementSibling?.innerText || '-';
                    const company = ownerCard.querySelector('.fa-building')?.parentElement?.nextElementSibling?.innerText || '-';
                    const country = ownerCard.querySelector('.fa-flag')?.parentElement?.nextElementSibling?.innerText || '-';
                    ownerRows.push(['Name', name]);
                    ownerRows.push(['Company', company]);
                    ownerRows.push(['Country', country]);
                } else {
                    ownerRows.push(['Name', '-']);
                    ownerRows.push(['Company', '-']);
                    ownerRows.push(['Country', '-']);
                }

                // Draw PDF
                const logoUrl = window.location.origin + '/images/logo2.png';
                const drawLogo = (cb) => {
                    const img = new window.Image();
                    img.crossOrigin = 'anonymous';
                    img.onload = function () {
                        doc.addImage(img, 'PNG', pageWidth - 156, 24, 120, 48);
                        cb();
                    };
                    img.onerror = function () { cb(); };
                    img.src = logoUrl;
                };

                drawLogo(() => {
                    doc.setFontSize(20);
                    doc.setFont('helvetica', 'bold');
                    doc.text('Coverage Results - ' + productName, pageWidth / 2, y + 32, { align: 'center' });
                    y += 64;

                    // Product image and beside it: Model Name, Line, Type
                    if (productImgUrl) {
                        const img = new window.Image();
                        img.crossOrigin = 'anonymous';
                        img.onload = function () {
                            doc.addImage(img, 'PNG', 40, y, 120, 90);
                            doc.setFontSize(14);
                            doc.setFont('helvetica', 'normal');
                            // Draw Model Name, Line, Type beside image
                            let infoY = y + 10;
                            doc.text('Model Name: ' + productName, 180, infoY);
                            doc.text('Line: ' + productLine, 180, infoY + 26);
                            doc.text('Type: ' + productType, 180, infoY + 52);
                            renderTables(y + 110);
                        };
                        img.onerror = function () {
                            renderTables(y);
                        };
                        img.src = productImgUrl;
                    } else {
                        renderTables(y);
                    }

                    function renderTables(startY) {
                        let tableY = startY + 40;

                        doc.setFontSize(14);
                        doc.setFont('helvetica', 'bold');
                        doc.text('Product Specifications', 40, tableY);
                        doc.autoTable({
                            startY: tableY + 8,
                            head: specsHead,
                            body: specsRows,
                            theme: 'grid',
                            headStyles: { fillColor: [0, 84, 142] },
                            styles: { font: 'helvetica', fontSize: 11 },
                            margin: { left: 40, right: 40 }
                        });
                        tableY = doc.lastAutoTable.finalY + 16;

                        doc.text('Owner Information', 40, tableY);
                        doc.autoTable({
                            startY: tableY + 8,
                            head: [['Attribute', 'Value']],
                            body: ownerRows,
                            theme: 'grid',
                            headStyles: { fillColor: [0, 84, 142] },
                            styles: { font: 'helvetica', fontSize: 11 },
                            margin: { left: 40, right: 40 }
                        });
                        tableY = doc.lastAutoTable.finalY + 16;

                        doc.text('Warranty Information', 40, tableY);
                        doc.autoTable({
                            startY: tableY + 8,
                            head: [['Attribute', 'Value']],
                            body: warrantyRows,
                            theme: 'grid',
                            headStyles: { fillColor: [0, 84, 142] },
                            styles: { font: 'helvetica', fontSize: 11 },
                            margin: { left: 40, right: 40 }
                        });

                        doc.save('equipment-coverage-' + productLine + '-' + productType + '.pdf');
                    }
                });
            }
        });
</script>
@endpush

