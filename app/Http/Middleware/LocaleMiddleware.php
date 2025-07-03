<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if language is set in the URL query string
        if ($request->has('lang')) {
            $locale = $request->lang;

            // Check if the locale is valid (only allow en and ar)
            if (in_array($locale, ['en', 'ar'])) {
                Session::put('locale', $locale);
                App::setLocale($locale);
            }
        }
        // Use session locale if available
        elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
