@extends('layouts.public')

@section('title', $product->name . ' - Soosan Cebotics')
@section('description', Str::limit($product->description, 160))

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}"
                            class="text-decoration-none">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                            class="text-decoration-none">{{ __('Products') }}</a></li>
                    @if ($product->category)
                        <li class="breadcrumb-item"><a href="{{ route('products.category', $product->category) }}"
                                class="text-decoration-none">{{ $product->category->name }}</a></li>
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
                                        alt="{{ $product->name }}" class="img-fluid rounded"
                                        style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
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
                                                    class="img-fluid rounded"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <!-- Placeholder Image -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-body d-flex align-items-center justify-content-center"
                                style="aspect-ratio: 1/1;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                                    class="bi bi-image text-secondary" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path
                                        d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
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
                        <p class="fs-5 text-secondary mb-3">{{ __('Model:') }} <span
                                class="fw-semibold">{{ $product->model_number }}</span></p>
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

                    <!-- Contact CTA -->
                    <div class="card bg-primary bg-opacity-10 mb-3">
                        <div class="card-body">
                            <h3 class="h5 fw-semibold mb-2">{{ __('Interested in this product?') }}</h3>
                            <p class="mb-3">
                                {{ __('Contact our sales team for pricing, availability, and technical specifications.') }}
                            </p>
                            <a href="{{ route('contact') }}" class="btn btn-primary">
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
                                <button id="si-btn" type="button" class="unit-toggle btn btn-primary btn-sm">
                                    {{ __('SI') }}
                                </button>
                                <button id="imperial-btn" type="button" class="unit-toggle btn btn-outline-primary btn-sm">
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

            <!-- Features Section -->
            @if (!empty($product->features))
                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-white">
                        <h2 class="h4 fw-bold mb-0">{{ __('Features') }}</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($product->features as $feature)
                                <li class="d-flex align-items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor"
                                        class="bi bi-check-circle-fill text-success me-2 flex-shrink-0"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Documents Section -->
            @if ($product->getMedia('documents')->count() > 0)
                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-white">
                        <h2 class="h4 fw-bold mb-0">{{ __('Downloads') }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach ($product->getMedia('documents') as $document)
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{ $document->getUrl() }}" target="_blank" class="text-decoration-none">
                                        <div
                                            class="border rounded p-3 d-flex align-items-center h-100 transition-all hover-shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="currentColor" class="bi bi-file-earmark-pdf text-danger me-3"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                <path
                                                    d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                            </svg>
                                            <div>
                                                <div class="fw-medium text-dark">{{ $document->name }}</div>
                                                <small class="text-muted">{{ __('PDF Document') }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="mb-5">
                    <h2 class="h4 fw-bold mb-4">{{ __('Related Products') }}</h2>
                    <div class="row g-4">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 shadow-sm">
                                    @if ($relatedProduct->getFirstMediaUrl('images'))
                                        <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}"
                                            alt="{{ $relatedProduct->name }}" class="card-img-top"
                                            style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                fill="currentColor" class="bi bi-image text-secondary"
                                                viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                <path
                                                    d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h3 class="h5 fw-semibold mb-2 text-truncate">{{ $relatedProduct->name }}</h3>
                                        @if ($relatedProduct->price)
                                            <p class="fs-4 fw-bold text-primary mb-3">
                                                ${{ number_format($relatedProduct->price, 2) }}</p>
                                        @endif
                                        <a href="{{ route('products.show', $relatedProduct) }}"
                                            class="btn btn-primary mt-auto">
                                            {{ __('View Details') }}
                                        </a>
                                    </div>
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
                    btn.classList.remove('border-primary');
                    btn.classList.add('border-secondary');
                });
                button.classList.remove('border-secondary');
                button.classList.add('border-primary');
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
                    siBtn.classList.add('btn-primary');
                    siBtn.classList.remove('btn-outline-primary');
                    imperialBtn.classList.add('btn-outline-primary');
                    imperialBtn.classList.remove('btn-primary');

                    // Show/hide specifications
                    siSpecs?.classList.remove('d-none');
                    imperialSpecs?.classList.add('d-none');
                });

                // Imperial button click
                imperialBtn?.addEventListener('click', function() {
                    // Update button states
                    imperialBtn.classList.add('btn-primary');
                    imperialBtn.classList.remove('btn-outline-primary');
                    siBtn.classList.add('btn-outline-primary');
                    siBtn.classList.remove('btn-primary');

                    // Show/hide specifications
                    imperialSpecs?.classList.remove('d-none');
                    siSpecs?.classList.add('d-none');
                });
            });
        </script>
    @endpush
@endsection
