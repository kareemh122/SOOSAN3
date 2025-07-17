@extends('layouts.admin')

@section('title', __('audit-logs.header.dashboard_btn'))

@push('styles')
<style>
    /* Modern Container */
    .modern-dashboard-container {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1a202c;
        line-height: 1.6;
    }
    .dark-mode .modern-dashboard-container {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        color: #f7fafc;
    }

    /* Modern Page Header */
    .modern-dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-dashboard-header::before {
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
    .modern-dashboard-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    .modern-dashboard-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Modern Cards */
    .modern-dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 94%;
    }
    .modern-dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .dark-mode .modern-dashboard-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }

    /* Modern Button */
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
        text-decoration: none;
    }

    /* Stats Cards */
    .modern-stats-cards {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .modern-stats-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .modern-stats-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .dark-mode .modern-stats-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }
    .modern-stats-card.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
    }
    .modern-stats-card.info {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #ffffff;
    }
    .modern-stats-card.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
    }
    .modern-stats-card .fs-2 {
        font-size: 2rem !important;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .modern-stats-card .small {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    /* Chart Container */
    .modern-chart-container {
        position: relative;
        height: 300px;
        padding: 1rem;
    }
    .modern-chart-container canvas {
        border-radius: 8px;
    }

    /* Table Enhancements */
    .modern-table-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .modern-table {
        margin-bottom: 0;
    }
    .modern-table thead th {
        background: rgba(248, 250, 252, 0.8);
        color: #374151;
        border: none;
        padding: 1rem 0.75rem;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .dark-mode .modern-table thead th {
        background: rgba(45, 55, 72, 0.8);
        color: #f7fafc;
    }
    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
    }
    .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
    }
    .dark-mode .modern-table tbody tr {
        border-bottom-color: rgba(74, 85, 104, 0.5);
    }
    .dark-mode .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.1);
    }
    .modern-table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
    }

    /* Progress Bar */
    .modern-progress {
        height: 20px;
        border-radius: 10px;
        background: rgba(226, 232, 240, 0.5);
        overflow: hidden;
        position: relative;
    }
    .dark-mode .modern-progress {
        background: rgba(74, 85, 104, 0.5);
    }
    .modern-progress-bar {
        height: 100%;
        border-radius: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: width 0.6s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }
    .modern-progress-bar.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .modern-progress-bar::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }

    /* Avatar Enhancements */
    .modern-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        margin-right: 0.75rem;
        transition: transform 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .modern-avatar:hover {
        transform: scale(1.1);
    }
    .modern-avatar.bg-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
    }

    /* Badge Enhancements */
    .modern-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        transition: all 0.3s ease;
    }
    .modern-badge:hover {
        transform: scale(1.05);
    }
    .modern-badge.bg-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
    }
    .modern-badge.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
    }
    .modern-badge.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
    }
    .modern-badge.bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
    }
    .modern-badge.bg-light {
        background: rgba(248, 250, 252, 0.8);
        color: #374151;
        border: 1px solid rgba(226, 232, 240, 0.5);
    }

    /* Animations */
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

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
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .modern-stats-cards {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .modern-dashboard-container {
            padding: 0.75rem;
        }
        .modern-dashboard-header {
            margin: -0.75rem -0.75rem 1.5rem;
            padding: 1.5rem 1rem;
        }
        .modern-dashboard-header h1 {
            font-size: 1.25rem;
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }
        .modern-btn {
            width: 100%;
            justify-content: center;
            padding: 0.875rem 1rem;
        }
        .modern-stats-cards {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .modern-stats-card {
            padding: 1rem;
        }
        .modern-stats-card .fs-2 {
            font-size: 1.5rem !important;
        }
        
        /* Chart responsiveness */
        .modern-chart-container {
            height: 250px;
            padding: 0.5rem;
        }
        
        /* Table responsiveness */
        .modern-table {
            font-size: 0.875rem;
        }
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.75rem 0.5rem;
        }
        
        /* Hide text on mobile, show icons */
        .mobile-hide-text {
            display: none;
        }
        
        /* Stack user info vertically on mobile */
        .user-info-mobile {
            flex-direction: column;
            align-items: flex-start !important;
        }
        .user-info-mobile .modern-avatar {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .modern-dashboard-header h1 {
            font-size: 1.125rem;
        }
        .modern-stats-card .fs-2 {
            font-size: 1.25rem !important;
        }
        .modern-btn {
            padding: 0.75rem;
            font-size: 0.75rem;
        }
        
        /* Ultra mobile optimizations */
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.5rem 0.25rem;
            font-size: 0.75rem;
        }
        
        /* Collapse some columns on very small screens */
        .mobile-collapse {
            display: none;
        }
        
        /* Chart mobile optimization */
        .modern-chart-container {
            height: 200px;
        }
    }

    /* Large screens optimization */
    @media (min-width: 1200px) {
        .modern-stats-cards {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Focus and accessibility */
    .modern-btn:focus {
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
<div class="modern-dashboard-container">
    <!-- Modern Header -->
    <div class="modern-dashboard-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h1>
                    <i class="fas fa-chart-bar"></i>
                    {{ __('audit-logs.header.dashboard_btn') }}
                </h1>
                <a href="{{ route('admin.audit-logs.index') }}" class="modern-btn">
                    <i class="fas fa-list"></i>
                    <span class="mobile-text-full">{{ __('audit-logs.header.title') }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Activity Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="modern-dashboard-card fade-in-up">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-chart-line text-primary"></i>
                        {{ __('audit-logs.dashboard.daily_activity', [], app()->getLocale()) }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="modern-chart-container">
                        <canvas id="dailyActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="modern-dashboard-card fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-chart-pie text-primary"></i>
                        {{ __('audit-logs.dashboard.event_types', [], app()->getLocale()) }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="modern-chart-container">
                        <canvas id="eventTypesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="modern-dashboard-card fade-in-up" style="animation-delay: 0.2s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-database text-primary"></i>
                        {{ __('audit-logs.dashboard.most_active_models', [], app()->getLocale()) }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive modern-table-container">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fas fa-cube me-2"></i>
                                        {{ __('audit-logs.dashboard.model', [], app()->getLocale()) }}
                                    </th>
                                    <th class="mobile-collapse">
                                        <i class="fas fa-hashtag me-2"></i>
                                        {{ __('audit-logs.dashboard.activity_count', [], app()->getLocale()) }}
                                    </th>
                                    <th>
                                        <i class="fas fa-chart-bar me-2"></i>
                                        {{ __('audit-logs.dashboard.percentage', [], app()->getLocale()) }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalModelActivity = $modelStats->sum('count'); @endphp
                                @foreach($modelStats as $stat)
                                    <tr>
                                        <td>
                                            <strong>{{ class_basename($stat->auditable_type) }}</strong>
                                        </td>
                                        <td class="mobile-collapse">{{ number_format($stat->count) }}</td>
                                        <td>
                                            @php $percentage = $totalModelActivity > 0 ? ($stat->count / $totalModelActivity) * 100 : 0; @endphp
                                            <div class="modern-progress">
                                                <div class="modern-progress-bar" style="width: {{ $percentage }}%">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="modern-dashboard-card fade-in-up" style="animation-delay: 0.3s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-users text-primary"></i>
                        {{ __('audit-logs.dashboard.most_active_users', [], app()->getLocale()) }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive modern-table-container">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fas fa-user me-2"></i>
                                        {{ __('audit-logs.dashboard.user', [], app()->getLocale()) }}
                                    </th>
                                    <th class="mobile-collapse">
                                        <i class="fas fa-hashtag me-2"></i>
                                        {{ __('audit-logs.dashboard.activity_count', [], app()->getLocale()) }}
                                    </th>
                                    <th>
                                        <i class="fas fa-chart-bar me-2"></i>
                                        {{ __('audit-logs.dashboard.percentage', [], app()->getLocale()) }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalUserActivity = $activeUsers->sum('count'); @endphp
                                @foreach($activeUsers as $userStat)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center user-info-mobile">
                                                @php $userImg = $userStat->user->image_url; @endphp
                                                @if($userImg)
                                                    <img src="{{ asset($userImg) }}" alt="{{ $userStat->user->name }}" class="modern-avatar">
                                                @else
                                                    <div class="modern-avatar bg-primary">
                                                        {{ substr($userStat->user->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <strong>{{ $userStat->user->name }}</strong>
                                            </div>
                                        </td>
                                        <td class="mobile-collapse">{{ number_format($userStat->count) }}</td>
                                        <td>
                                            @php $percentage = $totalUserActivity > 0 ? ($userStat->count / $totalUserActivity) * 100 : 0; @endphp
                                            <div class="modern-progress">
                                                <div class="modern-progress-bar bg-success" style="width: {{ $percentage }}%">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra Stats & Graphs Row -->
    <div class="row mb-4">
        <div class="col-lg-3">
            <div class="modern-stats-cards">
                <div class="modern-stats-card primary fade-in-up" style="animation-delay: 0.4s;">
                    <div class="fs-2">{{ number_format($totalLogs) }}</div>
                    <div class="small">{{ __('audit-logs.dashboard.total_logs', [], app()->getLocale()) }}</div>
                </div>
                <div class="modern-stats-card info fade-in-up" style="animation-delay: 0.5s;">
                    <div class="fs-2">{{ number_format($uniqueUsers) }}</div>
                    <div class="small">{{ __('audit-logs.dashboard.unique_users', [], app()->getLocale()) }}</div>
                </div>
                <div class="modern-stats-card success fade-in-up" style="animation-delay: 0.6s;">
                    <div class="fs-5">{{ __('audit-logs.dashboard.most_active_day', [], app()->getLocale()) }}</div>
                    <div class="fw-bold">{{ $mostActiveDay['date'] ?? '-' }}</div>
                    <div class="small">{{ $mostActiveDay['count'] ?? '-' }} {{ __('audit-logs.dashboard.logs', [], app()->getLocale()) }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="modern-dashboard-card fade-in-up" style="animation-delay: 0.7s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-chart-bar text-primary"></i>
                        {{ __('audit-logs.dashboard.monthly_activity', [], app()->getLocale()) }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="modern-chart-container">
                        <canvas id="monthlyActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="modern-dashboard-card fade-in-up" style="animation-delay: 0.8s;">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-clock text-primary"></i>
                        {{ __('audit-logs.dashboard.recent_activity', [], app()->getLocale()) }}
                    </h5>
                    <span class="modern-badge bg-primary">{{ $recentLogs->count() }} {{ __('audit-logs.dashboard.latest_entries', [], app()->getLocale()) }}</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive modern-table-container">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th>{{ __('audit-logs.table.columns.time') }}</th>
                                    <th>{{ __('audit-logs.table.columns.user') }}</th>
                                    <th>{{ __('audit-logs.table.columns.event') }}</th>
                                    <th class="mobile-collapse">{{ __('audit-logs.table.columns.model') }}</th>
                                    <th class="mobile-collapse">{{ __('audit-logs.dashboard.summary', [], app()->getLocale()) }}</th>
                                    <th>{{ __('audit-logs.table.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLogs as $log)
                                    <tr>
                                        <td>
                                            <span class="text-muted small">{{ $log->created_at->locale(app()->getLocale())->translatedFormat('H:i:s') }}</span>
                                            <br>
                                            <small class="text-muted">{{ $log->created_at->locale(app()->getLocale())->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            @if($log->user)
                                                <div class="d-flex align-items-center user-info-mobile">
                                                    @php $userImg = $log->user->image_url; @endphp
                                                    @if($userImg)
                                                        <img src="{{ asset($userImg) }}" alt="{{ $log->user->name }}" class="modern-avatar">
                                                    @else
                                                        <div class="modern-avatar bg-primary">
                                                            {{ substr($log->user->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-bold small">{{ $log->user->name }}</div>
                                                        <small class="text-muted">{{ ucfirst($log->user->role) }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">{{ __('audit-logs.table.system') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $eventColors = [
                                                    'created' => 'success',
                                                    'updated' => 'warning',
                                                    'deleted' => 'danger',
                                                    'restored' => 'info'
                                                ];
                                                $color = $eventColors[$log->event] ?? 'secondary';
                                            @endphp
                                            <span class="modern-badge bg-{{ $color }}">
                                                <i class="fas fa-{{ $log->event == 'created' ? 'plus' : ($log->event == 'updated' ? 'edit' : ($log->event == 'deleted' ? 'trash' : 'undo')) }}"></i>
                                                <span class="mobile-hide-text">{{ __('audit-logs.table.events.' . $log->event, [], app()->getLocale()) }}</span>
                                            </span>
                                        </td>
                                        <td class="mobile-collapse">
                                            <div>
                                                <span class="fw-bold">{{ class_basename($log->auditable_type) }}</span>
                                                <small class="text-muted d-block">ID: {{ $log->auditable_id }}</small>
                                            </div>
                                        </td>
                                        <td class="mobile-collapse">
                                            @if($log->new_values && count($log->new_values) > 0)
                                                @php
                                                    $changedFields = collect($log->new_values)->keys()->take(3);
                                                @endphp
                                                <small class="text-muted">
                                                    {{ __('audit-logs.dashboard.changed', [], app()->getLocale()) }}: {{ $changedFields->implode(', ') }}
                                                    @if(count($log->new_values) > 3)
                                                        <span class="modern-badge bg-light">+{{ count($log->new_values) - 3 }} {{ __('audit-logs.dashboard.more', [], app()->getLocale()) }}</span>
                                                    @endif
                                                </small>
                                            @else
                                                <small class="text-muted">{{ __('audit-logs.table.events.' . $log->event, [], app()->getLocale()) }} {{ class_basename($log->auditable_type) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.audit-logs.show', $log) }}" class="modern-btn btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center" style="background: rgba(248, 250, 252, 0.8); border-top: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <a href="{{ route('admin.audit-logs.index') }}" class="modern-btn">
                        <i class="fas fa-list me-2"></i>
                        {{ __('audit-logs.dashboard.view_all_activity_logs', [], app()->getLocale()) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart.js default configuration
Chart.defaults.font.family = "'Inter', 'Segoe UI', system-ui, sans-serif";
Chart.defaults.color = '#6b7280';
Chart.defaults.borderColor = 'rgba(226, 232, 240, 0.5)';

// Daily Activity Chart
const dailyActivityCtx = document.getElementById('dailyActivityChart').getContext('2d');
const dailyActivityChart = new Chart(dailyActivityCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($dailyActivity->pluck('date')) !!},
        datasets: [{
            label: 'Activity Count',
            data: {!! json_encode($dailyActivity->pluck('count')) !!},
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#667eea',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                borderColor: '#667eea',
                borderWidth: 1,
                cornerRadius: 8
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#6b7280'
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(226, 232, 240, 0.5)'
                },
                ticks: {
                    color: '#6b7280'
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});

// Event Types Chart
const eventTypesCtx = document.getElementById('eventTypesChart').getContext('2d');
const eventTypesChart = new Chart(eventTypesCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($eventStats->pluck('event')->map(function($event) { return ucfirst($event); })) !!},
        datasets: [{
            data: {!! json_encode($eventStats->pluck('count')) !!},
            backgroundColor: [
                '#10b981', // created - green
                '#f59e0b', // updated - yellow
                '#ef4444', // deleted - red
                '#3b82f6', // restored - blue
                '#8b5cf6', // other - purple
                '#f97316'  // other - orange
            ],
            borderWidth: 2,
            borderColor: '#ffffff',
            hoverBorderWidth: 3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                borderColor: '#667eea',
                borderWidth: 1,
                cornerRadius: 8
            }
        },
        cutout: '60%'
    }
});

// Monthly Activity Chart
const monthlyActivityCtx = document.getElementById('monthlyActivityChart').getContext('2d');
const monthlyActivityChart = new Chart(monthlyActivityCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($monthlyActivity->pluck('month')) !!},
        datasets: [{
            label: 'Logs',
            data: {!! json_encode($monthlyActivity->pluck('count')) !!},
            backgroundColor: 'rgba(102, 126, 234, 0.8)',
            borderColor: '#667eea',
            borderWidth: 1,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { 
                display: false 
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                borderColor: '#667eea',
                borderWidth: 1,
                cornerRadius: 8
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#6b7280'
                }
            },
            y: { 
                beginAtZero: true,
                grid: {
                    color: 'rgba(226, 232, 240, 0.5)'
                },
                ticks: {
                    color: '#6b7280'
                }
            }
        }
    }
});

// Add loading animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate progress bars
    setTimeout(() => {
        document.querySelectorAll('.modern-progress-bar').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    }, 500);

    // Add fade-in animation to table rows
    document.querySelectorAll('.modern-table tbody tr').forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        setTimeout(() => {
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50 + 1000);
    });

    // Add hover effects to cards
    document.querySelectorAll('.modern-dashboard-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection