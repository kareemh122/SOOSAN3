@extends('layouts.admin')

@section('title', __('users.view_user'))

@section('content')
<style>
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
    .modern-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 2rem;
        overflow: hidden;
    }
    .modern-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .modern-btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px rgba(108, 117, 125, 0.4);
    }
    .modern-btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #212529;
    }
    .modern-btn-warning:hover {
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
        color: #212529;
    }
    .user-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 3rem;
        margin: 0 auto 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    .info-section {
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 1rem;
        margin-bottom: 2rem;
    }
    .info-section h4 {
        color: #495057;
        margin-bottom: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-table {
        width: 100%;
        border-collapse: collapse;
    }
    .info-table tr {
        border-bottom: 1px solid #e9ecef;
    }
    .info-table tr:last-child {
        border-bottom: none;
    }
    .info-table td {
        padding: 0.875rem 0;
        vertical-align: top;
    }
    .info-table td:first-child {
        font-weight: 600;
        color: #495057;
        width: 35%;
    }
    .info-table td:last-child {
        color: #6c757d;
    }
    .modern-badge {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    .modern-badge.success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }
    .modern-badge.warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #212529;
    }
    .modern-badge.danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    .modern-badge.primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }
    .modern-badge.secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
    }
    .status-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
    }
    .status-card h5 {
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .status-card .status-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: white;
    }
    .status-active .status-icon {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    .status-inactive .status-icon {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    .status-admin .status-icon {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }
    .status-employee .status-icon {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
</style>

<!-- Page Header -->
<div class="modern-page-header">
    <div class="container-fluid position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">{{ __('users.view_user') }}</h1>
                <p class="mb-0 opacity-75">{{ __('users.view_user_description') }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.users.edit', $user) }}" class="modern-btn modern-btn-warning me-2">
                    <i class="fas fa-edit"></i>
                    {{ __('users.edit') }}
                </a>
                <a href="{{ route('admin.users.index') }}" class="modern-btn modern-btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('users.back_to_users') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- User Profile Card -->
    <div class="col-lg-4">
        <div class="modern-card">
            <div class="card-body text-center p-4">
                <div class="user-avatar-large overflow-hidden bg-light">
                    @if($user->image_url)
                        <img src="{{ asset($user->image_url) }}"
                            alt="{{ $user->name }}"
                            class="w-100 h-100 object-fit-cover"
                            style="border-radius:50%;"
                            onerror="this.onerror=null;this.src='{{ asset('images/fallback-user.png') }}';">
                    @else
                        <img src="{{ asset('images/fallback-user.png') }}"
                            alt="Default User"
                            class="w-100 h-100 object-fit-cover"
                            style="border-radius:50%;">
                    @endif
                </div>
                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="status-card status-{{ $user->is_verified ? 'active' : 'inactive' }}">
                            <div class="status-icon">
                                <i class="fas fa-{{ $user->is_verified ? 'check-circle' : 'times-circle' }}"></i>
                            </div>
                            <h5>{{ __('users.status') }}</h5>
                            <span class="modern-badge {{ $user->is_verified ? 'success' : 'secondary' }}">
                                {{ $user->is_verified ? __('users.active') : __('users.inactive') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="status-card status-{{ $user->role }}">
                            <div class="status-icon">
                                <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : 'user' }}"></i>
                            </div>
                            <h5>{{ __('users.role') }}</h5>
                            <span class="modern-badge {{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                {{ __('users.' . $user->role) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Details -->
    <div class="col-lg-8">
        <div class="modern-card">
            <div class="card-body p-0">
                <!-- Account Information -->
                <div class="info-section">
                    <h4>
                        <i class="fas fa-user-circle text-primary"></i>
                        {{ __('users.account_information') }}
                    </h4>
                    <table class="info-table">
                        <tr>
                            <td>{{ __('users.name') }}:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('users.email') }}:</td>
                            <td>
                                {{ $user->email }}
                                @if($user->email_verified_at)
                                    <span class="modern-badge success ms-2">
                                        <i class="fas fa-check"></i> {{ __('users.verified') }}
                                    </span>
                                @else
                                    <span class="modern-badge warning ms-2">
                                        <i class="fas fa-exclamation-triangle"></i> {{ __('users.unverified') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('users.role') }}:</td>
                            <td>
                                <span class="modern-badge {{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                    <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : 'user' }}"></i>
                                    {{ __('users.' . $user->role) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('users.account_status') }}:</td>
                            <td>
                                @if($user->is_verified)
                                    <span class="modern-badge success">
                                        <i class="fas fa-check-circle"></i> {{ __('users.active') }}
                                    </span>
                                @else
                                    <span class="modern-badge secondary">
                                        <i class="fas fa-times-circle"></i> {{ __('users.inactive') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Account Timeline -->
                <div class="info-section">
                    <h4>
                        <i class="fas fa-clock text-info"></i>
                        {{ __('users.account_timeline') }}
                    </h4>
                    <table class="info-table">
                        <tr>
                            <td>{{ __('users.created_at') }}:</td>
                            <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('users.updated_at') }}:</td>
                            <td>{{ $user->updated_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        @if($user->email_verified_at)
                        <tr>
                            <td>{{ __('users.email_verified_at') }}:</td>
                            <td>{{ $user->email_verified_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        @endif
                        @if($user->created_by)
                        <tr>
                            <td>{{ __('users.created_by') }}:</td>
                            <td>{{ $user->createdBy->name ?? __('users.system') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <!-- Activity Summary -->
                <div class="info-section">
                    <h4>
                        <i class="fas fa-chart-line text-success"></i>
                        {{ __('users.activity_summary') }}
                    </h4>
                    <table class="info-table">
                        <tr>
                            <td>{{ __('users.last_login') }}:</td>
                            <td>{{ $user->last_login_at ? $user->last_login_at->format('M d, Y h:i A') : __('users.never') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('users.login_count') }}:</td>
                            <td>{{ $user->login_count ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('users.last_ip') }}:</td>
                            <td>{{ $user->last_ip ?? __('users.na') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('users.registration_date') }}:</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
