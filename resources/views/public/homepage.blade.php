@extends('layouts.public')

@section('title', 'Soosan Cebotics - Leading Drilling Equipment Solutions')
@section('description', 'Discover industry-leading drilling equipment and machinery solutions. Quality products for construction, mining, and industrial applications worldwide.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-900 to-blue-700 text-white">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                {{ __('Leading Drilling Equipment Solutions') }}
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                {{ __('Discover industry-leading drilling machinery and equipment for construction, mining, and industrial applications worldwide.') }}
            </p>
            <div class="space-x-4">
                <a href="{{ route('products.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block transition-colors">
                    {{ __('Explore Products') }}
                </a>
                <a href="{{ route('serial-lookup.index') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-blue-900 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block transition-colors">
                    {{ __('Serial Lookup') }}
                </a>
            </div>
        </div>
    </div>
    
    <!-- Hero image background (placeholder) -->
    <div class="absolute inset-0 -z-10">
        <div class="w-full h-full bg-gradient-to-r from-blue-900 to-blue-700"></div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('Why Choose Soosan Cebotics?') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ __('We provide cutting-edge drilling solutions with unmatched quality, reliability, and innovation.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ __('Quality Guaranteed') }}</h3>
                <p class="text-gray-600">{{ __('All our equipment meets the highest international standards for quality and safety.') }}</p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center">
                <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ __('Advanced Technology') }}</h3>
                <p class="text-gray-600">{{ __('State-of-the-art technology ensuring maximum efficiency and performance.') }}</p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 110 19.5 9.75 9.75 0 010-19.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ __('Global Support') }}</h3>
                <p class="text-gray-600">{{ __('Comprehensive support and service network available worldwide.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('Featured Products') }}
            </h2>
            <p class="text-xl text-gray-600">
                {{ __('Explore our most popular drilling equipment and machinery') }}
            </p>
        </div>

        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        @if($product->getFirstMediaUrl('images'))
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">{{ __('No Image') }}</span>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                            @if($product->price)
                                <p class="text-2xl font-bold text-blue-600 mb-4">${{ number_format($product->price, 2) }}</p>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block transition-colors">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Placeholder for when no products are available -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for($i = 1; $i <= 3)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">{{ __('Product Image') }}</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ __('Featured Product') }} {{ $i }}</h3>
                            <p class="text-gray-600 mb-4">{{ __('Professional drilling equipment with advanced features and reliable performance.') }}</p>
                            <p class="text-2xl font-bold text-blue-600 mb-4">${{ number_format(50000 + ($i * 10000), 2) }}</p>
                            <a href="{{ route('products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block transition-colors">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>
                @endfor
            </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block transition-colors">
                {{ __('View All Products') }}
            </a>
        </div>
    </div>
</section>

<!-- Serial Lookup CTA -->
<section class="py-16 bg-blue-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            {{ __('Check Your Equipment Warranty') }}
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ __('Enter your equipment serial number to check warranty status, ownership information, and service history.') }}
        </p>
        <a href="{{ route('serial-lookup.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block transition-colors">
            {{ __('Check Serial Number') }}
        </a>
    </div>
</section>

<!-- Industries Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('Industries We Serve') }}
            </h2>
            <p class="text-xl text-gray-600">
                {{ __('Our equipment powers projects across multiple industries worldwide') }}
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 9.71 9 11 5.16-1.29 9-5.45 9-11V7l-10-5z"/>
                    </svg>
                </div>
                <h3 class="font-semibold">{{ __('Construction') }}</h3>
            </div>

            <div class="text-center">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3 class="font-semibold">{{ __('Mining') }}</h3>
            </div>

            <div class="text-center">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 11H7l2.8-7h4.4L17 11h-2l-1-2.5h-4L9 11zm8 2c1.1 0 2 .9 2 2v6c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2v-6c0-1.1.9-2 2-2h10z"/>
                    </svg>
                </div>
                <h3 class="font-semibold">{{ __('Infrastructure') }}</h3>
            </div>

            <div class="text-center">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h3 class="font-semibold">{{ __('Energy') }}</h3>
            </div>
        </div>
    </div>
</section>
@endsection
