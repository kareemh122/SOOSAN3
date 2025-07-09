@extends('layouts.admin')

@section('title', 'Product Categories')

@section('content')
<style>
    .modern-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
        margin: -2rem -2rem 2rem;
        border-radius: 0 0 1rem 1rem;
        position: relative;
        overflow: hidden;
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
    }
    .modern-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 2rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }
    .category-card {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        height: 100%;
    }
    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border-color: #667eea;
    }
    .category-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin: 0 auto 1rem;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    .modern-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .modern-btn-secondary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        border: 1px solid #dee2e6;
    }
    .modern-btn-secondary:hover {
        color: #495057;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        margin: 0 0.25rem;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    .badge-modern {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>

<!-- Page Header -->
<div class="modern-page-header">
    <div class="container-fluid position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">Product Categories</h1>
                <p class="mb-0 opacity-75">Organize and manage your product categories</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.product-categories.create') }}" class="modern-btn">
                    <i class="fas fa-plus"></i>
                    Add New Category
                </a>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 1rem; border: none; box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value">{{ $categories->total() }}</div>
        <div class="stat-label">Total Categories</div>
    </div>
    <div class="stat-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
        <div class="stat-value">{{ $categories->sum('products_count') ?? 0 }}</div>
        <div class="stat-label">Total Products</div>
    </div>
    <div class="stat-card" style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);">
        <div class="stat-value">{{ $categories->where('products_count', '>', 0)->count() }}</div>
        <div class="stat-label">Active Categories</div>
    </div>
    <div class="stat-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
        <div class="stat-value">{{ $categories->where('products_count', 0)->count() }}</div>
        <div class="stat-label">Empty Categories</div>
    </div>
</div>

<!-- Categories Grid -->
<div class="row">
    @forelse($categories as $category)
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-folder"></i>
                </div>
                
                <div class="text-center">
                    <h5 class="mb-2">{{ $category->name }}</h5>
                    <p class="text-muted mb-3">
                        {{ $category->description ? Str::limit($category->description, 80) : 'No description available' }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge badge-modern bg-{{ $category->products_count > 0 ? 'success' : 'warning' }}">
                            {{ $category->products_count ?? 0 }} 
                            {{ ($category->products_count ?? 0) === 1 ? 'Product' : 'Products' }}
                        </span>
                    </div>
                    
                    <small class="text-muted d-block mb-3">
                        Created {{ $category->created_at ? $category->created_at->diffForHumans() : 'N/A' }}
                    </small>
                    
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.product-categories.show', $category) }}" 
                           class="action-btn border-info text-info" 
                           title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.product-categories.edit', $category) }}" 
                           class="action-btn border-warning text-warning" 
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.product-categories.destroy', $category) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="action-btn border-danger text-danger" 
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <h4>No categories found</h4>
                <p class="mb-4">Start organizing your products by creating your first category.</p>
                <a href="{{ route('admin.product-categories.create') }}" class="modern-btn">
                    <i class="fas fa-plus"></i>
                    Create First Category
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($categories->hasPages())
    <div class="modern-card">
        <div class="card-body text-center">
            {{ $categories->links() }}
        </div>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth hover effects
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animate stat cards on load
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection
