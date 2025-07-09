@extends('layouts.admin')

@section('title', __('users.edit_user'))

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
    }
    .modern-form-group {
        margin-bottom: 1.5rem;
    }
    .modern-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }
    .modern-input {
        width: 100%;
        padding: 0.875rem 1.125rem;
        border: 2px solid #e9ecef;
        border-radius: 0.75rem;
        background: #fff;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    .modern-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: translateY(-1px);
    }
    .modern-input.is-invalid {
        border-color: #dc3545;
    }
    .modern-select {
        width: 100%;
        padding: 0.875rem 1.125rem;
        border: 2px solid #e9ecef;
        border-radius: 0.75rem;
        background: #fff;
        transition: all 0.3s ease;
        font-size: 1rem;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    .modern-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .modern-checkbox {
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 0.75rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .modern-checkbox:hover {
        border-color: #667eea;
        background: #f0f4ff;
    }
    .modern-checkbox input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #667eea;
        border-radius: 0.375rem;
        background: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .modern-checkbox input[type="checkbox"]:checked {
        background: #667eea;
        border-color: #667eea;
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
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
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
    .focused {
        transform: translateY(-2px);
    }
    .password-help {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
</style>

<!-- Page Header -->
<div class="modern-page-header">
    <div class="container-fluid position-relative">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">{{ __('users.edit_user') }}</h1>
                <p class="mb-0 opacity-75">{{ __('users.edit_user_description') }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.users.index') }}" class="modern-btn modern-btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('users.back_to_users') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="modern-card">
            <div class="card-body p-4">
                <!-- User Avatar -->
                <div class="text-center mb-4">
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modern-form-group">
                                <label for="name" class="modern-label">
                                    {{ __('users.name') }} <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="modern-input @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    required
                                    placeholder="{{ __('users.name_placeholder') }}"
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="modern-form-group">
                                <label for="email" class="modern-label">
                                    {{ __('users.email') }} <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    class="modern-input @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email', $user->email) }}" 
                                    required
                                    placeholder="{{ __('users.email_placeholder') }}"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modern-form-group">
                                <label for="password" class="modern-label">
                                    {{ __('users.new_password') }}
                                </label>
                                <input 
                                    type="password" 
                                    class="modern-input @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password"
                                    placeholder="{{ __('users.new_password_placeholder') }}"
                                >
                                <small class="password-help">{{ __('users.password_help') }}</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="modern-form-group">
                                <label for="password_confirmation" class="modern-label">
                                    {{ __('users.confirm_password') }}
                                </label>
                                <input 
                                    type="password" 
                                    class="modern-input" 
                                    id="password_confirmation" 
                                    name="password_confirmation"
                                    placeholder="{{ __('users.confirm_password_placeholder') }}"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modern-form-group">
                                <label for="role" class="modern-label">
                                    {{ __('users.role') }} <span class="text-danger">*</span>
                                </label>
                                <select class="modern-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">{{ __('users.select_role') }}</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        {{ __('users.admin') }}
                                    </option>
                                    <option value="employee" {{ old('role', $user->role) === 'employee' ? 'selected' : '' }}>
                                        {{ __('users.employee') }}
                                    </option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="modern-form-group">
                                <label class="modern-label">{{ __('users.account_status') }}</label>
                                <div class="modern-checkbox">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="is_verified" 
                                        name="is_verified" 
                                        {{ old('is_verified', $user->is_verified) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="is_verified">
                                        <strong>{{ __('users.account_verified') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ __('users.account_verified_description') }}</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.users.index') }}" class="modern-btn modern-btn-secondary">
                                    <i class="fas fa-times"></i>
                                    {{ __('users.cancel') }}
                                </a>
                                <button type="submit" class="modern-btn">
                                    <i class="fas fa-save"></i>
                                    {{ __('users.update_user') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('editUserForm');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    
    form.addEventListener('submit', function(e) {
        if (passwordField.value && passwordField.value !== confirmPasswordField.value) {
            e.preventDefault();
            alert('{{ __('users.passwords_do_not_match') }}');
            confirmPasswordField.focus();
        }
    });
    
    // Password confirmation validation
    confirmPasswordField.addEventListener('input', function() {
        if (passwordField.value && this.value && passwordField.value !== this.value) {
            this.setCustomValidity('{{ __('users.passwords_do_not_match') }}');
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Enhanced focus effects
    const inputs = document.querySelectorAll('.modern-input, .modern-select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});
</script>
@endsection
