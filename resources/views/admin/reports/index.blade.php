@extends('layouts.admin')

@section('title', __('reports.financial_reports'))

@push('styles')
<style>
    /* Reset and Base Styles */
    .modern-reports-container * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    .modern-reports-container {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1a202c;
        line-height: 1.6;
    }
    .dark-mode .modern-reports-container {
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
    .header-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Date Filter Card */
    .date-filter-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dark-mode .date-filter-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }
    .date-filter-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .date-filter-card h5 {
        color: #1a202c;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .dark-mode .date-filter-card h5 {
        color: #f7fafc;
    }

    /* Filter Options */
    .filter-option {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin: 0.5rem 0;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        backdrop-filter: blur(5px);
        position: relative;
        overflow: hidden;
        margin-right: 20px;
    }
    .dark-mode .filter-option {
        background: rgba(45, 55, 72, 0.9);
        border-color: #4a5568;
        color: #f7fafc;
    }
    .filter-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s;
    }
    .filter-option:hover::before {
        left: 100%;
    }
    .filter-option:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }
    .dark-mode .filter-option:hover {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
    }
    .filter-option.active {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    .filter-option span {
        font-weight: 600;
        font-size: 0.875rem;
    }
    .filter-option i {
        font-size: 1.125rem;
        transition: transform 0.3s ease;
    }
    .filter-option:hover i {
        transform: scale(1.1);
    }

    /* Custom Date Inputs */
    .custom-date-inputs {
        display: none;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(226, 232, 240, 0.8);
        animation: fadeInUp 0.3s ease;
    }
    .dark-mode .custom-date-inputs {
        border-top-color: rgba(74, 85, 104, 0.8);
    }
    .custom-date-inputs.active {
        display: block;
    }
    .custom-date-inputs label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.875rem;
    }
    .dark-mode .custom-date-inputs label {
        color: #f7fafc;
    }
    .custom-date-inputs .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(5px);
        margin-right: 20px;
        width: 90%;
    }
    .dark-mode .custom-date-inputs .form-control {
        background: rgba(45, 55, 72, 0.9);
        border-color: #4a5568;
        color: #f7fafc;
    }
    .custom-date-inputs .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 1);
    }
    .dark-mode .custom-date-inputs .form-control:focus {
        background: rgba(45, 55, 72, 1);
    }

    /* Report Cards */
    .report-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(20px);
        width: 95%;
    }
    .dark-mode .report-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }
    .report-card:nth-child(1) { animation-delay: 0.1s; }
    .report-card:nth-child(2) { animation-delay: 0.2s; }
    .report-card:nth-child(3) { animation-delay: 0.3s; }
    .report-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .report-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--report-color, #667eea) 0%, var(--report-color-secondary, #764ba2) 100%);
        z-index: 1;
    }
    .report-card.comprehensive {
        --report-color: #667eea;
        --report-color-secondary: #764ba2;
    }
    .report-card.owners {
        --report-color: #48bb78;
        --report-color-secondary: #38a169;
    }
    .report-card.sales {
        --report-color: #ed8936;
        --report-color-secondary: #dd6b20;
    }

    /* Report Icon */
    .report-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--report-color) 0%, var(--report-color-secondary) 100%);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .report-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .report-card:hover .report-icon::before {
        left: 100%;
    }
    .report-card:hover .report-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Report Content */
    .report-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    .dark-mode .report-card h4 {
        color: #f7fafc;
    }
    .report-card p {
        color: #6b7280;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
        line-height: 1.6;
    }
    .dark-mode .report-card p {
        color: #9ca3af;
    }

    /* Feature List */
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0 1.5rem;
    }
    .feature-list li {
        padding: 0.5rem 0;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    .dark-mode .feature-list li {
        color: #9ca3af;
    }
    .feature-list li:hover {
        color: var(--report-color);
        transform: translateX(4px);
    }
    .feature-list li:before {
        content: '✓';
        color: var(--report-color);
        font-weight: bold;
        font-size: 1.1rem;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: rgba(var(--report-color-rgb, 102, 126, 234), 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    .feature-list li:hover:before {
        background: var(--report-color);
        color: white;
        transform: scale(1.1);
    }

    /* Stats Preview */
    .stats-preview {
        background: rgba(248, 250, 252, 0.8);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border: 1px solid rgba(226, 232, 240, 0.5);
        transition: all 0.3s ease;
    }
    .dark-mode .stats-preview {
        background: rgba(45, 55, 72, 0.8);
        border-color: rgba(74, 85, 104, 0.5);
    }
    .stats-preview:hover {
        background: rgba(248, 250, 252, 1);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .dark-mode .stats-preview:hover {
        background: rgba(45, 55, 72, 1);
    }
    .stat-item {
        text-align: center;
        transition: all 0.3s ease;
    }
    .stat-item:hover {
        transform: scale(1.05);
    }
    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--report-color);
        margin-bottom: 0.5rem;
        line-height: 1;
        transition: all 0.3s ease;
    }
    .stat-item:hover .stat-value {
        transform: scale(1.1);
    }
    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .dark-mode .stat-label {
        color: #9ca3af;
    }

    /* Download Button */
    .download-btn {
        background: linear-gradient(135deg, var(--report-color) 0%, var(--report-color-secondary) 100%);
        border: none;
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .download-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .download-btn:hover::before {
        left: 100%;
    }
    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }
    .download-btn i {
        transition: transform 0.3s ease;
    }
    .download-btn:hover i {
        transform: scale(1.1);
    }

    /* Information Alert */
    .modern-info-alert {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 1px solid rgba(102, 126, 234, 0.2);
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        transition: all 0.3s ease;
    }
    .dark-mode .modern-info-alert {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
        border-color: rgba(102, 126, 234, 0.3);
    }
    .modern-info-alert:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
    }
    .modern-info-alert .alert-icon {
        color: #667eea;
        font-size: 2rem;
        margin-right: 1rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .modern-info-alert:hover .alert-icon {
        transform: scale(1.1) rotate(5deg);
    }
    .modern-info-alert h5 {
        color: #1a202c;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    .dark-mode .modern-info-alert h5 {
        color: #f7fafc;
    }
    .modern-info-alert p {
        color: #4a5568;
        margin-bottom: 1rem;
    }
    .dark-mode .modern-info-alert p {
        color: #a0aec0;
    }
    .modern-info-alert ul {
        color: #4a5568;
        margin-bottom: 0;
    }
    .dark-mode .modern-info-alert ul {
        color: #a0aec0;
    }
    .modern-info-alert li {
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    .modern-info-alert li:hover {
        color: #667eea;
        transform: translateX(4px);
    }

    /* Loading Modal */
    .modern-loading-modal .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    .dark-mode .modern-loading-modal .modal-content {
        background: rgba(45, 55, 72, 0.95);
    }
    .modern-loading-modal .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.3em;
        color: #667eea;
    }
    .modern-loading-modal h5 {
        color: #1a202c;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .dark-mode .modern-loading-modal h5 {
        color: #f7fafc;
    }
    .modern-loading-modal p {
        color: #6b7280;
        margin-bottom: 0;
    }
    .dark-mode .modern-loading-modal p {
        color: #9ca3af;
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

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    /* Mobile Responsive */
    @media (max-width: 1024px) {
        .modern-reports-container {
            padding: 0.75rem;
        }
        .modern-page-header {
            margin: -0.75rem -0.75rem 1.5rem;
            padding: 1.5rem 1rem;
        }
        .date-filter-card {
            padding: 1.5rem;
        }
        .filter-option {
            padding: 0.875rem 1rem;
        }
    }

    @media (max-width: 768px) {
        .modern-page-header h1 {
            font-size: 1.25rem;
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }
        .modern-page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        .date-filter-card {
            padding: 1rem;
        }
        .date-filter-card h5 {
            font-size: 1rem;
            text-align: center;
        }
        .filter-option {
            padding: 0.75rem;
            font-size: 0.875rem;
        }
        .filter-option span {
            font-size: 0.75rem;
        }
        .filter-option i {
            font-size: 1rem;
        }
        .report-card .card-body {
            padding: 1.5rem;
        }
        .report-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        .report-card h4 {
            font-size: 1.125rem;
        }
        .feature-list li {
            font-size: 0.75rem;
            padding: 0.375rem 0;
        }
        .stat-value {
            font-size: 1.5rem;
        }
        .stat-label {
            font-size: 0.75rem;
        }
        .download-btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
        }
        .modern-info-alert {
            padding: 1.5rem;
        }
        .modern-info-alert .alert-icon {
            font-size: 1.5rem;
        }
        .modern-info-alert h5 {
            font-size: 1rem;
        }
        .modern-info-alert p,
        .modern-info-alert li {
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
        .modern-page-header {
            padding: 1rem 0.75rem;
        }
        .modern-page-header h1 {
            font-size: 1.125rem;
        }
        .date-filter-card {
            padding: 0.75rem;
        }
        .filter-option {
            padding: 0.625rem;
            margin: 0.25rem 0;
        }
        .report-card .card-body {
            padding: 1rem;
        }
        .report-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .stats-preview {
            padding: 1rem;
        }
        .stat-value {
            font-size: 1.25rem;
        }
        .download-btn {
            padding: 0.625rem 1rem;
        }
        .modern-info-alert {
            padding: 1rem;
        }
        .modern-info-alert .d-flex {
            flex-direction: column;
            text-align: center;
        }
        .modern-info-alert .alert-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }

    /* Large screens optimization */
    @media (min-width: 1200px) {
        .modern-reports-container {
            padding: 1.5rem;
        }
        .modern-page-header {
            margin: -1.5rem -1.5rem 2rem;
        }
    }

    /* Focus and accessibility */
    .filter-option:focus,
    .download-btn:focus,
    .custom-date-inputs .form-control:focus {
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
<div class="modern-reports-container">
    <!-- Page Header -->
    <div class="modern-page-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1>
                        <i class="fas fa-chart-line"></i>
                        <span class="mobile-text">{{ __('reports.financial_reports') }}</span>
                        <span class="mobile-icon d-none">Reports</span>
                    </h1>
                    <p class="mobile-text">{{ __('reports.comprehensive_analytics_description') }}</p>
                    <p class="mobile-icon d-none">Analytics & Insights</p>
                </div>
                <div class="text-end">
                    <span class="header-badge">
                        <i class="fas fa-shield-alt me-1"></i>
                        <span class="mobile-text">{{ __('reports.admin_only') }}</span>
                        <span class="mobile-icon d-none">Admin</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Filter Section -->
    <div class="date-filter-card">
        <h5>
            <i class="fas fa-calendar-alt text-primary me-2"></i>
            {{ __('reports.select_time_period') }}
        </h5>
        <div class="row g-3" id="dateFilterOptions">
            <div class="col-lg-4 col-md-6">
                <div class="filter-option active" data-period="last_30_days">
                    <span>{{ __('reports.last_30_days') }}</span>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="filter-option" data-period="last_90_days">
                    <span>{{ __('reports.last_90_days') }}</span>
                    <i class="fas fa-calendar-week"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="filter-option" data-period="this_year">
                    <span>{{ __('reports.this_year') }}</span>
                    <i class="fas fa-calendar-year"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="filter-option" data-period="last_year">
                    <span>{{ __('reports.last_year') }}</span>
                    <i class="fas fa-history"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="filter-option" data-period="last_7_days">
                    <span>{{ __('reports.last_7_days') }}</span>
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="filter-option" data-period="custom">
                    <span>{{ __('reports.custom_range') }}</span>
                    <i class="fas fa-calendar-plus"></i>
                </div>
            </div>
        </div>
        
        <div class="custom-date-inputs" id="customDateInputs">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-calendar-day me-1"></i>
                        {{ __('reports.start_date') }}
                    </label>
                    <input type="date" class="form-control" id="startDate" value="{{ now()->subDays(30)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-calendar-check me-1"></i>
                        {{ __('reports.end_date') }}
                    </label>
                    <input type="date" class="form-control" id="endDate" value="{{ now()->format('Y-m-d') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="row g-4">
        <!-- Comprehensive Report -->
        <div class="col-lg-4 col-md-6">
            <div class="report-card comprehensive">
                <div class="card-body p-4">
                    <div class="report-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    
                    <h4>{{ __('reports.comprehensive_report') }}</h4>
                    <p>{{ __('reports.comprehensive_description') }}</p>
                    
                    <ul class="feature-list">
                        <li>{{ __('reports.financial_overview') }}</li>
                        <li>{{ __('reports.sales_analytics') }}</li>
                        <li>{{ __('reports.staff_performance') }}</li>
                        <li>{{ __('reports.growth_metrics') }}</li>
                        <li>{{ __('reports.regional_analysis') }}</li>
                        <li>{{ __('reports.trend_forecasting') }}</li>
                    </ul>
                    
                    <div class="stats-preview">
                        <div class="row">
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-value">${{ number_format($stats['comprehensive']['revenue'], 2) }}</div>
                                    <div class="stat-label">{{ __('reports.revenue_preview') }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-value">{{ number_format($stats['comprehensive']['sales']) }}</div>
                                    <div class="stat-label">{{ __('reports.sales_preview') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="download-btn comprehensive-btn" onclick="downloadReport('comprehensive')">
                        <i class="fas fa-download"></i>
                        <span class="mobile-text">{{ __('reports.download_comprehensive') }}</span>
                        <span class="mobile-icon d-none">Download</span>
                    </button>
                    <button class="download-btn comprehensive-btn mt-2" style="background:#fff;color:#667eea;border:1px solid #667eea" onclick="window.generateReportPDF(null, { reportType: 'comprehensive', title: 'Comprehensive Business Report', generatedAt: new Date().toLocaleString(), filename: 'comprehensive-business-report.pdf' })">
                        <i class="fas fa-file-pdf"></i>
                        <span class="mobile-text">Download as PDF (jsPDF)</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Owners Report -->
        <div class="col-lg-4 col-md-6">
            <div class="report-card owners">
                <div class="card-body p-4">
                    <div class="report-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    
                    <h4>{{ __('reports.owners_report') }}</h4>
                    <p>{{ __('reports.owners_description') }}</p>
                    
                    <ul class="feature-list">
                        <li>{{ __('reports.customer_demographics') }}</li>
                        <li>{{ __('reports.geographic_distribution') }}</li>
                        <li>{{ __('reports.purchase_behavior') }}</li>
                        <li>{{ __('reports.customer_lifetime_value') }}</li>
                        <li>{{ __('reports.acquisition_trends') }}</li>
                        <li>{{ __('reports.top_customers') }}</li>
                    </ul>
                    
                    <div class="stats-preview">
                        <div class="row">
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-value">{{ number_format($stats['owners']['total_owners']) }}</div>
                                    <div class="stat-label">{{ __('reports.total_owners') }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-value">{{ number_format($stats['owners']['countries']) }}</div>
                                    <div class="stat-label">{{ __('reports.countries') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="download-btn owners-btn" onclick="downloadReport('owners')">
                        <i class="fas fa-download"></i>
                        <span class="mobile-text">{{ __('reports.download_owners') }}</span>
                        <span class="mobile-icon d-none">Download</span>
                    </button>
                    <button class="download-btn owners-btn mt-2" style="background:#fff;color:#48bb78;border:1px solid #48bb78" onclick="downloadReportPDF('owners')">
                        <i class="fas fa-file-pdf"></i>
                        <span class="mobile-text">Download as PDF (jsPDF)</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Sales Report -->
        <div class="col-lg-4 col-md-6">
            <div class="report-card sales">
                <div class="card-body p-4">
                    <div class="report-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    
                    <h4>{{ __('reports.sales_report') }}</h4>
                    <p>{{ __('reports.sales_description') }}</p>
                    
                    <ul class="feature-list">
                        <li>{{ __('reports.product_performance') }}</li>
                        <li>{{ __('reports.sales_by_period') }}</li>
                        <li>{{ __('reports.staff_sales_metrics') }}</li>
                        <li>{{ __('reports.inventory_turnover') }}</li>
                        <li>{{ __('reports.profit_margins') }}</li>
                        <li>{{ __('reports.recent_transactions') }}</li>
                    </ul>
                    
                    <div class="stats-preview">
                        <div class="row">
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-value">{{ number_format($stats['sales']['products_sold']) }}</div>
                                    <div class="stat-label">{{ __('reports.products_sold') }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-value">${{ number_format($stats['sales']['avg_sale'], 2) }}</div>
                                    <div class="stat-label">{{ __('reports.avg_sale') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="download-btn sales-btn" onclick="downloadReport('sales')">
                        <i class="fas fa-download"></i>
                        <span class="mobile-text">{{ __('reports.download_sales') }}</span>
                        <span class="mobile-icon d-none">Download</span>
                    </button>
                    <button class="download-btn sales-btn mt-2" style="background:#fff;color:#ed8936;border:1px solid #ed8936" onclick="downloadReportPDF('sales')">
                        <i class="fas fa-file-pdf"></i>
                        <span class="mobile-text">Download as PDF (jsPDF)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="modern-info-alert">
        <div class="d-flex align-items-start">
            <i class="fas fa-info-circle alert-icon"></i>
            <div>
                <h5>{{ __('reports.important_information') }}</h5>
                <p>{{ __('reports.report_generation_info') }}</p>
                <ul>
                    <li>{{ __('reports.pdf_format_info') }}</li>
                    <li>{{ __('reports.charts_included_info') }}</li>
                    <li>{{ __('reports.executive_summary_info') }}</li>
                    <li>{{ __('reports.confidential_data_info') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade modern-loading-modal" id="loadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div class="spinner-border mb-3" role="status">
                    <span class="visually-hidden">{{ __('reports.generating') }}</span>
                </div>
                <h5>{{ __('reports.generating_report') }}</h5>
                <p>{{ __('reports.please_wait_message') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@if (isset($comprehensiveData) && isset($comprehensiveDateRange))
<script id="comprehensive-report-data" type="application/json">
@json(['data' => $comprehensiveData, 'dateRange' => $comprehensiveDateRange])
</script>
@endif

@push('scripts')
<!-- jsPDF CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- Custom report PDF logic -->
<script src="/js/report-pdf.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Date filter functionality
    const filterOptions = document.querySelectorAll('.filter-option');
    const customDateInputs = document.getElementById('customDateInputs');
    let selectedPeriod = 'last_30_days';

    filterOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove active class from all options
            filterOptions.forEach(opt => opt.classList.remove('active'));
            
            // Add active class to clicked option
            this.classList.add('active');
            
            // Get selected period
            selectedPeriod = this.dataset.period;
            
            // Show/hide custom date inputs with animation
            if (selectedPeriod === 'custom') {
                customDateInputs.classList.add('active');
            } else {
                customDateInputs.classList.remove('active');
            }
        });
    });

    // Add loading animations to cards
    const reportCards = document.querySelectorAll('.report-card');
    reportCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100 + 300);
    });

    // Enhanced hover effects for feature lists
    const featureItems = document.querySelectorAll('.feature-list li');
    featureItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(8px)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // Smooth scroll for mobile
    if (window.innerWidth <= 768) {
        document.querySelectorAll('.filter-option').forEach(option => {
            option.addEventListener('click', function() {
                setTimeout(() => {
                    this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            });
        });
    }
});

function downloadReport(reportType) {
    const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
    loadingModal.show();
    
    // Add loading animation to the clicked button
    const button = document.querySelector(`.${reportType}-btn`);
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span class="mobile-text">Generating...</span><span class="mobile-icon d-none">Loading</span>';
    button.disabled = true;
    
    // Get selected period
    const selectedPeriod = document.querySelector('.filter-option.active').dataset.period;
    
    // Build URL with parameters
    let url = `/admin/reports/${reportType}?period=${selectedPeriod}`;
    
    // Add custom dates if selected
    if (selectedPeriod === 'custom') {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        url += `&start_date=${startDate}&end_date=${endDate}`;
    }
    
    // Create a temporary link to trigger download
    const link = document.createElement('a');
    link.href = url;
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Hide loading modal and restore button after a delay
    setTimeout(() => {
        loadingModal.hide();
        button.innerHTML = originalContent;
        button.disabled = false;
    }, 2000);
}


// jsPDF Download Button Logic
window.downloadReportPDF = function(reportType) {
    // Gather report data from DOM (for demo, just use visible stats and features)
    let title = '';
    let period = document.querySelector('.filter-option.active span')?.innerText || '';
    let generatedAt = new Date().toLocaleString();
    let filename = reportType + '-report.pdf';
    let sections = [];
    let card = document.querySelector('.report-card.' + reportType);
    if (!card) return alert('Report card not found!');
    title = card.querySelector('h4')?.innerText || 'Report';
    // Features
    let features = Array.from(card.querySelectorAll('.feature-list li')).map(li => [li.innerText]);
    if (features.length) {
        sections.push({ title: 'Features', rows: features });
    }
    // Stats
    let stats = Array.from(card.querySelectorAll('.stat-item')).map(item => [
        item.querySelector('.stat-label')?.innerText || '',
        item.querySelector('.stat-value')?.innerText || ''
    ]);
    if (stats.length) {
        sections.push({ title: 'Stats', rows: stats });
    }
    // Call jsPDF logic
    if (window.generateReportPDF) {
        window.generateReportPDF(null, { title, period, generatedAt, filename, sections });
    } else {
        alert('jsPDF not loaded!');
    }
}

// Enhanced mobile interactions
if ('ontouchstart' in window) {
    document.querySelectorAll('.report-card').forEach(card => {
        card.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        card.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

// Keyboard navigation support
document.addEventListener('keydown', function(e) {
    if (e.key === 'Tab') {
        document.querySelectorAll('.filter-option, .download-btn').forEach(element => {
            element.addEventListener('focus', function() {
                this.style.outline = '2px solid #667eea';
                this.style.outlineOffset = '2px';
            });
            element.addEventListener('blur', function() {
                this.style.outline = 'none';
            });
        });
    }
});
</script>
@endpush