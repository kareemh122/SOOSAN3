@extends('layouts.admin')

@section('title', __('owners.edit_owner'))

@section('content')
<style>
/* Reset and prevent inheritance from global styles */
.owners-edit-container * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.owners-edit-container {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
    min-height: 100vh;
    padding: 1rem;
    color: #1f2937;
    line-height: 1.6;
    animation: fadeInPage 0.6s ease-out;
}

@keyframes fadeInPage {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Header */
.owners-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 1.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    position: relative;
    overflow: hidden;
    animation: slideInDown 0.6s ease-out;
}

@keyframes slideInDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.owners-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    animation: pulse 4s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.owners-header h1 {
    font-size: clamp(1.75rem, 4vw, 2.25rem);
    font-weight: 700;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    z-index: 2;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

@keyframes fadeInUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.owners-header h1 i {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
    60% { transform: translateY(-3px); }
}

.owners-header p {
    opacity: 0.9;
    font-size: clamp(0.95rem, 2.5vw, 1.1rem);
    margin: 0;
    position: relative;
    z-index: 2;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Enhanced Card */
.owners-card {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(229, 231, 235, 0.6);
    overflow: hidden;
    transition: all 0.3s ease;
    animation: slideInUp 0.8s ease-out 0.3s both;
}

@keyframes slideInUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.owners-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.owners-form {
    padding: 2rem;
}

.owners-form-group {
    margin-bottom: 1.75rem;
    animation: fadeInUp 0.6s ease-out;
}

.owners-form-group:last-child {
    margin-bottom: 0;
}

.owners-form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #374151;
    font-size: 0.875rem;
    letter-spacing: 0.025em;
    position: relative;
}

/* Enhanced Form Controls */
.owners-form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    background-color: #fff;
    color: #1f2937;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-family: inherit;
    position: relative;
}

.owners-form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    background-color: #fff;
    transform: translateY(-1px);
}

.owners-form-control:hover:not(:focus) {
    border-color: #d1d5db;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.owners-form-control.is-invalid {
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.owners-invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: block;
    animation: slideInUp 0.3s ease-out;
    padding-left: 0.5rem;
}

/* Enhanced Form Layout */
.owners-form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.75rem;
}

/* Form Actions */
.owners-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 2rem;
    border-top: 1px solid #e5e7eb;
    margin: 2rem -2rem -2rem -2rem;
    background: linear-gradient(135deg, #f8fafc, #ffffff);
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

/* Enhanced Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.875rem 2rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.btn-primary:active {
    transform: translateY(-1px) scale(0.98);
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
}

.btn-secondary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 25px rgba(107, 114, 128, 0.4);
    color: white;
    text-decoration: none;
}

/* Enhanced Alerts */
.alert {
    padding: 1.25rem 1.75rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    border: 1px solid transparent;
    animation: slideInDown 0.5s ease-out;
    position: relative;
    overflow: hidden;
}

.alert::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 4px;
    background: currentColor;
}

.alert-success {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    border-color: #a7f3d0;
    color: #065f46;
}

.alert-danger {
    background: linear-gradient(135deg, #fef2f2, #fecaca);
    border-color: #fca5a5;
    color: #991b1b;
}

.alert ul {
    margin: 0;
    padding-left: 1.25rem;
}

.alert li {
    margin-bottom: 0.5rem;
}

.alert li:last-child {
    margin-bottom: 0;
}

/* Enhanced Textarea */
.owners-form-control[rows] {
    resize: vertical;
    min-height: 120px;
    transition: min-height 0.3s ease;
}

.owners-form-control[rows]:focus {
    min-height: 140px;
}

/* Enhanced Select */
select.owners-form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
    cursor: pointer;
}

select.owners-form-control:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
}

/* Loading States */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn .fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Form Section Enhancements */
.owners-form-section {
    background: linear-gradient(135deg, #f8fafc, #ffffff);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-left: 4px solid #667eea;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.owners-form-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.owners-form-section h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.owners-form-section h3 i {
    color: #667eea;
    transition: transform 0.3s ease;
}

.owners-form-section:hover h3 i {
    transform: scale(1.1) rotate(5deg);
}

/* Required Indicator */
.owners-required {
    color: #ef4444;
    margin-left: 0.25rem;
    font-weight: 700;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .owners-form-row {
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }
}

@media (max-width: 768px) {
    .owners-edit-container {
        padding: 0.75rem;
    }
    
    .owners-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .owners-form {
        padding: 1.5rem;
    }
    
    .owners-form-actions {
        flex-direction: column;
        padding: 1.5rem;
        margin: 1.5rem -1.5rem -1.5rem -1.5rem;
        gap: 0.75rem;
    }
    
    .btn {
        padding: 1rem 1.5rem;
        width: 100%;
        justify-content: center;
    }
    
    .owners-form-control {
        padding: 0.875rem 1rem;
        font-size: 0.9rem;
    }
    
    .owners-form-group {
        margin-bottom: 1.5rem;
    }
    
    .owners-form-section {
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 480px) {
    .owners-edit-container {
        padding: 0.5rem;
    }
    
    .owners-header {
        padding: 1.25rem;
        border-radius: 1rem;
    }
    
    .owners-card {
        border-radius: 1rem;
    }
    
    .owners-form {
        padding: 1.25rem;
    }
    
    .owners-form-actions {
        padding: 1.25rem;
        margin: 1.25rem -1.25rem -1.25rem -1.25rem;
    }
    
    .owners-form-control {
        padding: 0.75rem 0.875rem;
        border-radius: 8px;
    }
    
    .btn {
        padding: 0.875rem 1.25rem;
        border-radius: 8px;
        font-size: 0.8rem;
    }
    
    .owners-form-section {
        padding: 1rem;
        border-radius: 8px;
    }
    
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 8px;
    }
}

/* Focus Management */
.owners-form-control:focus + .form-icon {
    color: #667eea;
}

/* Smooth Transitions */
* {
    transition: all 0.3s ease;
}

/* Print Styles */
@media print {
    .owners-edit-container {
        background: white;
        padding: 0;
    }
    
    .owners-header {
        background: #667eea !important;
        color: white !important;
    }
    
    .owners-form-actions {
        display: none;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .owners-form-control {
        border-width: 3px;
    }
    
    .btn {
        border: 2px solid currentColor;
    }
}

/* Reduced Motion */
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

<div class="owners-edit-container">
    <div class="owners-header">
        <h1>
            <i class="fas fa-user-edit"></i>
            <span class="header-text">{{ __('owners.edit_owner') }}</span>
        </h1>
        <p>{{ __('owners.update_owner_info_system') }}</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-exclamation-triangle"></i> {{ __('owners.validation_errors') }}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="owners-card">
                <form method="POST" action="{{ route('admin.owners.update', $owner) }}" class="owners-form" id="ownerEditForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Company Image Upload Section -->
            <div class="owners-form-section" style="border-bottom: 1px solid #e5e7eb; padding-bottom: 2rem; margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: 600; color: #374151;">
                    <i class="fas fa-image text-primary"></i> {{ __('owners.company_logo') }}
                </h3>
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img id="companyImagePreview"
                             src="{{ $owner->company_image_url ? asset($owner->company_image_url) : asset('images/fallback-company.svg') }}"
                             alt="{{ __('owners.company_logo') }}"
                             class="rounded-circle shadow-sm"
                             style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #e5e7eb; background: #f9fafb;"
                             onerror="this.onerror=null;this.src='{{ asset('images/fallback-company.svg') }}';">
                    </div>
                    <div class="col-md-9">
                        <label for="company_image" class="btn btn-primary">
                            <i class="fas fa-upload"></i> {{ __('owners.upload_new_logo') }}
                        </label>
                        <input type="file" name="company_image" id="company_image" class="d-none" accept="image/*">

                        <p class="text-muted small mt-2">
                            {{ __('owners.image_supported_formats') }}
                        </p>
                        @error('company_image')
                            <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="owners-form-row">
                <div class="owners-form-group">
                    <label for="name">
                        <i class="fas fa-user"></i>
                        {{ __('owners.full_name') }} 
                        <span class="owners-required">{{ __('owners.required') }}</span>
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $owner->name) }}"
                           required
                           placeholder="{{ __('owners.enter_full_name') }}">
                    @error('name')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="owners-form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        {{ __('owners.email_address') }} 
                        <span class="owners-required">{{ __('owners.required') }}</span>
                    </label>
                    <input type="email" 
                           class="owners-form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $owner->email) }}"
                           required
                           placeholder="{{ __('owners.enter_email_example') }}">
                    @error('email')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="owners-form-row">
                <div class="owners-form-group">
                    <label for="phone_number">
                        <i class="fas fa-phone"></i>
                        {{ __('owners.phone_number') }}
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('phone_number') is-invalid @enderror" 
                           id="phone_number" 
                           name="phone_number" 
                           value="{{ old('phone_number', $owner->phone_number) }}"
                           placeholder="{{ __('owners.enter_phone') }}">
                    @error('phone_number')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="owners-form-group">
                    <label for="company">
                        <i class="fas fa-building"></i>
                        {{ __('owners.company') }}
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('company') is-invalid @enderror" 
                           id="company" 
                           name="company" 
                           value="{{ old('company', $owner->company) }}"
                           placeholder="{{ __('owners.company_name_placeholder') }}">
                    @error('company')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="owners-form-group">
                <label for="address">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ __('owners.address') }}
                </label>
                <textarea class="owners-form-control @error('address') is-invalid @enderror" 
                          id="address" 
                          name="address" 
                          rows="3" 
                          placeholder="{{ __('owners.full_street_address') }}">{{ old('address', $owner->address) }}</textarea>
                @error('address')
                    <div class="owners-invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="owners-form-row">
                <div class="owners-form-group">
                    <label for="city">
                        <i class="fas fa-city"></i>
                        {{ __('owners.city') }}
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('city') is-invalid @enderror" 
                           id="city" 
                           name="city" 
                           value="{{ old('city', $owner->city) }}"
                           placeholder="{{ __('owners.city_name_placeholder') }}">
                    @error('city')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="owners-form-group">
                    <label for="state">
                        <i class="fas fa-map"></i>
                        {{ __('owners.state_province') }}
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('state') is-invalid @enderror" 
                           id="state" 
                           name="state" 
                           value="{{ old('state', $owner->state) }}"
                           placeholder="{{ __('owners.state_province_placeholder') }}">
                    @error('state')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="owners-form-row">
                <div class="owners-form-group">
                    <label for="postal_code">
                        <i class="fas fa-mail-bulk"></i>
                        {{ __('owners.postal_code') }}
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('postal_code') is-invalid @enderror" 
                           id="postal_code" 
                           name="postal_code" 
                           value="{{ old('postal_code', $owner->postal_code) }}"
                           placeholder="{{ __('owners.postal_code_placeholder') }}">
                    @error('postal_code')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="owners-form-group">
                    <label for="country">
                        <i class="fas fa-flag"></i>
                        {{ __('owners.country') }}
                    </label>
                    <input type="text" 
                           class="owners-form-control @error('country') is-invalid @enderror" 
                           id="country" 
                           name="country" 
                           value="{{ old('country', $owner->country) }}"
                           placeholder="{{ __('owners.country_placeholder') }}">
                    @error('country')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="owners-form-row">
                <div class="owners-form-group">
                    <label for="preferred_language">
                        <i class="fas fa-language"></i>
                        {{ __('owners.preferred_language') }}
                    </label>
                    <select class="owners-form-control @error('preferred_language') is-invalid @enderror" 
                            id="preferred_language" 
                            name="preferred_language">
                        <option value="">{{ __('owners.select_language') }}</option>
                        <option value="en" {{ old('preferred_language', $owner->preferred_language) == 'en' ? 'selected' : '' }}>{{ __('owners.english') }}</option>
                        <option value="ar" {{ old('preferred_language', $owner->preferred_language) == 'ar' ? 'selected' : '' }}>{{ __('owners.arabic') }}</option>
                    </select>
                    @error('preferred_language')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="owners-form-group">
                    <label for="status">
                        <i class="fas fa-toggle-on"></i>
                        {{ __('owners.status') }}
                    </label>
                    <select class="owners-form-control @error('status') is-invalid @enderror" 
                            id="status" 
                            name="status">
                        <option value="active" {{ old('status', $owner->status) == 'active' ? 'selected' : '' }}>{{ __('owners.active') }}</option>
                        <option value="inactive" {{ old('status', $owner->status) == 'inactive' ? 'selected' : '' }}>{{ __('owners.inactive') }}</option>
                    </select>
                    @error('status')
                        <div class="owners-invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="owners-form-actions">
                <a href="{{ route('admin.owners.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span class="btn-text">{{ __('owners.back_to_owners') }}</span>
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    <span class="btn-text">{{ __('owners.update_owner') }}</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ownerEditForm');
    const submitBtn = document.getElementById('submitBtn');
    const firstInput = document.querySelector('#name');
    
    // Enhanced form submission with loading state
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span class="btn-text">{{ __('owners.updating') }}</span>';
        
        // Add a subtle loading animation to the form
        form.style.opacity = '0.8';
        form.style.pointerEvents = 'none';
        
        // Simulate network delay for better UX (remove in production)
        setTimeout(() => {
            // Form will submit naturally
        }, 500);
    });

    // Enhanced auto-focus with smooth animation
    if (firstInput) {
        setTimeout(() => {
            firstInput.focus();
            firstInput.select();
        }, 300);
    }
    
    // Add real-time validation feedback
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Add smooth scroll for validation errors
    const firstError = document.querySelector('.is-invalid');
    if (firstError) {
        setTimeout(() => {
            firstError.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }, 100);
    }
    
    // Enhanced mobile responsive behavior
    function handleResponsive() {
        const isMobile = window.innerWidth < 768;
        const buttons = document.querySelectorAll('.btn .btn-text');
        
        if (isMobile) {
            buttons.forEach(btn => {
                if (btn.textContent.length > 10) {
                    btn.style.display = 'none';
                }
            });
        } else {
            buttons.forEach(btn => {
                btn.style.display = 'inline';
            });
        }
    }
    
    handleResponsive();
    window.addEventListener('resize', handleResponsive);
    
    // Add staggered animation to form groups
    const formGroups = document.querySelectorAll('.owners-form-group');
    formGroups.forEach((group, index) => {
        group.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('company_image');
    const imagePreview = document.getElementById('companyImagePreview');
    const removeCheckbox = document.getElementById('remove_company_image');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    if(removeCheckbox) {
                        removeCheckbox.checked = false;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }
    
    if (removeCheckbox) {
        removeCheckbox.addEventListener('change', function() {
            if (this.checked) {
                imageInput.value = ''; // Clear file input if user wants to remove
                imagePreview.src = '{{ asset('images/fallback-company.svg') }}'; // Reset preview to fallback
            }
        });
    }
});
</script>
@endsection