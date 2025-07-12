@extends('layouts.public')

@section('title', __('terms.title'))
@section('description', __('terms.description'))

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

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: var(--border-radius);
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-color);
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
    .terms-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, #0066a3 100%);
        color: white;
        padding: 8rem 0 5rem;
        margin-top: 0;
        position: relative;
        overflow: hidden;
    }

    .terms-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(176, 215, 1, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="terms-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23terms-grid)"/></svg>');
        z-index: 1;
    }

    .terms-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .terms-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
        line-height: 1.2;
    }

    .terms-hero .lead {
        font-size: clamp(1.1rem, 2.5vw, 1.4rem);
        font-weight: 400;
        opacity: 0.95;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        line-height: 1.6;
    }

    /* Enhanced Terms Section */
    .terms-section {
        background: var(--background-color);
        padding: 6rem 0;
        position: relative;
    }

    .terms-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(0,84,142,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots-pattern)"/></svg>');
        z-index: 0;
    }

    .terms-section .container {
        position: relative;
        z-index: 1;
    }

    /* Enhanced Terms Cards */
    .terms-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
        padding: 3rem;
        margin-bottom: 2.5rem;
        transition: all var(--transition-duration) cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .terms-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        transition: width var(--transition-duration) ease;
    }

    .terms-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-shadow-hover);
        border-color: rgba(0, 84, 142, 0.2);
    }

    .terms-card:hover::before {
        width: 8px;
    }

    /* Enhanced Section Icons */
    .section-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-color), #0066a3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 84, 142, 0.3);
        transition: all var(--transition-duration) ease;
    }

    .terms-card:hover .section-icon {
        background: linear-gradient(135deg, var(--secondary-color), #9bc600);
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 6px 25px rgba(176, 215, 1, 0.4);
    }

    /* Enhanced Section Titles */
    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        position: relative;
        display: flex;
        align-items: center;
        gap: 1rem;
        line-height: 1.3;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-color), transparent);
        border-radius: 1px;
    }

    /* Enhanced Terms Text */
    .terms-text {
        line-height: 1.8;
        color: var(--text-color);
        font-size: 1.1rem;
        font-weight: 400;
        margin-bottom: 1.5rem;
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
    }

    .updated-info i {
        font-size: 1.2rem;
        color: var(--primary-color);
    }

    /* Enhanced Terms Lists */
    .terms-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .terms-list li {
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
        position: relative;
        padding-left: 3rem;
        font-size: 1.05rem;
        color: var(--text-color);
        transition: all var(--transition-duration) ease;
    }

    .terms-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, var(--secondary-color), #9bc600);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        content: '\f00c';
        color: white;
        font-size: 0.8rem;
        box-shadow: 0 2px 8px rgba(176, 215, 1, 0.3);
    }

    .terms-list li:hover {
        padding-left: 3.5rem;
        color: var(--primary-color);
        background: rgba(0, 84, 142, 0.02);
    }

    .terms-list li:last-child {
        border-bottom: none;
    }

    /* Enhanced Terms Highlights */
    .terms-highlight {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        padding: 2rem;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--secondary-color);
        margin: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    .terms-highlight::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(176, 215, 1, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .terms-highlight h4 {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
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
        margin-top: 1.5rem;
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
        .terms-hero {
            padding: 6rem 0 4rem;
        }
        
        .terms-section {
            padding: 4rem 0;
        }
        
        .terms-card {
            padding: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .terms-hero {
            padding: 5rem 0 3rem;
        }
        
        .terms-hero h1 {
            font-size: 2.5rem;
        }
        
        .terms-hero .lead {
            font-size: 1.1rem;
        }
        
        .terms-section {
            padding: 3rem 0;
        }
        
        .terms-card {
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .section-title::after {
            width: 60px;
            height: 2px;
        }
        
        .section-icon {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }
        
        .terms-text {
            font-size: 1rem;
        }
        
        .updated-info {
            padding: 1.25rem 1.5rem;
            flex-direction: column;
            text-align: center;
            gap: 0.75rem;
        }
        
        .terms-highlight {
            padding: 1.5rem;
        }
        
        .terms-list li {
            padding: 0.75rem 0;
            padding-left: 2.5rem;
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
        .terms-hero {
            padding: 4rem 0 2rem;
        }
        
        .terms-card {
            padding: 1.5rem;
        }
        
        .section-title {
            font-size: 1.3rem;
        }
        
        .terms-highlight {
            padding: 1.25rem;
        }
        
        .terms-list li {
            padding-left: 2rem;
            font-size: 0.95rem;
        }
        
        .terms-list li::before {
            width: 16px;
            height: 16px;
            font-size: 0.7rem;
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
    [dir="rtl"] .terms-card::before {
        left: auto;
        right: 0;
    }

    [dir="rtl"] .section-title::after {
        background: linear-gradient(270deg, var(--primary-color), transparent);
    }

    [dir="rtl"] .terms-list li {
        padding-left: 0;
        padding-right: 3rem;
    }

    [dir="rtl"] .terms-list li::before {
        left: auto;
        right: 0;
    }

    [dir="rtl"] .updated-info {
        border-left: none;
        border-right: 4px solid var(--primary-color);
    }

    [dir="rtl"] .terms-highlight {
        border-left: none;
        border-right: 4px solid var(--secondary-color);
    }

    [dir="rtl"] .cta-button:hover i {
        transform: translateX(-5px);
    }

    /* Print Styles */
    @media print {
        .terms-hero {
            background: white !important;
            color: black !important;
            padding: 2rem 0 !important;
        }
        
        .terms-card {
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
    .terms-card:focus-within {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    .cta-button:focus {
        outline: 2px solid var(--secondary-color);
        outline-offset: 4px;
    }

    /* High Contrast Mode */
    @media (prefers-contrast: high) {
        .terms-card {
            border: 2px solid var(--text-color);
        }
        
        .section-title {
            color: var(--text-color);
        }
        
        .terms-text {
            color: var(--text-color);
        }
    }
</style>
@endpush

@section('content')
    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Enhanced Hero Section -->
    <section class="terms-hero">
        <div class="container">
            <div class="terms-content animate-fade-in">
                <h1 class="display-4 fw-bold mb-3">{{ __('terms.terms_of_service') }}</h1>
                <p class="lead">{{ __('terms.please_read_carefully') }}</p>
            </div>
        </div>
    </section>

    <!-- Enhanced Terms Content Section -->
    <section class="terms-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Enhanced Updated Info -->
                    <div class="updated-info animate-slide-in">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ __('terms.last_updated', ['date' => date('F j, Y')]) }}</span>
                    </div>

                    <!-- Acceptance of Terms -->
                    <div class="terms-card animate-slide-in">
                        <div class="section-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h2 class="section-title">{{ __('terms.acceptance_of_terms') }}</h2>
                        <p class="terms-text">
                            {{ __('terms.acceptance_description_1') }}
                        </p>
                        <p class="terms-text">
                            {{ __('terms.acceptance_description_2') }}
                        </p>
                    </div>

                    <!-- Use License -->
                    <div class="terms-card animate-slide-in">
                        <div class="section-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h2 class="section-title">{{ __('terms.use_license') }}</h2>
                        <p class="terms-text">
                            {{ __('terms.use_license_description') }}
                        </p>
                        
                        <div class="terms-highlight">
                            <h4 class="mb-3">{{ __('terms.prohibited_uses') }}</h4>
                            <ul class="terms-list">
                                <li>{{ __('terms.modify_or_copy') }}</li>
                                <li>{{ __('terms.use_for_commercial') }}</li>
                                <li>{{ __('terms.attempt_decompile') }}</li>
                                <li>{{ __('terms.remove_copyright') }}</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Product Information -->
                    <div class="terms-card animate-slide-in">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="section-title">{{ __('terms.product_information') }}</h2>
                        <p class="terms-text">
                            {{ __('terms.product_info_description') }}
                        </p>
                    </div>

                    <!-- Disclaimer -->
                    <div class="terms-card animate-slide-in">
                        <div class="section-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h2 class="section-title">{{ __('terms.disclaimer') }}</h2>
                        <p class="terms-text">
                            {{ __('terms.disclaimer_description') }}
                        </p>
                    </div>

                    <!-- Limitations -->
                    <div class="terms-card animate-slide-in">
                        <div class="section-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h2 class="section-title">{{ __('terms.limitations') }}</h2>
                        <p class="terms-text">
                            {{ __('terms.limitations_description') }}
                        </p>
                    </div>

                    <!-- Governing Law -->
                    <div class="terms-card animate-slide-in">
                        <div class="section-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h2 class="section-title">{{ __('terms.governing_law') }}</h2>
                        <p class="terms-text">
                            {{ __('terms.governing_law_description') }}
                        </p>
                    </div>

                    <!-- Enhanced Contact Section -->
                    <div class="contact-section animate-slide-in">
                        <div class="contact-content">
                            <h3 class="mb-3">{{ __('terms.have_questions') }}</h3>
                            <p class="mb-0">
                                {{ __('terms.contact_description') }}
                            </p>
                            <a href="{{ route('contact') }}" class="cta-button">
                                <i class="fas fa-envelope"></i>
                                {{ __('terms.contact_us') }}
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
                    const icon = entry.target.querySelector('.section-icon');
                    if (icon) {
                        setTimeout(() => {
                            icon.style.transform = 'scale(1.1) rotate(360deg)';
                            setTimeout(() => {
                                icon.style.transform = 'scale(1) rotate(0deg)';
                            }, 300);
                        }, 200);
                    }
                }
            });
        }, observerOptions);

        // Observe all terms cards and contact section
        document.querySelectorAll('.terms-card, .contact-section').forEach(card => {
            observer.observe(card);
        });

        // Enhanced card interactions
        document.querySelectorAll('.terms-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.borderColor = 'rgba(0, 84, 142, 0.3)';
                
                // Animate list items on hover
                const listItems = this.querySelectorAll('.terms-list li');
                listItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.transform = 'translateX(5px)';
                    }, index * 50);
                });
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.borderColor = 'var(--border-color)';
                
                // Reset list items
                const listItems = this.querySelectorAll('.terms-list li');
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
            document.querySelectorAll('.terms-card').forEach(card => {
                card.style.pageBreakInside = 'avoid';
            });
        });

        // Enhanced error handling
        window.addEventListener('error', function(e) {
            console.warn('Terms page error:', e.error);
        });

        // Enhanced performance monitoring
        if ('performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    if (perfData && perfData.loadEventEnd > 3000) {
                        console.warn('Terms page loaded slowly:', perfData.loadEventEnd + 'ms');
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
                    const title = entry.target.querySelector('.section-title');
                    if (title) {
                        announceToScreenReader(`Now viewing: ${title.textContent}`);
                    }
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.terms-card').forEach(card => {
            sectionObserver.observe(card);
        });
    });
</script>
@endpush