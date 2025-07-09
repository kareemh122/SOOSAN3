<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Drilling Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Admin Styles -->
    <style>
        :root {
            --admin-primary: #3b82f6;
            --admin-secondary: #6b7280;
            --admin-success: #10b981;
            --admin-danger: #ef4444;
            --admin-warning: #f59e0b;
            --admin-info: #06b6d4;
            --admin-dark: #1f2937;
            --admin-light: #f8fafc;
            --sidebar-width: 280px;
        }

        body {
            background-color: var(--admin-light);
            font-family: 'Inter', sans-serif;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--admin-dark) 0%, #374151 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .admin-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .admin-navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid #374151;
            text-align: center;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav .nav-link {
            color: #d1d5db;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--admin-primary);
            border-right: 3px solid var(--admin-primary);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }

        .submenu {
            padding-left: 1rem;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            margin: 0.25rem 0.5rem;
        }

        .submenu-link {
            padding: 0.5rem 1rem !important;
            font-size: 0.9rem;
            border-left: 2px solid transparent;
        }

        .submenu-link.active {
            border-left-color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
        }

        .submenu-link:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .admin-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .stats-card {
            padding: 1.5rem;
            border-left: 4px solid var(--admin-primary);
        }

        .btn-admin-primary {
            background-color: var(--admin-primary);
            border-color: var(--admin-primary);
            color: white;
        }

        .btn-admin-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .alert-custom {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }

        .table-admin {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table-admin th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e5e7eb;
            font-weight: 600;
            color: var(--admin-dark);
        }

        /* Notification Badge Styling */
        .notification-badge {
            min-width: 20px;
            height: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            line-height: 1;
            padding: 0.25rem 0.4rem;
            border: 2px solid white;
            animation: none;
            transition: all 0.3s ease;
        }

        .notification-badge.badge-visible {
            display: inline-block !important;
        }

        .notification-badge.badge-pulse {
            animation: pulse 1s ease-in-out;
        }

        .notification-badge.badge-new {
            animation: bounce 0.6s ease-in-out;
            background-color: #dc3545 !important;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        /* Notification Dropdown Styling */
        .notification-dropdown-content {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .notification-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .notification-item:hover {
            background-color: #f8fafc;
            border-left-color: var(--admin-primary);
        }

        .notification-item.unread {
            background-color: #eff6ff;
            border-left-color: var(--admin-primary);
        }

        .notification-item.notification-new {
            animation: slideIn 0.3s ease-out;
        }

        .notification-dot {
            width: 8px;
            height: 8px;
            background-color: var(--admin-primary);
            border-radius: 50%;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Toast Notification Styling */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            max-width: 300px;
            transform: translateX(100%);
            transition: all 0.3s ease;
        }

        .toast-notification.show {
            transform: translateX(0);
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-content {
                margin-left: 0;
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    @if(!request()->routeIs('admin.login'))
        <!-- Sidebar -->
        <div class="admin-sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h4 class="mb-0">
                    <i class="fas fa-cogs me-2"></i>
                    {{ __('admin.admin_panel') }}
                </h4>
            </div>
            
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    {{ __('admin.dashboard') }}
                </a>
                
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        {{ __('admin.users') }}
                    </a>
                @endif
                
                <!-- Products - employees can create new and edit existing (with approval) -->
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    {{ __('admin.products') }}
                </a>
                
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.product-categories.index') }}" class="nav-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        {{ __('admin.categories') }}
                    </a>
                @endif
                
                <!-- Owners - employees can create new and edit existing (with approval) -->
                <a href="{{ route('admin.owners.index') }}" class="nav-link {{ request()->routeIs('admin.owners.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i>
                    {{ __('admin.owners') }}
                </a>
                
                <!-- Sold Products - employees can create new and edit existing (with approval) -->
                <a href="{{ route('admin.sold-products.index') }}" class="nav-link {{ request()->routeIs('admin.sold-products.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    {{ __('admin.sold_products') }}
                </a>
                
                <!-- Contact Messages - view only for employees -->
                <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    {{ __('admin.contact_messages') }}
                </a>

                @if(auth()->user()->isAdmin())
                    <!-- Pending Changes - admin only -->
                    <a href="{{ route('admin.pending-changes.index') }}" class="nav-link {{ request()->routeIs('admin.pending-changes.*') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i>
                        {{ __('admin.pending_changes') }}
                        @php
                            $pendingCount = \App\Models\PendingChange::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge badge-warning ml-2">{{ $pendingCount }}</span>
                        @endif
                    </a>

                    <!-- Audit Logs - admin only -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}" 
                           data-bs-toggle="collapse" data-bs-target="#auditLogsSubmenu" 
                           aria-expanded="{{ request()->routeIs('admin.audit-logs.*') ? 'true' : 'false' }}">
                            <i class="fas fa-eye text-primary"></i>
                            System Monitor
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.audit-logs.*') ? 'show' : '' }}" id="auditLogsSubmenu">
                            <div class="submenu">
                                <a href="{{ route('admin.audit-logs.dashboard') }}" class="nav-link submenu-link {{ request()->routeIs('admin.audit-logs.dashboard') ? 'active' : '' }}">
                                    <i class="fas fa-chart-bar"></i>
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.audit-logs.index') }}" class="nav-link submenu-link {{ request()->routeIs('admin.audit-logs.index') ? 'active' : '' }}">
                                    <i class="fas fa-list"></i>
                                    Activity Log
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Reports - admin/CEO only -->
                    @if(auth()->user()->canAccessReports())
                        <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line text-success"></i>
                            {{ __('reports.reports') }}
                        </a>
                    @endif
                @endif
                
                <hr class="border-secondary mx-3">
                
                <a href="{{ route('homepage') }}" class="nav-link" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    View Website
                </a>
                
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link logout-btn" style="width: 100%; text-align: left; border: none; background: none; color: #d1d5db;">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ __('admin.logout') }}
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Top Navbar -->
            <nav class="admin-navbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link d-md-none me-3" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Language Switcher -->
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-language me-1"></i>
                            {{ app()->isLocale('ar') ? 'العربية' : 'English' }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">
                                <i class="fas fa-flag-usa me-2"></i>English
                            </a></li>
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['lang' => 'ar']) }}">
                                <i class="fas fa-flag me-2"></i>العربية
                            </a></li>
                        </ul>
                    </div>
                    
                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                                  style="display: {{ auth()->user()->unreadNotifications->count() > 0 ? 'inline-block' : 'none' }};"
                                  data-initial-count="{{ auth()->user()->unreadNotifications->count() }}">
                                {{ auth()->user()->unreadNotifications->count() > 0 ? auth()->user()->unreadNotifications->count() : '0' }}
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown-content" style="width: 350px; max-height: 400px; overflow-y: auto;">
                            <li><h6 class="dropdown-header">{{ __('admin.notifications') }}</h6></li>
                            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                <li>
                                    <a class="dropdown-item py-2 notification-item {{ !$notification->read_at ? 'unread' : '' }}" 
                                       href="{{ route('notifications.index') }}"
                                       data-notification-id="{{ $notification->id }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="{{ $notification->data['icon'] ?? 'fas fa-exclamation-triangle' }} text-{{ $notification->data['color'] ?? 'warning' }}"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <div class="fw-bold text-truncate">{{ $notification->data['title'] ?? __('admin.notifications') }}</div>
                                                <div class="text-muted small text-truncate">{{ Str::limit($notification->data['message'] ?? '', 60) }}</div>
                                                @if(isset($notification->data['reason']) && $notification->data['reason'])
                                                    <div class="text-danger small text-truncate">{{ Str::limit($notification->data['reason'], 80) }}</div>
                                                @endif
                                                <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item-text text-muted">{{ __('admin.no_notifications') }}</span></li>
                            @endforelse
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="{{ route('notifications.index') }}">{{ __('admin.view_all_notifications') }}</a></li>
                        </ul>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle text-decoration-none" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i>{{ __('common.profile') }}
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('admin.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="p-4">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-custom mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-custom mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-custom mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    @else
        @yield('content')
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                if (alert.classList.contains('alert-success')) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);

        // Confirm delete actions
        document.querySelectorAll('[data-confirm]').forEach(function(element) {
            element.addEventListener('click', function(e) {
                if (!confirm(this.dataset.confirm)) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <!-- Real-time notifications -->
    <script src="{{ asset('js/notifications.js') }}"></script>

    @stack('scripts')
</body>
</html>
