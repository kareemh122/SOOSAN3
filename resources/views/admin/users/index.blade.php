@extends('layouts.admin')

@section('title', __('users.staff_management'))

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
    .user-card {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }
    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border-color: #667eea;
    }
    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        margin-right: 1rem;
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
    .modern-search {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        width: 100%;
    }
    .modern-search:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }
    .modern-select {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }
    .modern-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }
    .badge-modern {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
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
                <h1 class="h2 mb-2">{{ __('users.staff_management') }}</h1>
                <p class="mb-0 opacity-75">{{ __('users.manage_staff') }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.users.create') }}" class="modern-btn">
                    <i class="fas fa-plus"></i>
                    {{ __('users.add_user') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value">{{ $users->total() }}</div>
        <div class="stat-label">{{ __('users.total_staff') }}</div>
    </div>
    <div class="stat-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
        <div class="stat-value">{{ $users->where('is_verified', true)->count() }}</div>
        <div class="stat-label">{{ __('users.verified') }} {{ __('users.staff') }}</div>
    </div>
    <div class="stat-card" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);">
        <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
        <div class="stat-label">{{ __('users.admin') }} {{ __('users.staff') }}</div>
    </div>
    <div class="stat-card" style="background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);">
        <div class="stat-value">{{ $users->where('role', 'employee')->count() }}</div>
        <div class="stat-label">{{ __('users.employee') }} {{ __('users.staff') }}</div>
    </div>
</div>

<!-- Filters -->
<div class="modern-card">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.users.index') }}" id="filterForm">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">{{ __('users.search_staff') }}</label>
                    <input 
                        type="text" 
                        class="modern-search" 
                        id="search" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="{{ __('users.search_placeholder') }}"
                    >
                </div>
                <div class="col-md-3">
                    <label for="role" class="form-label fw-semibold">{{ __('users.role') }}</label>
                    <select class="modern-select" id="role" name="role">
                        <option value="">{{ __('users.all_roles') }}</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>{{ __('users.admin') }}</option>
                        <option value="employee" {{ request('role') === 'employee' ? 'selected' : '' }}>{{ __('users.employee') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="verified" class="form-label fw-semibold">{{ __('users.status') }}</label>
                    <select class="modern-select" id="verified" name="verified">
                        <option value="">{{ __('users.all_statuses') }}</option>
                        <option value="verified" {{ request('verified') === 'verified' ? 'selected' : '' }}>{{ __('users.verified') }}</option>
                        <option value="unverified" {{ request('verified') === 'unverified' ? 'selected' : '' }}>{{ __('users.unverified') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="modern-btn">
                            <i class="fas fa-search"></i> {{ __('users.filter') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Staff Grid -->
<div class="row">
    @forelse($users as $user)
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="user-card">
                <div class="d-flex align-items-start">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-modern bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                {{ $user->role === 'admin' ? __('users.admin') : __('users.employee') }}
                            </span>
                            @if($user->is_verified)
                                <span class="badge badge-modern bg-success">
                                    <i class="fas fa-check me-1"></i>
                                    {{ __('users.verified') }}
                                </span>
                            @else
                                <span class="badge badge-modern bg-warning">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ __('users.unverified') }}
                                </span>
                            @endif
                        </div>
                        
                        <small class="text-muted d-block mb-3">
                            {{ __('users.created') }} {{ $user->created_at ? $user->created_at->diffForHumans() : __('users.na') }}
                        </small>
                        
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.users.show', $user) }}" 
                               class="action-btn border-info text-info" 
                               title="{{ __('users.view') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="action-btn border-warning text-warning" 
                               title="{{ __('users.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="action-btn border-{{ $user->is_verified ? 'secondary' : 'success' }} text-{{ $user->is_verified ? 'secondary' : 'success' }}" 
                                            title="{{ $user->is_verified ? __('users.unverify') : __('users.verify') }}">
                                        <i class="fas fa-{{ $user->is_verified ? 'times' : 'check' }}"></i>
                                    </button>
                                </form>
                                
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="action-btn border-danger text-danger" 
                                            title="{{ __('users.delete') }}" 
                                            onclick="return confirm('{{ __('users.confirm_delete') }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span class="action-btn border-secondary text-secondary" 
                                      title="{{ __('users.cannot_modify_own_account') }}">
                                    <i class="fas fa-lock"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h4>{{ __('users.no_staff_found') }}</h4>
                <p class="mb-4">{{ __('users.no_staff_match_filters') }}</p>
                @if(request()->hasAny(['search', 'role', 'verified']))
                    <a href="{{ route('admin.users.index') }}" class="modern-btn modern-btn-secondary">
                        <i class="fas fa-times"></i>
                        {{ __('users.clear_filters') }}
                    </a>
                @endif
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($users->hasPages())
    <div class="modern-card">
        <div class="card-body text-center">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endif

<!-- Summary -->
<div class="text-center mt-4">
    <small class="text-muted">
        {{ __('users.showing') }} {{ $users->firstItem() ?? 0 }} {{ __('users.to') }} {{ $users->lastItem() ?? 0 }} {{ __('users.of') }} {{ $users->total() }} {{ __('users.staff') }}
    </small>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form on filter change
    const filterForm = document.getElementById('filterForm');
    const filterInputs = filterForm.querySelectorAll('select, input');
    
    filterInputs.forEach(input => {
        if (input.type === 'text') {
            let timeout;
            input.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });
        } else {
            input.addEventListener('change', function() {
                filterForm.submit();
            });
        }
    });
    
    // Add smooth hover effects
    const userCards = document.querySelectorAll('.user-card');
    userCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection
