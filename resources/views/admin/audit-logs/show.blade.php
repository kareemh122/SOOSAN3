@extends('layouts.admin')

@section('title', __('audit-logs.show.title'))

@push('styles')
<style>
    /* Modern Container */
    .modern-audit-show-container {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1rem;
        color: #1a202c;
        line-height: 1.6;
    }
    .dark-mode .modern-audit-show-container {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        color: #f7fafc;
    }

    /* Modern Page Header */
    .modern-audit-show-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .modern-audit-show-header::before {
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
    .modern-audit-show-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    .modern-audit-show-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Modern Cards */
    .modern-audit-show-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .modern-audit-show-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .dark-mode .modern-audit-show-card {
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
    .modern-btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
    }
    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px -5px rgba(108, 117, 125, 0.4);
    }

    /* Table Enhancements */
    .modern-info-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .modern-info-table tr {
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        transition: background-color 0.3s ease;
    }
    .modern-info-table tr:hover {
        background: rgba(102, 126, 234, 0.05);
    }
    .dark-mode .modern-info-table tr {
        border-bottom-color: rgba(74, 85, 104, 0.5);
    }
    .dark-mode .modern-info-table tr:hover {
        background: rgba(102, 126, 234, 0.1);
    }
    .modern-info-table th {
        padding: 1rem 0.75rem;
        font-weight: 600;
        color: #374151;
        text-align: left;
        width: 35%;
        vertical-align: top;
    }
    .dark-mode .modern-info-table th {
        color: #f7fafc;
    }
    .modern-info-table td {
        padding: 1rem 0.75rem;
        color: #1a202c;
        word-break: break-word;
    }
    .dark-mode .modern-info-table td {
        color: #f7fafc;
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

    /* JSON Display */
    .modern-json-display {
        background: rgba(248, 250, 252, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.5);
        border-radius: 12px;
        padding: 1rem;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        font-size: 0.875rem;
        line-height: 1.5;
        overflow-x: auto;
        max-height: 300px;
        overflow-y: auto;
    }
    .dark-mode .modern-json-display {
        background: rgba(45, 55, 72, 0.8);
        border-color: rgba(74, 85, 104, 0.5);
        color: #f7fafc;
    }

    /* Comparison Table */
    .modern-comparison-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .modern-comparison-table thead th {
        background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
        color: #ffffff;
        border: none;
        padding: 1rem 0.75rem;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .modern-comparison-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
    }
    .modern-comparison-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
    }
    .dark-mode .modern-comparison-table tbody tr {
        border-bottom-color: rgba(74, 85, 104, 0.5);
    }
    .dark-mode .modern-comparison-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.1);
    }
    .modern-comparison-table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
    }

    /* Value Changes */
    .value-old {
        color: #dc2626;
        font-weight: 500;
        background: rgba(220, 38, 38, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        display: inline-block;
    }
    .value-new {
        color: #059669;
        font-weight: 500;
        background: rgba(5, 150, 105, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        display: inline-block;
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
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modern-audit-show-container {
            padding: 0.75rem;
        }
        .modern-audit-show-header {
            margin: -0.75rem -0.75rem 1.5rem;
            padding: 1.5rem 1rem;
        }
        .modern-audit-show-header h1 {
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
        .modern-info-table th,
        .modern-info-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }
        .modern-info-table th {
            width: 40%;
        }
        .modern-comparison-table thead th,
        .modern-comparison-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }
        .modern-json-display {
            font-size: 0.75rem;
            padding: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .modern-audit-show-header h1 {
            font-size: 1.125rem;
        }
        .modern-info-table th,
        .modern-info-table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.75rem;
        }
        .modern-comparison-table thead th,
        .modern-comparison-table tbody td {
            padding: 0.5rem 0.25rem;
            font-size: 0.75rem;
        }
        .modern-json-display {
            font-size: 0.7rem;
            padding: 0.5rem;
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
<div class="modern-audit-show-container">
    <!-- Modern Header -->
    <div class="modern-audit-show-header">
<div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1>
                        <i class="fas fa-eye"></i>
                        {{ __('audit-logs.show.title') }}
                    </h1>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('admin.audit-logs.index') }}" class="modern-btn modern-btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        {{ __('audit-logs.show.back_to_logs') }}
        </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Basic Information Card -->
        <div class="col-lg-6 mb-4">
            <div class="modern-audit-show-card fade-in-up">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-info-circle text-primary"></i>
                        {{ __('audit-logs.show.basic_info') }}
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <table class="modern-info-table">
                        <tr>
                            <th>{{ __('audit-logs.show.event') }}</th>
                            <td>
                                @php
                                    $eventColors = [
                                        'created' => 'success',
                                        'updated' => 'warning',
                                        'deleted' => 'danger'
                                    ];
                                    $color = $eventColors[$auditLog->event] ?? 'secondary';
                                @endphp
                                <span class="modern-badge bg-{{ $color }}">
                                    <i class="fas fa-{{ $auditLog->event == 'created' ? 'plus' : ($auditLog->event == 'updated' ? 'edit' : 'trash') }}"></i>
                                    {{ __('audit-logs.table.events.' . $auditLog->event) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.model_type') }}</th>
                            <td>
                                <span class="fw-bold">{{ class_basename($auditLog->auditable_type) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.record_id') }}</th>
                            <td>
                                <code class="bg-light px-2 py-1 rounded">{{ $auditLog->auditable_id }}</code>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.user') }}</th>
                            <td>
                                @if($auditLog->user)
                                    <div class="d-flex align-items-center">
                                        <div class="modern-avatar bg-primary me-2" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 14px;">
                                            {{ substr($auditLog->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $auditLog->user->name }}</div>
                                            <small class="text-muted">#{{ $auditLog->user->id }}</small>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">{{ __('audit-logs.table.system') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.datetime') }}</th>
                            <td>
                                <div>
                                    <div class="fw-bold">{{ $auditLog->created_at->format('M d, Y \a\t g:i A') }}</div>
                                    <small class="text-muted">{{ $auditLog->created_at->diffForHumans() }}</small>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.table.columns.ip_address') }}</th>
                            <td>
                                <code class="bg-light px-2 py-1 rounded">{{ $auditLog->ip_address ?? __('audit-logs.table.na') }}</code>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.method') }}</th>
                            <td>
                                <span class="badge bg-secondary">{{ $auditLog->method ?? __('audit-logs.table.na') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.url') }}</th>
                            <td>
                                <code class="bg-light px-2 py-1 rounded" style="word-break: break-all;">{{ $auditLog->url ?? __('audit-logs.table.na') }}</code>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('audit-logs.show.user_agent') }}</th>
                            <td>
                                <small class="text-muted" style="word-break: break-all;">{{ Str::limit($auditLog->user_agent, 100) ?? __('audit-logs.table.na') }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Changes Card -->
        <div class="col-lg-6 mb-4">
            @if($auditLog->old_values || $auditLog->new_values)
            <div class="modern-audit-show-card fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-exchange-alt text-primary"></i>
                        {{ __('audit-logs.show.data_changes') }}
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    @if($auditLog->old_values && $auditLog->event === 'updated')
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-minus-circle text-danger me-2"></i>
                        {{ __('audit-logs.modal.old_values') }}
                    </h6>
                    <div class="modern-json-display mb-3">
                        <pre class="mb-0">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                    @endif

                    @if($auditLog->new_values)
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-plus-circle text-success me-2"></i>
                        {{ $auditLog->event === 'updated' ? __('audit-logs.modal.new_values') : __('audit-logs.modal.new_values') }}
                    </h6>
                    <div class="modern-json-display">
                        <pre class="mb-0">{{ json_encode($auditLog->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                    @endif

                    @if($auditLog->old_values && $auditLog->event === 'deleted')
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-trash text-danger me-2"></i>
                        {{ __('audit-logs.modal.deleted_values') }}
                    </h6>
                    <div class="modern-json-display">
                        <pre class="mb-0">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Field Comparison Table -->
    @if($auditLog->event === 'updated' && $auditLog->old_values && $auditLog->new_values)
    <div class="row">
        <div class="col-12">
            <div class="modern-audit-show-card fade-in-up" style="animation-delay: 0.2s;">
                <div class="card-header" style="background: rgba(248, 250, 252, 0.8); border-bottom: 1px solid rgba(226, 232, 240, 0.5); padding: 1.5rem;">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-table text-primary"></i>
                        {{ __('audit-logs.show.field_comparison') }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="modern-comparison-table">
                            <thead>
                                <tr>
                                    <th>{{ __('audit-logs.show.field') }}</th>
                                    <th>{{ __('audit-logs.show.old_value') }}</th>
                                    <th>{{ __('audit-logs.show.new_value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditLog->new_values as $field => $newValue)
                                <tr>
                                    <td>
                                        <strong>{{ $field }}</strong>
                                    </td>
                                    <td>
                                        <span class="value-old">
                                            {{ $auditLog->old_values[$field] ?? __('audit-logs.table.na') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="value-new">
                                            {{ $newValue }}
                                        </span>
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
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth hover effects
    const cards = document.querySelectorAll('.modern-audit-show-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection
