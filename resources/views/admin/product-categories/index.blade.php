@extends('layouts.admin')

@section('title', __('product_categories.categories'))
@section('page-title', __('product_categories.categories'))
@section('page-subtitle', __('product_categories.categories_management'))

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        --warning-gradient: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        --danger-gradient: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        --info-gradient: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        --secondary-gradient: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        --border-radius: 1rem;
        --border-radius-sm: 0.5rem;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
        --card-shadow-hover: 0 15px 40px rgba(0,0,0,0.15);
    }

    .modern-page-header {
        background: var(--primary-gradient);
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

    .modern-page-header::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .modern-page-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    
    .modern-page-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2.5rem);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .modern-page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .modern-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: var(--transition);
        position: relative;
    }

    .modern-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        z-index: 0;
    }

    .modern-card > * {
        position: relative;
        z-index: 1;
    }
    
    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-shadow-hover);
    }
    
    .modern-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding: 1.5rem;
    }
    
    .modern-card-title {
        font-weight: 700;
        font-size: clamp(1.1rem, 3vw, 1.4rem);
        color: #2c3e50;
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
    
    /* Enhanced Category Cards */
    .category-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
        position: relative;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category-card:hover::before {
        opacity: 1;
    }
    
    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        border-color: rgba(102, 126, 234, 0.3);
    }
    
    .category-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .category-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .category-card .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .category-card .card-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #2c3e50;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    
    .category-card .card-text {
        font-size: 0.9rem;
        line-height: 1.5;
        color: #6c757d;
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    .category-card .card-text a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }

    .category-card .card-text a:hover {
        color: #764ba2;
        text-decoration: underline;
    }
    
    .category-card .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 20px;
        background: var(--primary-gradient);
        color: white;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        width: fit-content;
    }
    
    .category-card .card-footer {
        background: rgba(248, 249, 250, 0.8);
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1rem 1.5rem;
    }

    .category-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .category-meta small {
        color: #6c757d;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .category-meta small i {
        opacity: 0.7;
    }

    /* Modern Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid;
        background: transparent;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.1;
        transition: all 0.3s ease;
        transform: translate(-50%, -50%);
    }

    .action-btn:hover::before {
        width: 100%;
        height: 100%;
    }

    .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .action-btn.view-btn {
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .action-btn.edit-btn {
        border-color: #f59e0b;
        color: #f59e0b;
    }

    .action-btn.delete-btn {
        border-color: #ef4444;
        color: #ef4444;
    }

    .action-btn:hover {
        color: white;
    }

    .action-btn.view-btn:hover {
        background: #3b82f6;
        border-color: #3b82f6;
    }

    .action-btn.edit-btn:hover {
        background: #f59e0b;
        border-color: #f59e0b;
    }

    .action-btn.delete-btn:hover {
        background: #ef4444;
        border-color: #ef4444;
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1.25rem;
        font-weight: 500;
        position: relative;
        overflow: hidden;
    }

    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        z-index: 0;
    }

    .alert > * {
        position: relative;
        z-index: 1;
    }
    
    .alert-success {
        background: var(--success-gradient);
        color: white;
    }
    
    .alert-info {
        background: var(--info-gradient);
        color: white;
    }
    
    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }
    
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 0.25rem;
        border: 1px solid #e9ecef;
        color: #667eea;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover {
        background: var(--primary-gradient);
        border-color: #667eea;
        color: #ffffff;
        transform: translateY(-1px);
    }
    
    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        border-color: #667eea;
        color: #fff;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .category-card .card-img-top {
            height: 180px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .modern-page-header {
            padding: 1.5rem 1rem;
            margin: -1rem -1rem 1.5rem;
        }
        
        .modern-card-header {
            padding: 1rem;
        }
        
        .modern-card-header .d-flex {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch !important;
        }
        
        .modern-btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            justify-content: center;
        }
        
        .category-card .card-img-top {
            height: 160px;
        }
        
        .category-card .card-body {
            padding: 1rem;
        }

        .category-card .card-footer {
            padding: 0.75rem 1rem;
        }

        .category-meta {
            flex-direction: column;
            gap: 0.5rem;
            text-align: center;
        }
        
        .action-buttons {
            gap: 0.75rem;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 576px) {
        .modern-page-header {
            padding: 1rem 0.5rem;
        }

        .category-card .card-img-top {
            height: 140px;
        }

        .category-card .card-body {
            padding: 0.875rem;
        }

        .category-card .card-footer {
            padding: 0.625rem 0.875rem;
        }

        .category-card .card-title {
            font-size: 1rem;
        }

        .category-card .card-text {
            font-size: 0.85rem;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            font-size: 0.75rem;
        }

        .badge {
            font-size: 0.7rem !important;
            padding: 0.375rem 0.625rem !important;
        }
    }
    
    /* Animation for loading */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .category-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-stagger:nth-child(1) { animation-delay: 0.1s; }
    .animate-stagger:nth-child(2) { animation-delay: 0.2s; }
    .animate-stagger:nth-child(3) { animation-delay: 0.3s; }
    .animate-stagger:nth-child(4) { animation-delay: 0.4s; }
    .animate-stagger:nth-child(5) { animation-delay: 0.5s; }
    .animate-stagger:nth-child(6) { animation-delay: 0.6s; }
    .animate-stagger:nth-child(7) { animation-delay: 0.7s; }
    .animate-stagger:nth-child(8) { animation-delay: 0.8s; }

    /* RTL Support */
    [dir="rtl"] .action-buttons {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .category-meta {
        flex-direction: row-reverse;
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
@endpush

@section('content')
    <div class="modern-page-header">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h1><i class="fas fa-layer-group me-2"></i>{{ __('product_categories.categories') }}</h1>
                    <p class="mb-0">{{ __('product_categories.categories_management') }}</p>
                </div>
                <a href="{{ route('admin.product-categories.create') }}" class="modern-btn">
                    <i class="fas fa-plus"></i>
                    <span>{{ __('product_categories.add_category') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="modern-card">
        <div class="modern-card-header">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <h5 class="modern-card-title mb-0">
                    <i class="fas fa-list-ul"></i>
                    {{ __('product_categories.categories') }}
                </h5>
            </div>
        </div>
        <div class="card-body p-3 p-md-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('global.close') }}"></button>
                </div>
            @endif

            <div class="row g-3 g-md-4">
                @forelse($categories as $category)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="category-card h-100 animate-stagger">
                            <a href="{{ route('admin.product-categories.show', $category) }}" class="text-decoration-none">
                                @php $iconUrl = $category->icon_url; @endphp
                                <img src="{{ $iconUrl && $iconUrl !== '' ? asset($iconUrl) : 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=400' }}"
                                     class="card-img-top"
                                     alt="{{ $category->name }}"
                                     loading="lazy"
                                     onerror="this.onerror=null;this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=400';">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="card-text">
                                    @if($category->parent)
                                        <i class="fas fa-sitemap me-1"></i>
                                        <span class="d-none d-md-inline">{{ __('product_categories.parent_category') }}:</span>
                                        <a href="{{ route('admin.product-categories.show', $category->parent_id) }}" class="text-decoration-none">{{ $category->parent->name }}</a>
                                    @else
                                        <i class="fas fa-crown me-1"></i>
                                        <span class="d-none d-md-inline">{{ __('product_categories.parent_category') }}:</span>
                                        {{ __('product_categories.none') }}
                                    @endif
                                </p>
                                <div class="mt-auto">
                                    <span class="badge">
                                        <i class="fas fa-box me-1"></i>
                                        {{ $category->products_count }}
                                        <span class="d-none d-sm-inline">{{ __('product_categories.products_count') }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.product-categories.show', $category) }}" 
                                       class="action-btn view-btn" 
                                       title="{{ __('users.view') }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.product-categories.edit', $category) }}" 
                                       class="action-btn edit-btn"
                                       title="{{ __('users.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.product-categories.destroy', $category) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('{{ __('product_categories.confirm_delete') }}');" 
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-btn delete-btn"
                                                title="{{ __('users.delete') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ __('product_categories.no_categories') }}
                        </div>
                    </div>
                @endforelse
            </div>

            @if($categories->hasPages())
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add staggered animation to category cards
    const cards = document.querySelectorAll('.category-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
    
    // Enhanced hover effects for action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Touch device optimizations
    if ('ontouchstart' in window) {
        actionButtons.forEach(btn => {
            btn.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.95)';
            });
            
            btn.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
    }
});
</script>
@endpush