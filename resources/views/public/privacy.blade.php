@extends('layouts.public')

@section('title', __('privacy.title'))
@section('description', __('privacy.description'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --primary-color: #00548e;
        --secondary-color: #b0d701;
        --accent-color: #4ade80;
        --background-color: #f8fafc;
        --text-color: #111827;
        --text-muted: #6b7280;
        --border-color: #e2e8f0;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --transition-duration: 0.3s;
        --border-radius: 16px;
        --card-shadow: 0 4px 20px rgba(0, 84, 142, 0.08);
        --card-shadow-hover: 0 8px 32px rgba(0, 84, 142, 0.15);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: var(--text-color);
        background: var(--background-color);
        overflow-x: hidden;
    }

    /* Scroll Progress Indicator */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        z-index: 9999;
        transition: width 0.1s ease;
    }

    /* Enhanced Hero Section */
    .privacy-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, #0066a3 100%);
        color: white;
        padding: 8rem 0 5rem;
        margin-top: 0;
        position: relative;
        overflow: hidden;
    }

    .privacy-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(176, 215, 1, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="privacy-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23privacy-grid)"/></svg>');
        z-index: 1;
    }

    .privacy-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .privacy-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        line-height: 1.2;
    }

    .privacy-hero .lead {
        font-size: clamp(1.1rem, 2.5vw, 1.4rem);
        font-weight: 400;
        opacity: 0.95;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        line-height: 1.6;
    }

    /* Enhanced Privacy Section */
    .privacy-section {
        background: var(--background-color);
        padding: 6rem 0;
        position: relative;
    }

    .privacy-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(0,84,142,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots-pattern)"/></svg>');
        z-index: 0;
    }

    .privacy-section .container {
        position: relative;
        z-index: 1;
    }

    /* Enhanced Updated Info */
    .updated-info {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        padding: 1.5rem 2rem;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--primary-color);
        margin-bottom: 3rem;
        font-size: 1rem;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 1rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 84, 142, 0.1);
        transition: all var(--transition-duration) ease;
    }

    .updated-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 84, 142, 0.15);
    }

    .updated-info i {
        font-size: 1.2rem;
        color: var(--primary-color);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Enhanced Privacy Cards */
    .privacy-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
        margin-bottom: 2.5rem;
        transition: all var(--transition-duration) cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .privacy-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        transition: width var(--transition-duration) ease;
    }

    .privacy-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-shadow-hover);
        border-color: rgba(0, 84, 142, 0.2);
    }

    .privacy-card:hover::before {
        width: 8px;
    }

    /* Enhanced Card Headers */
    .card-header {
        background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        border-bottom: 1px solid var(--border-color);
        padding: 2rem 2.5rem 1.5rem;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        position: relative;
    }

    .card-header h3 {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
        line-height: 1.3;
    }

    .card-header h3 i {
        font-size: 1.3rem;
        transition: all var(--transition-duration) ease;
    }

    .privacy-card:hover .card-header h3 i {
        transform: scale(1.2) rotate(5deg);
        color: var(--secondary-color);
    }

    /* Enhanced Card Bodies */
    .card-body {
        padding: 2.5rem;
    }

    .card-body p {
        line-height: 1.8;
        color: var(--text-color);
        font-size: 1.1rem;
        font-weight: 400;
        margin-bottom: 1.5rem;
    }

    .card-body p:last-child {
        margin-bottom: 0;
    }

    /* Enhanced Lists */
    .info-list ul,
    .card-body ul {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
    }

    .info-list li,
    .card-body li {
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
        position: relative;
        padding-left: 2.5rem;
        font-size: 1.05rem;
        color: var(--text-color);
        transition: all var(--transition-duration) ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .info-list li:hover,
    .card-body li:hover {
        padding-left: 3rem;
        color: var(--primary-color);
        background: rgba(0, 84, 142, 0.02);
        border-radius: 8px;
    }

    .info-list li:last-child,
    .card-body li:last-child {
        border-bottom: none;
    }

    .info-list li i,
    .card-body li i {
        color: var(--secondary-color);
        font-size: 1rem;
        min-width: 1rem;
        transition: all var(--transition-duration) ease;
    }

    .info-list li:hover i,
    .card-body li:hover i {
        transform: scale(1.2);
        color: var(--primary-color);
    }

    /* Enhanced Contact Section */
    .contact-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #0066a3 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
        border-radius: var(--border-radius);
        margin-top: 3rem;
        position: relative;
        overflow: hidden;
    }

    .contact-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 20%, rgba(176, 215, 1, 0.15) 0%, transparent 50%),
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="contact-dots" width="30" height="30" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="1.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23contact-dots)"/></svg>');
        z-index: 1;
    }

    .contact-content {
        position: relative;
        z-index: 2;
    }

    .contact-section h3 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .contact-section p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Enhanced CTA Button */
    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--secondary-color);
        color: white;
        padding: 1.25rem 2.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all var(--transition-duration) cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid var(--secondary-color);
        box-shadow: 0 4px 20px rgba(176, 215, 1, 0.3);
        position: relative;
        overflow: hidden;
    }

    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .cta-button:hover::before {
        left: 100%;
    }

    .cta-button:hover {
        background: transparent;
        color: var(--secondary-color);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 30px rgba(176, 215, 1, 0.4);
        text-decoration: none;
    }

    .cta-button i {
        transition: transform var(--transition-duration) ease;
    }

    .cta-button:hover i {
        transform: translateX(5px);
    }

    /* Enhanced Animations */
    .animate-slide-in {
        animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Enhanced Responsive Design */
    @media (max-width: 1024px) {
        .privacy-hero {
            padding: 6rem 0 4rem;
        }
        
        .privacy-section {
            padding: 4rem 0;
        }
        
        .card-header,
        .card-body {
            padding: 2rem;
        }
    }

    @media (max-width: 768px) {
        .privacy-hero {
            padding: 5rem 0 3rem;
        }
        
        .privacy-hero h1 {
            font-size: 2.5rem;
        }
        
        .privacy-hero .lead {
            font-size: 1.1rem;
        }
        
        .privacy-section {
            padding: 3rem 0;
        }
        
        .privacy-card {
            margin-bottom: 2rem;
        }
        
        .card-header h3 {
            font-size: 1.3rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .card-header,
        .card-body {
            padding: 1.5rem;
        }
        
        .card-body p {
            font-size: 1rem;
        }
        
        .updated-info {
            padding: 1.25rem 1.5rem;
            flex-direction: column;
            text-align: center;
            gap: 0.75rem;
        }
        
        .info-list li,
        .card-body li {
            padding: 0.75rem 0;
            padding-left: 2rem;
            font-size: 1rem;
        }
        
        .contact-section {
            padding: 3rem 1.5rem;
            margin-top: 2rem;
        }
        
        .contact-section h3 {
            font-size: 1.8rem;
        }
        
        .contact-section p {
            font-size: 1.1rem;
        }
        
        .cta-button {
            padding: 1rem 2rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .privacy-hero {
            padding: 4rem 0 2rem;
        }
        
        .card-header h3 {
            font-size: 1.2rem;
        }
        
        .card-header,
        .card-body {
            padding: 1.25rem;
        }
        
        .info-list li,
        .card-body li {
            padding-left: 1.5rem;
            font-size: 0.95rem;
        }
        
        .contact-section {
            padding: 2.5rem 1rem;
        }
        
        .contact-section h3 {
            font-size: 1.6rem;
        }
        
        .cta-button {
            padding: 0.875rem 1.75rem;
            font-size: 0.95rem;
        }
    }

    /* RTL Support */
    [dir="rtl"] .privacy-card::before {
        left: auto;
        right: 0;
    }

    [dir="rtl"] .info-list li,
    [dir="rtl"] .card-body li {
        padding-left: 0;
        padding-right: 2.5rem;
    }

    [dir="rtl"] .info-list li:hover,
    [dir="rtl"] .card-body li:hover {
        padding-right: 3rem;
        padding-left: 0;
    }

    [dir="rtl"] .updated-info {
        border-left: none;
        border-right: 4px solid var(--primary-color);
    }

    [dir="rtl"] .cta-button:hover i {
        transform: translateX(-5px);
    }

    /* Print Styles */
    @media print {
        .privacy-hero {
            background: white !important;
            color: black !important;
            padding: 2rem 0 !important;
        }
        
        .privacy-card {
            box-shadow: none !important;
            border: 1px solid #ccc !important;
            break-inside: avoid;
            margin-bottom: 1rem !important;
        }
        
        .contact-section {
            background: white !important;
            color: black !important;
            border: 1px solid #ccc !important;
        }
        
        .cta-button {
            display: none !important;
        }
    }

    /* Accessibility Enhancements */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Focus States */
    .privacy-card:focus-within {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    .cta-button:focus {
        outline: 2px solid var(--secondary-color);
        outline-offset: 4px;
    }

    /* High Contrast Mode */
    @media (prefers-contrast: high) {
        .privacy-card {
            border: 2px solid var(--text-color);
        }
        
        .card-header h3 {
            color: var(--text-color);
        }
        
        .card-body p {
            color: var(--text-color);
        }
    }
</style>
@endpush

@section('content')
    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Enhanced Hero Section -->
    <section class="privacy-hero">
        <div class="container">
            <div class="privacy-content animate-fade-in">
                <h1 class="display-4 fw-bold mb-3">{{ __('privacy.privacy_policy') }}</h1>
                <p class="lead">{{ __('privacy.privacy_important') }}</p>
            </div>
        </div>
    </section>

    <!-- Enhanced Privacy Content Section -->
    <section class="privacy-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Enhanced Updated Info -->
                    <div class="updated-info animate-slide-in">
                        <i class="fas fa-shield-alt"></i>
                        <span>{{ __('privacy.last_updated', ['date' => date('F j, Y')]) }}</span>
                    </div>

                    <!-- Introduction -->
                    <div class="card privacy-card animate-slide-in" id="introduction">
                        <div class="card-header">
                            <h3><i class="fas fa-info-circle"></i> {{ __('privacy.introduction_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{!! __('privacy.introduction_content') !!}</p>
                        </div>
                    </div>

                    <!-- Information Collection -->
                    <div class="card privacy-card animate-slide-in" id="information_collection">
                        <div class="card-header">
                            <h3><i class="fas fa-database"></i> {{ __('privacy.information_collection_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{{ __('privacy.information_collection_content') }}</p>
                            <div class="info-list">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> {!! __('privacy.info_item_1') !!}</li>
                                    <li><i class="fas fa-check-circle"></i> {!! __('privacy.info_item_2') !!}</li>
                                    <li><i class="fas fa-check-circle"></i> {!! __('privacy.info_item_3') !!}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Information Usage -->
                    <div class="card privacy-card animate-slide-in" id="information_usage">
                        <div class="card-header">
                            <h3><i class="fas fa-cogs"></i> {{ __('privacy.information_usage_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{{ __('privacy.information_usage_content') }}</p>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> {{ __('privacy.usage_item_1') }}</li>
                                <li><i class="fas fa-check-circle"></i> {{ __('privacy.usage_item_2') }}</li>
                                <li><i class="fas fa-check-circle"></i> {{ __('privacy.usage_item_3') }}</li>
                                <li><i class="fas fa-check-circle"></i> {{ __('privacy.usage_item_4') }}</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Cookies -->
                    <div class="card privacy-card animate-slide-in" id="cookies">
                        <div class="card-header">
                            <h3><i class="fas fa-cookie-bite"></i> {{ __('privacy.cookies_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{!! __('privacy.cookies_content') !!}</p>
                        </div>
                    </div>

                    <!-- Data Sharing -->
                    <div class="card privacy-card animate-slide-in" id="data_sharing">
                        <div class="card-header">
                            <h3><i class="fas fa-share-alt"></i> {{ __('privacy.data_sharing_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{!! __('privacy.data_sharing_content') !!}</p>
                        </div>
                    </div>

                    <!-- Data Security -->
                    <div class="card privacy-card animate-slide-in" id="data_security">
                        <div class="card-header">
                            <h3><i class="fas fa-shield-alt"></i> {{ __('privacy.data_security_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{!! __('privacy.data_security_content') !!}</p>
                        </div>
                    </div>

                    <!-- Your Rights -->
                    <div class="card privacy-card animate-slide-in" id="your_rights">
                        <div class="card-header">
                            <h3><i class="fas fa-user-shield"></i> {{ __('privacy.your_rights_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{!! __('privacy.your_rights_content') !!}</p>
                        </div>
                    </div>

                    <!-- Contact Us -->
                    <div class="card privacy-card animate-slide-in" id="contact_us">
                        <div class="card-header">
                            <h3><i class="fas fa-envelope"></i> {{ __('privacy.contact_us_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{{ __('privacy.contact_us_content') }}</p>
                            <p><strong>{{ __('privacy.contact_us_company') }}</strong></p>
                        </div>
                    </div>

                    <!-- Enhanced Contact Section -->
                    <div class="contact-section animate-slide-in">
                        <div class="contact-content">
                            <h3 class="mb-3">{{ __('privacy.questions_privacy') }}</h3>
                            <p class="mb-10">
                                {{ __('privacy.questions_description') }}
                            </p>
                            <a href="{{ route('contact') }}" class="cta-button">
                                <i class="fas fa-envelope"></i>
                                {{ __('privacy.contact_privacy_team') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced scroll progress indicator
        function updateScrollProgress() {
            const scrollProgress = document.getElementById('scrollProgress');
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = (scrollTop / scrollHeight) * 100;
            
            if (scrollProgress) {
                scrollProgress.style.width = progress + '%';
            }
        }

        // Enhanced scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Add staggered animation delay
                    entry.target.style.animationDelay = `${index * 0.1}s`;
                    entry.target.classList.add('animate-slide-in');
                    
                    // Add entrance animation to icons
                    const icon = entry.target.querySelector('.card-header h3 i');
                    if (icon) {
                        setTimeout(() => {
                            icon.style.transform = 'scale(1.2) rotate(360deg)';
                            setTimeout(() => {
                                icon.style.transform = 'scale(1) rotate(0deg)';
                            }, 300);
                        }, 200);
                    }
                }
            });
        }, observerOptions);

        // Observe all privacy cards and contact section
        document.querySelectorAll('.privacy-card, .contact-section').forEach(card => {
            observer.observe(card);
        });

        // Enhanced card interactions
        document.querySelectorAll('.privacy-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.borderColor = 'rgba(0, 84, 142, 0.3)';
                
                // Animate list items on hover
                const listItems = this.querySelectorAll('li');
                listItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.transform = 'translateX(5px)';
                    }, index * 50);
                });
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.borderColor = 'var(--border-color)';
                
                // Reset list items
                const listItems = this.querySelectorAll('li');
                listItems.forEach(item => {
                    item.style.transform = 'translateX(0)';
                });
            });
        });

        // Enhanced smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced scroll event listeners
        let ticking = false;
        
        function handleScroll() {
            if (!ticking) {
                requestAnimationFrame(() => {
                    updateScrollProgress();
                    ticking = false;
                });
                ticking = true;
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });

        // Initialize scroll progress
        updateScrollProgress();

        // Enhanced keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Add keyboard shortcuts for better accessibility
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'Home':
                        e.preventDefault();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        break;
                    case 'End':
                        e.preventDefault();
                        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                        break;
                }
            }
        });

        // Enhanced focus management
        const focusableElements = document.querySelectorAll(
            'a[href], button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])'
        );

        focusableElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.style.outline = '2px solid var(--primary-color)';
                this.style.outlineOffset = '2px';
            });

            element.addEventListener('blur', function() {
                this.style.outline = '';
                this.style.outlineOffset = '';
            });
        });

        // Enhanced print functionality
        window.addEventListener('beforeprint', function() {
            // Expand all collapsed sections for printing
            document.querySelectorAll('.privacy-card').forEach(card => {
                card.style.pageBreakInside = 'avoid';
            });
        });

        // Enhanced error handling
        window.addEventListener('error', function(e) {
            console.warn('Privacy page error:', e.error);
        });

        // Enhanced performance monitoring
        if ('performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    if (perfData && perfData.loadEventEnd > 3000) {
                        console.warn('Privacy page loaded slowly:', perfData.loadEventEnd + 'ms');
                    }
                }, 0);
            });
        }

        // Enhanced accessibility announcements
        const announceToScreenReader = (message) => {
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.style.position = 'absolute';
            announcement.style.left = '-10000px';
            announcement.style.width = '1px';
            announcement.style.height = '1px';
            announcement.style.overflow = 'hidden';
            announcement.textContent = message;
            
            document.body.appendChild(announcement);
            
            setTimeout(() => {
                document.body.removeChild(announcement);
            }, 1000);
        };

        // Announce when sections come into view
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const title = entry.target.querySelector('.card-header h3');
                    if (title) {
                        announceToScreenReader(`Now viewing: ${title.textContent}`);
                    }
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.privacy-card').forEach(card => {
            sectionObserver.observe(card);
        });
    });
</script>
@endpush