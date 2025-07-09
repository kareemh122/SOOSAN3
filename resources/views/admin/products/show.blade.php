@extends('layouts.admin')

@section('title', __('products.product_details'))

@section('content')
<style>
/* Reset and prevent inheritance from global styles */
.product-show-container * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.product-show-container {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f8fafc;
    min-height: 100vh;
    padding: 2rem;
    color: #1f2937;
    line-height: 1.6;
}

/* Modern Header */
.product-show-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 0 0 1.5rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.product-show-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.product-show-header-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-show-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-show-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-top: 0.5rem;
    font-weight: 400;
}

.product-show-actions {
    display: flex;
    gap: 1rem;
}

.product-show-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 0.75rem;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.product-show-btn-primary {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.product-show-btn-primary:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: translateY(-1px);
}

.product-show-btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.product-show-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    transform: translateY(-1px);
}

/* Main Content */
.product-show-content {
    max-width: 1200px;
    margin: 0 auto;
}

.product-show-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 2rem;
    margin-bottom: 2rem;
}

/* Product Card */
.product-show-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

.product-show-card:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}

.product-show-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.product-show-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.product-show-card-icon {
    width: 24px;
    height: 24px;
    color: #667eea;
}

.product-show-card-body {
    padding: 1.5rem;
}

/* Specifications Grid */
.product-specs-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.product-spec-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.product-spec-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.product-spec-item:last-child {
    border-bottom: none;
}

.product-spec-label {
    font-weight: 600;
    color: #6b7280;
    font-size: 0.9rem;
}

.product-spec-value {
    color: #1f2937;
    font-weight: 500;
    text-align: right;
}

/* Status Badge */
.product-status-badges {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.product-status-badge {
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.product-status-badge.active {
    background: #dcfce7;
    color: #16a34a;
}

.product-status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}

.product-status-badge.featured {
    background: #fef3c7;
    color: #d97706;
}

.product-status-badge.normal {
    background: #f3f4f6;
    color: #6b7280;
}

/* Image Container */
.product-image-container {
    background: #f8fafc;
    border-radius: 0.75rem;
    padding: 1rem;
    margin-top: 1.5rem;
    text-align: center;
}

.product-image {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.product-no-image {
    padding: 3rem 1rem;
    color: #9ca3af;
    background: #f9fafb;
    border-radius: 0.5rem;
    border: 2px dashed #d1d5db;
    text-align: center;
}

.product-no-image-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 1rem;
    color: #d1d5db;
}

/* Metadata */
.product-metadata {
    padding: 1rem 0;
    border-top: 1px solid #f3f4f6;
    margin-top: 1rem;
}

.product-metadata-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    font-size: 0.9rem;
}

.product-metadata-label {
    color: #6b7280;
    font-weight: 500;
}

.product-metadata-value {
    color: #1f2937;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .product-show-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .product-specs-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .product-show-container {
        padding: 1rem;
    }
    
    .product-show-header {
        margin: -1rem -1rem 1.5rem -1rem;
        padding: 2rem 0;
    }
    
    .product-show-header-content {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
        padding: 0 1rem;
    }
    
    .product-show-title {
        font-size: 2rem;
    }
    
    .product-show-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .product-show-btn {
        justify-content: center;
    }
    
    .product-specs-grid {
        grid-template-columns: 1fr;
    }
    
    .product-status-badges {
        flex-direction: column;
        align-items: stretch;
    }
    
    .product-status-badge {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .product-show-title {
        font-size: 1.75rem;
    }
    
    .product-show-subtitle {
        font-size: 1rem;
    }
}
</style>

<div class="product-show-container">
    <!-- Header -->
    <div class="product-show-header">
        <div class="product-show-header-content">
            <div>
                <h1 class="product-show-title">{{ $product->model_name }}</h1>
                <p class="product-show-subtitle">{{ __('products.product_details_specifications') }}</p>
            </div>
            <div class="product-show-actions">
                <a href="{{ route('admin.products.edit', $product) }}" class="product-show-btn product-show-btn-primary">
                    <svg class="product-show-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    {{ __('products.edit_product') }}
                </a>
                <a href="{{ route('admin.products.index') }}" class="product-show-btn product-show-btn-secondary">
                    <svg class="product-show-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('products.back_to_products') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="product-show-content">
        <div class="product-show-grid">
            <!-- Product Information -->
            <div class="product-show-card">
                <div class="product-show-card-header">
                    <h2 class="product-show-card-title">
                        <svg class="product-show-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('products.product_specifications') }}
                    </h2>
                </div>
                <div class="product-show-card-body">
                    <div class="product-specs-grid">
                        <div class="product-spec-group">
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.model_name') }}</span>
                                <span class="product-spec-value">{{ $product->model_name }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.line') }}</span>
                                <span class="product-spec-value">{{ $product->line ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.type') }}</span>
                                <span class="product-spec-value">{{ $product->type ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.category') }}</span>
                                <span class="product-spec-value">{{ $product->category->name ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.body_weight') }}</span>
                                <span class="product-spec-value">{{ $product->body_weight ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.operating_weight') }}</span>
                                <span class="product-spec-value">{{ $product->operating_weight ?? __('products.n_a') }}</span>
                            </div>
                        </div>
                        <div class="product-spec-group">
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.overall_length') }}</span>
                                <span class="product-spec-value">{{ $product->overall_length ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.overall_width') }}</span>
                                <span class="product-spec-value">{{ $product->overall_width ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.overall_height') }}</span>
                                <span class="product-spec-value">{{ $product->overall_height ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.required_oil_flow') }}</span>
                                <span class="product-spec-value">{{ $product->required_oil_flow ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.operating_pressure') }}</span>
                                <span class="product-spec-value">{{ $product->operating_pressure ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.impact_rate') }}</span>
                                <span class="product-spec-value">{{ $product->impact_rate ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.impact_rate_soft_rock') }}</span>
                                <span class="product-spec-value">{{ $product->impact_rate_soft_rock ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.hose_diameter') }}</span>
                                <span class="product-spec-value">{{ $product->hose_diameter ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.rod_diameter') }}</span>
                                <span class="product-spec-value">{{ $product->rod_diameter ?? __('products.n_a') }}</span>
                            </div>
                            <div class="product-spec-item">
                                <span class="product-spec-label">{{ __('products.applicable_carrier') }}</span>
                                <span class="product-spec-value">{{ $product->applicable_carrier ?? __('products.n_a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Status & Image -->
            <div class="product-show-card">
                <div class="product-show-card-header">
                    <h2 class="product-show-card-title">
                        <svg class="product-show-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('products.status_details') }}
                    </h2>
                </div>
                <div class="product-show-card-body">
                    <div class="product-status-badges">
                        <span class="product-status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                            {{ $product->is_active ? __('products.active') : __('products.inactive') }}
                        </span>
                        <span class="product-status-badge {{ $product->is_featured ? 'featured' : 'normal' }}">
                            {{ $product->is_featured ? __('products.featured') : __('products.normal') }}
                        </span>
                    </div>
                    
                    <div class="product-metadata">
                        <div class="product-metadata-item">
                            <span class="product-metadata-label">{{ __('products.created') }}</span>
                            <span class="product-metadata-value">{{ $product->created_at ? $product->created_at->format('M d, Y H:i') : __('products.n_a') }}</span>
                        </div>
                        <div class="product-metadata-item">
                            <span class="product-metadata-label">{{ __('products.updated') }}</span>
                            <span class="product-metadata-value">{{ $product->updated_at ? $product->updated_at->format('M d, Y H:i') : __('products.n_a') }}</span>
                        </div>
                    </div>

                    <div class="product-image-container">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" class="product-image">
                        @else
                            <div class="product-no-image">
                                <svg class="product-no-image-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p>{{ __('products.no_image_available') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
