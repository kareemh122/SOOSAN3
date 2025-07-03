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
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($product->status) }}
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

            <!-- Specifications Tabs -->
            @if ($product->specs_si || $product->specs_imperial || $product->features || $product->applications)
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                            @if ($product->specs_si || $product->specs_imperial)
                                <button
                                    class="tab-button active py-4 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600"
                                    data-tab="specifications">
                                    {{ __('Specifications') }}
                                </button>
                            @endif
                            @if ($product->features)
                                <button
                                    class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-tab="features">
                                    {{ __('Features') }}
                                </button>
                            @endif
                            @if ($product->applications)
                                <button
                                    class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-tab="applications">
                                    {{ __('Applications') }}
                                </button>
                            @endif
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Specifications Tab -->
                        @if ($product->specs_si || $product->specs_imperial)
                            <div id="specifications" class="tab-content">
                                <div class="mb-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="unit-system" value="si" checked
                                            class="form-radio text-blue-600">
                                        <span class="ml-2">{{ __('SI Units') }}</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" name="unit-system" value="imperial"
                                            class="form-radio text-blue-600">
                                        <span class="ml-2">{{ __('Imperial Units') }}</span>
                                    </label>
                                </div>

                                <!-- SI Specifications -->
                                @if ($product->specs_si)
                                    <div id="specs-si" class="specifications-content">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach ($product->specs_si as $key => $value)
                                                <div class="flex justify-between py-2 border-b border-gray-100">
                                                    <span
                                                        class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                    <span class="text-gray-900">{{ $value }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Imperial Specifications -->
                                @if ($product->specs_imperial)
                                    <div id="specs-imperial" class="specifications-content hidden">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach ($product->specs_imperial as $key => $value)
                                                <div class="flex justify-between py-2 border-b border-gray-100">
                                                    <span
                                                        class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                    <span class="text-gray-900">{{ $value }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Features Tab -->
                        @if ($product->features)
                            <div id="features" class="tab-content hidden">
                                <ul class="space-y-3">
                                    @foreach ($product->features as $feature)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20">
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

                        <!-- Applications Tab -->
                        @if ($product->applications)
                            <div id="applications" class="tab-content hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($product->applications as $application)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h4 class="font-medium text-gray-900 mb-2">{{ $application }}</h4>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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

            // Tab functionality
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabContents = document.querySelectorAll('.tab-content');

                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const targetTab = this.dataset.tab;

                        // Update button states
                        tabButtons.forEach(btn => {
                            btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                            btn.classList.add('border-transparent', 'text-gray-500');
                        });
                        this.classList.add('active', 'border-blue-500', 'text-blue-600');
                        this.classList.remove('border-transparent', 'text-gray-500');

                        // Update content visibility
                        tabContents.forEach(content => {
                            content.classList.add('hidden');
                        });
                        document.getElementById(targetTab).classList.remove('hidden');
                    });
                });

                // Unit system switching
                const unitRadios = document.querySelectorAll('input[name="unit-system"]');
                unitRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        const selectedUnit = this.value;
                        const siSpecs = document.getElementById('specs-si');
                        const imperialSpecs = document.getElementById('specs-imperial');

                        if (selectedUnit === 'si') {
                            siSpecs?.classList.remove('hidden');
                            imperialSpecs?.classList.add('hidden');
                        } else {
                            siSpecs?.classList.add('hidden');
                            imperialSpecs?.classList.remove('hidden');
                        }
                    });
                });
            });

            // Unit conversion for price
            function convertUnits(unit) {
                const priceElements = document.querySelectorAll('.product-price');

                priceElements.forEach(element => {
                    const originalPrice = parseFloat(element.dataset.price);
                    let convertedPrice = originalPrice;

                    // Implement actual conversion logic if needed
                    if (unit === 'Imperial') {
                        convertedPrice = originalPrice;
                    }

                    element.textContent = '$' + new Intl.NumberFormat().format(convertedPrice.toFixed(2));
                });
            }
        </script>
    @endpush
@endsection
