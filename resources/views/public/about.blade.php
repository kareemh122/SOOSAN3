@extends('layouts.public')

@section('title', __('about.title'))
@section('description', __('about.description'))

@push('styles')
    <style>
        /* SOOSAN EGYPT Brand Colors */
        :root {
            --soosan-blue: #00548e;
            --soosan-green: #b0d701;
            --soosan-white: #ffffff;
            --soosan-black: #000000;
            --soosan-gray: #f8f9fa;
            --soosan-light-gray: #e9ecef;
            --soosan-dark-gray: #495057;
            --soosan-shadow: rgba(0, 84, 142, 0.1);
            --soosan-shadow-hover: rgba(0, 84, 142, 0.2);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--soosan-dark-gray);
            background-color: var(--soosan-gray);
        }

        /* Enhanced Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--soosan-blue) 0%, #003d6b 100%);
            color: var(--soosan-white);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(176,215,1,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(176,215,1,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.4;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--soosan-green) 0%, #9bc400 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Stats Section */
        .stats-container {
            display: flex;
            justify-content: center;
            gap: 4rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            min-width: 150px;
        }

        .stats-counter {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            display: block;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            line-height: 1;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--soosan-white);
            font-weight: 500;
            opacity: 0.9;
        }

        /* Enhanced Card Styles */
        .content-section {
            padding: 5rem 0;
            background: var(--soosan-gray);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .animated-card {
            background: var(--soosan-white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px var(--soosan-shadow);
            margin-bottom: 2.5rem;
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid var(--soosan-light-gray);
            position: relative;
        }

        .animated-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px var(--soosan-shadow-hover);
        }

        .animated-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--soosan-blue) 0%, var(--soosan-green) 100%);
        }

        .card-body {
            padding: 2.5rem;
        }

        /* Feature Icon Styles */
        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: var(--soosan-blue);
            color: var(--soosan-white);
            font-size: 2rem;
            box-shadow: 0 4px 15px rgba(0, 84, 142, 0.3);
            transition: var(--transition);
            position: relative;
        }

        .feature-icon:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 8px 25px rgba(0, 84, 142, 0.4);
        }

        .feature-icon::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: var(--transition);
        }

        .feature-icon:hover::before {
            opacity: 1;
        }

        /* Typography */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--soosan-blue);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 1.25rem;
            color: var(--soosan-dark-gray);
            margin-bottom: 2rem;
            line-height: 1.85;
        }

        /* Grid Layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -0.75rem;
        }

        .col-md-2 {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
            padding: 0.75rem;
        }

        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding: 0.75rem;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0.75rem;
        }

        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
            padding: 0.75rem;
        }

        .col-md-10 {
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
            padding: 0.75rem;
        }

        /* Why Choose Us Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(341px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            text-align: center;
            padding: 2rem;
            background: var(--soosan-white);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 10px var(--soosan-shadow);
            transition: var(--transition);
            border: 1px solid var(--soosan-light-gray);
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px var(--soosan-shadow-hover);
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--soosan-blue);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--soosan-dark-gray);
            line-height: 1.6;
        }

        /* Timeline Styles */
        .timeline-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline-item {
            position: relative;
            padding: 2rem 0 2rem 4rem;
            border-left: 3px solid var(--soosan-light-gray);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 2.5rem;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--soosan-blue);
            border: 3px solid var(--soosan-white);
            box-shadow: 0 0 0 3px var(--soosan-blue);
            z-index: 2;
        }

        .timeline-item:nth-child(even)::before {
            background: var(--soosan-green);
            box-shadow: 0 0 0 3px var(--soosan-green);
        }

        .timeline-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--soosan-blue);
            margin-bottom: 0.5rem;
        }

        .timeline-description {
            color: var(--soosan-dark-gray);
            line-height: 1.6;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 0.875rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: 2px solid transparent;
            cursor: pointer;
            text-align: center;
            line-height: 1.5;
        }

        .btn-primary {
            background: var(--soosan-blue);
            color: var(--soosan-white);
            border-color: var(--soosan-blue);
        }

        .btn-primary:hover {
            background: #b0d701;
            border-color: #b0d701;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 84, 142, 0.3);
        }

        .btn-secondary {
            background: var(--soosan-green);
            color: var(--soosan-white);
            border-color: var(--soosan-green);
        }

        .btn-secondary:hover {
            background: #9bc400;
            border-color: #9bc400;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(176, 215, 1, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--soosan-blue);
            border-color: var(--soosan-blue);
        }

        .btn-outline:hover {
            background: var(--soosan-blue);
            color: var(--soosan-white);
        }

        .btn-lg {
            padding: 1.125rem 2.5rem;
            font-size: 1.125rem;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        /* Contact CTA Section */
        .contact-cta {
            background: white;
            color: var(--soosan-white);
            text-align: center;
            padding: 4rem 2.5rem;
            margin-top: 3rem;
        }

        .contact-cta .feature-icon {
            background: var(--soosan-white);
            color: var(--soosan-blue);
            margin-bottom: 2rem;
        }

        .contact-cta .section-title {
            color: var(--soosan-blue);
            margin-bottom: 1.5rem;
        }

        .contact-cta .btn {
            margin: 0.5rem;
        }

        .contact-cta .btn-primary {
            background: var(--soosan-white);
            color: var(--soosan-blue);
            border-color: var(--soosan-white);
        }

        .contact-cta .btn-primary:hover {
            background: var(--soosan-light-gray);
            border-color: var(--soosan-light-gray);
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        .mb-5 {
            margin-bottom: 3rem;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mt-1 {
            margin-top: 0.5rem;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .align-items-center {
            align-items: center;
        }

        /* Animations */
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

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-counter {
            animation: countUp 0.8s ease-out forwards;
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .stats-container {
                gap: 2rem;
            }

            .stats-counter {
                font-size: 2.5rem;
            }

            .col-md-2,
            .col-md-4,
            .col-md-6,
            .col-md-8,
            .col-md-10 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .card-body {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .timeline-item {
                padding-left: 2.5rem;
            }

            .btn {
                display: block;
                width: 100%;
                margin-bottom: 1rem;
            }

            .contact-cta .btn {
                width: auto;
                display: inline-block;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                padding: 3rem 0;
            }

            .hero-title {
                font-size: 2rem;
            }

            .stats-counter {
                font-size: 2rem;
            }

            .card-body {
                padding: 1rem;
            }

            .contact-cta {
                padding: 3rem 1.5rem;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Accessibility */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Focus States */
        .btn:focus,
        .animated-card:focus {
            outline: 2px solid var(--soosan-green);
            outline-offset: 2px;
        }

        /* Print Styles */
        @media print {
            .hero-section {
                background: var(--soosan-white) !important;
                color: var(--soosan-black) !important;
            }

            .animated-card {
                box-shadow: none !important;
                border: 1px solid var(--soosan-light-gray) !important;
            }

            .btn {
                display: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Enhanced Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title animate-counter">
                    {{ __('about.hero_title') }}
                </h1>
                <p class="hero-subtitle animate-counter">
                    {{ __('about.hero_subtitle') }}
                </p>
                <div class="stats-container">
                    <div class="stat-item">
                        <span class="stats-counter animate-counter" data-count="40">0</span>
                        <p class="stat-label">{{ __('about.years_of_excellence') }}</p>
                    </div>
                    <div class="stat-item">
                        <span class="stats-counter animate-counter" data-count="1000"
                            style="animation-delay: 0.2s;">0</span>+
                        <p class="stat-label">{{ __('about.projects_completed') }}</p>
                    </div>
                    <div class="stat-item">
                        <span class="stats-counter animate-counter" data-count="70" style="animation-delay: 0.4s;">0</span>
                        <p class="stat-label">{{ __('about.countries_served') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Content Section -->
    <section class="content-section">
        <div class="container">
            <!-- Our Story -->
            <div class="animated-card loading">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-4">
                            <div class="feature-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="section-title">{{ __('about.about_us_title') }}</h2>
                            <p class="section-subtitle">
                                {{ __('about.about_us_description') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our History -->
            <div class="animated-card loading">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-4">
                            <div class="feature-icon">
                                <i class="fas fa-history"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="section-title">{{ __('about.our_history_title') }}</h2>
                            <p class="section-subtitle">
                                {{ __('about.our_history_description') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Mission -->
            <div class="animated-card loading">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-4">
                            <div class="feature-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="section-title">{{ __('about.our_mission_title') }}</h2>
                            <p class="section-subtitle">
                                {{ __('about.our_mission_description') }}
                            </p>
                            <p class="section-subtitle mb-0">
                                {{ __('about.our_mission_description_2') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Products -->
            <div class="animated-card loading">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-4">
                            <div class="feature-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="section-title">{{ __('about.our_products_title') }}</h2>
                            <p class="section-subtitle mb-4">
                                {{ __('about.our_products_description') }}
                            </p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-right"></i> {{ __('about.explore_products') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="animated-card loading">
                <div class="card-body">
                    <h2 class="section-title text-center mb-5">{{ __('about.why_choose_us_title') }}</h2>
                    <div class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="feature-title">{{ __('about.why_choose_us_performance_title') }}</h3>
                            <p class="feature-description">
                                {{ __('about.why_choose_us_performance_description') }}
                            </p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3 class="feature-title">{{ __('about.why_choose_us_partnership_title') }}</h3>
                            <p class="feature-description">
                                {{ __('about.why_choose_us_partnership_description') }}
                            </p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h3 class="feature-title">{{ __('about.why_choose_us_support_title') }}</h3>
                            <p class="feature-description">
                                {{ __('about.why_choose_us_support_description') }}
                            </p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h3 class="feature-title">{{ __('about.why_choose_us_innovation_title') }}</h3>
                            <p class="feature-description">
                                {{ __('about.why_choose_us_innovation_description') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="animated-card loading">
                <div class="contact-cta">
                    <div class="feature-icon mx-auto">
                        <a href="{{ route('contact') }}">
                            <i class="fas fa-phone"></i>
                        </a>
                    </div>
                    <h2 class="section-title">{{ __('about.contact_us') }}</h2>
                    <p class="section-subtitle">
                        {{ __('about.contact_cta_description') }}
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope"></i>
                        {{ __('about.get_in_touch') }}
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-cogs"></i>
                        {{ __('about.view_products') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Performance optimized counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stats-counter[data-count]');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000; // 2 seconds
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    // Use easing function for smooth animation
                    const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                    const current = Math.floor(easeOutQuart * target);

                    counter.textContent = current;

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                // Start animation when element is in view
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            requestAnimationFrame(updateCounter);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5,
                    rootMargin: '50px'
                });

                observer.observe(counter);
            });
        }

        // Enhanced card animations with performance optimization
        function initCardAnimations() {
            const cards = document.querySelectorAll('.animated-card.loading');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Use requestAnimationFrame for smooth animations
                        requestAnimationFrame(() => {
                            entry.target.classList.remove('loading');
                            entry.target.classList.add('loaded');
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px'
            });

            cards.forEach((card, index) => {
                // Stagger animation delays
                card.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(card);
            });
        }

        // Smooth scroll for internal links
        function initSmoothScroll() {
            const links = document.querySelectorAll('a[href^="#"]');

            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        // Optimize images loading
        function initLazyLoading() {
            const images = document.querySelectorAll('img[data-src]');

            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }

        // Enhanced hover effects for feature cards
        function initHoverEffects() {
            const featureCards = document.querySelectorAll('.feature-card');

            featureCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        }

        // Accessibility improvements
        function initAccessibility() {
            // Add keyboard navigation for cards
            const cards = document.querySelectorAll('.animated-card');

            cards.forEach(card => {
                card.setAttribute('tabindex', '0');
                card.setAttribute('role', 'article');

                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });

            // Add ARIA labels for better screen reader support
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => {
                if (!btn.getAttribute('aria-label')) {
                    btn.setAttribute('aria-label', btn.textContent.trim());
                }
            });
        }

        // Error handling for animations
        function handleAnimationErrors() {
            window.addEventListener('error', function(e) {
                console.warn('Animation error:', e.message);
                // Fallback: show all content immediately
                document.querySelectorAll('.loading').forEach(el => {
                    el.classList.remove('loading');
                    el.classList.add('loaded');
                });
            });
        }

        // Performance monitoring
        function initPerformanceMonitoring() {
            if ('performance' in window) {
                window.addEventListener('load', function() {
                    const loadTime = performance.now();
                    console.log(`Page loaded in ${loadTime}ms`);

                    // Log Core Web Vitals if available
                    if ('PerformanceObserver' in window) {
                        const observer = new PerformanceObserver((entryList) => {
                            const entries = entryList.getEntries();
                            entries.forEach(entry => {
                                if (entry.entryType === 'largest-contentful-paint') {
                                    console.log('LCP:', entry.startTime);
                                }
                            });
                        });

                        observer.observe({
                            entryTypes: ['largest-contentful-paint']
                        });
                    }
                });
            }
        }

        // Throttled scroll handler for performance
        function throttle(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        }

        // Enhanced scroll effects
        function initScrollEffects() {
            const heroSection = document.querySelector('.hero-section');

            const scrollHandler = throttle(function() {
                const scrollY = window.pageYOffset;
                const rate = scrollY * -0.5;

                if (heroSection) {
                    heroSection.style.transform = `translateY(${rate}px)`;
                }
            }, 10);

            window.addEventListener('scroll', scrollHandler);
        }

        // Initialize all functions when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Core functionality
                animateCounters();
                initCardAnimations();
                initSmoothScroll();
                initAccessibility();

                // Enhanced features
                initHoverEffects();
                initLazyLoading();
                initScrollEffects();
                initPerformanceMonitoring();

                // Error handling
                handleAnimationErrors();

                // Mark page as fully loaded
                document.body.classList.add('page-loaded');

            } catch (error) {
                console.error('Error initializing page:', error);
                // Fallback behavior
                document.querySelectorAll('.loading').forEach(el => {
                    el.classList.remove('loading');
                    el.classList.add('loaded');
                });
            }
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            // Cancel any running animations
            document.querySelectorAll('.animate-counter').forEach(el => {
                el.style.animation = 'none';
            });
        });

        // Handle reduced motion preference
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.style.setProperty('--transition', 'none');
            document.querySelectorAll('.animate-counter').forEach(el => {
                el.style.animation = 'none';
            });
        }
    </script>
@endpush
