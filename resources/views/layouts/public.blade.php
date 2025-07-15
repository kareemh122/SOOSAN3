<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SoosanEgypt - Drilling Equipment Solutions')</title>
    <meta name="description" content="@yield('description', 'Leading provider of drilling equipment and solutions. Quality machinery for construction, mining, and industrial applications.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Global Enhanced Styles -->
    <link href="{{ asset('css/global-styles.css') }}" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (app()->isLocale('ar'))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
        <link rel="stylesheet" href="{{ asset('css/rtl-styles.css') }}">
    @endif

    <!-- Additional head content -->
    @stack('head')
    @stack('styles')

    <style>
        .social-icons {
            display: flex;
            gap: 15px;
        }
        .social {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            padding-right: 7px;
        }

        .social:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .facebook {
            background-color: #1877F2; /* Facebook Blue */
        }

        .linkedin {
            background-color: #0A66C2; /* LinkedIn Blue */
        }

        .youtube {
            background-color: #FF0000; /* YouTube Red */
        }

        .copy-right-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .copy-right-section img:first-child {
            width: 150px;
        }
        .copy-right-section img:last-child {
            width: 150px;
        }
        .copy-right-section p {
            font-size: 20px;
        }
        .powered-by {
            text-align: center;
            font-size: 18px;
            color: #ccc;
        }

        /* Enhanced Navbar Logo Styling */
        .navbar-logo {
            transition: all 0.3s ease;
            filter: brightness(1.1) contrast(1.1);
        }

        .navbar-logo:hover {
            transform: scale(1.05);
            filter: brightness(1.2) contrast(1.2);
        }

        .navbar-brand {
            padding: 0.5rem 0;
        }

        /* Responsive logo sizing */
        @media (max-width: 768px) {
            .navbar-logo {
                height: 55px !important;
                max-width: 160px !important;
            }
        }

        @media (max-width: 576px) {
            .navbar-logo {
                height: 50px !important;
                max-width: 140px !important;
            }
        }

        @media (min-width: 1200px) {
            .navbar-logo {
                height: 70px !important;
                max-width: 220px !important;
            }
        }

        /* Multi-level Dropdown Styles */
        .navbar-nav-dropdown {
            position: relative;
        }

        .navbar-nav-dropdown .nav-icon-item {
            position: relative;
        }

        .dropdown-menu-level1 {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 280px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .navbar-nav-dropdown:hover .dropdown-menu-level1 {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu-level2 {
            position: absolute;
            top: 0;
            left: 100%;
            min-width: 260px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1051;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-10px);
            transition: all 0.3s ease;
            margin-left: 5px;
        }

        .dropdown-category-item:hover .dropdown-menu-level2 {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        .dropdown-category-item {
            position: relative;
            padding: 12px 20px;
            color: #374151;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.2s ease;
        }

        .dropdown-category-item:hover {
            background: #f8fafc;
            color: #1f2937;
            text-decoration: none;
        }

        .dropdown-category-item:last-child {
            border-bottom: none;
        }

        .dropdown-category-item .category-icon {
            width: 24px;
            height: 24px;
            margin-right: 12px;
            color: #6b7280;
        }

        .dropdown-category-item .arrow-icon {
            font-size: 12px;
            color: #9ca3af;
        }

        .dropdown-line-item {
            padding: 10px 20px;
            color: #374151;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .dropdown-line-item:hover {
            background: #f0f9ff;
            color: #0284c7;
            text-decoration: none;
            padding-left: 24px;
        }

        .dropdown-line-item:last-child {
            border-bottom: none;
        }

        /* RTL Support */
        html[dir='rtl'] .dropdown-menu-level1 {
            left: auto;
            right: 0;
        }

        html[dir='rtl'] .dropdown-menu-level2 {
            left: auto;
            right: 100%;
            margin-left: 0;
            margin-right: 5px;
        }

        html[dir='rtl'] .dropdown-category-item .category-icon {
            margin-right: 0;
            margin-left: 12px;
        }

        html[dir='rtl'] .dropdown-category-item .arrow-icon {
            transform: rotate(180deg);
        }

        html[dir='rtl'] .dropdown-line-item:hover {
            padding-left: 20px;
            padding-right: 24px;
        }

        html[dir='rtl'] .dropdown-category-item:hover .dropdown-menu-level2 {
            transform: translateX(0);
        }

        html[dir='rtl'] .dropdown-menu-level2 {
            transform: translateX(10px);
        }

        /* Enhanced hover effects */
        .navbar-nav-dropdown .nav-icon-item:hover {
            background: rgba(37, 99, 235, 0.1);
            border-radius: 8px;
        }

        .dropdown-category-item .category-icon {
            transition: color 0.2s ease;
        }

        .dropdown-category-item:hover .category-icon {
            color: #2563eb;
        }

        .dropdown-category-item:hover .arrow-icon {
            color: #2563eb;
            transform: translateX(3px);
        }

        html[dir='rtl'] .dropdown-category-item:hover .arrow-icon {
            transform: rotate(180deg) translateX(3px);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-nav-dropdown {
                position: static;
            }
            
            .dropdown-menu-level1,
            .dropdown-menu-level2 {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border: none;
                margin: 0;
                background: transparent;
                min-width: auto;
                width: 100%;
            }

            .dropdown-category-item {
                padding: 8px 12px;
                font-size: 14px;
            }

            .dropdown-line-item {
                padding: 6px 16px;
                font-size: 13px;
                margin-left: 20px;
            }

            html[dir='rtl'] .dropdown-line-item {
                margin-left: 0;
                margin-right: 20px;
            }
        }
    </style>
</head>

<body class="bg-light">
    <!-- Fixed Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top" style="min-height:72px; font-size:1.15rem; padding-top: 0.7rem; padding-bottom: 0.7rem; z-index: 1050;">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}">
                <img src="{{ asset('images/logo.webp') }}" height="65" alt="SoosanEgypt"
                    class="navbar-logo {{ app()->isLocale('ar') ? 'ms-2' : 'me-2' }}"
                    style="max-width: 200px; width: auto; object-fit: contain;">
                {{-- <span class="fs-4 fw-bold text-dark">Soosan</span> --}}
            </a>

            <!-- Mobile menu button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Enhanced Icon-based navigation for all pages -->
                <div class="icon-nav ms-auto">
                    <a href="{{ route('homepage') }}"
                       class="nav-icon-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-icon-label">{{ __('common.home') }}</span>
                    </a>

                    <!-- Multi-level Products Dropdown -->
                    <div class="navbar-nav-dropdown">
                        <a href="{{ route('products.index') }}"
                           class="nav-icon-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                            <i class="fas fa-cogs nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.products') }}</span>
                        </a>
                        
                        <!-- Level 1 Dropdown: Categories -->
                        <div class="dropdown-menu-level1">
                            @if($productCategories && $productCategories->count() > 0)
                                @foreach($productCategories as $category)
                                    <div class="dropdown-category-item">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-layer-group category-icon"></i>
                                            <span>{{ $category->name }}</span>
                                        </div>
                                        <i class="fas fa-chevron-right arrow-icon"></i>
                                        
                                        <!-- Level 2 Dropdown: Product Lines -->
                                        <div class="dropdown-menu-level2">
                                            <a href="{{ route('products.index', ['line' => ['SQ Line']]) }}" class="dropdown-line-item">
                                            {{ __('common.SQ_line') }}
                                            </a>
                                            <a href="{{ route('products.index', ['line' => ['SB Line']]) }}" class="dropdown-line-item">
                                            {{ __('common.SB_line') }}
                                            </a>
                                            <a href="{{ route('products.index', ['line' => ['SB-E Line']]) }}" class="dropdown-line-item">
                                            {{ __('common.SB-E_line') }}
                                            </a>
                                            <a href="{{ route('products.index', ['line' => ['ET-II Line']]) }}" class="dropdown-line-item">
                                            {{ __('common.ET-II_line') }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="dropdown-category-item">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-layer-group category-icon"></i>
                                        <span>{{ __('common.no_categories') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('serial-lookup.index') }}"
                       class="nav-icon-item {{ request()->routeIs('serial-lookup.*') ? 'active' : '' }}">
                        <i class="fas fa-search nav-icon"></i>
                        <span class="nav-icon-label">{{ __('common.serial_lookup') }}</span>
                    </a>

                    @if(Route::has('about'))
                        <a href="{{ route('about') }}"
                           class="nav-icon-item {{ request()->routeIs('about') ? 'active' : '' }}">
                            <i class="fas fa-info-circle nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.about') }}</span>
                        </a>
                    @endif

                    @if(Route::has('contact'))
                        <a href="{{ route('contact') }}"
                           class="nav-icon-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                            <i class="fas fa-phone nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.contact') }}</span>
                        </a>
                    @endif

                    @if(Route::has('support'))
                        <a href="{{ route('support') }}"
                           class="nav-icon-item {{ request()->routeIs('support') ? 'active' : '' }}">
                            <i class="fas fa-headset nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.support') }}</span>
                        </a>
                    @endif

                    @auth('web')
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-icon-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.dashboard') }}</span>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="nav-icon-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                            <i class="fas fa-user-cog nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.profile') }}</span>
                        </a>
                    @endauth

                    <!-- Authentication Icons -->
                    @auth('web')
                        <x-logout-button route="admin.logout" />
                    @else
                        <a href="{{ route('admin.login') }}"
                           class="nav-icon-item {{ request()->routeIs('admin.login') ? 'active' : '' }}">
                            <i class="fas fa-sign-in-alt nav-icon"></i>
                            <span class="nav-icon-label">{{ __('common.login') }}</span>
                        </a>
                    @endauth
                </div>
                
                <!-- Language Toggle with Earth Icon -->
                <x-language-toggle class="ms-4" />
            </div>
        </div>
    </nav>

    <!-- Page Header/Search Slot -->
    @hasSection('page-header')
        <div class="bg-white border-bottom shadow-sm" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">
            <div class="container">
                @yield('page-header')
            </div>
        </div>
    @endif

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
                    <h5 class="fw-semibold mb-3">SoosanEgypt</h5>
                    <p class="text-light small mb-3">{{ __('common.footer_description') }}</p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/share/1KvmELF3Kn/?mibextid=wwXIfr" class="social facebook" aria-label="Facebook" target="_blank" title="SOOSAN EGYPT FACEBOOK">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/madina-contracting-company/" class="social linkedin" aria-label="LinkedIn" target="_blank" title="AL MADINA COMPANY LINKEDIN">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.youtube.com/@soosancebotics" class="social youtube" aria-label="YouTube" target="_blank" title="SOOSAN CEBOTICS YOUTUBE">
                            <i class="fab fa-youtube"></i>
                        </a>
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
            <div class="text-center copy-right-section">
                <a href="https://soosancebotics.com/en/main" title="SOOSAN CEBOTICS" target="_blank">
                    <img src="{{ asset('images/soosan_logo_en.svg') }}" alt="SOOSAN CEBOTICS">
                </a>
                <p class="text-light small mb-0">&copy; {{ date('Y') }} SoosanEgypt.
                    {{ __('common.copyright') }}</p>
                <a href="https://madinagp.com/tag/al-madina-contracting-company/" title="AL MADINA CONRACTING COMPANY" target="_blank">
                    <img src="{{ asset('images/almadina2.png') }}" alt="AL MADINA CONTRACTING COMPANY">
                </a>
            </div>
            <div>
                <p class="powered-by">Powered By: AK</p>
            </div>
        </div>

    </footer>

    <!-- Scripts -->
    <script>
        // Global Enhanced Navigation Functions
        function initGlobalNavEffects() {
            const navbar = document.querySelector('.navbar');
            let lastScrollY = window.scrollY;

            window.addEventListener('scroll', () => {
                const currentScrollY = window.scrollY;

                // Add scrolled class when scrolling down
                if (currentScrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Hide/show navbar on scroll (optional enhancement)
                if (currentScrollY > lastScrollY && currentScrollY > 100) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }

                lastScrollY = currentScrollY;
            });
        }

        // Enhanced Icon Animations for All Pages
        function initGlobalIconAnimations() {
            const iconItems = document.querySelectorAll('.nav-icon-item');

            iconItems.forEach((item, index) => {
                // Add staggered entrance animation
                item.style.animationDelay = `${index * 0.1}s`;

                // Add click ripple effect
                item.addEventListener('click', function(e) {
                    // Don't add ripple if it's a navigation click
                    if (e.target.closest('a')) return;

                    // Create ripple element
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');

                    // Position ripple
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(37, 99, 235, 0.3) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                        z-index: 1000;
                    `;

                    this.appendChild(ripple);

                    // Remove ripple after animation
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });

                // Add hover effects
                item.addEventListener('mouseenter', function() {
                    this.style.filter = 'drop-shadow(0 4px 8px rgba(37, 99, 235, 0.2))';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.filter = 'none';
                });
            });
        }

        // Enhanced Button Interactions
        function initEnhancedButtons() {
            const buttons = document.querySelectorAll('.btn');

            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Add loading class for form submissions
                    if (this.type === 'submit') {
                        this.classList.add('loading');
                    }
                });
            });
        }

        // Enhanced Form Interactions
        function initEnhancedForms() {
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitBtn) {
                        submitBtn.classList.add('loading');
                        submitBtn.disabled = true;
                    }
                });
            });
        }

        // Enhanced Card Interactions
        function initEnhancedCards() {
            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        }

        // Unit switcher (if exists)
        function initUnitSwitcher() {
            const unitToggle = document.getElementById('unit-toggle');
            if (unitToggle) {
                unitToggle.addEventListener('click', function() {
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
            }
        }

        // Page Loading Effects
        function initPageEffects() {
            // Fade in page content
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.3s ease';

            window.addEventListener('load', function() {
                document.body.style.opacity = '1';
            });

            // Initialize all enhancements after DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeEnhancements);
            } else {
                initializeEnhancements();
            }
        }

        // Initialize All Enhancements
        function initializeEnhancements() {
            // Load preferred settings
            const preferredUnit = localStorage.getItem('preferredUnit') || 'SI';
            const currentUnitElement = document.getElementById('current-unit');
            if (currentUnitElement) {
                currentUnitElement.textContent = preferredUnit;
            }

            if (typeof convertUnits === 'function') {
                convertUnits(preferredUnit);
            }

            // Initialize all global effects
            initGlobalNavEffects();
            initGlobalIconAnimations();
            initEnhancedButtons();
            initEnhancedForms();
            initEnhancedCards();
            initUnitSwitcher();

            // Initialize language toggle with entrance animation
            const languageToggle = document.getElementById('languageToggle');
            if (languageToggle) {
                languageToggle.style.opacity = '0';
                languageToggle.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    languageToggle.style.transition = 'all 0.3s ease';
                    languageToggle.style.opacity = '1';
                    languageToggle.style.transform = 'scale(1)';
                }, 100);
            }

            // Add keyboard navigation support
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    document.body.classList.add('keyboard-navigation');
                }
            });

            document.addEventListener('mousedown', function() {
                document.body.classList.remove('keyboard-navigation');
            });
        }

        // Initialize page effects immediately
        initPageEffects();

        // Enhanced navigation and navbar functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth navigation without refresh
            const navLinks = document.querySelectorAll('.nav-icon-item[href]');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add loading state
                    const icon = this.querySelector('.nav-icon');
                    const originalClass = icon.className;

                    // Show loading spinner briefly
                    icon.className = 'fas fa-spinner fa-spin nav-icon';

                    // Restore original icon after short delay
                    setTimeout(() => {
                        icon.className = originalClass;
                    }, 300);
                });
            });

            // Enhanced multi-level dropdown functionality
            const dropdownItems = document.querySelectorAll('.dropdown-category-item');
            let activeDropdown = null;
            let dropdownTimeout = null;

            dropdownItems.forEach(item => {
                const level2Menu = item.querySelector('.dropdown-menu-level2');
                
                item.addEventListener('mouseenter', function() {
                    clearTimeout(dropdownTimeout);
                    
                    // Hide other level 2 menus
                    dropdownItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            const otherLevel2 = otherItem.querySelector('.dropdown-menu-level2');
                            if (otherLevel2) {
                                otherLevel2.style.opacity = '0';
                                otherLevel2.style.visibility = 'hidden';
                                otherLevel2.style.transform = 'translateX(-10px)';
                            }
                        }
                    });
                    
                    // Show current level 2 menu
                    if (level2Menu) {
                        setTimeout(() => {
                            level2Menu.style.opacity = '1';
                            level2Menu.style.visibility = 'visible';
                            level2Menu.style.transform = 'translateX(0)';
                        }, 100);
                    }
                });

                item.addEventListener('mouseleave', function() {
                    dropdownTimeout = setTimeout(() => {
                        if (level2Menu) {
                            level2Menu.style.opacity = '0';
                            level2Menu.style.visibility = 'hidden';
                            level2Menu.style.transform = 'translateX(-10px)';
                        }
                    }, 150);
                });

                // Keep level 2 menu open when hovering over it
                if (level2Menu) {
                    level2Menu.addEventListener('mouseenter', function() {
                        clearTimeout(dropdownTimeout);
                    });

                    level2Menu.addEventListener('mouseleave', function() {
                        this.style.opacity = '0';
                        this.style.visibility = 'hidden';
                        this.style.transform = 'translateX(-10px)';
                    });
                }
            });

            // Enhanced navbar scroll behavior
            let lastScrollTop = 0;
            const navbar = document.querySelector('.navbar');

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                lastScrollTop = scrollTop;
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                const dropdown = e.target.closest('.navbar-nav-dropdown');
                if (!dropdown) {
                    dropdownItems.forEach(item => {
                        const level2Menu = item.querySelector('.dropdown-menu-level2');
                        if (level2Menu) {
                            level2Menu.style.opacity = '0';
                            level2Menu.style.visibility = 'hidden';
                            level2Menu.style.transform = 'translateX(-10px)';
                        }
                    });
                }
            });
        });
    </script>

    @stack('scripts')

@if (!request()->is('admin*') && !request()->is('dashboard*'))
    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" class="scroll-to-top-btn shadow rounded-circle d-flex align-items-center justify-content-center bg-primary"
        aria-label="{{ __('common.scroll_to_top') }}"
        style="position: fixed; bottom: 32px; right: 32px; width: 48px; height: 48px; color: #fff; border: none; z-index: 2000; display: none; transition: opacity 0.3s, visibility 0.3s;">
        <i class="fas fa-arrow-up"></i>
    </button>
    <style>
        .scroll-to-top-btn {
            opacity: 0;
            visibility: hidden;
            box-shadow: 0 8px 32px rgba(0, 84, 142, 0.18);
            font-size: 1.5rem;
            
        }
        .scroll-to-top-btn.show {
            opacity: 1;
            visibility: visible;
        }
        .scroll-to-top-btn:active {
            transform: scale(0.95);
        }
        html[dir='rtl'] .scroll-to-top-btn {
            right: auto;
            left: 32px;
            padding-right: 14px;
        }
    </style>
    <script>
        (function() {
            const btn = document.getElementById('scrollToTopBtn');
            let ticking = false;
            function toggleBtn() {
                if (window.scrollY > 200) {
                    btn.classList.add('show');
                    btn.style.display = 'flex';
                } else {
                    btn.classList.remove('show');
                    setTimeout(() => { btn.style.display = 'none'; }, 300);
                }
            }
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        toggleBtn();
                        ticking = false;
                    });
                    ticking = true;
                }
            });
            btn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        })();
    </script>
@endif
</body>

</html>
