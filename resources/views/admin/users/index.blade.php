@extends('layouts.admin')

@section('title', __('users.staff_management'))

@push('styles')
<style>
    /* CSS Variables */
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
        --transition-fast: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
        --card-shadow-hover: 0 15px 40px rgba(0,0,0,0.15);
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

    /* Cards */
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
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: var(--transition);
    }

    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-shadow-hover);
    }

    .modern-card:hover::before {
        transform: scaleX(1);
    }

    /* Statistics Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--primary-gradient);
        color: #ffffff;
        padding: 2rem;
        border-radius: var(--border-radius);
        text-align: center;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        transition: var(--transition);
        opacity: 0;
    }

    .stat-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
    }

    .stat-card:hover::before {
        opacity: 1;
        animation: shimmer 1.5s ease-in-out;
    }

    .stat-card.success {
        background: var(--success-gradient);
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
    }

    .stat-card.success:hover {
        box-shadow: 0 20px 40px rgba(40, 167, 69, 0.4);
    }

    .stat-card.danger {
        background: var(--danger-gradient);
        box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
    }

    .stat-card.danger:hover {
        box-shadow: 0 20px 40px rgba(220, 53, 69, 0.4);
    }

    .stat-card.purple {
        background: var(--info-gradient);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
    }

    .stat-card.purple:hover {
        box-shadow: 0 20px 40px rgba(139, 92, 246, 0.4);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .stat-icon {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 2.5rem;
        opacity: 0.2;
    }

    /* User Cards */
    .user-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition);
        margin-bottom: 1.5rem;
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
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: var(--transition);
    }

    .user-card:hover::before {
        transform: scaleX(1);
    }

    .user-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: var(--card-shadow-hover);
        border-color: rgba(102, 126, 234, 0.3);
    }

    .user-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 1.5rem;
        margin-right: 1rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        transition: var(--transition);
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        @if(app()->getLocale() === 'ar')
            margin-left: 20px;
        @else
            margin-right: 20px;
    @endif
    }

    .user-avatar::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
        transform: rotate(45deg);
        transition: var(--transition);
        opacity: 0;
    }

    .user-card:hover .user-avatar {
        transform: scale(1.1) rotate(5deg);
    }

    .user-card:hover .user-avatar::before {
        opacity: 1;
        animation: shimmer 1s ease-in-out;
    }

    /* Buttons */
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

    /* Form Controls */
    .modern-search,
    .modern-select {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #e2e8f0;
        border-radius: var(--border-radius-sm);
        padding: 0.875rem 1rem;
        transition: var(--transition);
        width: 100%;
        backdrop-filter: blur(10px);
        font-size: 0.9rem;
    }

    .modern-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
        padding-right: 2.5rem;
    }

    .modern-search:focus,
    .modern-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 1);
        transform: translateY(-1px);
    }

    /* Badges */
    .badge-modern {
        padding: 0.5rem 0.75rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: var(--transition);
    }

    .badge-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Action Buttons */
    .action-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid;
        background: transparent;
        transition: var(--transition);
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
        transform: scale(0);
        transition: var(--transition);
    }

    .action-btn:hover::before {
        transform: scale(1);
    }

    .action-btn:hover {
        transform: scale(1.1);
        color: white !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state h4 {
        color: #1a202c;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    /* Mobile Responsiveness */
    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }
    }

    @media (max-width: 768px) {
        .modern-page-header {
            padding: 2rem 0;
            margin: -1rem -1rem 1.5rem;
        }

        .modern-page-header .row {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .modern-page-header h1 {
            font-size: 1.5rem;
            justify-content: center;
        }

        .modern-page-header p {
            font-size: 0.95rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-icon {
            font-size: 2rem;
            top: 1rem;
            right: 1rem;
        }

        .user-card {
            padding: 1.25rem;
        }

        .user-card .d-flex {
            flex-direction: column;
            text-align: center;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.25rem;
            margin: 0 auto 1rem;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            font-size: 0.875rem;
            margin: 0.25rem;
        }

        .modern-btn {
            width: 100%;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        /* Mobile text adjustments */
        .mobile-text {
            display: none;
        }

        .mobile-icon {
            display: inline;
        }

        /* Filter form adjustments */
        .filter-form .row > div {
            margin-bottom: 1rem;
        }

        .filter-form .modern-btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .modern-page-header {
            margin: -0.5rem -0.5rem 1rem;
            padding: 1.5rem 0;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .stat-value {
            font-size: 1.75rem;
        }

        .user-card {
            padding: 1rem;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            margin: 0.125rem;
        }

        .modern-search,
        .modern-select {
            padding: 0.75rem 0.875rem;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 375px) {
        .modern-page-header {
            padding: 1rem 0;
        }

        .modern-page-header h1 {
            font-size: 1.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            font-size: 0.9rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }
    }

    /* Animations */
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

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out;
    }

    .animate-stagger {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-stagger:nth-child(1) { animation-delay: 0.1s; }
    .animate-stagger:nth-child(2) { animation-delay: 0.2s; }
    .animate-stagger:nth-child(3) { animation-delay: 0.3s; }
    .animate-stagger:nth-child(4) { animation-delay: 0.4s; }
    .animate-stagger:nth-child(5) { animation-delay: 0.5s; }
    .animate-stagger:nth-child(6) { animation-delay: 0.6s; }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .modern-btn:hover,
        .modern-card:hover,
        .user-card:hover,
        .stat-card:hover,
        .action-btn:hover {
            transform: none;
        }

        .modern-btn:active {
            transform: scale(0.95);
        }

        .user-card:active,
        .stat-card:active {
            transform: scale(0.98);
        }

        .action-btn:active {
            transform: scale(0.9);
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        * {
            transition: none !important;
            animation: none !important;
        }
    }

    /* High contrast mode */
    @media (prefers-contrast: high) {
        .modern-card,
        .user-card {
            border: 2px solid #000;
        }

        .modern-search,
        .modern-select {
            border: 2px solid #000;
        }
    }

    /* Focus indicators for accessibility */
    .modern-search:focus-visible,
    .modern-select:focus-visible,
    .modern-btn:focus-visible,
    .action-btn:focus-visible {
        outline: 2px solid #667eea;
        outline-offset: 2px;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="modern-page-header animate-fade-in-up">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>
                    <i class="fas fa-users"></i>
                    {{ __('users.staff_management') }}
                </h1>
                <p>{{ __('users.manage_staff') }}</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('admin.users.create') }}" class="modern-btn">
                    <i class="fas fa-plus"></i>
                    <span class="mobile-text">{{ __('users.add_user') }}</span>
                    <span class="d-md-none">Add</span>
                </a>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show animate-slide-in-left" role="alert" 
         style="border-radius: var(--border-radius); border: none; box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card animate-stagger">
        <i class="fas fa-users stat-icon"></i>
        <div class="stat-value">{{ $users->total() }}</div>
        <div class="stat-label">{{ __('users.total_staff') }}</div>
    </div>
    <div class="stat-card success animate-stagger">
        <i class="fas fa-check-circle stat-icon"></i>
        <div class="stat-value">{{ $users->where('is_verified', true)->count() }}</div>
        <div class="stat-label">{{ __('users.verified') }} {{ __('users.staff') }}</div>
    </div>
    <div class="stat-card danger animate-stagger">
        <i class="fas fa-user-shield stat-icon"></i>
        <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
        <div class="stat-label">{{ __('users.admin') }} {{ __('users.staff') }}</div>
    </div>
    <div class="stat-card purple animate-stagger">
        <i class="fas fa-user stat-icon"></i>
        <div class="stat-value">{{ $users->where('role', 'employee')->count() }}</div>
        <div class="stat-label">{{ __('users.employee') }} {{ __('users.staff') }}</div>
    </div>
</div>

<!-- Filters -->
<div class="modern-card animate-stagger">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.users.index') }}" id="filterForm" class="filter-form">
            <div class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <label for="search" class="form-label fw-semibold">
                        <i class="fas fa-search me-1 text-muted"></i>
                        {{ __('users.search_staff') }}
                    </label>
                    <input 
                        type="text" 
                        class="modern-search" 
                        id="search" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="{{ __('users.search_placeholder') }}"
                    >
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="role" class="form-label fw-semibold">
                        <i class="fas fa-user-tag me-1 text-muted"></i>
                        {{ __('users.role') }}
                    </label>
                    <select class="modern-select" id="role" name="role">
                        <option value="">{{ __('users.all_roles') }}</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>{{ __('users.admin') }}</option>
                        <option value="employee" {{ request('role') === 'employee' ? 'selected' : '' }}>{{ __('users.employee') }}</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="verified" class="form-label fw-semibold">
                        <i class="fas fa-check-circle me-1 text-muted"></i>
                        {{ __('users.status') }}
                    </label>
                    <select class="modern-select" id="verified" name="verified">
                        <option value="">{{ __('users.all_statuses') }}</option>
                        <option value="verified" {{ request('verified') === 'verified' ? 'selected' : '' }}>{{ __('users.verified') }}</option>
                        <option value="unverified" {{ request('verified') === 'unverified' ? 'selected' : '' }}>{{ __('users.unverified') }}</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="modern-btn">
                            <i class="fas fa-search"></i> 
                            <span class="mobile-text">{{ __('users.filter') }}</span>
                            <span class="d-md-none">{{ __('users.filter') }}</span>
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
        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="user-card animate-stagger">
                <div class="d-flex align-items-start">
                    <div class="user-avatar">
                        @if($user->image_url)
                            <img src="{{ asset($user->image_url) }}" 
                                 alt="{{ $user->name }}" 
                                 style="width: 100%; height: 100%; border-radius: 50%; object-fit: contain;"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="display: none; width: 100%; height: 100%; border-radius: 50%; background: var(--primary-gradient); align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.5rem;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                        <p class="text-muted mb-2 small">
                            <i class="fas fa-envelope me-1"></i>
                            {{ $user->email }}
                        </p>
                        
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
            <div class="empty-state animate-fade-in-up">
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
    <div class="modern-card animate-fade-in-up">
        <div class="card-body text-center p-4">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endif

<!-- Summary -->
<div class="text-center mt-4">
    <small class="text-muted">
        <i class="fas fa-info-circle me-1"></i>
        {{ __('users.showing') }} {{ $users->firstItem() ?? 0 }} {{ __('users.to') }} {{ $users->lastItem() ?? 0 }} {{ __('users.of') }} {{ $users->total() }} {{ __('users.staff') }}
    </small>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form on filter change
    const filterForm = document.getElementById('filterForm');
    const filterInputs = filterForm.querySelectorAll('select');
    
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            setTimeout(() => {
                filterForm.submit();
            }, 200);
        });
    });
    
    // Search input debouncing
    const searchInput = document.getElementById('search');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 2 || this.value.length === 0) {
                    filterForm.submit();
                }
            }, 500);
        });
    }
    
    // Enhanced hover effects
    const userCards = document.querySelectorAll('.user-card');
    userCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Animate elements on load
    const animatedElements = document.querySelectorAll('.animate-stagger');
    animatedElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
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

    // Touch device optimizations
    if ('ontouchstart' in window) {
        document.querySelectorAll('.user-card, .stat-card').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = this.style.transform.replace('scale(1.02)', '') + ' scale(0.98)';
            });
            
            element.addEventListener('touchend', function() {
                this.style.transform = this.style.transform.replace(' scale(0.98)', '');
            });
        });
    }

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe user cards for scroll animations
    document.querySelectorAll('.user-card').forEach(card => {
        observer.observe(card);
    });
});
</script>
@endpush
@endsection