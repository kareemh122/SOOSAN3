@extends('layouts.admin')

@section('title', __('admin.review_change'))

@push('styles')
<style>
    /* Modern Container */
    .modern-pending-show-container {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1a202c;
        line-height: 1.6;
    }
    .dark-mode .modern-pending-show-container {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        color: #f7fafc;
    }

    /* Modern Page Header */
    .modern-pending-show-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-pending-show-header::before {
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
    .modern-pending-show-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    .modern-pending-show-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Modern Cards */
    .modern-pending-show-card {
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
    .modern-pending-show-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: 1;
    }
    .modern-pending-show-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 24px -6px rgba(0, 0, 0, 0.1);
    }
    .dark-mode .modern-pending-show-card {
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
    .modern-btn.btn-outline-secondary {
        background: transparent;
        border: 2px solid #6b7280;
        color: #6b7280;
        box-shadow: none;
    }
    .modern-btn.btn-outline-secondary:hover {
        background: #6b7280;
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -5px rgba(107, 114, 128, 0.5);
    }
    .modern-btn.btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        border: none;
    }
    .modern-btn.btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -5px rgba(16, 185, 129, 0.5);
    }
    .modern-btn.btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
        border: none;
    }
    .modern-btn.btn-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px -5px rgba(239, 68, 68, 0.5);
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

    /* Info Row */
    .modern-info-row {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(226, 232, 240, 0.3);
    }
    .modern-info-row:last-child {
        border-bottom: none;
    }
    .modern-info-label {
        font-weight: 600;
        color: #374151;
        min-width: 120px;
        flex-shrink: 0;
    }
    .dark-mode .modern-info-label {
        color: #f7fafc;
    }
    .modern-info-value {
        color: #6b7280;
        flex: 1;
    }
    .dark-mode .modern-info-value {
        color: #9ca3af;
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

    /* Alert Enhancements */
    .modern-alert {
        border-radius: 16px;
        border: none;
        padding: 1.25rem;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .modern-alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        z-index: 0;
    }
    .modern-alert > * {
        position: relative;
        z-index: 1;
    }
    .modern-alert.alert-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    .modern-alert.alert-info {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    /* Form Enhancements */
    .modern-form-group {
        margin-bottom: 1.5rem;
    }
    .modern-form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }
    .dark-mode .modern-form-label {
        color: #f7fafc;
    }
    .modern-form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 12px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
    }
    .modern-form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: rgba(255, 255, 255, 1);
    }
    .dark-mode .modern-form-control {
        background: rgba(45, 55, 72, 0.9);
        border-color: rgba(74, 85, 104, 0.8);
        color: #f7fafc;
    }
    .dark-mode .modern-form-control:focus {
        background: rgba(45, 55, 72, 1);
    }

    /* Modal Enhancements */
    .modern-modal .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }
    .modern-modal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        border-bottom: none;
        padding: 1.5rem;
    }
    .modern-modal .modal-body {
        padding: 1.5rem;
    }
    .modern-modal .modal-footer {
        border-top: 1px solid rgba(226, 232, 240, 0.5);
        padding: 1.5rem;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .modern-info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .modern-info-label {
            min-width: auto;
        }
    }

    @media (max-width: 768px) {
        .modern-pending-show-container {
            padding: 0.75rem;
        }
        .modern-pending-show-header {
            margin: -0.75rem -0.75rem 1.5rem;
            padding: 1.5rem 1rem;
        }
        .modern-pending-show-header h1 {
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
    }

    @media (max-width: 576px) {
        .modern-pending-show-header h1 {
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
        .mobile-collapse {
            display: none;
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
<div class="modern-pending-show-container">
    <!-- Modern Header -->
    <div class="modern-pending-show-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h1>
                    <i class="fas fa-eye"></i>
                    {{ __('admin.review_change') }}
                </h1>
                <a href="{{ route('admin.pending-changes.index') }}" class="modern-btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span class="mobile-text-full">{{ __('admin.back_to_list') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="modern-pending-show-card fade-in-up">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-info-circle text-primary"></i>
                        {{ __('admin.change_details') }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="modern-info-row">
                        <div class="modern-info-label">{{ __('admin.type') }}:</div>
                        <div class="modern-info-value">
                            <span class="modern-badge badge-info">{{ $pendingChange->model_name }}</span>
                        </div>
                    </div>
                    
                    <div class="modern-info-row">
                        <div class="modern-info-label">{{ __('admin.action') }}:</div>
                        <div class="modern-info-value">
                            @if($pendingChange->action === 'update')
                                <span class="modern-badge badge-warning">{{ __('admin.update') }}</span>
                            @elseif($pendingChange->action === 'delete')
                                <span class="modern-badge badge-danger">{{ __('admin.delete') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="modern-info-row">
                        <div class="modern-info-label">{{ __('admin.requested_by') }}:</div>
                        <div class="modern-info-value">{{ $pendingChange->requestedBy->name }}</div>
                    </div>

                    <div class="modern-info-row">
                        <div class="modern-info-label">{{ __('admin.requested_at') }}:</div>
                        <div class="modern-info-value">{{ $pendingChange->created_at->locale(app()->getLocale())->translatedFormat('M d, Y H:i:s') }}</div>
                    </div>

                    @if($pendingChange->action === 'delete')
                        <div class="modern-alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ __('admin.delete_warning') }}
                        </div>
                    @else
                        <h6 class="mt-4 mb-3 fw-bold">{{ __('admin.proposed_changes') }}:</h6>
                        
                        @php $changes = $pendingChange->changed_fields; @endphp
                        
                        @if(count($changes) > 0)
                            <div class="table-responsive modern-table-container">
                                <table class="table modern-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin.field') }}</th>
                                            <th>{{ __('admin.current_value') }}</th>
                                            <th>{{ __('admin.proposed_value') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($changes as $field => $change)
                                            <tr>
                                                <td><strong>{{ ucfirst(str_replace('_', ' ', $field)) }}</strong></td>
                                                <td>
                                                    <span class="text-muted">
                                                        @if(is_null($change['from']))
                                                            <em>{{ __('admin.empty') }}</em>
                                                        @else
                                                            {{ $change['from'] }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold">
                                                        @if(is_null($change['to']))
                                                            <em>{{ __('admin.empty') }}</em>
                                                        @else
                                                            {{ $change['to'] }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">{{ __('admin.no_changes_detected') }}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="modern-pending-show-card fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-tasks text-primary"></i>
                        {{ __('admin.review_actions') }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($pendingChange->isPending())
                        <!-- Approve Button -->
                        <form method="POST" action="{{ route('admin.pending-changes.approve', $pendingChange) }}" class="mb-4">
                            @csrf
                            <div class="modern-form-group">
                                <label class="modern-form-label">{{ __('admin.approval_notes') }} ({{ __('admin.optional') }})</label>
                                <textarea name="review_notes" class="modern-form-control" rows="3" 
                                          placeholder="{{ __('admin.approval_notes_placeholder') }}"></textarea>
                            </div>
                            <button type="submit" class="modern-btn btn-success w-100"
                                    onclick="return confirm('{{ __('admin.confirm_approve') }}')">
                                <i class="fas fa-check"></i> {{ __('admin.approve_change') }}
                            </button>
                        </form>

                        <!-- Reject Button -->
                        <button type="button" class="modern-btn btn-danger w-100" 
                                data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fas fa-times"></i> {{ __('admin.reject_change') }}
                        </button>

                        <!-- Reject Modal -->
                        <div class="modal fade modern-modal" id="rejectModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('admin.pending-changes.reject', $pendingChange) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('admin.reject_change') }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modern-form-group">
                                                <label class="modern-form-label">{{ __('admin.reason_for_rejection') }} <span class="text-danger">*</span></label>
                                                <textarea name="review_notes" class="modern-form-control" rows="4" required
                                                          placeholder="{{ __('admin.explain_rejection') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="modern-btn btn-outline-secondary" data-bs-dismiss="modal">
                                                {{ __('admin.cancel') }}
                                            </button>
                                            <button type="submit" class="modern-btn btn-danger">
                                                {{ __('admin.reject') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="modern-alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ __('admin.change_already_reviewed') }}
                        </div>
                        
                        <div class="modern-info-row">
                            <div class="modern-info-label">{{ __('admin.status') }}:</div>
                            <div class="modern-info-value">
                                @if($pendingChange->isApproved())
                                    <span class="modern-badge badge-success">{{ __('admin.approved') }}</span>
                                @else
                                    <span class="modern-badge badge-danger">{{ __('admin.rejected') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        @if($pendingChange->reviewedBy)
                            <div class="modern-info-row">
                                <div class="modern-info-label">{{ __('admin.reviewed_by') }}:</div>
                                <div class="modern-info-value">{{ $pendingChange->reviewedBy->name }}</div>
                            </div>
                        @endif
                        
                        @if($pendingChange->reviewed_at)
                            <div class="modern-info-row">
                                <div class="modern-info-label">{{ __('admin.reviewed_at') }}:</div>
                                <div class="modern-info-value">{{ $pendingChange->reviewed_at->locale(app()->getLocale())->translatedFormat('M d, Y H:i') }}</div>
                            </div>
                        @endif
                        
                        @if($pendingChange->review_notes)
                            <div class="mt-3">
                                <div class="modern-info-label mb-2">{{ __('admin.review_notes') }}:</div>
                                <div class="modern-info-value p-3 bg-light rounded">
                                    {{ $pendingChange->review_notes }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
