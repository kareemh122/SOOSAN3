@extends('layouts.public')

@section('title', 'Drilling Equipment Products - Soosan Cebotics')
@section('description', 'Browse our comprehensive range of drilling equipment and machinery. Find the perfect solution
    for your construction, mining, or industrial project.')

@section('content')
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('Our Products') }}
                </h1>
                <p class="text-xl text-gray-600">
                    {{ __('Discover our complete range of drilling equipment and machinery solutions') }}
                </p>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <form method="GET" action="{{ route('products.index') }}"
                    class="space-y-4 md:space-y-0 md:flex md:items-center md:space-x-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="{{ __('Search products...') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Category Filter -->
                    <div class="md:w-64">
                        <select name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                    <div class="flex space-x-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}"
                            placeholder="{{ __('Min Price') }}"
                            class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="number" name="max_price" value="{{ request('max_price') }}"
                            placeholder="{{ __('Max Price') }}"
                            class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Sort -->
                    <div class="md:w-48">
                        <select name="sort"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('Name A-Z') }}
                            </option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>
                                {{ __('Price Low-High') }}</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>
                                {{ __('Newest First') }}</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        {{ __('Filter') }}
                    </button>

                    @if (request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            {{ __('Clear') }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow product-card"
                            data-product-id="{{ $product->id }}">
                            <!-- Product Image -->
                            @if ($product->getFirstMediaUrl('images'))
                                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <div class="p-4">
                                <!-- Category -->
                                @if ($product->category)
                                    <span
                                        class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-2">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                                <!-- Product Name -->
                                <h3 class="text-lg font-semibold mb-2 line-clamp-2">{{ $product->name }}</h3>

                                <!-- Model Number -->
                                @if ($product->model_number)
                                    <p class="text-sm text-gray-500 mb-2">{{ __('Model:') }} {{ $product->model_number }}
                                    </p>
                                @endif

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($product->description, 120) }}</p>

                                <!-- Price -->
                                @if ($product->price)
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-2xl font-bold text-blue-600 product-price"
                                            data-price="{{ $product->price }}">
                                            ${{ number_format($product->price, 2) }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Action Button -->
                                <a href="{{ route('products.show', $product) }}"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center inline-block transition-colors font-medium">
                                    {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <!-- No Products Found -->
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('No products found') }}</h3>
                    <p class="text-gray-600 mb-4">{{ __('Try adjusting your search criteria or browse all categories.') }}
                    </p>
                    <a href="{{ route('products.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block transition-colors">
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
