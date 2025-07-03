@extends('layouts.public')

@section('title', 'Drilling Equipment Products - Soosan Cebotics')
@section('description',
    'Browse our comprehensive range of drilling equipment and machinery. Find the perfect solution
    for your construction, mining, or industrial project.')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <!-- Page Header -->
            <div class="mb-4">
                <h1 class="display-4 fw-bold text-dark mb-3">
                    {{ __('common.all_products') }}
                </h1>
                <p class="lead text-muted">
                    {{ __('common.products_subtitle') }}
                </p>
            </div>

            <!-- Filters and Search -->
            <div class="card p-4 mb-4">
                <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-end">
                    <!-- Search -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">{{ __('Search') }}</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="{{ __('Search products...') }}" class="form-control">
                    </div>

                    <!-- Category Filter -->
                    <div class="col-md-2">
                        <label for="category" class="form-label">{{ __('Category') }}</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="col-md-2">
                        <label class="form-label">{{ __('Price Range') }}</label>
                        <div class="d-flex gap-1">
                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                placeholder="{{ __('Min') }}" class="form-control">
                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                placeholder="{{ __('Max') }}" class="form-control">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="col-md-2">
                        <label for="sort" class="form-label">{{ __('Sort By') }}</label>
                        <select name="sort" id="sort" class="form-select">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('Name A-Z') }}
                            </option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>
                                {{ __('Price Low-High') }}</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>
                                {{ __('Newest First') }}</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Filter') }}
                            </button>

                            @if (request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                    {{ __('Clear') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="row g-4 mb-4">
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card h-100 product-card" data-product-id="{{ $product->id }}">
                                <!-- Product Image -->
                                @if ($product->getFirstMediaUrl('images'))
                                    <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <svg class="text-muted" width="64" height="64" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <!-- Category -->
                                    @if ($product->category)
                                        <span class="badge bg-primary mb-2 align-self-start">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif

                                    <!-- Product Name -->
                                    <h5 class="card-title fw-semibold mb-2">{{ $product->name }}</h5>

                                    <!-- Model Number -->
                                    @if ($product->model_number)
                                        <p class="text-muted small mb-2">{{ __('Model:') }} {{ $product->model_number }}
                                        </p>
                                    @endif

                                    <!-- Description -->
                                    <p class="card-text text-muted small mb-3 flex-grow-1">
                                        {{ Str::limit($product->description, 120) }}</p>

                                    <!-- Price -->
                                    @if ($product->price)
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <span class="h4 fw-bold text-primary product-price mb-0"
                                                data-price="{{ $product->price }}">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Action Button -->
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary mt-auto">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <!-- No Products Found -->
                <div class="text-center py-5">
                    <svg class="text-muted mx-auto mb-3" width="96" height="96" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="h4 fw-semibold text-dark mb-2">{{ __('No products found') }}</h3>
                    <p class="text-muted mb-4">{{ __('Try adjusting your search criteria or browse all categories.') }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        {{ __('View All Products') }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            // Unit conversion functionality
            function convertUnits(unit) {
                const priceElements = document.querySelectorAll('.product-price');

                priceElements.forEach(element => {
                    const originalPrice = parseFloat(element.dataset.price);
                    let convertedPrice = originalPrice;

                    // Simple conversion example (you can implement actual conversion logic)
                    if (unit === 'Imperial') {
                        // This is just a placeholder - implement actual conversion if needed
                        convertedPrice = originalPrice;
                    }

                    element.textContent = '$' + new Intl.NumberFormat().format(convertedPrice.toFixed(2));
                });
            }

            // Auto-submit form on filter change
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                const selects = form.querySelectorAll('select');

                selects.forEach(select => {
                    select.addEventListener('change', function() {
                        form.submit();
                    });
                });
            });
        </script>
    @endpush
@endsection
