@extends('layouts.public')

@section('title', $product->name . ' - Soosan Cebotics')
@section('description', Str::limit($product->description, 160))

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
                    @if ($product->category)
                        <li><span class="text-gray-500">/</span></li>
                        <li><a href="{{ route('products.category', $product->category) }}"
                                class="text-blue-600 hover:text-blue-800">{{ $product->category->name }}</a></li>
                    @endif
                    <li><span class="text-gray-500">/</span></li>
                    <li><span class="text-gray-900 font-medium">{{ $product->name }}</span></li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <!-- Product Images -->
                <div>
                    @if ($product->getMedia('images')->count() > 0)
                        <div class="space-y-4">
                            <!-- Main Image -->
                            <div class="aspect-square bg-white rounded-lg overflow-hidden shadow-md">
                                <img id="main-image" src="{{ $product->getFirstMediaUrl('images') }}"
                                    alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>

                            <!-- Thumbnail Images -->
                            @if ($product->getMedia('images')->count() > 1)
                                <div class="grid grid-cols-4 gap-2">
                                    @foreach ($product->getMedia('images') as $index => $media)
                                        <button
                                            class="aspect-square bg-white rounded border-2 {{ $index === 0 ? 'border-blue-500' : 'border-gray-200' }} overflow-hidden hover:border-blue-500 transition-colors thumbnail-btn"
                                            onclick="changeMainImage('{{ $media->getUrl() }}', this)">
                                            <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <!-- Placeholder Image -->
                        <div class="aspect-square bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <!-- Category Badge -->
                    @if ($product->category)
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    @endif

                    <!-- Product Name -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $product->name }}</h1>

                    <!-- Model Number -->
                    @if ($product->model_number)
                        <p class="text-lg text-gray-600">{{ __('Model:') }} <span
                                class="font-semibold">{{ $product->model_number }}</span></p>
                    @endif

                    <!-- Price -->
                    @if ($product->price)
                        <div class="text-3xl font-bold text-blue-600 product-price" data-price="{{ $product->price }}">
                            ${{ number_format($product->price, 2) }}
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-700">{{ __('Status:') }}</span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? __('Available') : __('Unavailable') }}
                        </span>
                    </div>

                    <!-- Contact CTA -->
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">{{ __('Interested in this product?') }}</h3>
                        <p class="text-gray-600 mb-4">
                            {{ __('Contact our sales team for pricing, availability, and technical specifications.') }}</p>
                        <a href="{{ route('contact') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium inline-block transition-colors">
                            {{ __('Contact Sales') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Specifications Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
                <!-- Unit Toggle -->
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">{{ __('Specifications') }}</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium text-gray-700">{{ __('Units:') }}</span>
                            <div class="flex bg-gray-100 rounded-lg p-1">
                                <button id="si-btn"
                                    class="unit-toggle px-4 py-2 text-sm font-medium rounded-md bg-blue-600 text-white transition-colors">
                                    {{ __('SI') }}
                                </button>
                                <button id="imperial-btn"
                                    class="unit-toggle px-4 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700 transition-colors">
                                    {{ __('Imperial') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Content -->
                <div class="p-6">
                    <div id="specifications-content">
                        <!-- SI Specifications (Default) -->
                        <div id="si-specs" class="specifications-table">
                            @php
                                $siSpecs = $product->getSpecificationsWithUnit('si');
                            @endphp
                            @if ($siSpecs && count($siSpecs) > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                                    @foreach ($siSpecs as $key => $spec)
                                        @if ($spec['value'])
                                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                                <span class="font-medium text-gray-700">{{ $spec['label'] }}:</span>
                                                <span class="text-gray-900 font-semibold">
                                                    {{ $spec['value'] }} {{ $spec['unit'] }}
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Imperial Specifications (Hidden by default) -->
                        <div id="imperial-specs" class="specifications-table hidden">
                            @php
                                $imperialSpecs = $product->getSpecificationsWithUnit('imperial');
                            @endphp
                            @if ($imperialSpecs && count($imperialSpecs) > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                                    @foreach ($imperialSpecs as $key => $spec)
                                        @if ($spec['value'])
                                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                                <span class="font-medium text-gray-700">{{ $spec['label'] }}:</span>
                                                <span class="text-gray-900 font-semibold">
                                                    {{ $spec['value'] }} {{ $spec['unit'] }}
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-700">{{ $feature }}</span>
            </li>
            @endforeach
            </ul>
        </div>
        @endif

        <!-- Documents Section -->
        @if ($product->getMedia('documents')->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ __('Downloads') }}</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($product->getMedia('documents') as $document)
                            <a href="{{ $document->getUrl() }}" target="_blank"
                                class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                <svg class="w-8 h-8 text-red-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                </svg>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $document->name }}</div>
                                    <div class="text-sm text-gray-500">{{ __('PDF Document') }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Related Products') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            @if ($relatedProduct->getFirstMediaUrl('images'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}"
                                    alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
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
                                <h3 class="text-lg font-semibold mb-2 line-clamp-2">{{ $relatedProduct->name }}</h3>
                                @if ($relatedProduct->price)
                                    <p class="text-xl font-bold text-blue-600 mb-3">
                                        ${{ number_format($relatedProduct->price, 2) }}</p>
                                @endif
                                <a href="{{ route('products.show', $relatedProduct) }}"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center inline-block transition-colors font-medium">
                                    {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    </div>

    @push('scripts')
        <script>
            // Image gallery functionality
            function changeMainImage(src, button) {
                document.getElementById('main-image').src = src;

                // Update active thumbnail
                document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                    btn.classList.remove('border-blue-500');
                    btn.classList.add('border-gray-200');
                });
                button.classList.remove('border-gray-200');
                button.classList.add('border-blue-500');
            }

            // Unit conversion functionality
            document.addEventListener('DOMContentLoaded', function() {
                const siBtn = document.getElementById('si-btn');
                const imperialBtn = document.getElementById('imperial-btn');
                const siSpecs = document.getElementById('si-specs');
                const imperialSpecs = document.getElementById('imperial-specs');

                // SI button click
                siBtn?.addEventListener('click', function() {
                    // Update button states
                    siBtn.classList.add('bg-blue-600', 'text-white');
                    siBtn.classList.remove('text-gray-500');
                    imperialBtn.classList.remove('bg-blue-600', 'text-white');
                    imperialBtn.classList.add('text-gray-500');

                    // Show/hide specifications
                    siSpecs?.classList.remove('hidden');
                    imperialSpecs?.classList.add('hidden');
                });

                // Imperial button click
                imperialBtn?.addEventListener('click', function() {
                    // Update button states
                    imperialBtn.classList.add('bg-blue-600', 'text-white');
                    imperialBtn.classList.remove('text-gray-500');
                    siBtn.classList.remove('bg-blue-600', 'text-white');
                    siBtn.classList.add('text-gray-500');

                    // Show/hide specifications
                    imperialSpecs?.classList.remove('hidden');
                    siSpecs?.classList.add('hidden');
                });
            });
        </script>
    @endpush
@endsection
