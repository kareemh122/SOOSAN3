<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {
        // Get featured products for homepage
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'media'])
            ->latest()
            ->limit(3)
            ->get();

        return view('public.homepage', compact('featuredProducts'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function terms()
    {
        return view('public.terms');
    }

    public function support()
    {
        return view('public.support');
    }
}
