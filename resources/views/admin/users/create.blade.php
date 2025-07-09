@extends('layouts.admin')

@section('title', __('users.create_user'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="card-header bg-white border-bottom p-3">
                <h5 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    {{ __('users.create_user') }}
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('users.name') }} <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="{{ __('users.enter_name') }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('users.email') }} <span class="text-danger">*</span></label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="{{ __('users.enter_email') }}"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">{{ __('users.password') }} <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="{{ __('users.enter_password') }}"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">{{ __('users.confirm_password') }} <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="{{ __('users.confirm_password') }}"
                                required
                            >
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label for="role" class="form-label">{{ __('users.role') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">{{ __('users.select_role') }}</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>{{ __('users.admin') }}</option>
                                <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>{{ __('users.employee') }}</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Verification Status -->
                        <div class="col-md-6">
                            <label class="form-label">{{ __('users.verification_status') }}</label>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="is_verified" 
                                    name="is_verified" 
                                    value="1"
                                    {{ old('is_verified') ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="is_verified">
                                    {{ __('users.mark_as_verified') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            {{ __('users.back_to_staff') }}
                        </a>
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-save me-2"></i>
                            {{ __('users.create_staff') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
