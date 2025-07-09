@extends('layouts.admin')

@section('title', __('products.title'))

@section('content')
<style>
/* Reset and prevent inheritance from global styles */
.products-admin-container * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.products-admin-container {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f8fafc;
    min-height: 100vh;
    padding: 2rem;
    color: #1f2937;
    line-height: 1.6;
}

/* Modern Header */
.products-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 0 0 1.5rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.products-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.products-header-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 2rem;
}

.products-title-section h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.products-title-section p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.products-add-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 1rem 2rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.products-add-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    color: white;
    border-color: rgba(255, 255, 255, 0.5);
}

/* Stats Grid */
.products-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.products-stat-card {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.products-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.products-stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.products-stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.products-stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.products-stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.products-stat-content p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Search and Filter Section */
.products-controls {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
}

.products-controls-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.products-controls-header i {
    color: #667eea;
    font-size: 1.25rem;
}

.products-controls-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

.products-filter-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 1rem;
    align-items: end;
}

.products-form-group label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.products-form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background: white;
}

.products-form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.products-search-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.products-search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.products-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    position: relative;
}

.products-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.products-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: 0.75rem 0.75rem 0 0;
}

.product-image-wrapper {
    width: 100%;
    height: 200px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 0.75rem;
}

.product-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 0.5rem;
    transition: transform 0.3s ease;
}

.products-card:hover .product-image {
    transform: scale(1.02);
}

.products-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.products-card:hover .products-image img {
    transform: scale(1.05);
}

.products-image-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #9ca3af;
    font-size: 3rem;
    gap: 0.5rem;
}

.products-image-placeholder span {
    font-size: 0.875rem;
    font-weight: 500;
}

.products-status-badges {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.products-status {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    backdrop-filter: blur(8px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.products-status.active {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.products-status.inactive {
    background: rgba(239, 68, 68, 0.9);
    color: white;
}

.products-status.featured {
    background: rgba(245, 158, 11, 0.9);
    color: white;
}

.products-content {
    padding: 1.5rem;
}

.products-card-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.products-category {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.products-details {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 1rem 0;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 8px;
}

.products-detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.products-detail-item i {
    color: #667eea;
    width: 16px;
    flex-shrink: 0;
}

.products-detail-label {
    color: #6b7280;
    font-weight: 500;
    min-width: 50px;
}
    width: 16px;
}

.products-detail-value {
    font-weight: 600;
    color: #1f2937;
}

.products-description {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.products-actions {
    display: flex;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
}

.products-action-btn {
    flex: 1;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.products-action-btn.view {
    background: rgba(6, 182, 212, 0.1);
    color: #06b6d4;
    border: 1px solid rgba(6, 182, 212, 0.3);
}

.products-action-btn.edit {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.products-action-btn.delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.products-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.products-action-btn.view:hover {
    background: #06b6d4;
    color: white;
}

.products-action-btn.edit:hover {
    background: #f59e0b;
    color: white;
}

.products-action-btn.delete:hover {
    background: #ef4444;
    color: white;
}

.products-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #e5e7eb;
    background: #fafbfc;
}

.products-created-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6b7280;
    font-size: 0.75rem;
}

.products-created-date i {
    color: #667eea;
}

/* Pagination Styles - Completely isolated */
.products-pagination-wrapper {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    gap: 1rem !important;
    margin: 2rem 0 !important;
    padding: 1.5rem !important;
    background: white !important;
    border-radius: 1rem !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
    border: 1px solid #e5e7eb !important;
}

.products-pagination-wrapper .pagination {
    display: flex !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
    gap: 0.5rem !important;
    align-items: center !important;
}

.products-pagination-wrapper .pagination .page-item {
    margin: 0 !important;
    list-style: none !important;
}

.products-pagination-wrapper .pagination .page-item.active .page-link {
    color: white !important;
    background-color: #667eea !important;
    border-color: #667eea !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
    font-weight: 600 !important;
}

.products-pagination-wrapper .pagination .page-item.disabled .page-link {
    color: #9ca3af !important;
    pointer-events: none !important;
    background-color: #f9fafb !important;
    border-color: #e5e7eb !important;
    opacity: 0.6 !important;
    cursor: not-allowed !important;
}

.products-pagination-wrapper .pagination .page-link {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    padding: 0.75rem 1rem !important;
    font-size: 0.875rem !important;
    line-height: 1.25 !important;
    color: #6b7280 !important;
    text-decoration: none !important;
    background-color: white !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
    min-width: 40px !important;
    height: auto !important;
    width: auto !important;
    font-weight: 500 !important;
    justify-content: center !important;
}

.products-pagination-wrapper .pagination .page-link:hover {
    color: #667eea !important;
    text-decoration: none !important;
    background-color: #f8fafc !important;
    border-color: #667eea !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2) !important;
}

.products-pagination-wrapper .pagination .page-link i {
    font-size: 0.75rem !important;
}

.pagination-info {
    font-size: 0.875rem !important;
    color: #6b7280 !important;
    font-weight: 500 !important;
    text-align: center !important;
}

/* Empty State */
.products-empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.products-empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
}

.products-empty-state h3 {
    color: #1f2937;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.products-empty-state p {
    color: #6b7280;
    margin-bottom: 2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .products-admin-container {
        padding: 1rem;
    }
    
    .products-header {
        margin: -1rem -1rem 2rem -1rem;
        padding: 2rem 0;
    }
    
    .products-header-content {
        flex-direction: column;
        text-align: center;
        padding: 0 1rem;
    }
    
    .products-title-section h1 {
        font-size: 2rem;
    }
    
    .products-filter-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
    }
    
    .products-image,
    .product-image-wrapper {
        height: 180px;
    }
    
    .products-details {
        grid-template-columns: 1fr;
    }
    
    .products-stats {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .products-header-content {
        padding: 0 0.5rem;
    }
    
    .products-actions {
        flex-direction: column;
    }
    
    .products-action-btn {
        width: 100%;
    }
}

/* Animation */
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

.products-card {
    animation: fadeInUp 0.6s ease forwards;
}

.products-card:nth-child(2) { animation-delay: 0.1s; }
.products-card:nth-child(3) { animation-delay: 0.2s; }
.products-card:nth-child(4) { animation-delay: 0.3s; }
.products-card:nth-child(5) { animation-delay: 0.4s; }
.products-card:nth-child(6) { animation-delay: 0.5s; }
</style>

<div class="products-admin-container">
    <!-- Page Header -->
    <div class="products-header">
        <div class="products-header-content">
            <div class="products-title-section">
                <h1><i class="fas fa-cubes"></i> {{ __('products.products_management') }}</h1>
                <p>{{ __('products.manage_products') }}</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="products-add-btn">
                <i class="fas fa-plus"></i>
                {{ __('products.add_product') }}
            </a>
        </div>
    </div>

    @if(auth()->user()->isEmployee())
        <!-- Employee Notice -->
        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 1rem 1.5rem; margin-bottom: 2rem; border-radius: 8px;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-info-circle" style="color: #f59e0b; font-size: 1.25rem;"></i>
                <div>
                    <h4 style="color: #92400e; margin: 0 0 0.25rem 0; font-size: 1rem; font-weight: 600;">{{ __('products.employee_access') }}</h4>
                    <p style="color: #92400e; margin: 0; font-size: 0.875rem;">{{ __('products.employee_access_desc') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="products-stats">
        <div class="products-stat-card">
            <div class="products-stat-header">
                <div class="products-stat-icon">
                    <i class="fas fa-cubes"></i>
                </div>
            </div>
            <div class="products-stat-content">
                <h3>{{ $products->total() }}</h3>
                <p>{{ __('products.total_products') }}</p>
            </div>
        </div>
        
        <div class="products-stat-card">
            <div class="products-stat-header">
                <div class="products-stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="products-stat-content">
                <h3>{{ $products->where('status', 'active')->count() }}</h3>
                <p>{{ __('products.active_products') }}</p>
            </div>
        </div>
        
        <div class="products-stat-card">
            <div class="products-stat-header">
                <div class="products-stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="products-stat-content">
                <h3>{{ $products->where('is_featured', true)->count() }}</h3>
                <p>{{ __('products.featured_products') }}</p>
            </div>
        </div>
        
        <div class="products-stat-card">
            <div class="products-stat-header">
                <div class="products-stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
            <div class="products-stat-content">
                <h3>{{ $categories->count() }}</h3>
                <p>{{ __('products.categories') }}</p>
            </div>
        </div>
    </div>

    <!-- Search and Filter Controls -->
    <div class="products-controls">
        <div class="products-controls-header">
            <i class="fas fa-search"></i>
            <h3>{{ __('products.search_filter_products') }}</h3>
        </div>
        
        <form method="GET" action="{{ route('admin.products.index') }}" id="filterForm">
            <div class="products-filter-grid">
                <div class="products-form-group">
                    <label for="search">{{ __('products.search_products') }}</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           class="products-form-control" 
                           placeholder="{{ __('products.search_placeholder') }}"
                           value="{{ request('search') }}">
                </div>
                
                <div class="products-form-group">
                    <label for="category_filter">{{ __('products.category') }}</label>
                    <select id="category_filter" name="category" class="products-form-control">
                        <option value="">{{ __('products.all_categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="products-form-group">
                    <label for="status_filter">{{ __('products.status') }}</label>
                    <select id="status_filter" name="status" class="products-form-control">
                        <option value="">{{ __('products.all_status') }}</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('products.active') }}</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('products.inactive') }}</option>
                    </select>
                </div>
                
                <button type="submit" class="products-search-btn">
                    <i class="fas fa-search"></i> {{ __('products.search') }}
                </button>
            </div>
        </form>
    </div>

    @if($products->count() > 0)
        <!-- Products Grid -->
        <div class="products-grid">
            @foreach($products as $product)
                <div class="products-card">
                    <!-- Product Image -->
                    <div class="products-image">
                        @if($product->image_url)
                            <div class="product-image-wrapper">
                                <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" class="product-image" loading="lazy">
                            </div>
                        @else
                            <div class="products-image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>{{ __('products.no_image') }}</span>
                            </div>
                        @endif
                        
                        <!-- Status Badges -->
                        <div class="products-status-badges">
                            @if($product->is_featured)
                                <div class="products-status featured">
                                    <i class="fas fa-star"></i>
                                    {{ __('products.featured') }}
                                </div>
                            @endif
                            <div class="products-status {{ $product->is_active ? 'active' : 'inactive' }}">
                                {{ $product->is_active ? __('products.active') : __('products.inactive') }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Content -->
                    <div class="products-content">
                        <h4 class="products-card-title">{{ $product->model_name }}</h4>
                        
                        @if($product->category)
                            <span class="products-category">
                                <i class="fas fa-tag"></i>
                                {{ $product->category->name }}
                            </span>
                        @endif
                        
                        <!-- Product Details -->
                        <div class="products-details">
                            @if($product->line)
                                <div class="products-detail-item">
                                    <i class="fas fa-layer-group"></i>
                                    <span class="products-detail-label">{{ __('products.line') }}:</span>
                                    <span class="products-detail-value">{{ $product->line }}</span>
                                </div>
                            @endif
                            @if($product->type)
                                <div class="products-detail-item">
                                    <i class="fas fa-tools"></i>
                                    <span class="products-detail-label">{{ __('products.type') }}:</span>
                                    <span class="products-detail-value">{{ $product->type }}</span>
                                </div>
                            @endif
                            @if($product->body_weight)
                                <div class="products-detail-item">
                                    <i class="fas fa-weight-hanging"></i>
                                    <span class="products-detail-label">{{ __('products.weight') }}:</span>
                                    <span class="products-detail-value">{{ $product->body_weight }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Product Actions -->
                    <div class="products-actions">
                        <a href="{{ route('admin.products.show', $product) }}" class="products-action-btn view">
                            <i class="fas fa-eye"></i> {{ __('products.view') }}
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="products-action-btn edit">
                            <i class="fas fa-edit"></i> {{ __('products.edit') }}
                        </a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                              style="display: inline; flex: 1;" 
                              onsubmit="return confirm('{{ __('products.delete_confirmation') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="products-action-btn delete" style="width: 100%;">
                                <i class="fas fa-trash"></i> {{ __('products.delete') }}
                            </button>
                        </form>
                    </div>
                    
                    <!-- Product Footer -->
                    <div class="products-footer">
                        <div class="products-created-date">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $product->created_at ? $product->created_at->format('M d, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="products-pagination-wrapper">
                <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <span class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                                {{ __('products.previous') }}
                            </span>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="page-item">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                                {{ __('products.previous') }}
                            </span>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $start = max($products->currentPage() - 2, 1);
                        $end = min($start + 4, $products->lastPage());
                        $start = max($end - 4, 1);
                    @endphp

                    {{-- First page link --}}
                    @if($start > 1)
                        <a href="{{ $products->url(1) }}" class="page-item">
                            <span class="page-link">1</span>
                        </a>
                        @if($start > 2)
                            <span class="page-item disabled">
                                <span class="page-link">...</span>
                            </span>
                        @endif
                    @endif

                    {{-- Page links --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $products->currentPage())
                            <span class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $products->url($page) }}" class="page-item">
                                <span class="page-link">{{ $page }}</span>
                            </a>
                        @endif
                    @endfor

                    {{-- Last page link --}}
                    @if($end < $products->lastPage())
                        @if($end < $products->lastPage() - 1)
                            <span class="page-item disabled">
                                <span class="page-link">...</span>
                            </span>
                        @endif
                        <a href="{{ $products->url($products->lastPage()) }}" class="page-item">
                            <span class="page-link">{{ $products->lastPage() }}</span>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="page-item">
                            <span class="page-link">
                                {{ __('products.next') }}
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </a>
                    @else
                        <span class="page-item disabled">
                            <span class="page-link">
                                {{ __('products.next') }}
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </span>
                    @endif
                </nav>
                
                {{-- Pagination Info --}}
                <div class="pagination-info">
                    {{ __('products.showing_results', ['first' => $products->firstItem(), 'last' => $products->lastItem(), 'total' => $products->total()]) }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="products-empty-state">
            <div class="products-empty-icon">
                <i class="fas fa-cubes"></i>
            </div>
            <h3>{{ __('products.no_products_found') }}</h3>
            <p>{{ __('products.start_building_catalog') }}</p>
            <a href="{{ route('admin.products.create') }}" class="products-add-btn">
                <i class="fas fa-plus"></i>
                {{ __('products.add_first_product') }}
            </a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form on filter change
    const filterForm = document.getElementById('filterForm');
    const filterInputs = filterForm.querySelectorAll('select');
    
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            filterForm.submit();
        });
    });

    // Add loading state to forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.dataset.noLoading) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __('products.processing') }}';
            }
        });
    });

    // Confirmation for delete actions
    document.querySelectorAll('form[method="POST"]').forEach(form => {
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput && methodInput.value === 'DELETE') {
            form.addEventListener('submit', function(e) {
                if (!confirm('{{ __('products.delete_cannot_undone') }}')) {
                    e.preventDefault();
                }
            });
        }
    });

    // Auto-hide alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            if (alert.style) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        });
    }, 5000);
});
</script>
@endsection
