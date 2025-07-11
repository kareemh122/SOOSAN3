@extends('layouts.public')

@section('title', __('homepage.hero_slide_1_title') . ' - SoosanEgypt')
@section('description', __('homepage.hero_slide_1_description'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<!-- AOS Styles -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<style>
    /* Override navbar styles for homepage */
    .navbar {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
    }

    /* Icon Navigation Styles */
    .icon-nav {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav-icon-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: var(--text-color);
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 12px;
        min-width: 60px;
    }

    .nav-icon-item:hover {
        color: var(--primary-color);
        transform: translateY(-2px);
        background: rgba(37, 99, 235, 0.05);
    }

    .nav-icon-item.active {
        color: var(--primary-color);
        background: rgba(37, 99, 235, 0.1);
    }

    .nav-icon {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-icon-item:hover .nav-icon {
        transform: scale(1.1);
        animation: iconBounce 0.6s ease;
    }

    .nav-icon-label {
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .nav-icon-item:hover .nav-icon-label {
        opacity: 1;
        transform: scale(1.05);
    }

    /* Icon specific animations */
    .nav-icon-item:hover .fa-home {
        animation: homeAnimation 0.6s ease;
    }

    .nav-icon-item:hover .fa-cogs {
        animation: gearsAnimation 1s ease;
    }

    .nav-icon-item:hover .fa-search {
        animation: searchAnimation 0.8s ease;
    }

    .nav-icon-item:hover .fa-user-shield {
        animation: shieldAnimation 0.7s ease;
    }

    /* Keyframe animations */
    @keyframes iconBounce {
        0%, 100% { transform: scale(1.1); }
        50% { transform: scale(1.25); }
    }

    @keyframes homeAnimation {
        0%, 100% { transform: scale(1.1); }
        25% { transform: scale(1.2) rotate(-5deg); }
        75% { transform: scale(1.2) rotate(5deg); }
    }

    @keyframes gearsAnimation {
        0%, 100% { transform: scale(1.1) rotate(0deg); }
        50% { transform: scale(1.25) rotate(180deg); }
    }

    @keyframes searchAnimation {
        0%, 100% { transform: scale(1.1); }
        25% { transform: scale(1.2) translateX(-2px); }
        75% { transform: scale(1.2) translateX(2px); }
    }

    @keyframes shieldAnimation {
        0%, 100% { transform: scale(1.1); }
        50% { transform: scale(1.25); }
        25% { filter: drop-shadow(0 0 10px rgba(37, 99, 235, 0.5)); }
        75% { filter: drop-shadow(0 0 15px rgba(37, 99, 235, 0.7)); }
    }

    /* Active indicator */
    .nav-icon-item::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .nav-icon-item.active::after,
    .nav-icon-item:hover::after {
        width: 24px;
    }

    /* Mobile responsive */
    @media (max-width: 991px) {
        .icon-nav {
            flex-direction: column;
            gap: 1rem;
            background: white;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        .nav-icon-item {
            flex-direction: row;
            justify-content: flex-start;
            width: 100%;
            padding: 0.75rem;
            gap: 1rem;
        }

        .nav-icon {
            margin-bottom: 0;
            font-size: 1.25rem;
        }

        .nav-icon-label {
            font-size: 0.9rem;
        }

        .nav-icon-item::after {
            display: none;
        }
    }

    /* Language and login adjustments */
    .navbar-nav .nav-link,
    .navbar-nav .btn {
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        transform: translateY(-1px);
    }

    .navbar-nav .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    /* Hero section padding adjustment for fixed navbar */
    .hero-slider {
        margin-top: 0;
    }

    /* iPhone-style Language Toggle Switch */
    .language-toggle-container {
        display: flex;
        align-items: center;
        margin-left: 1rem;
    }

    .language-toggle {
        position: relative;
        width: 80px;
        height: 36px;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        border-radius: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 2px solid #e2e8f0;
    }

    .language-toggle.active {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-color: var(--primary-color);
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2), 0 0 0 2px rgba(37, 99, 235, 0.2);
    }

    .language-toggle-slider {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 30px;
        height: 30px;
        background: white;
        border-radius: 50%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: #64748b;
    }

    .language-toggle.active .language-toggle-slider {
        transform: translateX(44px);
        color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .language-labels {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 8px;
        pointer-events: none;
        font-size: 11px;
        font-weight: 600;
    }

    .lang-en {
        color: #64748b;
        transition: all 0.3s ease;
    }

    .lang-ar {
        color: #64748b;
        transition: all 0.3s ease;
    }

    .language-toggle.active .lang-en {
        color: rgba(255, 255, 255, 0.8);
    }

    .language-toggle.active .lang-ar {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Hover effects */
    .language-toggle:hover {
        transform: scale(1.02);
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .language-toggle:active {
        transform: scale(0.98);
    }

    /* Animation for smooth sliding */
    @keyframes slideToggle {
        0% { transform: translateX(0); }
        100% { transform: translateX(44px); }
    }

    .language-toggle.active .language-toggle-slider {
        animation: slideToggle 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Mobile adjustments */
    @media (max-width: 991px) {
        .language-toggle-container {
            margin: 1rem 0;
            justify-content: center;
        }
        
        .language-toggle {
            width: 90px;
            height: 40px;
        }
        
        .language-toggle-slider {
            width: 34px;
            height: 34px;
        }
        
        .language-toggle.active .language-toggle-slider {
            transform: translateX(48px);
        }
    }
    :root {
        --primary-color: #2563eb;
        --secondary-color: #1d4ed8;
        --accent-color: #4ade80;
        --background-color: #f8fafc;
        --text-color: #111827;
        --text-muted: #6b7280;
        --border-color: #e2e8f0;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --transition-duration: 0.4s;
        --border-radius: 12px;
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

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Modern Hero Slider */
    .hero-slider {
        position: relative;
        height: 100vh;
        overflow: hidden;
    }

    .slider-container {
        position: relative;
        height: 100%;
    }

    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
    }

    .hero-slide.active {
        opacity: 1;
    }

    .slide-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    .slide-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg, 
            rgba(0, 0, 0, 0.3) 0%, 
            rgba(0, 0, 0, 0.1) 50%, 
            rgba(0, 0, 0, 0.2) 100%
        );
        z-index: 2;
    }
    .slide-overlay::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(20,30,40,0.55);
        z-index: 1;
        pointer-events: none;
    }

    /* Modern Hero Content Section */
    .hero-content-overlay {
        position: absolute;
        left: 7%;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        color: #fff;
        max-width: 600px;
        width: 90%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        background: none;
        padding: 0;
        box-shadow: none;
    }
    .hero-main-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.1;
        color: #fff;
        margin-bottom: 1.1rem;
        text-shadow: 0 4px 24px rgba(0,0,0,0.18);
        letter-spacing: -1px;
    }
    .hero-desc {
        font-size: 1.25rem;
        color: #e0e7ef;
        margin-bottom: 2.2rem;
        font-weight: 400;
        text-shadow: 0 2px 10px rgba(0,0,0,0.18);
    }
    .hero-btn-group {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }
    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 1.15rem;
        font-weight: 700;
        border-radius: 0.7rem;
        border: none;
        outline: none;
        padding: 1.05rem 2.2rem;
        background: #00548e;
        color: #222;
        box-shadow: 0 4px 24px rgba(0,0,0,0.14);
        text-decoration: none;
        transition: all 0.2s cubic-bezier(.4,2,.3,1);
        cursor: pointer;
    }
    .hero-btn i {
        font-size: 1.15em;
    }
    .btn-explore {
        background: #b0d701;
        color: #222;
        border: none;
    }
    .btn-explore:hover, .btn-explore:focus {
        background: #a0c000;
        color: #fff;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 8px 32px #b0d70144;
    }
    .btn-warranty {
        background: #fff;
        color: #00548e;
        border: 2px solid #b0d701;
    }
    .btn-warranty:hover, .btn-warranty:focus {
        background: #b0d701;
        color: #222;
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 8px 32px #b0d70144;
    }
    @media (max-width: 900px) {
        .hero-main-title { font-size: 2.2rem; }
        .hero-content-overlay { left: 4%; max-width: 98vw; }
    }
    @media (max-width: 600px) {
        .hero-main-title { font-size: 1.35rem; }
        .hero-desc { font-size: 1rem; }
        .hero-content-overlay { left: 2%; padding: 0; }
        .hero-btn { font-size: 1rem; padding: 0.85rem 1.2rem; }
    }

    .hero-content-section {
        position: relative;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        padding: 6rem 0;
        margin-top: -100px;
        z-index: 10;
        border-radius: 40px 40px 0 0;
        box-shadow: 0 -20px 40px rgba(0, 0, 0, 0.1);
    }

    .hero-content-section::before {
        content: '';
        position: absolute;
        top: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color), var(--secondary-color));
    }

    .hero-content {
        text-align: center;
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .hero-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.3);
        animation: slideUp 0.8s ease-out;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--text-color);
        line-height: 1.2;
        animation: slideUp 0.8s ease-out 0.2s both;
    }

    .hero-title .highlight {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: clamp(1.2rem, 2.5vw, 1.8rem);
        font-weight: 500;
        margin-bottom: 3rem;
        color: var(--text-muted);
        line-height: 1.6;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        animation: slideUp 0.8s ease-out 0.4s both;
    }

    .hero-cta {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: slideUp 0.8s ease-out 0.6s both;
    }

    .btn-primary-hero {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.25rem 3rem;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.4s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.3);
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .btn-primary-hero:hover::before {
        left: 100%;
    }

    .btn-primary-hero:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(37, 99, 235, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-secondary-hero {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 1.25rem 3rem;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.4s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .btn-secondary-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: var(--primary-color);
        transition: width 0.4s ease;
        z-index: -1;
    }

    .btn-secondary-hero:hover::before {
        width: 100%;
    }

    .btn-secondary-hero:hover {
        color: white;
        text-decoration: none;
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
    }

    /* Modern Slider Navigation */
    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        color: var(--primary-color);
        padding: 1rem;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        transition: all 0.4s ease;
        z-index: 3;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slider-nav:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.3);
    }

    .slider-nav.prev {
        left: 2rem;
    }

    .slider-nav.next {
        right: 2rem;
    }

    .slider-dots {
        position: absolute;
        bottom: 9.5rem;
        left: 25%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.75rem;
        z-index: 1001;
        /* No background, overlay on video */
        pointer-events: auto;
    }

    .dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: transparent;
        border: 2px solid #00548e;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        opacity: 0.95;
    }

    .dot.active {
        background: #00548e;
        border-color: #00548e;
        opacity: 1;
    }

    .dot:hover {
        background: #b0d701;
        border-color: #b0d701;
        transform: scale(1.2);
        opacity: 1;
    }

    /* Modern Stats Section */
    .stats-section {
        background: #00548e;
        color: white;
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="stats-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23stats-pattern)"/></svg>');
        opacity: 0.5;
    }

    .stats-container {
        position: relative;
        z-index: 2;
    }

    .stat-card {
        text-align: center;
        padding: 2rem 1rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0.8));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: block;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 600;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Modern Product Search Section */
    
    .search-tags {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .tag-label {
        font-size: 1rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .search-tag {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .search-tag:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        color: white;
        text-decoration: none;
    }

    .search-input-container:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
    }

    .search-input {
        flex: 1;
        border: none;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        background: transparent;
        outline: none;
    }

    .search-tags {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .tag-label {
        font-weight: 600;
        color: var(--text-color);
    }

    .search-tag {
        background: var(--primary-color);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius);
        font-size: 0.9rem;
        text-decoration: none;
        transition: all var(--transition-duration) ease;
    }

    .search-tag:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
    }

    .search-filters {
        display: flex;
        gap: 1rem;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-select {
        min-width: 200px;
        border: 2px solid var(--border-color);
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        background: white;
        color: var(--text-color);
        transition: all var(--transition-duration) ease;
    }

    .search-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
    }

    .search-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all var(--transition-duration) ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .search-btn:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
    }

    /* Modern Product Line Section */
    .product-line-section {
        background: white;
        padding: 6rem 0;
        position: relative;
    }

    .section-header {
        text-align: center;
        margin-bottom: 4rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .section-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--accent-color), #10b981);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 20px rgba(74, 222, 128, 0.3);
    }

    .section-title {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 800;
        color: black;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .section-description {
        font-size: 1.2rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    .product-categories {
        display: flex;
        gap: 1rem;
        margin-bottom: 4rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .category-btn {
        background: #f1f5f9;
        color: var(--text-color);
        padding: 1rem 2rem;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .category-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        transition: left 0.3s ease;
        z-index: -1;
    }

    .category-btn:hover::before,
    .category-btn.active::before {
        left: 0;
    }

    .category-btn:hover,
    .category-btn.active {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
    }

    .product-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        position: relative;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .product-card:hover::before {
        opacity: 0.03;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 60px rgba(37, 99, 235, 0.15);
    }

    .product-image {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: #f8fafc;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.08);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #00548e, #0066a3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .product-link {
        background: white;
        color: #b0d701;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
        transform: scale(0.5);
    }

    .product-card:hover .product-link {
        transform: scale(1);
    }

    .product-link:hover {
        background: #b0d701;
        color: white;
        transform: scale(1.1);
    }

    .product-info {
        padding: 2rem;
        position: relative;
        z-index: 2;
    }

    .product-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-color);
        line-height: 1.3;
    }

    .product-description {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .product-btn {
        background: #00548e;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .product-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .product-btn:hover::before {
        left: 100%;
    }

    .product-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Features Section */
    .features-section {
        background: var(--background-color);
        padding: 4rem 0;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: var(--border-radius);
        text-align: center;
        transition: all var(--transition-duration) ease;
        box-shadow: 0 4px 12px var(--shadow-color);
        border: 1px solid var(--border-color);
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-size: 2rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .feature-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .feature-description {
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Serial Lookup Section */
    .serial-lookup-section {
        background: #00548e;
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .serial-lookup-content .section-title {
        color: white;
        margin-bottom: 1rem;
    }

    .serial-lookup-content .section-description {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
    }

    .serial-form {
        max-width: 500px;
        margin: 0 auto;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .serial-input {
        flex: 1;
        min-width: 250px;
        padding: 1rem 1.5rem;
        border: none;
        border-radius: var(--border-radius);
        font-size: 1rem;
        outline: none;
    }

    .serial-btn {
        background: #b0d701;
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all var(--transition-duration) ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .serial-btn:hover {
        background: rgb(152, 186, 4);
        transform: translateY(-2px);
    }

    /* Industries Section */
    .industries-section {
        background: white;
        padding: 4rem 0;
    }

    .industries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .industry-card {
        text-align: center;
        padding: 2rem;
        border-radius: var(--border-radius);
        transition: all var(--transition-duration) ease;
        border: 1px solid var(--border-color);
    }

    .industry-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px var(--shadow-color);
    }

    .industry-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        background: var(--background-color);
        color: var(--primary-color);
        font-size: 2rem;
        border: 2px solid var(--border-color);
    }

    .industry-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .industry-description {
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Animations */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-content {
            padding: 0 1rem;
        }
        
        .hero-cta {
            flex-direction: column;
            align-items: center;
        }
        
        .slider-nav {
            display: none;
        }
        
        .search-filters {
            flex-direction: column;
            gap: 1rem;
        }
        
        .search-select {
            width: 100%;
            min-width: auto;
        }
        
        .product-grid {
            grid-template-columns: 1fr;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
        }
        
        .industries-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .serial-form {
            flex-direction: column;
        }
        
        .serial-input {
            min-width: auto;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .industries-grid {
            grid-template-columns: 1fr;
        }
        
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .hero-content-section {
            padding: 4rem 0;
            margin-top: -50px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .hero-cta {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-primary-hero,
        .btn-secondary-hero {
            width: 100%;
            justify-content: center;
        }

        .stats-section {
            padding: 3rem 0;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .product-search-section {
            padding: 4rem 0;
        }

        .search-title {
            font-size: 2rem;
        }

        .search-input-container {
            flex-direction: column;
            padding: 1rem;
            gap: 1rem;
        }

        .search-input {
            padding: 1rem;
            text-align: center;
        }

        .search-input-btn {
            width: 100%;
        }

        .product-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .product-categories {
            flex-direction: column;
            gap: 0.5rem;
        }

        .category-btn {
            width: 100%;
        }

        .slider-nav {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .slider-nav.prev {
            left: 1rem;
        }

        .slider-nav.next {
            right: 1rem;
        }
    }

    /* RTL Support for Modern Design */
    [dir="rtl"] .hero-content-section {
        text-align: center;
    }

    [dir="rtl"] .hero-cta {
        direction: rtl;
        justify-content: center;
    }

    [dir="rtl"] .slider-nav.prev {
        left: auto;
        right: 2rem;
    }

    [dir="rtl"] .slider-nav.next {
        right: auto;
        left: 2rem;
    }

    [dir="rtl"] .search-input-container {
        direction: rtl;
    }

    [dir="rtl"] .search-input {
        text-align: right;
    }

    [dir="rtl"] .search-tags {
        direction: rtl;
    }

    [dir="rtl"] .product-categories {
        direction: rtl;
    }

    /* Animation improvements */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Modern scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Loading states */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Modern focus states */
    .btn-primary-hero:focus,
    .btn-secondary-hero:focus,
    .search-input-btn:focus,
    .category-btn:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Scroll Sections Styles */
    .scroll-section {
        position: relative;
        overflow: hidden;
    }

    .scroll-section .content-block {
        padding: 2rem 0;
    }

    .scroll-section .image-block {
        position: relative;
    }

    .scroll-section .image-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(37, 99, 235, 0.1), rgba(16, 185, 129, 0.1));
        z-index: 1;
        border-radius: 12px;
    }

    .scroll-section img {
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .scroll-section img:hover {
        transform: scale(1.05);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }

    .feature-item {
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateX(10px);
    }

    .badge-item {
        text-align: center;
        transition: all 0.3s ease;
        background: white;
    }

    .badge-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .stat-item {
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: scale(1.1);
    }

    /* Responsive Design for Scroll Sections */
    @media (max-width: 768px) {
        .scroll-section .row {
            flex-direction: column;
        }
        
        .scroll-section .col-lg-6 {
            margin-bottom: 2rem;
        }

        .scroll-section .order-lg-1,
        .scroll-section .order-lg-2 {
            order: initial;
        }

        .scroll-section img {
            height: 250px !important;
        }

        .display-4 {
            font-size: 2rem;
        }
    }

    /* RTL Support */
    [dir="rtl"] .hero-content {
        text-align: center;
    }

    [dir="rtl"] .hero-cta {
        direction: rtl;
        justify-content: center;
    }

    [dir="rtl"] .hero-title {
        font-family: 'Arial', sans-serif;
        direction: rtl;
    }

    [dir="rtl"] .hero-subtitle,
    [dir="rtl"] .hero-description {
        direction: rtl;
        text-align: center;
    }

    [dir="rtl"] .slider-nav.prev {
        left: auto;
        right: 2rem;
    }

    [dir="rtl"] .slider-nav.next {
        right: auto;
        left: 2rem;
    }

    [dir="rtl"] .search-input-container {
        direction: rtl;
    }

    [dir="rtl"] .search-input {
        text-align: right;
    }

    [dir="rtl"] .search-tags {
        direction: rtl;
    }

    [dir="rtl"] .product-categories {
        direction: rtl;
    }

    [dir="rtl"] .feature-item {
        direction: rtl;
    }

    [dir="rtl"] .feature-item:hover {
        transform: translateX(-10px);
    }

    [dir="rtl"] .stats-grid {
        direction: rtl;
    }

    [dir="rtl"] .quality-badges {
        direction: rtl;
    }

    [dir="rtl"] .future-features {
        direction: rtl;
    }

    [dir="rtl"] .icon-nav {
        direction: rtl;
    }

    [dir="rtl"] .language-toggle-container {
        margin-right: 1rem;
        margin-left: 0;
    }

    /* Arabic font improvements */
    [dir="rtl"] .hero-title,
    [dir="rtl"] .hero-subtitle,
    [dir="rtl"] .hero-description,
    [dir="rtl"] .section-title,
    [dir="rtl"] .section-description,
    [dir="rtl"] .search-title,
    [dir="rtl"] .search-subtitle {
        font-family: 'Arial', 'Tahoma', sans-serif;
    }

    /* Responsive RTL adjustments */
    @media (max-width: 768px) {
        [dir="rtl"] .hero-cta {
            flex-direction: column;
            align-items: center;
        }

        [dir="rtl"] .slider-nav.prev {
            right: 1rem;
        }

        [dir="rtl"] .slider-nav.next {
            left: 1rem;
        }
    }

    /* Typing Effect Cursor */
    .typed-cursor {
        color: var(--primary-color);
        font-weight: 100;
        animation: blink 1s infinite;
    }

    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }

    .image-block {
        width: fit-content;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .image-block img {
        display: block;
        width: 100%;
        height: 400px;
        object-fit: contain;
        background: #fff;
        margin: 0 auto;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
    }
</style>
@endpush

@section('content')
    <!-- Modern Hero Slider Section (No Text) -->
    <section class="hero-slider" id="home">
        <div class="slider-container">
            <!-- Slide 1 -->
            <div class="hero-slide active" data-video="1">
                <video class="slide-video" muted>
                    <source src="{{ asset('videos/1751260750371.webm') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="slide-overlay">
                  <div class="hero-content-overlay">
                    <h1 class="hero-main-title">Advanced Hydraulic Breakers<br>Innovation that Breaks Boundaries</h1>
                    <p class="hero-desc">Experience unmatched performance with our cutting-edge hydraulic breakers technology designed for the toughest demolition and construction applications.</p>
                    <div class="hero-btn-group">
                      <a href="/products" class="hero-btn btn-explore">
                        <i class="fas fa-arrow-right"></i> Explore Products
                      </a>
                      <a href="/serial-lookup" class="hero-btn btn-warranty">
                        <i class="fas fa-shield-alt"></i> Check Warranty
                      </a>
                    </div>
                  </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="hero-slide" data-video="2">
                <video class="slide-video" muted>
                    <source src="{{ asset('videos/1751260768956.webm') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="slide-overlay">
                  <div class="hero-content-overlay">
                  <h1 class="hero-main-title">Advanced Hydraulic Breakers<br>Innovation that Breaks Boundaries</h1>
                    <p class="hero-desc">Experience unmatched performance with our cutting-edge hydraulic breakers technology designed for the toughest demolition and construction applications.</p>
                    <div class="hero-btn-group">
                      <a href="/products" class="hero-btn btn-explore">
                        <i class="fas fa-arrow-right"></i> Explore Products
                      </a>
                      <a href="/serial-lookup" class="hero-btn btn-warranty">
                        <i class="fas fa-shield-alt"></i> Check Warranty
                      </a>
                    </div>
                  </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="hero-slide" data-video="3">
                <video class="slide-video" muted>
                    <source src="{{ asset('videos/1751260792190.webm') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="slide-overlay">
                  <div class="hero-content-overlay">
                  <h1 class="hero-main-title">Advanced Hydraulic Breakers<br>Innovation that Breaks Boundaries</h1>
                    <p class="hero-desc">Experience unmatched performance with our cutting-edge hydraulic breakers technology designed for the toughest demolition and construction applications.</p>
                    <div class="hero-btn-group">
                      <a href="/products" class="hero-btn btn-explore">
                        <i class="fas fa-arrow-right"></i> Explore Products
                      </a>
                      <a href="/serial-lookup" class="hero-btn btn-warranty">
                        <i class="fas fa-shield-alt"></i> Check Warranty
                      </a>
                    </div>
                  </div>
                </div>
            </div>

        <!-- Modern Slider Navigation -->
        <button class="slider-nav prev" onclick="changeSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="slider-nav next" onclick="changeSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Dots -->
        <div class="slider-dots">
            <button class="dot active" onclick="currentSlideIndexSet(1)"></button>
            <button class="dot" onclick="currentSlideIndexSet(2)"></button>
            <button class="dot" onclick="currentSlideIndexSet(3)"></button>
        </div>
    </section>

    <!-- Modern Hero Content Section -->
    <section class="hero-content-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">{{ __('homepage.product_badge') }}</div>
                <h1 class="hero-title">
                    {{ __('homepage.hero_slide_1_title') }} <span class="highlight">{{ __('homepage.hero_slide_1_subtitle') }}</span>
                </h1>
                <p class="hero-subtitle">
                    {{ __('homepage.hero_slide_1_description') }}
                </p>
                <div class="hero-cta">
                    <a href="{{ route('products.index') }}" class="btn-primary-hero">
                        <i class="fas fa-arrow-right"></i>
                        {{ __('homepage.explore_products') }}
                    </a>
                    <a href="{{ route('about') }}" class="btn-secondary-hero">
                        <i class="fas fa-info-circle"></i>
                        {{ __('homepage.learn_more') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Hydraulic Breaker Product Lines Section -->
<section class="breaker-lines-section" id="breaker-lines">  
    <div class="container">
        <!-- Section Header with Animation -->
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <div class="section-badge">
                <i class="fas fa-cogs"></i>
                PRODUCT EXCELLENCE
            </div>
            <h2 class="section-title">Hydraulic Breaker Product Lines</h2>
            <p class="section-description">
                Discover our comprehensive range of hydraulic breakers, each engineered to deliver exceptional performance across diverse applications and industries.
            </p>
        </div>

        <!-- Enhanced Tab Navigation -->
        <div class="breaker-tabs" data-aos="fade-up" data-aos-delay="200">
            <button class="breaker-tab active" data-line="sq-line">
                <span class="tab-icon">SQ</span>
                <span class="tab-text">SQ Line</span>
                <div class="tab-glow"></div>
            </button>
            <button class="breaker-tab" data-line="sb-line">
                <span class="tab-icon">SB</span>
                <span class="tab-text">SB Line</span>
                <div class="tab-glow"></div>
            </button>
            <button class="breaker-tab" data-line="sb-e-line">
                <span class="tab-icon">SB-E</span>
                <span class="tab-text">SB-E Line</span>
                <div class="tab-glow"></div>
            </button>
            <button class="breaker-tab" data-line="et-ii-line">
                <span class="tab-icon">ET-II</span>
                <span class="tab-text">ET-II Line</span>
                <div class="tab-glow"></div>
            </button>
        </div>

        <!-- Enhanced Card Content -->
        <div class="breaker-tab-content" data-aos="fade-up" data-aos-delay="400">
            <!-- Content will be injected here by JS -->
        </div>
    </div>
</section>

<style>
/* Enhanced Section Styling */
.breaker-lines-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    position: relative;
    overflow: hidden;
}

.breaker-lines-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23e2e8f0" stroke-width="0.5" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.4;
    z-index: 0;
}

.breaker-lines-section .container {
    position: relative;
    z-index: 1;
}

/* Enhanced Section Header */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #00548e, #0066a3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 84, 142, 0.3);
    animation: pulse-glow 2s infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 4px 20px rgba(0, 84, 142, 0.3); }
    50% { box-shadow: 0 4px 30px rgba(0, 84, 142, 0.5); }
}

.section-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: black;
    margin-bottom: 1.5rem;
    -webkit-background-clip: text;
    background-clip: text;
    line-height: 1.2;
}

.section-description {
    font-size: 1.2rem;
    color: #64748b;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.7;
}

/* Enhanced Tab Navigation */
.breaker-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.breaker-tab {
    position: relative;
    background: white;
    color: #00548e;
    border: 2px solid #e2e8f0;
    border-radius: 1.5rem;
    padding: 1rem 2rem;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    min-width: 140px;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0, 84, 142, 0.1);
}

.breaker-tab::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.6s;
}

.breaker-tab:hover::before {
    left: 100%;
}

.tab-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, #00548e, #0066a3);
    color: white;
    border-radius: 50%;
    font-size: 0.8rem;
    font-weight: 800;
    transition: all 0.4s ease;
    box-shadow: 0 2px 10px rgba(0, 84, 142, 0.3);
}

.tab-text {
    font-size: 1rem;
    transition: all 0.3s ease;
}

.tab-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(176, 215, 1, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.4s ease;
    z-index: -1;
}

.breaker-tab:hover {
    transform: translateY(-3px) scale(1.02);
    border-color: #00548e;
    box-shadow: 0 8px 25px rgba(0, 84, 142, 0.2);
}

.breaker-tab:hover .tab-icon {
    transform: rotate(360deg) scale(1.1);
    background: linear-gradient(135deg, #b0d701, #9bc600);
}

.breaker-tab:hover .tab-glow {
    width: 120%;
    height: 120%;
}

.breaker-tab.active {
    background: linear-gradient(135deg, #00548e, #0066a3);
    color: white;
    border-color: #00548e;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 84, 142, 0.3);
}

.breaker-tab.active .tab-icon {
    background: #b0d701;
    color: #00548e;
    transform: scale(1.1);
}

.breaker-tab.active .tab-text {
    color: white;
}

/* Enhanced Card Content */
.breaker-tab-content {
    margin-top: 2rem;
    min-height: 500px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

/* Enhanced Split Card */
.breaker-product-split-card {
    display: flex;
    flex-direction: row;
    border-radius: 2rem;
    overflow: hidden;
    background: white;
    box-shadow: 0 20px 60px rgba(0, 84, 142, 0.15);
    max-width: 1000px;
    width: 1100px;
    margin: 0 auto;
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    border: 1px solid rgba(0, 84, 142, 0.1);
}

.breaker-product-split-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 84, 142, 0.05), rgba(176, 215, 1, 0.05));
    opacity: 0;
    transition: opacity 0.4s ease;
    border-radius: 2rem;
    z-index: 1;
}

.breaker-product-split-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 30px 80px rgba(0, 84, 142, 0.25);
}

.breaker-product-split-card:hover::before {
    opacity: 1;
}

/* Enhanced Image Section */
.breaker-product-split-card .card-image {
    flex: 0 0 36%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    overflow: hidden;
}

.breaker-product-split-card .card-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 84, 142, 0.1), rgba(176, 215, 1, 0.1));
    z-index: 1;
}

.breaker-product-split-card .card-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
    position: relative;
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
}

.breaker-product-split-card:hover .card-image img {
    transform: scale(1.1) rotate(2deg);
    filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.2));
}

.breaker-product-split-card .card-image .line-badge {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    z-index: 3;
    background: linear-gradient(135deg, #00548e, #0066a3);
    color: white;
    font-weight: 800;
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 20px rgba(0, 84, 142, 0.3);
    transition: all 0.4s ease;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.breaker-product-split-card:hover .line-badge {
    background: linear-gradient(135deg, #b0d701, #9bc600);
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 6px 25px rgba(176, 215, 1, 0.4);
}

/* Enhanced Content Section */
.breaker-product-split-card .card-info {
    flex: 1;
    background: white;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    z-index: 2;
}

.breaker-product-split-card .subtitle {
    color: #00548e;
    font-weight: 800;
    font-size: 2rem;x
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    line-height: 1.2;
}

.breaker-product-split-card .subtitle i {
    color: #b0d701;
    font-size: 1.5rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

.breaker-product-split-card .description {
    color: #475569;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    line-height: 1.8;
    font-weight: 400;
}

/* Enhanced Features Section */
.breaker-product-split-card .features {
    margin-bottom: 2rem;
}

.breaker-product-split-card .features-title {
    color: #00548e;
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.breaker-product-split-card .features-title i {
    color: #b0d701;
    font-size: 1.2rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.breaker-feature-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
    margin-bottom: 2rem;
    font-size: 1rem;
    font-weight: 600;
    list-style: none;
    padding: 0;
}

.breaker-feature-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #334155;
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    background: rgba(176, 215, 1, 0.05);
}

.breaker-feature-list li:hover {
    background: rgba(176, 215, 1, 0.1);
    transform: translateX(5px);
}

.breaker-feature-list li i {
    color: #b0d701;
    font-size: 1.1rem;
    min-width: 1.1rem;
}

/* Enhanced Applications Section */
.breaker-product-split-card .apps-title {
    color: #00548e;
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.breaker-product-split-card .apps-title i {
    color: #b0d701;
    font-size: 1.2rem;
}

.breaker-product-apps {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.breaker-app-label {
    display: inline-block;
    background: rgba(176, 215, 1, 0.05);
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 1.5rem;
    padding: 0.5rem 1.25rem;
    margin: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
}

.breaker-app-label:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 84, 142, 0.4);
}

/* Enhanced Action Buttons */
.breaker-product-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.breaker-product-btn {
    background: linear-gradient(135deg, #00548e, #0066a3);
    color: white;
    font-weight: 700;
    border: none;
    border-radius: 2rem;
    padding: 1rem 2.5rem;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 84, 142, 0.3);
    outline: none;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
}

.breaker-product-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.breaker-product-btn:hover::before {
    left: 100%;
}

.breaker-product-btn:hover {
    background: linear-gradient(135deg, #b0d701, #9bc600);
    color: #fff;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 30px rgba(176, 215, 1, 0.4);
}

.breaker-product-btn i {
    transition: transform 0.3s ease;
}

.breaker-product-btn:hover i {
    transform: translateX(5px);
}

/* Card Enter Animation */
@keyframes cardEnter {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.breaker-product-split-card {
    animation: cardEnter 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .breaker-product-split-card .card-info {
        padding: 2rem;
    }
    
    .breaker-product-split-card .subtitle {
        font-size: 1.75rem;
    }
}

@media (max-width: 768px) {
    .breaker-lines-section {
        padding: 4rem 0;
    }
    
    .breaker-tabs {
        gap: 0.5rem;
        padding: 0 1rem;
    }
    
    .breaker-tab {
        padding: 0.75rem 1.5rem;
        min-width: auto;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .tab-icon {
        width: 2rem;
        height: 2rem;
        font-size: 0.7rem;
    }
    
    .tab-text {
        font-size: 0.9rem;
    }
    
    .breaker-product-split-card {
        flex-direction: column;
        margin: 0 1rem;
    }
    
    .breaker-product-split-card .card-image {
        flex: none;
        height: 250px;
    }
    
    .breaker-product-split-card .card-info {
        padding: 2rem 1.5rem;
    }
    
    .breaker-product-split-card .subtitle {
        font-size: 1.5rem;
    }
    
    .breaker-feature-list {
        grid-template-columns: 1fr;
    }
    
    .breaker-product-actions {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 2rem;
    }
    
    .section-description {
        font-size: 1rem;
    }
    
    .breaker-tabs {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .breaker-tab {
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }
    
    .breaker-product-split-card .card-info {
        padding: 1.5rem 1rem;
    }
    
    .breaker-product-split-card .subtitle {
        font-size: 1.25rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

/* Loading Animation */
.breaker-tab-content.loading {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 400px;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid #e2e8f0;
    border-top: 4px solid #00548e;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
        // Enhanced Data for each product line
        const breakerLinesData = {
            'et-ii-line': {
                name: 'ET-II Line',
                image: 'https://res.cloudinary.com/dikwwdtgc/image/upload/v1751673317/ETII200-removebg-preview_kvxysk.png',
                subtitle: 'Elite Technology Series',
                description: `Open Type design built for heavy-duty efficiency, the ET-II Line delivers extreme breaking power, user-friendly maintenance, and exceptional durability, optimal for mining, quarrying, and large-scale construction projects worldwide.`,
                features: [
                    'State-of-the-art technology',
                    'Maximum power output',
                    'Advanced diagnostics',
                    'Premium components',
                    'Heavy-duty construction',
                    'Superior reliability'
                ],
                applications: [
                    'Large-scale mining',
                    'Major infrastructure',
                    'Industrial demolition',
                    'Quarry operations'
                ],
                filter: 'ET-II Line',
            },
            'sq-line': {
                name: 'SQ Line',
                image: 'https://res.cloudinary.com/dikwwdtgc/image/upload/v1752246624/SQ50_Easylube-removebg-preview_spzxzk.png',
                subtitle: 'Premium Performance Series',
                description: `The SQ Premium Series range of breakers integrates SOOSAN's unique technology to increase productivity, lower cost of operation and improve operator convenience. Built for excellence and engineered for the future.`,
                features: [
                    'Advanced hydraulic system',
                    'Superior impact energy',
                    'Reduced maintenance costs',
                    'Enhanced durability',
                    'Precision engineering',
                    'Smart control technology'
                ],
                applications: [
                    'Heavy demolition',
                    'Mining operations',
                    'Infrastructure development',
                    'Quarry operations'
                ],
                filter: 'SQ Line',
            },
            'sb-line': {
                name: 'SB Line',
                image: 'https://res.cloudinary.com/dikwwdtgc/image/upload/v1751662920/SB100_side-removebg-preview_gahxhf.png',
                subtitle: 'Standard Excellence Series',
                description: `The SB Line offers proven durability and power, with a simple structure, high impact energy, and compatibility across carriers suitable for tough demolition, excavation work, mining, quarrying, and large scale construction.`,
                features: [
                    'Reliable performance',
                    'Cost-effective solution',
                    'Easy maintenance',
                    'Versatile applications',
                    'Robust construction',
                    'Wide compatibility'
                ],
                applications: [
                    'General construction',
                    'Road works',
                    'Building demolition',
                    'Excavation projects'
                ],
                filter: 'SB Line',
            },
            'sb-e-line': {
                name: 'SB-E Line',
                image:'https://res.cloudinary.com/dikwwdtgc/image/upload/v1751671252/SB40E_side-removebg-preview_x8vcb7.png',
                subtitle: 'Enhanced Efficiency Series',
                description: `Engineered for enhanced performance, the SB-E Line combines advanced technology, strong impact force, and increased longevity perfect for demanding jobsites, precision-driven operations, mining, quarrying, and large scale construction.`,
                features: [
                    'Energy-efficient design',
                    'Smart control system',
                    'Reduced fuel consumption',
                    'Optimized performance',
                    'Extended service life',
                    'Advanced diagnostics'
                ],
                applications: [
                    'Urban construction',
                    'Renovation projects',
                    'Precision demolition',
                    'Infrastructure maintenance'
                ],
                filter: 'SB-E Line',
            },
        };

        // Enhanced rendering function
        function renderBreakerSplitCard(lineKey) {
            const data = breakerLinesData[lineKey];
            if (!data) return '';
            
            let imageHTML = '';
            if (Array.isArray(data.image)) {
                imageHTML = data.image.map(img => 
                    `<img src="${img}" alt="${data.name}" onerror="this.src='https://via.placeholder.com/400x300/00548e/ffffff?text=${encodeURIComponent(data.name)}'" style="width:50%;display:inline-block;object-fit:contain;" />`
                ).join('');
            } else {
                imageHTML = `<img src="${data.image}" alt="${data.name}" onerror="this.src='https://via.placeholder.com/400x300/00548e/ffffff?text=${encodeURIComponent(data.name)}'" />`;
            }
            
            return `
            <div class="breaker-product-split-card">
                <div class="card-image">
                    ${imageHTML}
                    <div class="line-badge">${data.name}</div>
                </div>
                <div class="card-info">
                    <div class="subtitle">
                        <i class="fas fa-award"></i> 
                        ${data.subtitle}
                    </div>
                    <div class="description">${data.description}</div>
                    <div class="features">
                        <div class="features-title">
                            <i class="fas fa-bolt"></i> 
                            Key Features
                        </div>
                        <ul class="breaker-feature-list">
                            ${data.features.map(f => `<li><i class='fas fa-check-circle'></i> ${f}</li>`).join('')}
                        </ul>
                    </div>
                    <div class="apps-title">
                        <i class="fas fa-industry"></i> 
                        Applications
                    </div>
                    <div class="breaker-product-apps">
                        ${data.applications.map(app => `<span class="breaker-app-label">${app}</span>`).join('')}
                    </div>
                    <div class="breaker-product-actions">
                        <button class="breaker-product-btn explore-btn" data-filter="${data.filter}">
                            <i class="fas fa-arrow-right"></i> 
                            Explore More
                        </button>
                    </div>
                </div>
            </div>
            `;
        }

        // Enhanced JavaScript functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.breaker-tab');
            const content = document.querySelector('.breaker-tab-content');
            
            // Enhanced tab switching with loading animation
            function setActiveTab(tab) {
                // Show loading state
                content.innerHTML = '<div class="loading-spinner"></div>';
                content.classList.add('loading');
                
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                tab.classList.add('active');
                
                // Get the line data
                const line = tab.getAttribute('data-line');
                
                // Simulate loading delay for smooth transition
                setTimeout(() => {
                    content.classList.remove('loading');
                    content.innerHTML = renderBreakerSplitCard(line);
                    
                    // Add entrance animation
                    const card = content.querySelector('.breaker-product-split-card');
                    if (card) {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(30px)';
                        
                        setTimeout(() => {
                            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    }
                }, 300);
            }
            
            // Initialize with first tab
            if (tabs.length > 0) {
                setActiveTab(tabs[0]);
            }
            
            // Add click event listeners to tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    setActiveTab(this);
                });
                
                // Add keyboard support
                tab.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        setActiveTab(this);
                    }
                });
            });
            
            // Handle Explore More button click with enhanced animation
            content.addEventListener('click', function(e) {
                if (e.target.closest('.explore-btn')) {
                    const btn = e.target.closest('.explore-btn');
                    const filter = btn.getAttribute('data-filter');
                    
                    // Add click animation
                    btn.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        btn.style.transform = '';
                        window.location.href = `/products?line[]=${encodeURIComponent(filter)}`;
                    }, 150);
                }
            });
            
            // Add intersection observer for scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);
            
            // Observe section elements
            const section = document.querySelector('.breaker-lines-section');
            if (section) {
                observer.observe(section);
            }
        });

        // Add smooth scrolling for better UX
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
</script>

<!-- AOS Library for scroll animations -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
</script>

    
    <!-- Modern Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-container">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">{{ __('homepage.countries_stat') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <span class="stat-number">1000+</span>
                            <span class="stat-label">{{ __('homepage.projects_stat') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">{{ __('homepage.support_stat') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <span class="stat-number">20+</span>
                            <span class="stat-label">{{ __('homepage.years_stat') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Scroll Sections -->
    <!-- Section 1: Innovation & Technology -->
    <section class="scroll-section bg-white py-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="content-block">
                        <h2 class="display-4 fw-bold mb-4" style="color: #00548e">
                            <span id="typed-innovation"></span>
                        </h2>
                        <p class="lead text-muted mb-4">
                            {{ __('homepage.innovation_section_description') }}
                        </p>
                        <div class="features-list">
                            <div class="feature-item d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>{{ __('homepage.advanced_hydraulic_tech') }}</span>
                            </div>
                            <div class="feature-item d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>{{ __('homepage.precision_engineering') }}</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>{{ __('homepage.industry_leading_performance') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-delay="400">
                    <div class="image-block">
                        <img src="{{ asset('images/img2.webp') }}" 
                             alt="Innovation & Technology" 
                             class="img-fluid"
                             style="width: 100%; height: 400px; object-fit: contain; background: none; box-shadow: none; border-radius: 0;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Global Presence -->
    <section class="scroll-section bg-light py-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-delay="200">
                    <div class="content-block">
                        <h2 class="display-4 fw-bold mb-4" style="color: #00548e">
                            <span id="typed-global"></span>
                        </h2>
                        <p class="lead text-muted mb-4">
                            {{ __('homepage.global_section_description') }}
                        </p>
                        <div class="stats-grid row">
                            <div class="col-4 text-center">
                                <div class="stat-item">
                                    <h3 class="h2 fw-bold" style="color: #00548e">50+</h3>
                                    <p class="text-muted">{{ __('homepage.countries_stat') }}</p>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="stat-item">
                                    <h3 class="h2 fw-bold" style="color: #00548e">1000+</h3>
                                    <p class="text-muted">{{ __('homepage.projects_stat') }}</p>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="stat-item">
                                    <h3 class="h2 fw-bold" style="color: #00548e">24/7</h3>
                                    <p class="text-muted">{{ __('homepage.support_stat') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-delay="400">
                    <div class="image-block">
                        <img src="{{ asset('images/img3.webp') }}" 
                             alt="Global Presence" 
                             class="img-fluid"
                             style="width: 100%; height: 400px; object-fit: contain; background: none; box-shadow: none; border-radius: 0;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Quality & Reliability -->
    <section class="scroll-section bg-white py-5" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="content-block">
                        <h2 class="display-4 fw-bold mb-4" style="color: #00548e">
                            <span id="typed-quality"></span>
                        </h2>
                        <p class="lead text-muted mb-4">
                            {{ __('homepage.quality_section_description') }}
                        </p>
                        <div class="quality-badges row">
                            <div class="col-md-6 mb-3">
                                <div class="badge-item p-3 border rounded">
                                    <i class="fas fa-award text-warning fs-3 mb-2"></i>
                                    <h6 class="fw-bold">{{ __('homepage.iso_certified') }}</h6>
                                    <small class="text-muted">{{ __('homepage.international_standards') }}</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="badge-item p-3 border rounded">
                                    <i class="fas fa-shield-alt text-primary fs-3 mb-2"></i>
                                    <h6 class="fw-bold">{{ __('homepage.quality_assured') }}</h6>
                                    <small class="text-muted">{{ __('homepage.rigorous_testing') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-delay="400">
                    <div class="image-block">
                        <img src="{{ asset('images/img1.webp') }}" 
                             alt="Quality & Reliability" 
                             class="img-fluid"
                             style="width: 100%; height: 400px; object-fit: contain; background: none; box-shadow: none; border-radius: 0;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Highlights Section -->
    <section class="highlights-section" id="highlights">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Highlights</h2>
                <p class="section-description">Explore some of our featured moments.</p>
            </div>
            <div class="highlights-grid">
                <div class="highlight-item animate-fade-in">
                    <video class="highlight-media" src="/videos/video1.mp4" controls preload="metadata" poster="/images/thumbnail1.webp" title="Hydraulic Breakers"></video>
                </div>
                <div class="highlight-item animate-fade-in">
                    <video class="highlight-media" src="/videos/video2.mp4" controls preload="metadata" poster="/images/thumbnail2.webp" title="Hydraulic Breakers"></video>
                </div>
                <div class="highlight-item animate-fade-in">
                    <video class="highlight-media" src="/videos/video3.webm" controls preload="metadata" poster="/images/thumbnail3.webp" title="Hydraulic Breakers"></video>
                </div>
                <div class="highlight-item animate-fade-in">
                    <img class="highlight-media" src="/images/img7.webp" alt="Highlight Image 1">
                </div>
                <div class="highlight-item animate-fade-in">
                    <img class="highlight-media" src="/images/img8.webp" alt="Highlight Image 2">
                </div>
                <div class="highlight-item animate-fade-in">
                    <img class="highlight-media" src="/images/img10.webp" alt="Highlight Image 3">
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videos = document.querySelectorAll('.highlight-item video.highlight-media');

            videos.forEach(video => {
                video.setAttribute('tabindex', '0');

                // Focus video on click for keyboard control
                video.addEventListener('click', () => video.focus());

                // Just for debugging: remove this if not needed
                video.addEventListener('loadedmetadata', () => {
                    console.log("Video loaded:", video.src, "duration:", video.duration);
                });
            });

            document.addEventListener('keydown', function (e) {
                const video = document.activeElement;
                if (!video || video.tagName.toLowerCase() !== 'video') return;

                const key = e.key.toLowerCase();
                const isReady = video.readyState >= 2 && !isNaN(video.duration);

                if (["arrowright", "arrowleft", "arrowup", "arrowdown", "m", "f", "escape"].includes(key)) {
                    e.preventDefault();
                }

                switch (key) {
                    case "arrowright":
                        if (isReady) {
                            video.currentTime = Math.min(video.duration, video.currentTime + 5);
                        } else {
                            console.warn("Video not ready to seek forward.");
                        }
                        break;

                    case "arrowleft":
                        if (isReady) {
                            video.currentTime = Math.max(0, video.currentTime - 5);
                        } else {
                            console.warn("Video not ready to seek backward.");
                        }
                        break;

                    case "arrowup":
                        video.volume = Math.min(1, video.volume + 0.1);
                        break;

                    case "arrowdown":
                        video.volume = Math.max(0, video.volume - 0.1);
                        break;

                    case "m":
                        video.muted = !video.muted;
                        break;

                    case "f":
                        const isFullscreen =
                            document.fullscreenElement === video ||
                            document.webkitFullscreenElement === video ||
                            document.msFullscreenElement === video;

                        if (!isFullscreen) {
                            if (video.requestFullscreen) video.requestFullscreen();
                            else if (video.webkitRequestFullscreen) video.webkitRequestFullscreen();
                            else if (video.msRequestFullscreen) video.msRequestFullscreen();
                        } else {
                            if (document.exitFullscreen) document.exitFullscreen();
                            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                            else if (document.msExitFullscreen) document.msExitFullscreen();
                        }
                        break;

                    case "escape":
                        if (document.fullscreenElement || document.webkitFullscreenElement || document.msFullscreenElement) {
                            if (document.exitFullscreen) document.exitFullscreen();
                            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                            else if (document.msExitFullscreen) document.msExitFullscreen();
                        }
                        break;
                }
            });
        });
    </script>

    <style>
        .highlights-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
            padding: 4rem 0 3rem;
        }
        .highlights-section .section-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .highlights-section .section-description {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 0;
        }
        .highlights-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(320px, 1fr));
            gap: 2.8rem;
            align-items: stretch;
            justify-items: center;
            margin-bottom: 1.5rem;
        }
        .highlight-item {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.13);
            overflow: hidden;
            transition: transform 0.32s cubic-bezier(.4,2,.3,1), box-shadow 0.32s, filter 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 250px;
            max-width: 100%;
            position: relative;
            cursor: pointer;
            opacity: 0;
            transform: translateY(40px) scale(0.98);
            animation: fadeInUp 0.7s forwards;
            will-change: transform, box-shadow, filter;
        }
        .highlight-item:hover, 
        .highlight-item:focus-within {
            transform: translateY(-12px);
            transform: scale(1.2);
            box-shadow: 0 16px 48px 0 rgba(0,84,142,0.16), 0 4px 16px rgba(176,215,1,0.11);
            filter: brightness(1.08) saturate(1.18);
            z-index: 2;
        }
        .highlight-media {
            width: 100%;
            height: 320px;
            max-width: 100%;
            object-fit: cover;
            background: #e0e7ef;
            display: block;
            transition: filter 0.3s, box-shadow 0.3s;
            border-radius: 0;
            outline: none;
        }
        .highlight-item video.highlight-media {
            object-fit: contain;
            background: #000;
        }
        .highlight-item:hover .highlight-media, .highlight-item:focus-within .highlight-media {
            filter: brightness(1.09) saturate(1.2) drop-shadow(0 2px 12px #b0d70133);
        }
        .highlight-item video.highlight-media {
            aspect-ratio: 16/9;
            min-height: 220px;
            min-width: 320px;
            height: 320px;
            width: 100%;
            max-width: 100%;
            background: #000;
            border: none;
            display: block;
            outline: none;
            object-fit: contain;
            /* Letterbox for portrait videos */
        }
        .highlight-item video.highlight-media::-webkit-media-controls {
            opacity: 1 !important;
        }
        .highlight-item video.highlight-media:focus {
            outline: 2px solid #b0d701;
        }
        .highlight-item:active {
            filter: brightness(1.04) saturate(1.08);
        }
        .highlight-item img.highlight-media {
            aspect-ratio: 16/9;
            min-height: 220px;
            min-width: 320px;
            height: 320px;
            width: 100%;
            max-width: 100%;
            background: #e0e7ef;
            border: none;
            display: block;
        }
        @media (max-width: 1200px) {
            .highlights-grid {
                grid-template-columns: repeat(2, minmax(320px, 1fr));
            }
            .highlight-media {
                height: 220px;
            }
        }
        @media (max-width: 800px) {
            .highlights-grid {
                grid-template-columns: 1fr;
            }
            .highlight-media {
                height: 180px;
            }
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @media (max-width: 1200px) {
            .highlights-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 800px) {
            .highlights-grid {
                grid-template-columns: 1fr;
            }
            .highlight-media {
                height: 180px;
            }
        }
    </style>

    <!-- Modern Product Search Section -->
    <section class="product-search-section" id="search">
        <div class="container">
            <div class="search-content">
                <p class="search-intro">{{ __('homepage.search_intro') }}</p>
                <h2 class="search-title">{{ __('homepage.search_title') }}</h2>
                <p class="search-subtitle">{{ __('homepage.search_subtitle') }}</p>
                
                <!-- Modern Search Form -->
                <form action="{{ route('products.index') }}" method="GET" class="search-form">
                    <div class="search-input-container">
                        <input type="text" name="search" class="search-input" placeholder="{{ __('homepage.search_placeholder_text') }}" value="{{ request('search') }}">
                        <button type="submit" class="search-input-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <div class="search-tags">
                    <span class="tag-label">{{ __('homepage.popular_searches') }}</span>
                    <a href="{{ route('products.index') }}" class="search-tag">Hydraulic Breakers</a>
                    <a href="{{ route('products.index', ['type[]' => 'TR-F']) }}" class="search-tag">TR-F</a>
                    <a href="{{ route('products.index', ['type[]' => 'Top Direct']) }}" class="search-tag">Top Direct</a>
                    <a href="{{ route('products.index', ['type[]' => 'Skid Steer Loader']) }}" class="search-tag">SSL</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .product-search-section {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            padding: 5rem 0;
            position: relative;
        }

        .product-search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="search-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(37,99,235,0.05)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23search-grid)"/></svg>');
        }

        .search-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .search-intro {
            font-size: 1rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-title {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            line-height: 1.2;
        }

        .search-subtitle {
            font-size: 1.3rem;
            margin-bottom: 3rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .search-form {
            max-width: 600px;
            margin: 0 auto 3rem;
        }

        .search-input-container {
            position: relative;
            display: flex;
            align-items: center;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 60px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 0.5rem;
        }

        .search-input-container:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 10px 40px rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
        }

        .search-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 1.25rem 2rem;
            font-size: 1.1rem;
            background: transparent;
            color: var(--text-color);
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-input-btn {
            width: fit-content;
            color: #00548e;
            border: none;
            background: transparent;
            border-radius: 50px;
            padding: 1.25rem 2rem;
            font-size: 1.35rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
        }

        .search-input-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
        }

        .search-tags {
            margin-top: 1.1rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.8rem 1.1rem;
        }
        .tag-label {
            font-size: 1.02rem;
            font-weight: 600;
            color: #00548e;
            margin-right: 1.1rem;
        }
        .search-tag {
            display: inline-block;
            background: #00548e;
            color: #fff;
            font-size: 1.01rem;
            font-weight: 700;
            border-radius: 1.3rem;
            padding: 0.45rem 1.5rem;
            text-decoration: none;
            transition: background 0.22s, color 0.22s, box-shadow 0.22s, transform 0.22s;
            box-shadow: 0 2px 12px rgba(0,84,142,0.09);
            position: relative;
            outline: none;
        }
        .search-tag:hover, .search-tag:focus {
            background: #b1d50e;
            color: #fff;
            box-shadow: 0 6px 20px rgba(0,84,142,0.18);
            transform: translateY(-2px) scale(1.06);
            text-decoration: none;
        }
        .search-tag:active {
            background: #00548e;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,84,142,0.13);
            transform: scale(0.98);
        }
        @media (max-width: 700px) {
            .search-tags {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.7rem 0;
            }
            .tag-label {
                margin-bottom: 0.5rem;
            }
        }
    </style>

    <!-- Product Line Section -->
    <section class="product-line-section" id="products">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">{{ __('homepage.product_badge') }}</span>
                <h2 class="section-title">{{ __('homepage.product_section_title') }}</h2>
                <p class="section-description">{{ __('homepage.product_section_description') }}</p>
            </div>
            
            <div class="product-grid">
                @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                    @foreach($featuredProducts as $product)
                        <div class="product-card" data-category="{{ $product->category ?? 'attachments' }}">
                            <div class="product-image">
                                @if(!empty($product->image_url))
                                    <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}">
                                @elseif($product->getFirstMediaUrl('images'))
                                    <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->model_name }}">
                                @else
                                    <img src="https://res.cloudinary.com/dikwwdtgc/image/upload/v1751662869/SB10II_side-removebg-preview_lzzibc.png" alt="{{ $product->model_name }}">
                                @endif
                                <div class="product-overlay">
                                    <a href="{{ route('products.show', $product) }}" class="product-link">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">{{ $product->model_name }}</h3>
                                <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                                <a href="{{ route('products.show', $product) }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default products when no database products available -->
                    <div class="product-card" data-category="attachments">
                        <div class="product-image">
                            <img src="https://res.cloudinary.com/dikwwdtgc/image/upload/v1751662869/SB10II_side-removebg-preview_lzzibc.png" alt="Hydraulic Breaker">
                            <div class="product-overlay">
                                <a href="{{ route('products.index') }}" class="product-link">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ __('homepage.hydraulic_breaker_title') }}</h3>
                            <p class="product-description">{{ __('homepage.hydraulic_breaker_description') }}</p>
                            <a href="{{ route('products.index') }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                        </div>
                    </div>

                    <div class="product-card" data-category="attachments">
                        <div class="product-image">
                            <img src="https://res.cloudinary.com/dikwwdtgc/image/upload/v1751662872/SB20II_side-removebg-preview_xnxixz.png" alt="Crusher">
                            <div class="product-overlay">
                                <a href="{{ route('products.index') }}" class="product-link">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ __('homepage.crusher_title') }}</h3>
                            <p class="product-description">{{ __('homepage.crusher_description') }}</p>
                            <a href="{{ route('products.index') }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                        </div>
                    </div>

                    <div class="product-card" data-category="attachments">
                        <div class="product-image">
                            <img src="https://res.cloudinary.com/dikwwdtgc/image/upload/v1751662872/SB20II_side-removebg-preview_xnxixz.png" alt="Multi Processor">
                            <div class="product-overlay">
                                <a href="{{ route('products.index') }}" class="product-link">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ __('homepage.multi_processor_title') }}</h3>
                            <p class="product-description">{{ __('homepage.multi_processor_description') }}</p>
                            <a href="{{ route('products.index') }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                        </div>
                    </div>

                    <div class="product-card" data-category="hydraulic">
                        <div class="product-image">
                            <img src="https://res.cloudinary.com/dikwwdtgc/image/upload/v1751662870/SB20II_side_3-pin_removebg_preview_dzqt0r.png" alt="Rock Drill">
                            <div class="product-overlay">
                                <a href="{{ route('products.index') }}" class="product-link">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ __('homepage.rock_drill_title') }}</h3>
                            <p class="product-description">{{ __('homepage.rock_drill_description') }}</p>
                            <a href="{{ route('products.index') }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                        </div>
                    </div>

                    <div class="product-card" data-category="crane">
                        <div class="product-image">
                            <img src="https://images.pexels.com/photos/834892/pexels-photo-834892.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Crane System">
                            <div class="product-overlay">
                                <a href="{{ route('products.index') }}" class="product-link">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ __('homepage.crane_system_title') }}</h3>
                            <p class="product-description">{{ __('homepage.crane_system_description') }}</p>
                            <a href="{{ route('products.index') }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                        </div>
                    </div>

                    <div class="product-card" data-category="aerial">
                        <div class="product-image">
                            <img src="https://images.pexels.com/photos/1108101/pexels-photo-1108101.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Aerial Platform">
                            <div class="product-overlay">
                                <a href="{{ route('products.index') }}" class="product-link">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ __('homepage.aerial_platform_title') }}</h3>
                            <p class="product-description">{{ __('homepage.aerial_platform_description') }}</p>
                            <a href="{{ route('products.index') }}" class="product-btn">{{ __('homepage.learn_more_btn') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Serial Lookup CTA -->
    <section class="serial-lookup-section" id="warranty">
        <div class="container">
            <div class="serial-lookup-content">
                <h2 class="section-title">{{ __('homepage.warranty_check_title') }}</h2>
                <p class="section-description">{{ __('homepage.warranty_check_description') }}</p>
                <form action="{{ route('serial-lookup.lookup') }}" method="POST" class="serial-form">
                    @csrf
                    <input type="text" name="serial_number" class="serial-input" placeholder="{{ __('homepage.serial_number_placeholder') }}">
                    <button type="submit" class="serial-btn">
                        <i class="fas fa-search"></i>
                        {{ __('homepage.warranty_check_btn') }}
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Soosan Youtube Section -->
    <section class="soosan-youtube-section" id="soosan-youtube">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Soosan Youtube</h2>
                <p class="section-description">Discover our latest videos and insights on the official Soosan YouTube channel.</p>
            </div>
            <div class="youtube-video-grid">
                <div class="youtube-video-item">
                    <iframe src="https://www.youtube.com/embed/cMefr35fupY" title="Soosan Video 3" frameborder="0" allowfullscreen loading="lazy" aria-label="Soosan YouTube Video 3"></iframe>
                </div>
                <div class="youtube-video-item">
                    <iframe src="https://www.youtube.com/embed/iJmuKhtD_nk" title="Soosan Video 2" frameborder="0" allowfullscreen loading="lazy" aria-label="Soosan YouTube Video 2"></iframe>
                </div>
                <div class="youtube-video-item">
                    <iframe src="https://www.youtube.com/embed/AGvShKigxLg" title="Soosan Video 4" frameborder="0" allowfullscreen loading="lazy" aria-label="Soosan YouTube Video 4"></iframe>
                </div>
            </div>
            <div class="youtube-explore-btn-wrapper">
                <a href="https://www.youtube.com/@soosancebotics" class="btn btn-primary youtube-explore-btn" target="_blank" rel="noopener" aria-label="Explore more on YouTube">
                     <i class="fas fa-arrow-right"></i> Explore More
                </a>
            </div>
        </div>
    </section>

    <style>
        .soosan-youtube-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
            padding: 4rem 0 3rem;
            margin-bottom: 0;
        }
        .soosan-youtube-section .section-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .soosan-youtube-section .section-description {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 0;
        }
        .youtube-video-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(360px, 1fr));
            gap: 3.5rem;
            margin-bottom: 2.5rem;
            justify-items: center;
            align-items: stretch;
        }
        .youtube-video-item {
            position: relative;
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 6px 32px rgba(37, 99, 235, 0.13);
            background: #000;
            transition: box-shadow 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: transform 0.3s ease;
        }
        .youtube-video-item:hover {
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.18);
            transform: scale(1.1);
        }
        .youtube-video-item iframe {
            width: 100%;
            height: 100%;
            min-width: 400px;
            min-height: 250px;
            max-width: 100%;
            max-height: 100%;
            border: none;
            display: block;
            border-radius: 0;
            background: #000;
            aspect-ratio: 16/9;
            /* Ensure controls are visible */
            allowfullscreen: true;
            allow: accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;
        }
        .youtube-explore-btn-wrapper {
            text-align: center;
        }
        .youtube-explore-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(74, 222, 128, 0.16);
            background: #00548e;
            color: #fff;
            transition: background 0.2s, transform 0.2s;
            text-decoration: none;
            border: none;
        }
        .youtube-explore-btn:hover {
            background: #b0d701;
            transform: translateY(-2px);
            color: #fff;
        }
        .youtube-explore-btn i {
            font-size: 1.1em;
            margin-left: 0.5em;
            transition: transform 0.2s;
        }
        .youtube-explore-btn:hover i {
            transform: translateX(4px);
        }
        @media (max-width: 1200px) {
            .youtube-video-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .youtube-video-item {
                max-width: 95vw;
                height: 240px;
            }
        }
        @media (max-width: 900px) {
            .youtube-video-grid {
                grid-template-columns: 1fr;
            }
            .youtube-video-item {
                max-width: 100vw;
                height: 200px;
            }
        }
    </style>


    <!-- Industries We Serve Section -->
    <section class="industries-serve-section" id="industries-serve">
        <div class="container">
            <h2 class="industries-serve-title">Powering Every Industry</h2>
            <p class="industries-serve-desc">
                Our hydraulic breakers and equipment solutions serve diverse industries worldwide,<br>
                delivering exceptional performance across all applications and environments.
            </p>
            <div class="industries-serve-grid">
                <!-- Card 1: Construction -->
                <div class="industry-serve-card">
                    <div class="industry-serve-img-wrap">
                        <img src="/images/img10.webp" alt="Construction" class="industry-serve-img" />
                    </div>
                    <div class="industry-serve-content">
                        <h3 class="industry-serve-name">Construction</h3>
                        <p class="industry-serve-description">Building the future with reliable equipment for all construction needs, from residential to commercial projects.</p>
                        <div class="industry-serve-apps-title">Key Applications:</div>
                        <ul class="industry-serve-apps">
                            <li>Building demolition</li>
                            <li>Site preparation</li>
                            <li>Foundation work</li>
                        </ul>
                    </div>
                    <div class="industry-progress-bar"></div>
                </div>
                <!-- Card 2: Infrastructure -->
                <div class="industry-serve-card">
                    <div class="industry-serve-img-wrap">
                        <img src="/images/img4.webp" alt="Infrastructure" class="industry-serve-img" />
                    </div>
                    <div class="industry-serve-content">
                        <h3 class="industry-serve-name">Infrastructure</h3>
                        <p class="industry-serve-description">Developing critical infrastructure with heavy-duty machinery for roads, bridges, and public works.</p>
                        <div class="industry-serve-apps-title">Key Applications:</div>
                        <ul class="industry-serve-apps">
                            <li>Road construction</li>
                            <li>Bridge building</li>
                            <li>Utility installation</li>
                        </ul>
                    </div>
                    <div class="industry-progress-bar"></div>
                </div>
                <!-- Card 3: Mining -->
                <div class="industry-serve-card">
                    <div class="industry-serve-img-wrap">
                        <img src="/images/img9.webp" alt="Mining" class="industry-serve-img" />
                    </div>
                    <div class="industry-serve-content">
                        <h3 class="industry-serve-name">Mining</h3>
                        <p class="industry-serve-description">Extracting resources efficiently with specialized mining equipment designed for harsh underground conditions.</p>
                        <div class="industry-serve-apps-title">Key Applications:</div>
                        <ul class="industry-serve-apps">
                            <li>Rock breaking</li>
                            <li>Quarry operations</li>
                            <li>Tunnel construction</li>
                        </ul>
                    </div>
                    <div class="industry-progress-bar"></div>
                </div>
                <!-- Card 4: Industrial -->
                <div class="industry-serve-card">
                    <div class="industry-serve-img-wrap">
                        <img src="/images/img6.webp" alt="Industrial" class="industry-serve-img" />
                    </div>
                    <div class="industry-serve-content">
                        <h3 class="industry-serve-name">Industrial</h3>
                        <p class="industry-serve-description">Supporting industrial operations with robust equipment for manufacturing and processing environments.</p>
                        <div class="industry-serve-apps-title">Key Applications:</div>
                        <ul class="industry-serve-apps">
                            <li>Material handling</li>
                            <li>Plant maintenance</li>
                            <li>Equipment installation</li>
                        </ul>
                    </div>
                    <div class="industry-progress-bar"></div>
                </div>
            </div>
        </div>
        <style>
            .industries-serve-section {
                background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
                padding: 4rem 0 3rem 0;
                margin-top: 0;
            }
            .industries-serve-title {
                text-align: center;
                font-size: 3.5rem;
                font-weight: 800;
                margin-bottom: 0.7rem;
                letter-spacing: -1px;
            }
            .industries-serve-desc {
                text-align: center;
                color: #223;
                font-size: 1.13rem;
                margin-bottom: 2.5rem;
                line-height: 1.5;
            }
            .industries-serve-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 2.5rem 2.5rem;
                justify-items: center;
                align-items: stretch;
                max-width: 1100px;
                margin: 0 auto;
            }
            .industry-serve-card {
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 8px 32px rgba(37,99,235,0.13);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                transition: transform 0.32s cubic-bezier(.4,2,.3,1), box-shadow 0.32s, filter 0.25s;
                min-width: 0;
                position: relative;
                min-height: 390px;
                width: 100%;
                cursor: pointer;
                will-change: transform, box-shadow, filter;
            }
            .industry-serve-card:hover, .industry-serve-card:focus-within {
                transform: translateY(-12px) scale(1.035);
                box-shadow: 0 16px 48px 0 rgba(0,84,142,0.16), 0 4px 16px rgba(176,215,1,0.11);
                filter: brightness(1.07) saturate(1.14);
                z-index: 2;
            }
            .industry-serve-img-wrap {
                width: 100%;
                height: 170px;
                background: #eee;
                display: flex;
                align-items: flex-end;
                justify-content: center;
                overflow: hidden;
                position: relative;
            }
            .industry-serve-img {
                width: 100%;
                height: 170px;
                object-fit: contain;
                border-top-left-radius: 18px;
                border-top-right-radius: 18px;
                transition: filter 0.3s;
                display: block;
            }
            .industry-serve-card:hover .industry-serve-img {
                filter: brightness(1.08) saturate(1.22);
            }
            .industry-serve-content {
                padding: 1.7rem 1.5rem 1.2rem 1.5rem;
                display: flex;
                flex-direction: column;
                flex: 1;
            }
            .industry-serve-name {
                font-size: 1.21rem;
                font-weight: 700;
                color: #00548e;
                margin-bottom: 0.5rem;
            }
            .industry-serve-description {
                font-size: 0.98rem;
                color: #222;
                margin-bottom: 1.1rem;
                line-height: 1.5;
                min-height: 48px;
            }
            .industry-serve-apps-title {
                font-size: 0.98rem;
                font-weight: 700;
                color: #00548e;
                margin-bottom: 0.2rem;
            }
            .industry-serve-apps {
                display: flex;
                flex-wrap: nowrap;
                gap: 0.5rem 0.7rem;
                padding: 0;
                margin: 0 0 0.2rem 0;
                list-style: none;
            }
            .industry-serve-apps li {
                background: #c2b22e;
                color: #fff;
                font-size: 0.86rem;
                font-weight: 600;
                border-radius: 1.1rem;
                padding: 0.28rem 1.08rem;
                margin: 0;
                box-shadow: 0 2px 8px rgba(176,215,1,0.10);
                transition: background 0.18s, color 0.18s;
                white-space: nowrap;
            }
            .industry-progress-bar {
                position: absolute;
                left: 0; bottom: 0;
                height: 4px;
                width: 0%;
                background: linear-gradient(90deg, #00548e 0%, #b0d701 100%);
                border-radius: 0 0 18px 18px;
                transition: width 0.7s cubic-bezier(.4,2,.3,1);
                z-index: 3;
            }
            .industry-serve-card:hover .industry-progress-bar,
            .industry-serve-card:focus-within .industry-progress-bar {
                width: 100%;
            }
            @media (max-width: 900px) {
                .industries-serve-grid {
                    grid-template-columns: 1fr;
                    gap: 2rem;
                }
                .industry-serve-card {
                    max-width: 95vw;
                }
            }
            @media (max-width: 600px) {
                .industries-serve-section {
                    padding: 2.1rem 0 1.2rem 0;
                }
                .industries-serve-title {
                    font-size: 1.5rem;
                }
                .industries-serve-desc {
                    font-size: 0.99rem;
                }
                .industries-serve-grid {
                    gap: 1.1rem;
                }
                .industry-serve-card {
                    min-height: 340px;
                    padding: 0;
                }
                .industry-serve-img-wrap, .industry-serve-img {
                    height: 120px;
                }
                .industry-serve-content {
                    padding: 1rem 0.7rem 1rem 0.7rem;
                }
                .industry-serve-description {
                    min-height: 0;
                }
            }
        </style>
    </section>

@endsection

@push('scripts')
<script>
    let currentSlideIndex = 0;
    let isAutoPlaying = true;
    
    // Enhanced Navbar Scroll Effect
    function initNavbarEffects() {
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
    
    // Enhanced Icon Animations
    function initIconAnimations() {
        const iconItems = document.querySelectorAll('.nav-icon-item');
        
        iconItems.forEach((item, index) => {
            // Add staggered entrance animation
            item.style.animationDelay = `${index * 0.1}s`;
            
            // Add click ripple effect
            item.addEventListener('click', function(e) {
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
                `;
                
                this.appendChild(ripple);
                
                // Remove ripple after animation
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
            
            // Add hover sound effect (optional)
            item.addEventListener('mouseenter', function() {
                // You can add sound effects here if desired
                this.style.filter = 'drop-shadow(0 4px 8px rgba(37, 99, 235, 0.2))';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.filter = 'none';
            });
        });
    }
    
    // Add CSS for ripple animation
    function addRippleStyles() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .nav-icon-item {
                position: relative;
                overflow: hidden;
            }
            
            @keyframes iconEnter {
                from {
                    opacity: 0;
                    transform: translateY(20px) scale(0.8);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
            
            .icon-nav .nav-icon-item {
                animation: iconEnter 0.6s ease-out forwards;
                opacity: 0;
            }
        `;
        document.head.appendChild(style);
    }
    
    // Slider Navigation
    function changeSlide(direction) {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot');
        const videos = document.querySelectorAll('.slide-video');

        // Pause current video
        if (videos[currentSlideIndex]) videos[currentSlideIndex].pause();

        slides[currentSlideIndex].classList.remove('active');
        dots[currentSlideIndex].classList.remove('active');

        // Calculate new slide index (looping)
        currentSlideIndex = (currentSlideIndex + direction + slides.length) % slides.length;

        slides[currentSlideIndex].classList.add('active');
        dots[currentSlideIndex].classList.add('active');

        // Play new video
        playCurrentVideo();
    }

    function currentSlideIndexSet(index) {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot');
        const videos = document.querySelectorAll('.slide-video');

        // Pause current video
        if (videos[currentSlideIndex]) videos[currentSlideIndex].pause();

        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        currentSlideIndex = index - 1;
        slides[currentSlideIndex].classList.add('active');
        dots[currentSlideIndex].classList.add('active');

        // Play new video
        playCurrentVideo();
    }

    function playCurrentVideo() {
        const videos = document.querySelectorAll('.slide-video');
        const currentVideo = videos[currentSlideIndex];

        if (currentVideo) {
            currentVideo.currentTime = 0; // Reset to beginning
            currentVideo.play().catch(e => {
                console.log('Video autoplay failed:', e);
                // If autoplay fails, try without sound first
                currentVideo.muted = true;
                currentVideo.play();
            });
        }
    }

    function nextSlide() {
        if (isAutoPlaying) {
            changeSlide(1);
        }
    }

    function setupVideoSlider() {
        const videos = document.querySelectorAll('.slide-video');
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot');

        videos.forEach((video, index) => {
            // When video ends, go to next slide (loop to first after last)
            video.addEventListener('ended', () => {
                if (index === currentSlideIndex && isAutoPlaying) {
                    setTimeout(() => {
                        // Advance to next slide (loop)
                        changeSlide(1);
                    }, 500);
                }
            });

            // Handle video loading
            video.addEventListener('loadeddata', () => {
                if (index === currentSlideIndex) {
                    playCurrentVideo();
                }
            });

            // Handle video errors
            video.addEventListener('error', (e) => {
                console.log(`Video ${index + 1} error:`, e);
                console.log(`Video src: ${video.src}`);
                // If video fails, advance to next slide after 3 seconds
                if (index === currentSlideIndex) {
                    setTimeout(() => {
                        changeSlide(1);
                    }, 3000);
                }
            });
        });

        // Dot click listeners (robustness)
        dots.forEach((dot, idx) => {
            dot.onclick = function() {
                currentSlideIndexSet(idx + 1);
            };
        });

        // Start playing the first video
        playCurrentVideo();
    }

    // Product Category Filter
    function initProductFilter() {
        const categoryBtns = document.querySelectorAll('.category-btn');
        const productCards = document.querySelectorAll('.product-card');

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const category = btn.dataset.category;
                productCards.forEach(card => {
                    card.style.display = category === 'all' || card.dataset.category === category ? 'block' : 'none';
                });
            });
        });
    }
    
    // Pause/Resume auto-play when user interacts
    document.addEventListener('click', (e) => {
        if (e.target.closest('.slider-nav') || e.target.closest('.dot')) {
            isAutoPlaying = false;
            // Resume auto-play after 10 seconds of no interaction
            setTimeout(() => {
                isAutoPlaying = true;
            }, 10000);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        initNavbarEffects();
        initIconAnimations();
        addRippleStyles();
        initProductFilter();
        setupVideoSlider();
        
        // Handle visibility change (pause videos when tab is not active)
        document.addEventListener('visibilitychange', () => {
            const videos = document.querySelectorAll('.slide-video');
            if (document.hidden) {
                videos.forEach(video => video.pause());
                isAutoPlaying = false;
            } else {
                isAutoPlaying = true;
                playCurrentVideo();
            }
        });
    });
</script>

<!-- AOS and Typed.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });

    // Initialize Typed.js for each section
    document.addEventListener('DOMContentLoaded', function() {
        // Innovation section typing
        const innovationTyped = new Typed('#typed-innovation', {
            strings: [
                '{{ __("homepage.typing_innovation_1") }}', 
                '{{ __("homepage.typing_innovation_2") }}', 
                '{{ __("homepage.typing_innovation_3") }}'
            ],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            showCursor: true,
            cursorChar: '|'
        });

        // Global section typing
        const globalTyped = new Typed('#typed-global', {
            strings: [
                '{{ __("homepage.typing_global_1") }}', 
                '{{ __("homepage.typing_global_2") }}', 
                '{{ __("homepage.typing_global_3") }}'
            ],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            showCursor: true,
            cursorChar: '|',
            startDelay: 500
        });

        // Quality section typing
        const qualityTyped = new Typed('#typed-quality', {
            strings: [
                '{{ __("homepage.typing_quality_1") }}', 
                '{{ __("homepage.typing_quality_2") }}', 
                '{{ __("homepage.typing_quality_3") }}'
            ],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            showCursor: true,
            cursorChar: '|',
            startDelay: 1000
        });

        // Future section typing
        const futureTyped = new Typed('#typed-future', {
            strings: [
                '{{ __("homepage.typing_future_1") }}', 
                '{{ __("homepage.typing_future_2") }}', 
                '{{ __("homepage.typing_future_3") }}'
            ],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 2000,
            loop: true,
            showCursor: true,
            cursorChar: '|',
            startDelay: 1500
        });

        // Add smooth scrolling for better UX
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

        // Add scroll reveal animations
        const scrollElements = document.querySelectorAll('.scroll-section');
        
        const elementInView = (el, percentageScroll = 100) => {
            const elementTop = el.getBoundingClientRect().top;
            return (
                elementTop <= 
                ((window.innerHeight || document.documentElement.clientHeight) * (percentageScroll/100))
            );
        };

        const displayScrollElement = (element) => {
            element.classList.add('scrolled');
        };

        const hideScrollElement = (element) => {
            element.classList.remove('scrolled');
        };

        const handleScrollAnimation = () => {
            scrollElements.forEach((el) => {
                if (elementInView(el, 80)) {
                    displayScrollElement(el);
                } else {
                    hideScrollElement(el);
                }
            });
        };

        window.addEventListener('scroll', () => {
            handleScrollAnimation();
        });

        // Initialize on load
        handleScrollAnimation();
    });
</script>
@endpush