@extends('layouts.public')

@section('title', __('auth.login'))

@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); padding-top: 80px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg border-0" style="border-radius: 20px; backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95);">
                        <div class="card-body p-5">
                        <!-- Logo/Brand -->
                        <div class="text-center mb-4">
                                <img src="{{ asset('images/soosan_logo_en.svg') }}" alt="Soosan Logo" style="height: 60px; width: auto;" class="mb-3">
                                <h2 class="h4 mb-0 text-dark">{{ __('auth.welcome_back') }}</h2>
                                <p class="text-muted">{{ __('auth.sign_in_to_account') }}</p>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">{{ __('auth.email_address') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="{{ __('auth.enter_your_email') }}" style="border-left: none;">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">{{ __('auth.password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required
                                        placeholder="{{ __('auth.enter_your_password') }}" style="border-left: none;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()"
                                        title="{{ __('auth.toggle_password_visibility') }}">
                                        <i class="fas fa-eye" id="password-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('auth.remember_me') }}
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg" id="loginBtn" style="border-radius: 10px; padding: 12px; font-weight: 600;">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    {{ __('auth.sign_in') }}
                                </button>
                            </div>
                            
                            <!-- Forgot Password Link -->
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-muted small">
                                        {{ __('auth.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                        </form>

                        <!-- Back to Website Link -->
                        <div class="text-center mt-4">
                            <a href="{{ route('homepage') }}" class="text-decoration-none btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>
                                {{ __('auth.back_to_website') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordEye = document.getElementById('password-eye');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordEye.classList.remove('fa-eye');
                passwordEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordEye.classList.remove('fa-eye-slash');
                passwordEye.classList.add('fa-eye');
            }
        }

        // Add loading state to login form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitButton = document.getElementById('loginBtn');
            const originalText = submitButton.innerHTML;

            form.addEventListener('submit', function() {
                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<i class="fas fa-spinner fa-spin me-2"></i>{{ __('auth.processing') }}';

                // Re-enable button after 5 seconds as failsafe
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }, 5000);
            });
        });
    </script>
@endsection