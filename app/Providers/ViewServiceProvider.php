<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Share product categories only with specific views that need them
        View::composer(['layouts.public', 'layouts.navigation', 'public.*'], function ($view) {
            static $productCategories = null;
            
            if ($productCategories === null) {
                $productCategories = ProductCategory::all();
            }
            
            $view->with('productCategories', $productCategories);
        });
    }
}
