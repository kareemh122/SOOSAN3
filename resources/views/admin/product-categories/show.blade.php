@extends('layouts.admin')

@section('title', __('product_categories.view_category'))
@section('page-title', __('product_categories.view_category') . ': ' . $category->name)

@push('styles')
<style>
    .modern-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .modern-page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,197.3C960,213,1056,203,1152,170.7C1248,139,1344,85,1392,58.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        z-index: 0;
    }
    .modern-page-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    
    .modern-page-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .modern-page-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .modern-card {
        background: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        border: 1px solid #E9ECEF;
        margin-bottom: 2rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }
    
    .modern-card-header {
        background: linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 100%);
        border-bottom: 1px solid #E9ECEF;
        padding: 1.5rem;
    }
    
    .modern-card-title {
        font-weight: 700;
        font-size: clamp(1.1rem, 3vw, 1.3rem);
        color: #2C3E50;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .modern-btn {
        background: var(--primary-gradient);
        border: none;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .modern-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .modern-btn:hover::before {
        left: 100%;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: #ffffff;
        text-decoration: none;
    }

    .modern-btn:active {
        transform: translateY(-1px);
    }

    .modern-btn-secondary {
        background: var(--secondary-gradient);
    }

    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px rgba(113, 128, 150, 0.4);
    }
    
    .category-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .category-image:hover {
        transform: scale(1.02);
    }
    
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .info-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #F1F3F4;
        transition: background-color 0.2s ease;
    }
    
    .info-list-item:hover {
        background-color: #F8F9FA;
    }
    
    .info-list-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #2C3E50;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .info-value {
        font-weight: 500;
        color: #6C757D;
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 0.5rem 0.75rem;
        border-radius: 50px;
        font-weight: 600;
    }
    
    .badge-primary {
        background: linear-gradient(135deg, #0077C8 0%, #005B99 100%);
        color: #FFFFFF;
    }
    
    .badge-secondary {
        background: linear-gradient(135deg, #6C757D 0%, #5A6268 100%);
        color: #FFFFFF;
    }
    
    .badge-info {
        background: linear-gradient(135deg, #17A2B8 0%, #138496 100%);
        color: #FFFFFF;
        text-decoration: none;
        transition: transform 0.2s ease;
    }
    
    .badge-info:hover {
        color: #FFFFFF;
        transform: translateY(-1px);
    }
    
    .sub-category-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 1px solid #E9ECEF;
        border-radius: 12px;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        background: #FFFFFF;
    }
    
    .sub-category-item:hover {
        border-color: #0077C8;
        box-shadow: 0 4px 16px rgba(0, 119, 200, 0.15);
        transform: translateY(-2px);
        color: inherit;
        text-decoration: none;
    }
    
    .sub-category-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 1rem;
        border: 2px solid #E9ECEF;
        transition: border-color 0.3s ease;
    }
    
    .sub-category-item:hover .sub-category-icon {
        border-color: #0077C8;
    }
    
    .sub-category-name {
        flex-grow: 1;
        font-weight: 600;
        color: #2C3E50;
        margin: 0;
    }
    
    .sub-category-count {
        background: linear-gradient(135deg, #0077C8 0%, #005B99 100%);
        color: #FFFFFF;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #CCE7FF 0%, #B3D9FF 100%);
        color: #0C5460;
    }
    
    .breadcrumb-nav {
        background: transparent;
        padding: 0;
        margin-bottom: 1rem;
    }
    
    .breadcrumb-nav .breadcrumb-item a {
        color: #F0F0F0;
        text-decoration: none;
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }
    
    .breadcrumb-nav .breadcrumb-item a:hover {
        opacity: 1;
    }
    
    .breadcrumb-nav .breadcrumb-item.active {
        color: #F0F0F0;
        font-weight: 500;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #FFC107 0%, #E0A800 100%);
        border: none;
        color: #212529;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(255, 193, 7, 0.3);
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #E0A800 0%, #D39E00 100%);
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .modern-page-header {
            padding: 1.5rem 0;
            margin: -1rem -1rem 1.5rem;
        }
        
        .modern-page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch !important;
        }
        
        .modern-card-header {
            padding: 1rem;
        }
        
        .modern-btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            justify-content: center;
        }
        
        .category-image {
            max-height: 200px;
        }
        
        .info-list-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
            padding: 0.75rem;
        }
        
        .info-label, .info-value {
            width: 100%;
        }
        
        .sub-category-item {
            padding: 0.75rem;
        }
        
        .sub-category-icon {
            width: 35px;
            height: 35px;
            margin-right: 0.75rem;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .action-buttons .btn {
            flex: 1;
            min-width: 120px;
        }
    }
    
    @media (max-width: 576px) {
        .modern-page-header h1 {
            font-size: 1.2rem;
            line-height: 1.3;
        }
        
        .modern-card {
            margin-bottom: 1.5rem;
        }
        
        .modern-card-header {
            padding: 0.75rem;
        }
        
        .card-body {
            padding: 1rem !important;
        }
        
        .category-image {
            max-height: 180px;
        }
        
        .sub-category-item {
            padding: 0.5rem;
        }
        
        .sub-category-icon {
            width: 30px;
            height: 30px;
            margin-right: 0.5rem;
        }
        
        .sub-category-name {
            font-size: 0.9rem;
        }
        
        .action-buttons .btn {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }
    }
    
    /* Tablet Responsiveness */
    @media (min-width: 768px) and (max-width: 1024px) {
        .modern-page-header h1 {
            font-size: 1.6rem;
        }
        
        .category-image {
            max-height: 250px;
        }
    }
    
    /* Animation */
    .modern-card {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .sub-category-item {
        animation: slideInLeft 0.4s ease-out;
    }
    
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
@endpush

@section('content')
<div class="modern-page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div class="flex-grow-1">
                <h1>
                    <i class="fas fa-eye me-2"></i>
                    <span class="d-none d-md-inline">{{ __('product_categories.view_category') }}:</span>
                    {{ __('product_categories.hydraulic_breakers') }}
                </h1>
            </div>
            <a href="{{ route('admin.product-categories.index') }}" class="modern-btn">
                <i class="fas fa-arrow-left"></i>
                <span class="d-none d-sm-inline">{{ __('product_categories.categories') }}</span>
                <span class="d-sm-none">{{ __('product_categories.back') }}</span>
            </a>
        </div>
    </div>
</div>

<div class="row g-3 g-md-4">
    <!-- Category Details Column -->
    <div class="col-lg-5">
        <div class="modern-card">
            <div class="modern-card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <h5 class="modern-card-title mb-0">
                    <i class="fas fa-info-circle"></i>
                    {{ $category->name }}
                </h5>
            </div>
            <div class="card-body p-3 p-md-4">
                <div class="text-center mb-4">
                    <img src="{{ $category->icon_url ?: 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=400' }}" 
                         alt="{{ $category->name }}" 
                         class="category-image"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=400';">
                </div>
                
                @if($category->description)
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-align-left me-1"></i>
                            {{ __('product_categories.description') }}
                        </h6>
                        <p class="text-muted">{{ $category->description }}</p>
                    </div>
                @endif
                
                <ul class="info-list">
                    <li class="info-list-item">
                        <span class="info-label">
                            <i class="fas fa-link"></i>
                            {{ __('product_categories.slug') }}
                        </span>
                        <span class="badge badge-secondary">{{ $category->slug }}</span>
                    </li>
                    <li class="info-list-item">
                        <span class="info-label">
                            <i class="fas fa-sitemap"></i>
                            {{ __('product_categories.parent_category') }}
                        </span>
                        @if($category->parent)
                            <a href="{{ route('admin.product-categories.show', $category->parent_id) }}" 
                               class="badge badge-info">
                                {{ $category->parent->name }}
                            </a>
                        @else
                            <span class="info-value">{{ __('product_categories.none') }}</span>
                        @endif
                    </li>
                    <li class="info-list-item">
                        <span class="info-label">
                            <i class="fas fa-box"></i>
                            {{ __('product_categories.products_count') }}
                        </span>
                        <span class="badge badge-primary">{{ $category->products_count }}</span>
                    </li>
                    <li class="info-list-item">
                        <span class="info-label">
                            <i class="fas fa-calendar-plus"></i>
                            <span class="d-none d-sm-inline">{{ __('product_categories.created_at') }}</span>
                            <span class="d-sm-none">{{ __('product_categories.created_at') }}</span>
                        </span>
                        <span class="info-value">{{ optional($category->created_at)->format('d M, Y') }}</span>
                    </li>
                    <li class="info-list-item">
                        <span class="info-label">
                            <i class="fas fa-calendar-edit"></i>
                            <span class="d-none d-sm-inline">{{ __('product_categories.updated_at') }}</span>
                            <span class="d-sm-none">{{ __('product_categories.updated_at') }}</span>
                        </span>
                        <span class="info-value">{{ optional($category->updated_at)->format('d M, Y') }}</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer text-center bg-white border-top-0 p-3 p-md-4">
                <div class="action-buttons">
                    <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>
                        <span class="d-none d-sm-inline">{{ __('product_categories.edit_category') }}</span>
                        <span class="d-sm-none">{{ __('product_categories.edit_category') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub-categories Column -->
    <div class="col-lg-7">
        <div class="modern-card">
            <div class="modern-card-header">
                <h6 class="modern-card-title mb-0">
                    <i class="fas fa-sitemap"></i>
                    {{ __('product_categories.sub_categories') }}
                    @if(optional($category->children)->count() > 0)
                        <span class="badge badge-primary ms-2">{{ $category->children->count() }}</span>
                    @endif
                </h6>
            </div>
            <div class="card-body p-3 p-md-4">
                @if(optional($category->children)->count() > 0)
                    <div class="sub-categories-list">
                        @foreach($category->children as $index => $child)
                            <a href="{{ route('admin.product-categories.show', $child) }}" 
                               class="sub-category-item"
                               style="animation-delay: {{ $index * 0.1 }}s">
                                <img src="{{ $child->icon_url ?: 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=80' }}" 
                                     class="sub-category-icon" 
                                     alt="{{ $child->name }}"
                                     loading="lazy"
                                     onerror="this.onerror=null;this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=80';">
                                <div class="flex-grow-1">
                                    <h6 class="sub-category-name">{{ $child->name }}</h6>
                                    @if($child->description)
                                        <p class="text-muted small mb-0 d-none d-md-block">{{ Str::limit($child->description, 60) }}</p>
                                    @endif
                                </div>
                                <span class="sub-category-count">{{ $child->products_count }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info text-center mb-0">
                        <i class="fas fa-info-circle"></i>
                        {{ __('product_categories.no_sub_categories') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add staggered animation to sub-category items
        const subCategoryItems = document.querySelectorAll('.sub-category-item');
        subCategoryItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
    
        
        // Add smooth scroll behavior for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endpush