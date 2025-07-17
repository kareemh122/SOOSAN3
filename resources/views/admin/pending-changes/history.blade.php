@extends('layouts.admin')

@section('title', __('admin.change_history'))

@push('styles')
<style>
    /* Modern Container */
    .modern-pending-history-container {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1a202c;
        line-height: 1.6;
    }
    .dark-mode .modern-pending-history-container {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        color: #f7fafc;
    }

    /* Modern Page Header */
    .modern-pending-history-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-pending-history-header::before {
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
    .modern-pending-history-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    .modern-pending-history-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Modern Cards */
    .modern-pending-history-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 8px 32px -8px rgba(0, 0, 0, 0.1), 0 4px 16px -4px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .modern-pending-history-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: 1;
    }
    .modern-pending-history-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 24px -6px rgba(0, 0, 0, 0.1);
    }
    .dark-mode .modern-pending-history-card {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }

    /* Modern Button */
    .modern-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #ffffff;
        padding: 0.875rem 1.75rem;
        border-radius: 16px;
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
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
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
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -5px rgba(102, 126, 234, 0.5);
        color: #ffffff;
        text-decoration: none;
    }
    .modern-btn.btn-outline-primary {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        box-shadow: none;
    }
    .modern-btn.btn-outline-primary:hover {
        background: #667eea;
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -5px rgba(102, 126, 234, 0.5);
    }

    /* Enhanced Table */
    .modern-table-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px -4px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    .dark-mode .modern-table-container {
        background: rgba(45, 55, 72, 0.95);
    }
    .modern-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    .modern-table thead th {
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.9) 0%, rgba(241, 245, 249, 0.9) 100%);
        color: #374151;
        border: none;
        padding: 1.25rem 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .dark-mode .modern-table thead th {
        background: linear-gradient(135deg, rgba(45, 55, 72, 0.9) 0%, rgba(51, 65, 85, 0.9) 100%);
        color: #f7fafc;
    }
    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(226, 232, 240, 0.3);
    }
    .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
    }
    .dark-mode .modern-table tbody tr {
        border-bottom-color: rgba(74, 85, 104, 0.3);
    }
    .dark-mode .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.1);
    }
    .modern-table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border: none;
        font-weight: 500;
    }

    /* Enhanced Badge */
    .modern-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .modern-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .modern-badge.badge-info {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #ffffff;
    }
    .modern-badge.badge-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
    }
    .modern-badge.badge-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
    }
    .modern-badge.badge-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
    }

    /* Filter Buttons */
    .modern-filter-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .modern-filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        background: transparent;
    }
    .modern-filter-btn.btn-outline-secondary {
        border-color: #6b7280;
        color: #6b7280;
    }
    .modern-filter-btn.btn-outline-secondary:hover,
    .modern-filter-btn.btn-outline-secondary:checked {
        background: #6b7280;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    }
    .modern-filter-btn.btn-outline-success {
        border-color: #10b981;
        color: #10b981;
    }
    .modern-filter-btn.btn-outline-success:hover,
    .modern-filter-btn.btn-outline-success:checked {
        background: #10b981;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .modern-filter-btn.btn-outline-danger {
        border-color: #ef4444;
        color: #ef4444;
    }
    .modern-filter-btn.btn-outline-danger:hover,
    .modern-filter-btn.btn-outline-danger:checked {
        background: #ef4444;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* Action Button */
    .modern-action-btn {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.3s ease;
        border: 2px solid #667eea;
        color: #667eea;
        background: transparent;
    }
    .modern-action-btn:hover {
        background: #667eea;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* Empty State */
    .modern-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 8px 32px -8px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .dark-mode .modern-empty-state {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }
    .modern-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 2rem;
        box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
    }
    .modern-empty-state h4 {
        color: #1a202c;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .dark-mode .modern-empty-state h4 {
        color: #f7fafc;
    }
    .modern-empty-state p {
        color: #6b7280;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }
    .dark-mode .modern-empty-state p {
        color: #9ca3af;
    }

    /* Pagination */
    .modern-pagination-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        margin: 2rem 0;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .dark-mode .modern-pagination-wrapper {
        background: rgba(45, 55, 72, 0.95);
        border-color: rgba(74, 85, 104, 0.3);
    }
    .modern-pagination-wrapper .pagination {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
    }
    .modern-pagination-wrapper .page-item {
        margin: 0;
        list-style: none;
    }
    .modern-pagination-wrapper .page-item.active .page-link {
        color: #ffffff;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        font-weight: 600;
    }
    .modern-pagination-wrapper .page-item.disabled .page-link {
        color: #9ca3af;
        pointer-events: none;
        background: rgba(248, 250, 252, 0.8);
        border-color: rgba(226, 232, 240, 0.8);
        opacity: 0.6;
        cursor: not-allowed;
    }
    .dark-mode .modern-pagination-wrapper .page-item.disabled .page-link {
        background: rgba(45, 55, 72, 0.8);
        border-color: rgba(74, 85, 104, 0.8);
        color: #6b7280;
    }
    .modern-pagination-wrapper .page-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: #374151;
        text-decoration: none;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 44px;
        font-weight: 500;
        justify-content: center;
        backdrop-filter: blur(5px);
    }
    .dark-mode .modern-pagination-wrapper .page-link {
        background: rgba(45, 55, 72, 0.9);
        border-color: rgba(74, 85, 104, 0.8);
        color: #f7fafc;
    }
    .modern-pagination-wrapper .page-link:hover {
        color: #667eea;
        background: rgba(255, 255, 255, 1);
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }
    .dark-mode .modern-pagination-wrapper .page-link:hover {
        color: #667eea;
        background: rgba(45, 55, 72, 1);
        border-color: #667eea;
    }
    .pagination-info {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        text-align: center;
    }
    .dark-mode .pagination-info {
        color: #9ca3af;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .modern-table thead th,
        .modern-table tbody td {
            padding: 1rem 0.75rem;
        }
    }

    @media (max-width: 768px) {
        .modern-pending-history-container {
            padding: 0.75rem;
        }
        .modern-pending-history-header {
            margin: -0.75rem -0.75rem 1.5rem;
            padding: 1.5rem 1rem;
        }
        .modern-pending-history-header h1 {
            font-size: 1.25rem;
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }
        .modern-btn {
            width: 100%;
            justify-content: center;
            padding: 1rem 1.25rem;
        }
        .modern-table {
            font-size: 0.875rem;
        }
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.75rem 0.5rem;
        }
        .modern-filter-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }
        .modern-filter-btn {
            width: 100%;
            justify-content: center;
        }
        .mobile-collapse {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .modern-pending-history-header h1 {
            font-size: 1.125rem;
        }
        .modern-btn {
            padding: 0.875rem;
            font-size: 0.8rem;
        }
        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.5rem 0.25rem;
            font-size: 0.75rem;
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
    .fade-in-up {
        animation: fadeInUp 0.8s ease forwards;
    }
</style>
@endpush

@section('content')
<div class="modern-pending-history-container">
    <!-- Modern Header -->
    <div class="modern-pending-history-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h1>
                    <i class="fas fa-history"></i>
                    {{ __('admin.change_history') }}
                </h1>
                <a href="{{ route('admin.pending-changes.index') }}" class="modern-btn btn-outline-primary">
                    <i class="fas fa-clock"></i>
                    <span class="mobile-text-full">{{ __('admin.pending_changes') }}</span>
                </a>
            </div>
        </div>
    </div>

    @if($changes->count() > 0)
        <div class="modern-pending-history-card fade-in-up">
            <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-list text-primary"></i>
                        {{ __('admin.all_changes') }}
                    </h5>
                    <div class="modern-filter-buttons">
                        <input type="radio" class="btn-check" name="statusFilter" id="all" value="all" checked>
                        <label class="modern-filter-btn btn-outline-secondary" for="all">{{ __('admin.all_changes') }}</label>
                        
                        <input type="radio" class="btn-check" name="statusFilter" id="approved" value="approved">
                        <label class="modern-filter-btn btn-outline-success" for="approved">{{ __('admin.approved_changes') }}</label>
                        
                        <input type="radio" class="btn-check" name="statusFilter" id="rejected" value="rejected">
                        <label class="modern-filter-btn btn-outline-danger" for="rejected">{{ __('admin.rejected_changes') }}</label>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive modern-table-container">
                    <table class="table modern-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-tag me-1"></i>{{ __('admin.change_type') }}</th>
                                <th><i class="fas fa-cog me-1"></i>{{ __('admin.action') }}</th>
                                <th><i class="fas fa-user me-1"></i>{{ __('admin.requested_by') }}</th>
                                <th class="mobile-collapse"><i class="fas fa-calendar me-1"></i>{{ __('admin.requested_at') }}</th>
                                <th class="mobile-collapse"><i class="fas fa-user-check me-1"></i>{{ __('admin.reviewed_by') }}</th>
                                <th class="mobile-collapse"><i class="fas fa-clock me-1"></i>{{ __('admin.reviewed_at') }}</th>
                                <th><i class="fas fa-info-circle me-1"></i>{{ __('admin.status') }}</th>
                                <th><i class="fas fa-tools me-1"></i>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($changes as $change)
                                <tr data-status="{{ $change->status }}">
                                    <td>
                                        <span class="modern-badge badge-info" title="{{ $change->model_name }}">
                                            <i class="fas fa-{{ $change->model_name === 'Owner' ? 'user-tie' : ($change->model_name === 'Product' ? 'box' : 'file') }} me-1"></i>
                                            <span class="mobile-hide-text">{{ $change->model_name }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        @if($change->action === 'update')
                                            <span class="modern-badge badge-warning" title="{{ __('admin.update') }}">
                                                <i class="fas fa-edit me-1"></i>
                                                <span class="mobile-hide-text">{{ __('admin.update') }}</span>
                                            </span>
                                        @elseif($change->action === 'delete')
                                            <span class="modern-badge badge-danger" title="{{ __('admin.delete') }}">
                                                <i class="fas fa-trash me-1"></i>
                                                <span class="mobile-hide-text">{{ __('admin.delete') }}</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle me-1 text-muted"></i>
                                            <span class="text-truncate" title="{{ $change->requestedBy->name }}">{{ $change->requestedBy->name }}</span>
                                        </div>
                                    </td>
                                    <td class="mobile-collapse">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock me-1 text-muted"></i>
                                            <span>{{ $change->created_at->locale(app()->getLocale())->translatedFormat('M d, Y H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="mobile-collapse">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-check me-1 text-muted"></i>
                                            <span>{{ $change->reviewedBy->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="mobile-collapse">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-check me-1 text-muted"></i>
                                            <span>{{ $change->reviewed_at ? $change->reviewed_at->locale(app()->getLocale())->translatedFormat('M d, Y H:i') : '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($change->status === 'approved')
                                            <span class="modern-badge badge-success" title="{{ __('admin.approved') }}">
                                                <i class="fas fa-check-circle me-1"></i>
                                                <span class="mobile-hide-text">{{ __('admin.approved') }}</span>
                                            </span>
                                        @elseif($change->status === 'rejected')
                                            <span class="modern-badge badge-danger" title="{{ __('admin.rejected') }}">
                                                <i class="fas fa-times-circle me-1"></i>
                                                <span class="mobile-hide-text">{{ __('admin.rejected') }}</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pending-changes.show', $change) }}" 
                                           class="modern-action-btn"
                                           title="{{ __('admin.view') }}">
                                            <i class="fas fa-eye"></i>
                                            <span class="mobile-hide-text">{{ __('admin.view') }}</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($changes->hasPages())
            <div class="modern-pagination-wrapper">
                <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
                    {{-- Previous Page Link --}}
                    @if ($changes->onFirstPage())
                        <span class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-{{ app()->getLocale() === 'ar' ? 'chevron-right' : 'chevron-left' }}"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $changes->previousPageUrl() }}" class="page-item">
                            <span class="page-link">
                                <i class="fas fa-{{ app()->getLocale() === 'ar' ? 'chevron-right' : 'chevron-left' }}"></i>
                            </span>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $start = max($changes->currentPage() - 2, 1);
                        $end = min($start + 4, $changes->lastPage());
                        $start = max($end - 4, 1);
                    @endphp

                    {{-- First page link --}}
                    @if($start > 1)
                        <a href="{{ $changes->url(1) }}" class="page-item">
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
                        @if ($page == $changes->currentPage())
                            <span class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </span>
                        @else
                            <a href="{{ $changes->url($page) }}" class="page-item">
                                <span class="page-link">{{ $page }}</span>
                            </a>
                        @endif
                    @endfor

                    {{-- Last page link --}}
                    @if($end < $changes->lastPage())
                        @if($end < $changes->lastPage() - 1)
                            <span class="page-item disabled">
                                <span class="page-link">...</span>
                            </span>
                        @endif
                        <a href="{{ $changes->url($changes->lastPage()) }}" class="page-item">
                            <span class="page-link">{{ $changes->lastPage() }}</span>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($changes->hasMorePages())
                        <a href="{{ $changes->nextPageUrl() }}" class="page-item">
                            <span class="page-link">
                                <i class="fas fa-{{ app()->getLocale() === 'ar' ? 'chevron-left' : 'chevron-right' }}"></i>
                            </span>
                        </a>
                    @else
                        <span class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-{{ app()->getLocale() === 'ar' ? 'chevron-left' : 'chevron-right' }}"></i>
                            </span>
                        </span>
                    @endif
                </nav>
                
                <div class="pagination-info">
                    {{ __('admin.pagination.showing_results', ['first' => $changes->firstItem(), 'last' => $changes->lastItem(), 'total' => $changes->total()]) }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="modern-empty-state fade-in-up">
            <div class="modern-empty-icon">
                <i class="fas fa-history"></i>
            </div>
            <h4>{{ __('admin.no_history') }}</h4>
            <p>{{ __('admin.no_history_desc') }}</p>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusFilters = document.querySelectorAll('input[name="statusFilter"]');
    const tableRows = document.querySelectorAll('tbody tr');

    statusFilters.forEach(filter => {
        filter.addEventListener('change', function() {
            const selectedStatus = this.value;
            
            tableRows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                
                if (selectedStatus === 'all' || rowStatus === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
