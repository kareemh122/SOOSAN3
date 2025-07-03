<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SerialLookupController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/privacy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');
Route::get('/support', [PublicController::class, 'support'])->name('support');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category:id}', [ProductController::class, 'category'])->name('products.category');

// Serial lookup routes
Route::get('/serial-lookup', [SerialLookupController::class, 'index'])->name('serial-lookup.index');
Route::post('/serial-lookup', [SerialLookupController::class, 'lookup'])->name('serial-lookup.lookup');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
