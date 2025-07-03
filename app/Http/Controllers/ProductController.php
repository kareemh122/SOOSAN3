<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'media']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('model_number', 'like', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Status filter (only show active products)
        $query->where('is_active', true);

        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');

        if (in_array($sortBy, ['name', 'price', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query->paginate(12);
        $categories = ProductCategory::all();

        return view('public.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Load relationships
        $product->load(['category', 'media']);

        // Get related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('public.products.show', compact('product', 'relatedProducts'));
    }

    public function category(ProductCategory $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['category', 'media'])
            ->paginate(12);

        return view('public.products.category', compact('category', 'products'));
    }
}
