@extends('layouts.public')

@section('title', $product->model_name . ' - Soosan Cebotics')
@section('description', 'View details and specifications for ' . $product->model_name)

@section('content')
<div class="container py-5" style="min-height: 70vh;">
    <div class="row g-5 align-items-start">
        <div class="col-lg-6 text-center mb-4 mb-lg-0">
            <div class="product-image-container rounded shadow-sm p-3 fade-in" style="min-height: 420px; display: flex; align-items: center; justify-content: center;">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" style="max-width: 100%; max-height: 500px; object-fit: contain;" loading="lazy">
                @else
                    <div class="text-center text-muted">
                        <i class="bi bi-image" style="font-size: 4rem; opacity: 0.3;"></i>
                        <p class="mt-3 mb-0">{{ __('common.no_image') }}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <span class="badge bg-primary mb-2" style="font-size: 1rem;">{{ $product->category->name ?? __('common.product_category') }}</span>
            <h1 class="fw-bold mb-3" style="font-size: 2.2rem;">{{ $product->model_name }}</h1>

            <div class="row mb-4 g-2">
                <div class="col-4 text-center">
                    <div class="product-specs-card rounded py-3 px-2">
                        <div class="fw-bold" style="font-size: 1.2rem;">
                            @php
                                $ow = $product->operating_weight;
                                $ow_si = $ow ? number_format($ow * 0.45359237, 1) . ' kg' : '- kg';
                                $ow_imperial = $ow ? number_format($ow, 1) . ' lb' : '- lb';
                            @endphp
                            <span class="unit-value" data-si="{{ $ow_si }}" data-imperial="{{ $ow_imperial }}">{{ $ow_si }}</span>
                        </div>
                        <div class="small text-muted">{{ __('common.operating_weight') }}</div>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div class="product-specs-card rounded py-3 px-2">
                        <div class="fw-bold" style="font-size: 1.2rem;">
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
                        <div class="small text-muted">{{ __('common.required_oil_flow') }}</div>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div class="product-specs-card rounded py-3 px-2">
                        <div class="fw-bold" style="font-size: 1.2rem;">
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
                        <div class="small text-muted">{{ __('common.applicable_carrier') }}</div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 mb-4">
                <button type="button" class="btn btn-outline-secondary flex-grow-1" id="shareBtn" style="border-radius: 8px; font-weight: 500;" aria-label="Share Product">
                    <i class="fas fa-share-alt me-2" aria-hidden="true"></i> Share
                </button>
                <button type="button" class="btn btn-outline-danger flex-grow-1" id="pdfBtn" style="border-radius: 8px; font-weight: 500;" aria-label="Download as PDF">
                    <i class="fas fa-file-pdf me-2" aria-hidden="true"></i>
                    <i class="fas fa-arrow-down me-2" aria-hidden="true"></i> Download PDF
                </button>
                <button type="button" class="btn btn-outline-success flex-grow-1" id="csvBtn" style="border-radius: 8px; font-weight: 500;" aria-label="Download as CSV">
                    <i class="fas fa-file-excel me-2" aria-hidden="true"></i>
                    <i class="fas fa-arrow-down me-2" aria-hidden="true"></i> Download CSV
                </button>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="d-flex justify-content-between mb-2 align-items-center">
            <h3 class="fw-bold">{{ __('common.specifications') }}</h3>
            <div class="unit-toggle btn-group" role="group" aria-label="Unit Toggle">
                <button type="button" class="btn btn-primary active" id="siBtn">{{ __('common.si') }}</button>
                <button type="button" class="btn btn-outline-primary" id="imperialBtn">{{ __('common.imperial') }}</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle specifications-table">
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

@php
    $similarProducts = \App\Models\Product::where(function($q) use ($product) {
        if ($product->type) $q->orWhere('type', $product->type);
    })
    ->where('id', '!=', $product->id)
    ->limit(12)
    ->get();
@endphp
@if($similarProducts->count())
<div class="container my-5">
    <h3 class="fw-bold mb-4">{{ __('common.similar_products') }}</h3>
    <div class="position-relative">
        <button id="carouselPrevBtn" class="btn btn-carousel-arrow position-absolute top-50 translate-middle-y carousel-arrow" 
                style="z-index: 10; border-radius: 50%; width: 50px; height: 50px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); {{ app()->getLocale() === 'ar' ? 'right: -30px;' : 'left: -30px;' }} display: none; background: #00548e;"
                title="{{ __('common.previous_products') }}" 
                aria-label="{{ __('common.previous_products') }}">
            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" style="font-size: 1.5rem; color: #ffffff;"></i>
        </button>
        <button id="carouselNextBtn" class="btn btn-carousel-arrow position-absolute top-50 translate-middle-y carousel-arrow" 
                style="z-index: 10; border-radius: 50%; width: 50px; height: 50px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); {{ app()->getLocale() === 'ar' ? 'left: -30px;' : 'right: -30px;' }}; background: #00548e;"
                title="{{ __('common.next_products') }}" 
                aria-label="{{ __('common.next_products') }}">
            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" style="font-size: 1.5rem; color: #ffffff;"></i>
        </button>
        <div class="carousel-container" style="overflow: hidden; border-radius: 12px;">
            <div id="similarProductsCarousel" class="d-flex gap-4 pb-3" style="transition: transform 0.4s ease-in-out; {{ app()->getLocale() === 'ar' ? 'direction: rtl;' : 'direction: ltr;' }}">
                @foreach($similarProducts as $sim)
                <div class="flex-shrink-0 product-card" style="width: 320px;">
                    <a href="{{ route('products.show', $sim->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm border-0 hover-card" style="min-height: 360px; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; {{ app()->getLocale() === 'ar' ? 'direction: rtl;' : 'direction: ltr;' }} background: #ffffff;">
                            <div class="card-img-container" style="background: linear-gradient(135deg, #e9ecef 0%, #ffffff 100%); display: flex; align-items: center; justify-content: center; height: 200px; position: relative; border-bottom: 2px solid #dee2e6; padding: 15px;">
                                @if($sim->image_url)
                                    <img src="{{ $sim->image_url }}" alt="{{ $sim->model_name }}" class="card-img-top" style="max-height: 180px; max-width: 100%; object-fit: contain; width: auto; height: auto; transition: transform 0.3s ease;" loading="lazy">
                                @else
                                    <div class="text-center text-muted">
                                        <i class="bi bi-image" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">{{ __('common.no_image') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; padding: 20px;">
                                <h5 class="card-title fw-semibold mb-3" style="font-size: 1.1rem; line-height: 1.3; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #333;">{{ $sim->model_name }}</h5>
                                <ul class="list-unstyled mb-0 flex-grow-1">
                                    <li class="d-flex justify-content-between mb-2 small">
                                        <strong class="text-muted">{{ __('common.operating_weight') }}:</strong> 
                                        <span class="text-dark">
                                            @if($sim->operating_weight !== null && $sim->operating_weight !== '')
                                                {{ number_format($sim->operating_weight, 1) }} {{ __('common.unit_lb') }}
                                            @else
                                                - {{ __('common.unit_lb') }}
                                            @endif
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2 small">
                                        <strong class="text-muted">{{ __('common.required_oil_flow') }}:</strong> 
                                        <span class="text-dark">
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
                                    <li class="d-flex justify-content-between mb-2 small">
                                        <strong class="text-muted">{{ __('common.applicable_carrier') }}:</strong> 
                                        <span class="text-dark">
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
                                <div class="mt-auto pt-3">
                                    <span class="btn btn-outline-primary btn-sm w-100" style="border-color: #003087; color: #003087; transition: all 0.3s ease;">{{ __('common.view_details') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="carousel-indicators d-flex justify-content-center gap-2 mt-5" style="position: relative; bottom: 0;">
            @for($i = 0; $i < ceil($similarProducts->count() / 3); $i++)
                <button class="carousel-indicator {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid #007bff; background: {{ $i === 0 ? '#007bff' : 'transparent' }}; transition: all 0.3s ease; cursor: pointer;"></button>
            @endfor
        </div>
    </div>
</div>
@endif
@endsection

<style>
/* Product Show Page Enhancements */
.product-image-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}
.product-image-container:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.product-specs-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}
.product-specs-card:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    border: none;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-outline-secondary, .btn-outline-success, .btn-outline-danger {
    border: 2px solid;
    transition: all 0.3s ease;
}
.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}
.btn-outline-success:hover {
    background: #198754;
    border-color: #198754;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}
.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.specifications-table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
.specifications-table th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    font-weight: 600;
    color: #495057;
    padding: 16px;
    text-align: center;
    width: 30%;
    border-bottom: 2px solid #dee2e6;
}
.specifications-table td {
    padding: 16px;
    border-bottom: 1px solid #f8f9fa;
    text-align: center;
}
.specifications-table tr:last-child td {
    border-bottom: none;
}
.specifications-table tr:hover {
    background: #f8f9fa;
}

/* Unit Toggle Enhancements */
.btn-group .btn {
    border: 2px solid #0d6efd;
    transition: all 0.3s ease;
}
.btn-group .btn.active {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    border-color: #0d6efd;
    color: white;
}
.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Badge Enhancements */
.badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Copy Toast */
.copy-toast {
    position: fixed;
    right: 32px;
    bottom: 32px;
    background: #002147;
    color: #fff;
    padding: 12px 24px;
    border-radius: 24px;
    font-size: 1rem;
    font-weight: 500;
    box-shadow: 0 4px 24px rgba(0, 33, 71, 0.15);
    opacity: 0;
    pointer-events: none;
    z-index: 1000;
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: translateY(40px);
}
.copy-toast.active {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* Scroll to Top Button */
#scrollTopBtn {
    position: fixed;
    bottom: 32px;
    right: 32px;
    z-index: 999;
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    min-width: 64px;
    height: 48px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0 1.5rem;
}
#scrollTopBtn:hover {
    background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
}

/* Carousel Enhancements */
.carousel-container {
    padding: 0 60px;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.carousel-arrow {
    background: linear-gradient(135deg, #003087 0%, #002060 100%);
    border: none;
    transition: all 0.3s ease;
}
.carousel-arrow:hover {
    background: linear-gradient(135deg, #002060 0%, #001440 100%);
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 48, 135, 0.4);
}

.carousel-indicator {
    background: transparent;
    border: 2px solid #003087;
    transition: all 0.3s ease;
}
.carousel-indicator.active {
    background: #003087;
    border-color: #003087;
}
.carousel-indicator:hover {
    background: #0056b3;
    border-color: #0056b3;
}

.product-card .card {
    background: #ffffff;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
    padding: 15px;
}
.product-card .card-img-container {
    background: linear-gradient(135deg, #e9ecef 0%, #ffffff 100%);
    border-bottom: 2px solid #dee2e6;
    padding: 15px;
}
.product-card .btn-outline-primary {
    border-color: #003087;
    color: #003087;
    transition: all 0.3s ease;
}
.product-card .btn-outline-primary:hover {
    background: #003087;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 48, 135, 0.3);
}
.hover-card {
    background: #ffffff;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
    padding: 15px;
    position: relative;
    overflow: hidden;
}
.hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    background: #00548e;
}
.hover-card:hover .card-img-top {
    transform: scale(1.05);
} 
/* .hover-card:hover .card-title,
.hover-card:hover .text-dark,
.hover-card:hover .text-muted {
    color: #ffffff !important;
} */
.hover-card:hover .btn-outline-primary {
    color: white !important;
    background-color: #b0d701;
    border-color: #b0d701 !important;
} 
/* .hover-card:hover .btn-outline-primary:hover {
    background: #b0d701;
    color: #ffffff;
    border-color: 
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(176, 215, 1, 0.3);
} */
.card-body {
    padding: 20px;
    transition: all 0.3s ease;
}
.card-img-container {
    padding: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-bottom: 2px solid #dee2e6;
    transition: all 0.3s ease;
}


/* Responsive Design */
@media (max-width: 1200px) {
    .carousel-container {
        padding: 0 40px;
    }
    #carouselPrevBtn, #carouselNextBtn {
        width: 40px;
        height: 40px;
        {{ app()->getLocale() === 'ar' ? 'right: -20px;' : 'left: -20px;' }}
    }
    .carousel-arrow i {
        font-size: 1.2rem;
    }
}

@media (max-width: 992px) {
    .carousel-container {
        padding: 0 30px;
    }
    .product-card {
        width: 280px;
    }
    .d-flex.gap-2.mb-4 .btn {
        flex-grow: 0;
        width: 48%;
    }
    .specifications-table th,
    .specifications-table td {
        padding: 12px;
    }
}

@media (max-width: 768px) {
    .carousel-container {
        padding: 0 20px;
    }
    .product-card {
        width: 240px;
    }
    #carouselPrevBtn, #carouselNextBtn {
        {{ app()->getLocale() === 'ar' ? 'right: -15px;' : 'left: -15px;' }}
    }
    .btn-group .btn {
        padding: 6px 12px;
        font-size: 0.875rem;
    }
    .d-flex.gap-2.mb-4 .btn {
        width: 100%;
        margin-bottom: 10px;
    }
    .d-flex.gap-2.mb-4 .btn:last-child {
        margin-bottom: 0;
    }
}

@media (max-width: 576px) {
    .product-card {
        width: 200px;
    }
    .card-img-container {
        height: 160px;
    }
    .card-img-top {
        max-height: 140px;
    }
    .card-body {
        padding: 10px;
    }
    .card-title {
        font-size: 1rem;
    }
    .btn-group {
        flex-direction: column;
    }
    .btn-group .btn {
        width: 100%;
        margin-bottom: 5px;
    }
    .btn-group .btn:last-child {
        margin-bottom: 0;
    }
}

/* RTL Support */
[dir="rtl"] .carousel-container {
    padding: 0 60px 0 60px;
}
[dir="rtl"] #carouselPrevBtn {
    right: -30px;
    left: auto;
}
[dir="rtl"] #carouselNextBtn {
    left: -30px;
    right: auto;
}
[dir="rtl"] #scrollTopBtn {
    left: 32px;
    right: auto;
}
[dir="rtl"] .copy-toast {
    left: 32px;
    right: auto;
}

/* Animation for loading states */
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

/* Enhanced unit value transitions */
.unit-value {
    transition: all 0.3s ease;
    display: inline-block;
}
.unit-value.updating {
    opacity: 0.6;
    transform: scale(0.95);
}
</style>

<button id="scrollTopBtn" title="{{ __('common.back_to_top') }}" style="display:none;">{{ __('common.top') }}</button>

@push('scripts')
<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
<!-- jsPDF Core (non-UMD) -->
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
    }

    if (siBtn && imperialBtn) {
        siBtn.addEventListener('click', () => setUnit('si'));
        imperialBtn.addEventListener('click', () => setUnit('imperial'));
        setUnit('si'); // Always default to SI
    }

    // Scroll to top
    const scrollBtn = document.getElementById('scrollTopBtn');
    if (scrollBtn) {
        window.addEventListener('scroll', () => {
            scrollBtn.style.display = window.scrollY > 300 ? 'flex' : 'none';
        });
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

        // Carousel
        const carousel = document.getElementById('similarProductsCarousel');
        const prevBtn = document.getElementById('carouselPrevBtn');
        const nextBtn = document.getElementById('carouselNextBtn');
        const indicators = document.querySelectorAll('.carousel-indicator');
        if (carousel && prevBtn && nextBtn) {
            let currentSlide = 0;
            const cardWidth = 320 + 16; // Adjusted for gap
            const visibleCards = window.innerWidth >= 992 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
            const totalCards = carousel.children.length;
            const maxSlide = Math.max(0, Math.ceil(totalCards / visibleCards) - 1);
            const isRTL = document.documentElement.dir === 'rtl' || '{{ app()->getLocale() }}' === 'ar';

            function updateCarousel() {
                const translateX = isRTL ? currentSlide * cardWidth * visibleCards : -(currentSlide * cardWidth * visibleCards);
                carousel.style.transform = `translateX(${translateX}px)`;
                prevBtn.style.display = currentSlide > 0 ? 'block' : 'none';
                nextBtn.style.display = currentSlide < maxSlide ? 'block' : 'none';
                indicators.forEach((ind, i) => {
                    ind.classList.toggle('active', i === currentSlide);
                    ind.style.background = i === currentSlide ? '#00548e' : 'transparent';
                    ind.style.borderColor = i === currentSlide ? '#00548e' : '#b0d701';
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
                if (newVisibleCards !== visibleCards) {
                    updateCarousel();
                }
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

    // PDF Download
    const downloadPdfBtn = document.querySelector('#pdfBtn');
    if (downloadPdfBtn) {
        downloadPdfBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            if (typeof doc.autoTable !== 'function') {
                alert('PDF libraries failed to load.');
                return;
            }

            const logo = new Image();
            logo.crossOrigin = 'anonymous';
            logo.src = '{{ asset("images/logo2.png") }}';

            logo.onload = function () {
                const docWidth = doc.internal.pageSize.getWidth();
                const logoWidth = 40;
                const logoHeight = (logo.height * logoWidth) / logo.width;
                
                doc.addImage(logo, 'WEBP', docWidth - logoWidth - 15, 10, logoWidth, logoHeight);

                doc.setFontSize(20);
                doc.setFont('helvetica', 'bold');
                doc.text(`${productData.model_name} Specifications`, docWidth / 2, 25, { align: 'center' });

                doc.setFontSize(12);
                doc.setFont('helvetica', 'normal');
                const line = productData.line && productData.line !== '-' ? productData.line : 'SB Line';
                const type = productData.type && productData.type !== '-' ? productData.type : 'TR-F';
                doc.text(`Line: ${line}`, 15, 40);
                doc.text(`Type: ${type}`, 15, 47);

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
                    ['Hose Diameter', convertToSI('hose_diameter', productData.hose_diameter), formatImperial('hose_diameter', productData.hose_diameter)],
                    ['Rod Diameter', convertToSI('rod_diameter', productData.rod_diameter), formatImperial('rod_diameter', productData.rod_diameter)],
                    ['Applicable Carrier', convertToSI('applicable_carrier', productData.applicable_carrier), formatImperial('applicable_carrier', productData.applicable_carrier)],
                ];

                doc.autoTable({
                    startY: 55,
                    head: [tableData[0]],
                    body: tableData.slice(1),
                    theme: 'grid',
                    styles: { font: 'helvetica', fontSize: 10, cellPadding: 5 },
                    headStyles: { fillColor: [13, 110, 253], textColor: [255, 255, 255], fontStyle: 'bold', halign: 'center' },
                    bodyStyles: { fillColor: [245, 245, 245], alternateFillColor: [255, 255, 255], halign: 'center' },
                    margin: { top: 10, right: 10, bottom: 20, left: 10 }
                });

                const now = new Date();
                doc.setFontSize(10);
                doc.text(`Generated on: ${now.toLocaleString('en-US', {
                    month: 'long', day: '2-digit', year: 'numeric',
                    hour: '2-digit', minute: '2-digit', hour12: true
                })} EEST`, docWidth / 2, 290, { align: 'center' });

                doc.save(`${productData.model_name}_specifications.pdf`);
                showToast('{{ __("common.pdf_download_started") }}');
            };

            logo.onerror = () => alert("Failed to load logo image. PDF not generated.");
        });
    }

    // CSV Download
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
            showToast('{{ __("common.csv_download_started") }}');
        });
    }

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
            case 'hose_diameter':
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
        const toast = document.createElement('div');
        toast.className = 'copy-toast';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.classList.add('active'), 10);
        setTimeout(() => toast.classList.remove('active'), 2010);
        setTimeout(() => document.body.removeChild(toast), 2210);
    }
});
</script>
@endpush