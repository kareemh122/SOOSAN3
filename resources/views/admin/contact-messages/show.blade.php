@extends('layouts.admin')

@section('title', __('contact-messages.view_message'))

@section('content')
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

    /* Cards */
    .modern-card {
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: none;
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

    .admin-card {
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
        transition: var(--transition);
        position: relative;
    }

    .admin-card::before {
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

    .admin-card:hover::before {
        transform: scaleX(1);
    }

    /* Message Avatar */
    .message-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 3rem;
        margin: 0 auto 1.5rem;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .message-avatar-large::before {
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

    .message-avatar-large:hover {
        transform: scale(1.05) rotate(5deg);
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.4);
    }

    .message-avatar-large:hover::before {
        opacity: 1;
        animation: shimmer 1.5s ease-in-out;
    }

    /* Buttons */
    .btns-section {
        @if(app()->getLocale() === 'en')
            justify-content: flex-end;
        @endif
    }
    .modern-btn {
        background: var(--primary-gradient);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
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
        color: white;
        text-decoration: none;
    }

    .modern-btn:active {
        transform: translateY(-1px);
    }

    .modern-btn-secondary {
        background: var(--secondary-gradient);
    }

    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px rgba(108, 117, 125, 0.3);
    }

    .modern-btn-success {
        background: var(--success-gradient);
    }

    .modern-btn-success:hover {
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
    }

    .modern-btn-danger {
        background: var(--danger-gradient);
    }

    .modern-btn-danger:hover {
        box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3);
    }

    .modern-btn-info {
        background: var(--info-gradient);
    }

    .modern-btn-info:hover {
        box-shadow: 0 10px 25px rgba(23, 162, 184, 0.3);
    }

    /* Info Rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
        transition: var(--transition);
    }

    .info-row:last-child {
        border-bottom: none;
    }
    h5 i {
    @if(app()->getLocale() === 'ar')
        margin-left: 10px;
    @else
        margin-right: 10px;
    @endif
    }

    .info-row:hover {
        background-color: #f8f9fa;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-radius: var(--border-radius-sm);
        transform: translateX(5px);
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        color: black;
        text-align: right;
        flex-shrink: 0;
    }
    .info-value span {
        color: white;
    }

    /* Message Content */
    .message-content {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border: 1px solid #e9ecef;
        border-radius: var(--border-radius);
        padding: 2rem;
        margin: 1.5rem 0;
        position: relative;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        transition: var(--transition);
        color: black;
    }

    .message-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
        background: var(--primary-gradient);
        border-radius: 2px 0 0 2px;
    }

    .message-content:hover {
        transform: translateY(-1px);
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Badge Modern */
    .badge-modern {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: var(--transition);
    }

    .badge-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Table Enhancements */
    .table-borderless td {
        padding: 0.75rem 0;
        border: none;
        transition: var(--transition);
    }

    .table-borderless tr:hover td {
        background-color: #f8f9fa;
        border-radius: var(--border-radius-sm);
        transform: translateX(5px);
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .modern-page-header {
            padding: 2rem 0;
            margin: -1rem -1rem 1.5rem;
        }

        .modern-page-header h1 {
            font-size: 1.5rem;
        }

        .modern-page-header .row > div {
            text-align: center;
            margin-bottom: 1rem;
        }

        .modern-page-header .col-md-4 {
            text-align: center !important;
        }

        .message-avatar-large {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .admin-card .card-body,
        .admin-card .card-header {
            padding: 1rem;
        }

        .modern-btn {
            width: 100%;
            justify-content: center;
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        .d-flex.justify-content-between {
            gap: 1rem;
        }

        .d-flex.justify-content-end {
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
            padding: 0.75rem 0;
        }

        .info-value {
            text-align: left;
            margin-left: 1rem;
        }

        .message-content {
            padding: 1.5rem;
            margin: 1rem 0;
        }

        .table-borderless td {
            padding: 0.5rem 0;
        }

        .row .col-md-6 {
            margin-bottom: 1.5rem;
        }


    }

    @media (max-width: 576px) {
        .modern-page-header {
            margin: -0.5rem -0.5rem 1rem;
            padding: 1.5rem 0;
        }

        .message-avatar-large {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .admin-card {
            margin-bottom: 1rem;
        }

        .admin-card .card-body,
        .admin-card .card-header {
            padding: 0.75rem;
        }

        .modern-btn {
            padding: 0.625rem 1rem;
            font-size: 0.8rem;
        }

        .message-content {
            padding: 1rem;
            font-size: 0.9rem;
        }

        .info-row {
            padding: 0.5rem 0;
        }

        .badge-modern {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }


    }

    @media (max-width: 375px) {
        .modern-page-header {
            padding: 1rem 0;
        }

        .message-avatar-large {
            width: 70px;
            height: 70px;
            font-size: 1.75rem;
        }

        .admin-card .card-body,
        .admin-card .card-header {
            padding: 0.5rem;
        }

        .modern-btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
        }

        .message-content {
            padding: 0.75rem;
            font-size: 0.85rem;
        }
    }

    /* Tablet Optimizations */
    @media (min-width: 768px) and (max-width: 1024px) {
        .modern-page-header {
            padding: 2.5rem 0;
        }

        .message-avatar-large {
            width: 110px;
            height: 110px;
            font-size: 2.75rem;
        }

        .modern-btn {
            padding: 0.75rem 1.25rem;
        }
    }

    /* Animation Classes */
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

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .modern-btn:hover,
        .modern-card:hover,
        .admin-card:hover,
        .info-row:hover,
        .message-content:hover {
            transform: none;
        }

        .modern-btn:active {
            transform: scale(0.95);
        }

        .message-avatar-large:active {
            transform: scale(0.95);
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
        .admin-card {
            border: 2px solid #000;
        }

        .message-content {
            border: 2px solid #000;
        }
    }

    /* Focus indicators for accessibility */
    .modern-btn:focus-visible {
        outline: 2px solid #667eea;
        outline-offset: 2px;
    }
</style>

<!-- Page Header -->
<div class="modern-page-header animate-fade-in-up">
    <div class="container-fluid position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-2">{{ __('contact-messages.message_details') }}</h1>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.contact-messages.index') }}" class="modern-btn modern-btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    {{ __('contact-messages.back_to_messages') }}
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

<div class="admin-card animate-stagger">
    <div class="card-header bg-white border-bottom p-4">
        <h4 class="mb-1" style="color: #7c7777;">{{ __('contact-messages.contact_message_number', ['id' => $contactMessage->id]) }}</h4>
        <div class="text-center">
            <div class="message-avatar-large">
                {{ strtoupper(substr($contactMessage->first_name, 0, 1)) }}{{ strtoupper(substr($contactMessage->last_name, 0, 1)) }}
            </div>
            <p class="text-muted mb-3" style="text-transform: capitalize;font-size: 1.95rem; font-weight: bold;">
                {{ $contactMessage->first_name }} {{ $contactMessage->last_name }}
            </p>
            <span class="badge-modern bg-{{ $contactMessage->is_read ? 'success' : 'warning' }}">
                <i class="fas fa-{{ $contactMessage->is_read ? 'envelope-open' : 'envelope' }} me-1"></i>
                    {{ $contactMessage->is_read ? __('contact-messages.read_status') : __('contact-messages.unread_status') }}
            </span>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold mb-3" style="color: var(--bs-secondary-color);">
                    <i class="fas fa-user me-2" style="color: var(--primary-gradient);"></i>
                    {{ __('contact-messages.sender_information') }}
                </h5>
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-id-card text-info"></i>
                        {{ __('contact-messages.name') }}:
                    </span>
                    <span class="info-value">{{ $contactMessage->first_name }} {{ $contactMessage->last_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-envelope text-primary"></i>
                        {{ __('contact-messages.email') }}:
                    </span>
                    <span class="info-value">
                        <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                            {{ $contactMessage->email }}
                        </a>
                    </span>
                </div>
                @if($contactMessage->phone)
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-phone text-success"></i>
                        {{ __('contact-messages.phone') }}:
                    </span>
                    <span class="info-value">
                        <a href="tel:{{ $contactMessage->phone }}" class="text-decoration-none">
                            {{ $contactMessage->phone }}
                        </a>
                    </span>
                </div>
                @endif
                @if($contactMessage->company)
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-building text-secondary"></i>
                        {{ __('contact-messages.company') }}:
                    </span>
                    <span class="info-value">{{ $contactMessage->company }}</span>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold mb-3" style="color: var(--bs-secondary-color);">
                    <i class="fas fa-info-circle me-2" style="color: var(--primary-gradient);"></i>
                    {{ __('contact-messages.message_information') }}
                </h6>
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-comment-alt text-warning"></i>
                        {{ __('contact-messages.subject') }}:
                    </span>
                    <span class="info-value">{{ $contactMessage->subject ?? __('contact-messages.no_subject') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-clock text-info"></i>
                        {{ __('contact-messages.received') }}:
                    </span>
                    <span class="info-value">
                        @if(app()->getLocale() === 'ar' && $contactMessage->created_at)
                            {{
                                \Carbon\Carbon::parse($contactMessage->created_at)
                                    ->translatedFormat('d F Y \الساعة H:i')
                            }}
                        @else
                            {{ $contactMessage->created_at ? $contactMessage->created_at->format('M d, Y \a\t H:i') : __('contact-messages.na') }}
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">
                        <i class="fas fa-eye text-secondary"></i>
                        {{ __('contact-messages.status') }}:
                    </span>
                    <span class="info-value">
                        <span class="badge-modern bg-{{ $contactMessage->is_read ? 'success' : 'warning' }}">
                            <i class="fas fa-{{ $contactMessage->is_read ? 'envelope-open' : 'envelope' }} me-1"></i>
                            {{ $contactMessage->is_read ? __('contact-messages.read_status') : __('contact-messages.unread_status') }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <h5 class="fw-bold mb-3" style="font-size: 1.3rem; color: var(--bs-secondary-color);">
                <i class="fas fa-comment-dots me-2" style="color: var(--primary-gradient);"></i>
                {{ __('contact-messages.message_content') }}
            </h6>
            <div class="message-content">
                {{ $contactMessage->message }}
            </div>
        </div>

        <div class="d-flex btns-section gap-2">
            @if(!$contactMessage->is_read && auth()->user()->isAdmin())
                <form action="{{ route('admin.contact-messages.mark-read', $contactMessage) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="modern-btn modern-btn-success">
                        <i class="fas fa-check me-2"></i>
                        {{ __('contact-messages.mark_as_read') }}
                    </button>
                </form>
            @endif

            <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}" class="modern-btn modern-btn-info">
                <i class="fas fa-reply me-2"></i>
                {{ __('contact-messages.reply_via_email') }}
            </a>

            @if(auth()->user()->isAdmin())
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('contact-messages.confirm_delete_simple') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modern-btn modern-btn-danger">
                        <i class="fas fa-trash me-2"></i>
                        {{ __('contact-messages.delete') }}
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on load
    const animatedElements = document.querySelectorAll('.animate-stagger');
    animatedElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';

        setTimeout(() => {
            element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Enhanced info row interactions
    document.querySelectorAll('.info-row').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
            this.style.backgroundColor = '#f8f9fa';
            this.style.paddingLeft = '1rem';
            this.style.paddingRight = '1rem';
            this.style.borderRadius = '0.5rem';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.backgroundColor = 'transparent';
            this.style.paddingLeft = '0';
            this.style.paddingRight = '0';
        });
    });

    // Enhanced button interactions
    document.querySelectorAll('.modern-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Message content interaction
    const messageContent = document.querySelector('.message-content');
    if (messageContent) {
        messageContent.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = 'inset 0 2px 4px rgba(0,0,0,0.05), 0 10px 25px rgba(0,0,0,0.15)';
        });

        messageContent.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'inset 0 2px 4px rgba(0,0,0,0.05)';
        });
    }

    // Touch device optimizations
    if ('ontouchstart' in window) {
        document.querySelectorAll('.modern-btn, .message-avatar-large').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = this.style.transform.replace('scale(1.02)', '') + ' scale(0.95)';
            });

            element.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.transform = this.style.transform.replace(' scale(0.95)', '');
                }, 100);
            });
        });
    }

    // Keyboard navigation support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close any open alerts
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }

        // Quick actions with keyboard shortcuts
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'r':
                    e.preventDefault();
                    // Focus on reply button
                    const replyBtn = document.querySelector('a[href^="mailto:"]');
                    if (replyBtn) replyBtn.click();
                    break;
                case 'Backspace':
                    e.preventDefault();
                    // Go back to messages list
                    window.location.href = "{{ route('admin.contact-messages.index') }}";
                    break;
            }
        }
    });

    // Auto-mark as read if unread (after 3 seconds of viewing)
    @if(!$contactMessage->is_read && auth()->user()->isAdmin())
        setTimeout(() => {
            const markReadForm = document.querySelector('form[action*="mark-read"]');
            if (markReadForm) {
                // Add visual indicator before auto-marking
                const submitBtn = markReadForm.querySelector('button');
                if (submitBtn) {
                    submitBtn.style.animation = 'pulse 1s ease-in-out';
                    setTimeout(() => {
                        markReadForm.submit();
                    }, 1000);
                }
            }
        }, 3000);
    @endif

    // Add pulse animation for auto-mark functionality
    const style = document.createElement('style');
    style.textContent =
    `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
