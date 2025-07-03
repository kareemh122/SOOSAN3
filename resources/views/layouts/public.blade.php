<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Soosan Cebotics - Drilling Equipment Solutions')</title>
    <meta name="description" content="@yield('description', 'Leading provider of drilling equipment and solutions. Quality machinery for construction, mining, and industrial applications.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (app()->isLocale('ar'))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    @endif

    <!-- Additional head content -->
    @stack('head')
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}">
                @if (app()->isLocale('ar'))
                    <img src="{{ asset('images/soosan_logo_ar.svg') }}" height="32"
                        class="{{ app()->isLocale('ar') ? 'ms-2' : 'me-2' }}">
                @else
                    <img src="{{ asset('images/soosan_logo_en.svg') }}" height="32"
                        class="{{ app()->isLocale('ar') ? 'ms-2' : 'me-2' }}">
                @endif
                {{-- <span class="fs-4 fw-bold text-dark">Soosan Cebotics</span> --}}
            </a>

            <!-- Mobile menu button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('homepage') ? 'active fw-semibold text-primary' : 'text-dark' }}"
                            href="{{ route('homepage') }}">
                            {{ __('common.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active fw-semibold text-primary' : 'text-dark' }}"
                            href="{{ route('products.index') }}">
                            {{ __('common.products') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('serial-lookup.*') ? 'active fw-semibold text-primary' : 'text-dark' }}"
                            href="{{ route('serial-lookup.index') }}">
                            {{ __('common.serial_lookup') }}
                        </a>
                    </li>


                </ul>

                <!-- Right side: Language switcher and admin login -->
                <ul class="navbar-nav ms-3">
                    <!-- Language Switcher -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="languageDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ app()->isLocale('ar') ? 'العربية' : 'English' }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">English</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['lang' => 'ar']) }}">العربية</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-md-3">
                    <h5 class="fw-semibold mb-3">Soosan Cebotics</h5>
                    <p class="text-light small mb-3">{{ __('common.footer_description') }}</p>
                    <div class="d-flex gap-3">
                        <!-- Social links placeholder -->
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3">
                    <h5 class="fw-semibold mb-3">{{ __('common.quick_links') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('products.index') }}"
                                class="text-light text-decoration-none small">{{ __('common.products') }}</a></li>
                        <li class="mb-2"><a href="{{ route('serial-lookup.index') }}"
                                class="text-light text-decoration-none small">{{ __('common.serial_lookup') }}</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}"
                                class="text-light text-decoration-none small">{{ __('common.about') }}</a></li>
                        <li class="mb-2"><a href="{{ route('support') }}"
                                class="text-light text-decoration-none small">{{ __('common.support') }}</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div class="col-md-3">
                    <h5 class="fw-semibold mb-3">{{ __('common.legal') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('privacy') }}"
                                class="text-light text-decoration-none small">{{ __('common.privacy') }}</a></li>
                        <li class="mb-2"><a href="{{ route('terms') }}"
                                class="text-light text-decoration-none small">{{ __('common.terms') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-3">
                    <h5 class="fw-semibold mb-3">{{ __('common.contact') }}</h5>
                    <div class="text-light small">
                        <p class="mb-1">123 Industrial Avenue</p>
                        <p class="mb-1">Industrial City, Country</p>
                        <p class="mb-1">Phone: +1 (555) 123-4567</p>
                        <p class="mb-1">Email: info@soosancebotics.com</p>
                    </div>
                </div>
            </div>

            <hr class="border-secondary mt-4 mb-3">
            <div class="text-center">
                <p class="text-light small mb-0">&copy; {{ date('Y') }} Soosan Cebotics.
                    {{ __('common.copyright') }}</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Unit switcher
        document.getElementById('unit-toggle').addEventListener('click', function() {
            const currentUnit = document.getElementById('current-unit');
            const newUnit = currentUnit.textContent === 'SI' ? 'Imperial' : 'SI';
            currentUnit.textContent = newUnit;

            // Store in localStorage
            localStorage.setItem('preferredUnit', newUnit);

            // Trigger unit conversion on page
            if (typeof convertUnits === 'function') {
                convertUnits(newUnit);
            }
        });

        // Load preferred unit from localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const preferredUnit = localStorage.getItem('preferredUnit') || 'SI';
            const currentUnitElement = document.getElementById('current-unit');
            if (currentUnitElement) {
                currentUnitElement.textContent = preferredUnit;
            }

            if (typeof convertUnits === 'function') {
                convertUnits(preferredUnit);
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
