<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                @auth
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <button class="btn btn-link nav-link position-relative dropdown-toggle" type="button" data-bs-toggle="dropdown" id="notificationDropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                                  style="display: {{ auth()->user()->unreadNotifications->count() > 0 ? 'inline-block' : 'none' }};"
                                  data-count="{{ auth()->user()->unreadNotifications->count() }}">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown-content" style="width: 350px; max-height: 400px; overflow-y: auto;">
                            <li><h6 class="dropdown-header">
                                <i class="fas fa-bell me-2"></i>{{ __('admin.notifications') }}
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-danger ms-2">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </h6></li>
                            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                <li>
                                    <a class="dropdown-item py-2 notification-item {{ !$notification->read_at ? 'unread' : '' }}" 
                                       href="{{ $notification->data['url'] ?? route('notifications.index') }}"
                                       data-notification-id="{{ $notification->id }}"
                                       onclick="markNotificationAsRead('{{ $notification->id }}')">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-2">
                                                <i class="{{ $notification->data['icon'] ?? 'fas fa-bell' }} text-{{ $notification->data['color'] ?? 'primary' }}"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-truncate">{{ $notification->data['title'] ?? __('admin.notifications') }}</div>
                                                <div class="text-muted small text-truncate">{{ Str::limit($notification->data['message'] ?? '', 60) }}</div>
                                                @if(isset($notification->data['reason']) && $notification->data['reason'])
                                                    <div class="text-danger small text-truncate">{{ Str::limit($notification->data['reason'], 80) }}</div>
                                                @endif
                                                <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                            @if(!$notification->read_at)
                                                <div class="notification-dot"></div>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <div class="dropdown-item-text text-muted text-center py-3">
                                        <i class="fas fa-bell-slash fa-2x mb-2 d-block"></i>
                                        {{ __('admin.no_notifications_yet') }}
                                    </div>
                                </li>
                            @endforelse
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center fw-bold" href="{{ route('notifications.index') }}">
                                <i class="fas fa-list me-2"></i>{{ __('admin.view_all_notifications') }}
                            </a></li>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <li>
                                    <button class="dropdown-item text-center text-primary mark-all-read-btn" onclick="markAllNotificationsAsRead()">
                                        <i class="fas fa-check-double me-2"></i>{{ __('admin.mark_all_as_read') }}
                                    </button>
                                </li>
                            @endif
                        </ul>
                    </li>
                    
                    <!-- User Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
