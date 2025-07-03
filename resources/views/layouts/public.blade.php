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

    <!-- Additional head content -->
    @stack('head')
</head>

<body class="bg-gray-50 text-gray-900 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('homepage') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="Soosan Cebotics" class="h-8 w-auto">
                        <span class="ml-2 text-xl font-bold text-gray-900">Soosan Cebotics</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('homepage') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('homepage') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('products.index') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('products.*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        {{ __('Products') }}
                    </a>
                    <a href="{{ route('serial-lookup.index') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('serial-lookup.*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        {{ __('Serial Lookup') }}
                    </a>
                    <a href="{{ route('about') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('about') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        {{ __('About') }}
                    </a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('contact') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        {{ __('Contact') }}
                    </a>
                </div>

                <!-- Right side: Language switcher and admin login -->
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div class="relative">
                        <button id="language-toggle"
                            class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                            <span class="mr-1">{{ app()->isLocale('ar') ? 'العربية' : 'English' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="language-menu"
                            class="hidden absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg border">
                            <a href="?lang=en"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">English</a>
                            <a href="?lang=ar"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">العربية</a>
                        </div>
                    </div>

                    <!-- Unit Switcher -->
                    <div class="relative">
                        <button id="unit-toggle" class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                            <span class="mr-1" id="current-unit">SI</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Admin Login -->
                    @auth
                        <a href="{{ url('/admin') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                            {{ __('Admin Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                            {{ __('Admin Login') }}
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t">
                    <a href="{{ route('homepage') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600">{{ __('Home') }}</a>
                    <a href="{{ route('products.index') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600">{{ __('Products') }}</a>
                    <a href="{{ route('serial-lookup.index') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600">{{ __('Serial Lookup') }}</a>
                    <a href="{{ route('about') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600">{{ __('About') }}</a>
                    <a href="{{ route('contact') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600">{{ __('Contact') }}</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Soosan Cebotics</h3>
                    <p class="text-gray-300 text-sm mb-4">Leading provider of drilling equipment and solutions for
                        construction, mining, and industrial applications.</p>
                    <div class="flex space-x-4">
                        <!-- Social links placeholder -->
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Quick Links') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.index') }}"
                                class="text-gray-300 hover:text-white">{{ __('Products') }}</a></li>
                        <li><a href="{{ route('serial-lookup.index') }}"
                                class="text-gray-300 hover:text-white">{{ __('Serial Lookup') }}</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-gray-300 hover:text-white">{{ __('About Us') }}</a></li>
                        <li><a href="{{ route('support') }}"
                                class="text-gray-300 hover:text-white">{{ __('Support') }}</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Legal') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('privacy') }}"
                                class="text-gray-300 hover:text-white">{{ __('Privacy Policy') }}</a></li>
                        <li><a href="{{ route('terms') }}"
                                class="text-gray-300 hover:text-white">{{ __('Terms of Service') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Contact') }}</h3>
                    <div class="text-gray-300 text-sm space-y-2">
                        <p>123 Industrial Avenue</p>
                        <p>Industrial City, Country</p>
                        <p>Phone: +1 (555) 123-4567</p>
                        <p>Email: info@soosancebotics.com</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-300">
                <p>&copy; {{ date('Y') }} Soosan Cebotics. {{ __('All rights reserved.') }}</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Language switcher
        document.getElementById('language-toggle').addEventListener('click', function() {
            document.getElementById('language-menu').classList.toggle('hidden');
        });

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

        // Mobile menu
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Load preferred unit from localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const preferredUnit = localStorage.getItem('preferredUnit') || 'SI';
            document.getElementById('current-unit').textContent = preferredUnit;

            if (typeof convertUnits === 'function') {
                convertUnits(preferredUnit);
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const languageToggle = document.getElementById('language-toggle');
            const languageMenu = document.getElementById('language-menu');

            if (!languageToggle.contains(event.target)) {
                languageMenu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
