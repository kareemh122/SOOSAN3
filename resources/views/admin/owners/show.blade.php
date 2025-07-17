@extends('layouts.admin')

@section('title', __('owners.show.title'))

@section('content')
<style>
        /* Reset and prevent inheritance from global styles */
        .owners-show-container * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .owners-show-container {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
            min-height: 100vh;
            padding: 1rem;
            color: #1f2937;
            line-height: 1.6;
        }

        /* Modern Header with Enhanced Animations */
        .owners-show-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin: -1rem -1rem 2rem -1rem;
            border-radius: 0 0 2rem 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
            animation: slideInDown 0.6s ease-out;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .owners-show-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .owners-show-header-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .owners-show-title-section h1 {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .owners-show-title-section p {
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
            opacity: 0.9;
            margin: 0;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .owners-action-buttons {
            display: flex;
            gap: 0.75rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .owners-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 0.875rem 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .owners-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .owners-btn:hover::before {
            left: 100%;
        }

        .owners-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            color: white;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .owners-btn.primary {
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            border-color: rgba(255, 255, 255, 0.9);
        }

        .owners-btn.primary:hover {
            background: white;
            color: #667eea;
            border-color: white;
            box-shadow: 0 15px 35px rgba(255, 255, 255, 0.3);
        }

        /* Content Grid with Staggered Animation */
        .owners-content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 2rem;
            margin-bottom: 2rem;
            animation: fadeIn 0.8s ease-out 0.8s both;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Enhanced Info Card */
        .owners-info-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(229, 231, 235, 0.6);
            overflow: hidden;
            transition: all 0.3s ease;
            animation: slideInLeft 0.8s ease-out;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .owners-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .owners-info-header {
            background: linear-gradient(135deg, #f8fafc, #e5e7eb);
            padding: 2rem;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
        }

        .owners-info-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .owners-info-header i {
            color: #667eea;
            font-size: 1.25rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-5px); }
            60% { transform: translateY(-3px); }
        }

        .owners-info-body {
            padding: 2rem;
        }

        .owners-detail-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
            animation: fadeInUp 0.6s ease-out;
        }

        .owners-detail-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .owners-detail-section h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .owners-detail-section h3::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, #667eea, transparent);
            margin-left: 1rem;
        }

        .owners-detail-section i {
            color: #667eea;
            transition: transform 0.3s ease;
        }

        .owners-detail-section:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .owners-detail-grid {
            display: grid;
            gap: 1rem;
        }

        .owners-detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border-radius: 12px;
            border-left: 4px solid #667eea;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .owners-detail-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .owners-detail-item:hover {
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
            border-left-color: #4f46e5;
        }

        .owners-detail-item:hover::before {
            opacity: 1;
        }

        .owners-detail-item i {
            color: #667eea;
            width: 24px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .owners-detail-item:hover i {
            color: #4f46e5;
            transform: scale(1.1);
        }

        .owners-detail-content {
            flex: 1;
        }

        .owners-detail-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .owners-detail-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
            word-break: break-word;
            transition: color 0.3s ease;
        }

        .owners-detail-value a {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .owners-detail-value a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s ease;
        }

        .owners-detail-value a:hover {
            color: #4f46e5;
            transform: translateY(-1px);
        }

        .owners-detail-value a:hover::after {
            width: 100%;
        }

        /* Enhanced Avatar Card */
        .owners-avatar-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(229, 231, 235, 0.6);
            overflow: hidden;
            height: fit-content;
            transition: all 0.3s ease;
            animation: slideInRight 0.8s ease-out;
            position: relative;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .owners-avatar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .owners-avatar-section {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .owners-avatar-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .owners-avatar-content {
            position: relative;
            z-index: 2;
        }

        .owners-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            margin: 0 auto 1rem;
            backdrop-filter: blur(10px);
            border: 4px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .owners-avatar:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .owners-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .owners-avatar-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .owners-avatar-company {
            font-size: 1rem;
            opacity: 0.8;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .owners-meta-info {
            padding: 2rem;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
        }

        .owners-meta-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            position: relative;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .owners-meta-item::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 2px;
        }

        .owners-meta-item:hover::before {
            transform: scaleY(1);
        }

        .owners-meta-item:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            padding-left: 1.5rem;
            border-radius: 12px;
            transform: translateX(8px);
        }

        .owners-meta-item:last-child {
            border-bottom: none;
        }

        .owners-meta-item i {
            color: #667eea;
            width: 24px;
            flex-shrink: 0;
            transition: all 0.3s ease;
            text-align: center;
        }

        .owners-meta-item:hover i {
            color: #764ba2;
            transform: scale(1.2) rotate(10deg);
        }

        .owners-meta-content {
            flex: 1;
        }

        .owners-meta-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .owners-meta-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
            word-break: break-word;
        }

        /* Enhanced Table Styles */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        .table {
            margin: 0;
            background: white;
        }

        .table th {
            background: #667eea;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
        }

        .table td {
            padding: 1rem;
            border-color: #e5e7eb;
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover td {
            background-color: rgba(102, 126, 234, 0.05);
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* No Data State */
        .owners-no-data {
            color: #6b7280;
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 2rem;
            text-align: center;
            justify-content: center;
        }

        .owners-no-data i {
            color: #9ca3af;
            font-size: 1.5rem;
        }

        /* Enhanced responsiveness for avatar card */
        @media (max-width: 1200px) {
            .owners-content-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .owners-avatar-card {
                order: -1;
                max-width: 100%;
            }
            
            .owners-avatar-section {
                padding: 2.5rem 2rem;
            }
            
            .owners-avatar {
                width: 110px;
                height: 110px;
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .owners-show-container {
                padding: 0.75rem;
            }
            
            .owners-show-header {
                margin: -0.75rem -0.75rem 1.5rem -0.75rem;
                padding: 1.5rem 0;
            }
            
            .owners-show-header-content {
                flex-direction: column;
                text-align: center;
                padding: 0 1rem;
                gap: 1rem;
            }
            
            .owners-action-buttons {
                flex-direction: row;
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .owners-btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.8rem;
            }
            
            .owners-btn span.btn-text {
                display: none;
            }
            
            .owners-info-body,
            .owners-meta-info {
                padding: 1.5rem;
            }
            
            .owners-avatar-section {
                padding: 2rem 1.5rem;
            }
            
            .owners-avatar {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }
            
            .owners-avatar-name {
                font-size: 1.25rem;
            }
            
            .owners-avatar-company {
                font-size: 0.875rem;
            }
            
            .owners-detail-item {
                padding: 0.875rem;
            }
            
            .owners-meta-item {
                padding: 0.875rem 0;
                gap: 0.625rem;
            }
            
            .owners-meta-item i {
                width: 20px;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .owners-show-header-content {
                padding: 0 0.75rem;
            }
            
            .owners-action-buttons {
                gap: 0.5rem;
            }
            
            .owners-btn {
                padding: 0.625rem 1rem;
                font-size: 0.75rem;
                min-width: 44px;
            }
            
            .owners-info-body,
            .owners-meta-info {
                padding: 1rem;
            }
            
            .owners-avatar-section {
                padding: 1.5rem 1rem;
            }
            
            .owners-avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
            
            .owners-avatar-name {
                font-size: 1.125rem;
            }
            
            .owners-avatar-company {
                font-size: 0.8rem;
            }
            
            .owners-detail-item {
                padding: 0.75rem;
                gap: 0.5rem;
            }
            
            .owners-detail-item i {
                width: 18px;
            }
            
            .owners-meta-item {
                padding: 0.75rem 0;
                gap: 0.5rem;
            }
            
            .owners-meta-item i {
                width: 18px;
            }
            
            .owners-meta-label {
                font-size: 0.7rem;
            }
            
            .owners-meta-value {
                font-size: 0.8rem;
            }
        }

        /* Loading Animation */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .loading {
            animation: shimmer 2s infinite linear;
            background: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-size: 1000px 104px;
        }

        /* Smooth page transitions */
        .owners-show-container {
            animation: fadeInPage 0.5s ease-out;
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

        .sold-products-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1.2rem;
        }

        .sold-product-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 1.25rem;
            box-shadow: 0 4px 20px rgba(102,126,234,0.08);
            border: 1.5px solid #e5e7eb;
            padding: 1.5rem 1.75rem;
            min-width: 250px;
            flex: 1 1 340px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sold-product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.02), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sold-product-card:hover::before {
            opacity: 1;
        }

        .sold-product-card:hover {
            box-shadow: 0 12px 40px rgba(102,126,234,0.15);
            border-color: #667eea;
            transform: translateY(-4px);
        }

        .sold-product-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.04rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
            z-index: 2;
        }

        .sold-product-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sold-product-label {
            font-weight: 600;
            color: #64748b;
            min-width: 120px;
            font-size: 0.98rem;
            letter-spacing: 0.01em;
        }

        .sold-product-value {
            font-weight: 600;
            color: #1e293b;
            text-align: right;
            flex: 1;
            word-break: break-all;
            font-size: 1.05rem;
        }

        .sold-product-value .badge {
            margin-left: 0.25rem;
            margin-right: 0.1rem;
            font-size: 0.93rem;
            padding: 0.45em 0.9em;
            border-radius: 1em;
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        @media (max-width: 900px) {
            .sold-products-cards {
                gap: 1rem;
            }
            
            .sold-product-card {
                min-width: 0;
                padding: 1.25rem;
                font-size: 0.97rem;
            }
            
            .sold-product-label {
                min-width: 90px;
                font-size: 0.95rem;
            }
            
            .sold-product-value {
                font-size: 0.97rem;
            }
        }

        @media (max-width: 600px) {
            .sold-products-cards {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .sold-product-card {
                padding: 1rem;
                font-size: 0.93rem;
            }
            
            .sold-product-label {
                min-width: 70px;
                font-size: 0.91rem;
            }
            
            .sold-product-value {
                font-size: 0.93rem;
            }
        }
</style>

<div class="owners-show-container">
    <!-- Page Header -->
    <div class="owners-show-header">
        <div class="owners-show-header-content">
            <div class="owners-show-title-section">
                <h1><i class="fas fa-user-circle"></i> {{ __('owners.show.header.title') }}</h1>
                <p>{{ __('owners.show.header.description') }}</p>
            </div>
            <div class="owners-action-buttons">
                <a href="{{ route('admin.owners.edit', $owner) }}" class="owners-btn primary">
                    <i class="fas fa-edit"></i>
                    <span class="btn-text">{{ __('owners.show.header.edit_btn') }}</span>
                </a>
                <a href="{{ route('admin.owners.index') }}" class="owners-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span class="btn-text">{{ __('owners.show.header.back_btn') }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="owners-content-grid">
        <!-- Main Info Card -->
        <div class="owners-info-card">
            <div class="owners-info-header">
                <h2><i class="fas fa-info-circle"></i> {{ __('owners.show.sections.owner_info') }}</h2>
            </div>
            
            <div class="owners-info-body">
                <!-- Basic Information Section -->
                <div class="owners-detail-section">
                    <h3><i class="fas fa-user"></i> {{ __('owners.show.sections.basic_info') }}</h3>
                    <div class="owners-detail-grid">
                        <div class="owners-detail-item">
                            <i class="fas fa-user"></i>
                            <div class="owners-detail-content">
                                <div class="owners-detail-label">{{ __('owners.show.labels.full_name') }}</div>
                                <div class="owners-detail-value">{{ $owner->name }}</div>
                            </div>
                        </div>
                        
                        @if($owner->email)
                            <div class="owners-detail-item">
                                <i class="fas fa-envelope"></i>
                                <div class="owners-detail-content">
                                    <div class="owners-detail-label">{{ __('owners.show.labels.email_address') }}</div>
                                    <div class="owners-detail-value">
                                        <a href="mailto:{{ $owner->email }}">{{ $owner->email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Information Section -->
                @if($owner->phone_number || $owner->company)
                    <div class="owners-detail-section">
                        <h3><i class="fas fa-address-book"></i> {{ __('owners.show.sections.contact_info') }}</h3>
                        <div class="owners-detail-grid">
                            @if($owner->phone_number)
                                <div class="owners-detail-item">
                                    <i class="fas fa-phone"></i>
                                    <div class="owners-detail-content">
                                        <div class="owners-detail-label">{{ __('owners.show.labels.phone_number') }}</div>
                                        <div class="owners-detail-value">
                                            <a href="tel:{{ $owner->phone_number }}">{{ $owner->phone_number }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($owner->company)
                                <div class="owners-detail-item">
                                    <i class="fas fa-building"></i>
                                    <div class="owners-detail-content">
                                        <div class="owners-detail-label">{{ __('owners.show.labels.company') }}</div>
                                        <div class="owners-detail-value">{{ $owner->company }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Location Information Section -->
                @if($owner->address || $owner->city || $owner->country)
                    <div class="owners-detail-section">
                        <h3><i class="fas fa-map-marker-alt"></i> {{ __('owners.show.sections.location_info') }}</h3>
                        <div class="owners-detail-grid">
                            @if($owner->address)
                                <div class="owners-detail-item">
                                    <i class="fas fa-map"></i>
                                    <div class="owners-detail-content">
                                        <div class="owners-detail-label">{{ __('owners.show.labels.address') }}</div>
                                        <div class="owners-detail-value">{{ $owner->address }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($owner->city)
                                <div class="owners-detail-item">
                                    <i class="fas fa-city"></i>
                                    <div class="owners-detail-content">
                                        <div class="owners-detail-label">{{ __('owners.show.labels.city') }}</div>
                                        <div class="owners-detail-value">{{ $owner->city }}</div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($owner->country)
                                <div class="owners-detail-item">
                                    <i class="fas fa-flag"></i>
                                    <div class="owners-detail-content">
                                        <div class="owners-detail-label">{{ __('owners.show.labels.country') }}</div>
                                        <div class="owners-detail-value">{{ $owner->country }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Preferences Section -->
                @if($owner->preferred_language)
                    <div class="owners-detail-section">
                        <h3><i class="fas fa-cog"></i> {{ __('owners.show.sections.preferences') }}</h3>
                        <div class="owners-detail-grid">
                            <div class="owners-detail-item">
                                <i class="fas fa-language"></i>
                                <div class="owners-detail-content">
                                    <div class="owners-detail-label">{{ __('owners.show.labels.preferred_language') }}</div>
                                    <div class="owners-detail-value">{{ strtoupper($owner->preferred_language) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Sold Products Section -->
                @if($owner->soldProducts && $owner->soldProducts->count())
                    <div class="owners-detail-section">
                        <h3><i class="fas fa-box"></i> {{ __('owners.sold_products') }}</h3>
                        <div class="sold-products-cards">
                            @foreach($owner->soldProducts as $soldProduct)
                                <div class="sold-product-card">
                                    <div class="sold-product-row">
                                        <span class="sold-product-label">{{ __('owners.product') }}:</span>
                                        <span class="sold-product-value">{{ $soldProduct->product->model_name ?? '-' }}</span>
                                    </div>
                                    <div class="sold-product-row">
                                        <span class="sold-product-label">{{ __('owners.serial_number') }}:</span>
                                        <span class="sold-product-value">{{ $soldProduct->serial_number }}</span>
                                    </div>
                                    <div class="sold-product-row">
                                        <span class="sold-product-label">{{ __('owners.sale_date') }}:</span>
                                        <span class="sold-product-value">{{ $soldProduct->sale_date ? $soldProduct->sale_date->locale(app()->getLocale())->translatedFormat('j F Y') : '-' }}</span>
                                    </div>
                                    <div class="sold-product-row">
                                        <span class="sold-product-label">{{ __('owners.warranty_end') }}:</span>
                                        <span class="sold-product-value">{{ $soldProduct->warranty_end_date ? $soldProduct->warranty_end_date->locale(app()->getLocale())->translatedFormat('j F Y') : '-' }}</span>
                                    </div>
                                    <div class="sold-product-row">
                                        <span class="sold-product-label">{{ __('owners.warranty_status') }}:</span>
                                        <span class="sold-product-value">
                                            @if($soldProduct->warranty_voided)
                                                <span class="badge bg-danger">{{ __('owners.warranty_voided') }}</span>
                                            @elseif($soldProduct->warranty_end_date && now()->gt($soldProduct->warranty_end_date))
                                                <span class="badge bg-secondary">{{ __('owners.warranty_expired') }}</span>
                                            @else
                                                <span class="badge bg-success">{{ __('owners.warranty_active') }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Enhanced Avatar Card -->
        <div class="owners-avatar-card">
            <div class="owners-avatar-section">
                <div class="owners-avatar-content">
                    <div class="owners-avatar">
                        @if ($owner->company_image_url)
                            <img src="{{ asset($owner->company_image_url) }}" alt="{{ $owner->company }} Logo" class="owners-avatar-img" onerror="this.onerror=null; this.src='{{ asset('images/default-building.svg') }}';">
                        @else
                            <i class="fas fa-building"></i>
                        @endif
                    </div>
                    <div class="owners-avatar-name">{{ $owner->name }}</div>
                    <div class="owners-avatar-company">{{ $owner->company ?? __('owners.show.fallbacks.no_company') }}</div>
                </div>
            </div>
            
            <div class="owners-meta-info">
                <div class="owners-meta-item">
                    <i class="fas fa-calendar-plus"></i>
                    <div class="owners-meta-content">
                        <div class="owners-meta-label">{{ __('owners.show.labels.created_at') }}</div>
                        <div class="owners-meta-value">
                            {{ $owner->created_at ? $owner->created_at->locale(app()->getLocale())->translatedFormat('j F Y \a\t g:i A') : __('owners.show.fallbacks.na') }}
                        </div>
                    </div>
                </div>
                
                <div class="owners-meta-item">
                    <i class="fas fa-calendar-check"></i>
                    <div class="owners-meta-content">
                        <div class="owners-meta-label">{{ __('owners.show.labels.last_updated') }}</div>
                        <div class="owners-meta-value">
                            {{ $owner->updated_at ? $owner->updated_at->locale(app()->getLocale())->translatedFormat('j F Y \a\t g:i A') : __('owners.show.fallbacks.na') }}
                        </div>
                    </div>
                </div>
                
                <div class="owners-meta-item">
                    <i class="fas fa-clock"></i>
                    <div class="owners-meta-content">
                        <div class="owners-meta-label">{{ __('owners.show.labels.time_since_created') }}</div>
                        <div class="owners-meta-value">
                            {{ $owner->created_at ? $owner->created_at->locale(app()->getLocale())->diffForHumans() : __('owners.show.fallbacks.na') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced hover effects with modern animations
    const detailItems = document.querySelectorAll('.owners-detail-item');
    const metaItems = document.querySelectorAll('.owners-meta-item');
    
    // Add staggered animation on load
    detailItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
        item.classList.add('fadeInUp');
    });
    
    // Enhanced intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);
    
    // Observe all animated elements
    document.querySelectorAll('.owners-detail-section, .owners-avatar-card, .owners-info-card').forEach(el => {
        observer.observe(el);
    });
    
    // Add smooth scrolling for mobile navigation
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
    
    // Add loading states for interactive elements
    const interactiveElements = document.querySelectorAll('.owners-btn');
    interactiveElements.forEach(element => {
        element.addEventListener('click', function(e) {
            if (!this.classList.contains('no-loading')) {
                this.style.pointerEvents = 'none';
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                
                setTimeout(() => {
                    this.innerHTML = originalContent;
                    this.style.pointerEvents = 'auto';
                }, 1000);
            }
        });
    });

    // Enhanced card interactions
    const soldProductCards = document.querySelectorAll('.sold-product-card');
    soldProductCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Avatar image error handling
    const avatarImg = document.querySelector('.owners-avatar-img');
    if (avatarImg) {
        avatarImg.addEventListener('error', function() {
            this.style.display = 'none';
            const fallbackIcon = document.createElement('i');
            fallbackIcon.className = 'fas fa-building';
            this.parentNode.appendChild(fallbackIcon);
        });
    }
});
</script>
@endsection