@extends('layouts.public')

@section('title', $product->name . ' - Soosan Cebotics')
@section('description', Str::limit($product->description, 160))

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-decoration-none">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">{{ __('Products') }}</a></li>
                    @if ($product->category)
                        <li class="breadcrumb-item"><a href="{{ route('products.category', $product->category) }}" class="text-decoration-none">{{ $product->category->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="row g-4 mb-5">
                <!-- Product Images -->
                <div class="col-lg-6">
                    @if ($product->getMedia('images')->count() > 0)
                        <div class="mb-4">
                            <!-- Main Image -->
                            <div class="card shadow-sm mb-3">
                                <div class="card-body p-0">
                                    <img id="main-image" src="{{ $product->getFirstMediaUrl('images') }}"
                                        alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
                                </div>
                            </div>

                            <!-- Thumbnail Images -->
                            @if ($product->getMedia('images')->count() > 1)
                                <div class="row g-2">
                                    @foreach ($product->getMedia('images') as $index => $media)
                                        <div class="col-3">
                                            <button
                                                class="btn p-0 border {{ $index === 0 ? 'border-primary' : 'border-secondary' }} rounded thumbnail-btn w-100"
                                                style="aspect-ratio: 1/1;" 
                                                onclick="changeMainImage('{{ $media->getUrl() }}', this)">
                                                <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}"
                                                    class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <!-- Placeholder Image -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-body d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-image text-secondary" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="col-lg-6">
                    <!-- Category Badge -->
                    @if ($product->category)
                        <span class="badge bg-primary bg-opacity-10 text-primary mb-2">
                            {{ $product->category->name }}
                        </span>
                    @endif

                    <!-- Product Name -->
                    <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>

                    <!-- Model Number -->
                    @if ($product->model_number)
                        <p class="fs-5 text-secondary mb-3">{{ __('Model:') }} <span class="fw-semibold">{{ $product->model_number }}</span></p>
                    @endif

                    <!-- Price -->
                    @if ($product->price)
                        <div class="fs-3 fw-bold text-primary mb-3 product-price" data-price="{{ $product->price }}">
                            ${{ number_format($product->price, 2) }}
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-4">
                        <p class="fs-5">{{ $product->description }}</p>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <span class="me-2">{{ __('Status:') }}</span>
                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->is_active ? __('Available') : __('Unavailable') }}
                        </span>
                    </div>

                    <!-- Contact CTA -->
                    <div class="card bg-primary bg-opacity-10 mb-3">
                        <div class="card-body">
                            <h3 class="h5 fw-semibold mb-2">{{ __('Interested in this product?') }}</h3>
                            <p class="mb-3">
                                {{ __('Contact our sales team for pricing, availability, and technical specifications.') }}</p>
                            <a href="{{ route('contact') }}"
                                class="btn btn-primary">
                                {{ __('Contact Sales') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Specifications Section -->
            <div class="card shadow-sm mb-5">
                <!-- Unit Toggle -->
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 fw-bold mb-0">{{ __('Specifications') }}</h2>
                        <div class="d-flex align-items-center">
                            <span class="me-2">{{ __('Units:') }}</span>
                            <div class="btn-group" role="group" aria-label="Unit toggle">
                                <button id="si-btn" type="button"
                                    class="unit-toggle btn btn-primary btn-sm">
                                    {{ __('SI') }}
                                </button>
                                <button id="imperial-btn" type="button"
                                    class="unit-toggle btn btn-outline-primary btn-sm">
                                    {{ __('Imperial') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Content -->
                <div class="card-body">
                    <div id="specifications-content">
                        <!-- SI Specifications (Default) -->
                        <div id="si-specs" class="specifications-table">
                            @php
                                $siSpecs = $product->getSpecificationsWithUnit('si');
                            @endphp
                            @if ($siSpecs && count($siSpecs) > 0)
                                <div class="row g-3">
                                    @foreach ($siSpecs as $key => $spec)
                                        @if ($spec['value'])
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-between py-2 border-bottom">
                                                    <span class="fw-medium">{{ $spec['label'] }}:</span>
                                                    <span class="fw-semibold">
                                                        {{ $spec['value'] }} {{ $spec['unit'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Imperial Specifications (Hidden by default) -->
                        <div id="imperial-specs" class="specifications-table d-none">
                            @php
                                $imperialSpecs = $product->getSpecificationsWithUnit('imperial');
                            @endphp
                            @if ($imperialSpecs && count($imperialSpecs) > 0)
                                <div class="row g-3">
                                    @foreach ($imperialSpecs as $key => $spec)
                                        @if ($spec['value'])
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-between py-2 border-bottom">
                                                    <span class="fw-medium">{{ $spec['label'] }}:</span>
                                                    <span class="fw-semibold">
                                                        {{ $spec['value'] }} {{ $spec['unit'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill text-success me-2 flex-shrink-0" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <span>{{ $feature }}</span>
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
