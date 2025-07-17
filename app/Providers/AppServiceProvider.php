<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // URL::forceScheme('https');
        // Register model observers
        \App\Models\ContactMessage::observe(\App\Observers\ContactMessageObserver::class);
        \App\Models\PendingChange::observe(\App\Observers\PendingChangeObserver::class);
        \App\Models\AuditLog::observe(\App\Observers\AuditLogObserver::class);
    }
}
