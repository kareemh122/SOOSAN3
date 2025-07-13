@extends('layouts.admin')

@section('title', __('users.staff_management'))

@push('styles')
<style>
    /* Reset and Base Styles */
    .modern-container * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    .modern-container {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1a202c;
        line-height: 1.6;
    }
    .dark-mode .modern-container {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        color: #f7fafc;
    }

    /* Page Header */
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
    .header-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        justify-content: flex-end;
        align-items: center;
    }

    /* Modern Card */
    .modern-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .modern-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .dark-mode .modern-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .stat-card:hover::before {
        left: 100%;
    }
    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px -5px rgba(102, 126, 234, 0.5);
    }
    .stat-card.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
    }
    .stat-card.success:hover {
        box-shadow: 0 20px 40px -5px rgba(16, 185, 129, 0.5);
    }
    .stat-card.danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4);
    }
    .stat-card.danger:hover {
        box-shadow: 0 20px 40px -5px rgba(239, 68, 68, 0.5);
    }
    .stat-card.purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.4);
    }
    .stat-card.purple:hover {
        box-shadow: 0 20px 40px -5px rgba(139, 92, 246, 0.5);
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 500;
    }
    .stat-icon {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        opacity: 0.3;
    }

    /* User Cards */
    .user-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }
    .user-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    .user-card:hover::before {
        transform: scaleX(1);
    }
    .user-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: rgba(102, 126, 234, 0.3);
    }
    .dark-mode .user-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }
    .user-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 1.5rem;
        margin-right: 1rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }
    .user-card:hover .user-avatar {
        transform: scale(1.1) rotate(5deg);
    }

    /* Buttons */
    .modern-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
        box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
        color: #ffffff;
    }
    .modern-btn-secondary {
        background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
    }
    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px -5px rgba(113, 128, 150, 0.4);
    }

    /* Form Controls */
    .modern-search {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        backdrop-filter: blur(5px);
    }
    .modern-search:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 1);
    }
    .dark-mode .modern-search {
        background: rgba(45, 55, 72, 0.9);
        border-color: #4a5568;
        color: #f7fafc;
    }
    .modern-select {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        backdrop-filter: blur(5px);
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
        padding-right: 2.5rem;
    }
    .modern-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 1);
    }
    .dark-mode .modern-select {
        background: rgba(45, 55, 72, 0.9);
        border-color: #4a5568;
        color: #f7fafc;
    }

    /* Badges */
    .badge-modern {
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Action Buttons */
    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid;
        background: transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0 0.25rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 50%;
        background: currentColor;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .action-btn:hover::before {
        opacity: 0.1;
    }
    .action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .action-btn i {
        position: relative;
        z-index: 1;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6b7280;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .dark-mode .empty-state {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
        color: #9ca3af;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        color: #667eea;
    }
    .empty-state h4 {
        color: #1a202c;
        margin-bottom: 0.5rem;
    }
    .dark-mode .empty-state h4 {
        color: #f7fafc;
    }

    .row div {
    }

    .single-card {
        width: 28%;
        margin-right: 10px;
    }
    .single-card:last-child {
        width: fit-content;
    }
     .staff-grid .user-card {
        width: 98%;
        margin-right: 10px;
     }


    /* Responsive Design */
    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .modern-container {
            padding: 0.75rem;
        }
        .modern-page-header {
            margin: -0.75rem -0.75rem 1.5rem;
            padding: 1.5rem 1rem;
        }
        .modern-page-header .row {
            flex-direction: column;
            gap: 1rem;
        }
        .header-actions {
            justify-content: center;
        }
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .stat-card {
            padding: 1.5rem;
        }
        .stat-value {
            font-size: 2rem;
        }
        .user-card {
            padding: 1rem;
        }
        .user-avatar {
            width: 56px;
            height: 56px;
            font-size: 1.25rem;
        }
        .action-btn {
            width: 36px;
            height: 36px;
            font-size: 0.875rem;
        }
        /* Mobile text/icon switching */
        .mobile-text {
            display: none;
        }
        .mobile-icon {
            display: inline;
        }
    }

    @media (max-width: 576px) {
        .modern-page-header h1 {
            font-size: 1.25rem;
        }
        .modern-page-header p {
            font-size: 0.875rem;
        }
        .user-card .d-flex {
            flex-direction: column;
            text-align: center;
        }
        .user-avatar {
            margin: 0 auto 1rem;
        }
        .action-btn {
            margin: 0.25rem;
        }
    }

    /* Animations */
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

    .user-card {
        animation: fadeInUp 0.6s ease forwards;
    }
    .user-card:nth-child(1) { animation-delay: 0.1s; }
    .user-card:nth-child(2) { animation-delay: 0.2s; }
    .user-card:nth-child(3) { animation-delay: 0.3s; }
    .user-card:nth-child(4) { animation-delay: 0.4s; }
    .user-card:nth-child(5) { animation-delay: 0.5s; }
    .user-card:nth-child(6) { animation-delay: 0.6s; }

    /* Focus and accessibility */
    .modern-search:focus,
    .modern-select:focus,
    .modern-btn:focus,
    .action-btn:focus {
        outline: 2px solid #667eea;
        outline-offset: 2px;
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
@endpush

@section('content')
<div class="modern-container">
    <!-- Page Header -->
    <div class="modern-page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1>
                        <i class="fas fa-users"></i>
                        {{ __('users.staff_management') }}
                    </h1>
                    <p>{{ __('users.manage_staff') }}</p>
                </div>
                <div class="col-lg-4">
                    <div class="header-actions">
                        <a href="{{ route('admin.users.create') }}" class="modern-btn">
                            <i class="fas fa-plus"></i>
                            <span class="mobile-text">{{ __('users.add_user') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-users stat-icon"></i>
            <div class="stat-value">{{ $users->total() }}</div>
            <div class="stat-label">{{ __('users.total_staff') }}</div>
        </div>
        <div class="stat-card success">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="stat-value">{{ $users->where('is_verified', true)->count() }}</div>
            <div class="stat-label">{{ __('users.verified') }} {{ __('users.staff') }}</div>
        </div>
        <div class="stat-card danger">
            <i class="fas fa-user-shield stat-icon"></i>
            <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
            <div class="stat-label">{{ __('users.admin') }} {{ __('users.staff') }}</div>
        </div>
        <div class="stat-card purple">
            <i class="fas fa-user stat-icon"></i>
            <div class="stat-value">{{ $users->where('role', 'employee')->count() }}</div>
            <div class="stat-label">{{ __('users.employee') }} {{ __('users.staff') }}</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="modern-card">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('admin.users.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6 single-card">
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
                    <div class="col-lg-3 col-md-6 single-card">
                        <label for="role" class="form-label fw-semibold">{{ __('users.role') }}</label>
                        <select class="modern-select" id="role" name="role">
                            <option value="">{{ __('users.all_roles') }}</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>{{ __('users.admin') }}</option>
                            <option value="employee" {{ request('role') === 'employee' ? 'selected' : '' }}>{{ __('users.employee') }}</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 single-card">
                        <label for="verified" class="form-label fw-semibold">{{ __('users.status') }}</label>
                        <select class="modern-select" id="verified" name="verified">
                            <option value="">{{ __('users.all_statuses') }}</option>
                            <option value="verified" {{ request('verified') === 'verified' ? 'selected' : '' }}>{{ __('users.verified') }}</option>
                            <option value="unverified" {{ request('verified') === 'unverified' ? 'selected' : '' }}>{{ __('users.unverified') }}</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6 single-card">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="modern-btn">
                                <i class="fas fa-search"></i> 
                                <span class="mobile-text">{{ __('users.filter') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Staff Grid -->
    <div class="row staff-grid">
        @forelse($users as $user)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="user-card">
                    <div class="d-flex align-items-start">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                            <p class="text-muted mb-2 small">{{ $user->email }}</p>
                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge badge-modern bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                    <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : 'user' }} me-1"></i>
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
                                <i class="fas fa-calendar me-1"></i>
                                {{ __('users.created') }} {{ $user->created_at ? $user->created_at->diffForHumans() : __('users.na') }}
                            </small>
                            
                            <div class="d-flex justify-content-center flex-wrap">
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
            <div class="card-body text-center p-4">
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
</div>

@push('scripts')
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
    
    // Enhanced hover effects
    const userCards = document.querySelectorAll('.user-card');
    userCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add loading state to forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.dataset.noLoading) {
                submitBtn.disabled = true;
                const originalContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span class="mobile-text">{{ __('users.processing') }}</span>';
                
                // Reset after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalContent;
                }, 5000);
            }
        });
    });

    // Keyboard navigation for cards
    document.querySelectorAll('.user-card').forEach((card, index) => {
        card.setAttribute('tabindex', '0');
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const viewLink = this.querySelector('.action-btn[title*="view"]');
                if (viewLink) {
                    viewLink.click();
                }
            }
        });
    });
});

// Performance optimization: Debounce search input
let searchTimeout;
const searchInput = document.getElementById('search');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // Auto-submit search after 500ms of no typing
            if (this.value.length >= 2 || this.value.length === 0) {
                document.getElementById('filterForm').submit();
            }
        }, 500);
    });
}
</script>
@endpush
@endsection
