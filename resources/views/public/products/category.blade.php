@extends('layouts.public')

@section('title', $category->name . ' - Soosan Cebotics')
@section('description', 'Browse ' . $category->name . ' drilling equipment and machinery from Soosan Cebotics.')

@section('content')
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('homepage') }}" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a>
                    </li>
                    <li><span class="text-gray-500">/</span></li>
                    <li><a href="{{ route('products.index') }}"
                            class="text-blue-600 hover:text-blue-800">{{ __('Products') }}</a></li>
                    <li><span class="text-gray-500">/</span></li>
                    <li><span class="text-gray-900 font-medium">{{ $category->name }}</span></li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $category->name }}
                </h1>
                @if ($category->description)
                    <p class="text-xl text-gray-600">{{ $category->description }}</p>
                @endif
            </div>

            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
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
                                        <span
                                            class="text-2xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
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
                    {{ $products->links() }}
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
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('No products found in this category') }}
                    </h3>
                    <p class="text-gray-600 mb-4">{{ __('Check back later for new products or browse other categories.') }}
                    </p>
                    <a href="{{ route('products.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block transition-colors">
                        {{ __('Browse All Products') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
