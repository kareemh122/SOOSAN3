@extends('layouts.public')

@section('title', 'Soosan Cebotics - Leading Drilling Equipment Solutions')
@section('description',
    'Discover industry-leading drilling equipment and machinery solutions. Quality products for
    construction, mining, and industrial applications worldwide.')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative hero-section text-white">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="position-relative container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 text-center py-5">
                    <h1 class="display-2 fw-bold mb-4">
                        {{ __('Leading Drilling Equipment Solutions') }}
                    </h1>
                    <p class="lead fs-4 mb-4">
                        {{ __('Discover industry-leading drilling machinery and equipment for construction, mining, and industrial applications worldwide.') }}
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4 py-2 fw-semibold">
                            {{ __('Explore Products') }}
                        </a>
                        <a href="{{ route('serial-lookup.index') }}"
                            class="btn btn-outline-light btn-lg px-4 py-2 fw-semibold">
                            {{ __('Serial Lookup') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-dark mb-3">
                    {{ __('Why Choose Soosan Cebotics?') }}
                </h2>
                <p class="lead text-muted">
                    {{ __('We provide cutting-edge drilling solutions with unmatched quality, reliability, and innovation.') }}
                </p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="feature-icon bg-primary bg-opacity-10 mb-3">
                            <svg width="32" height="32" class="text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="h4 fw-semibold mb-2">{{ __('Quality Guaranteed') }}</h3>
                        <p class="text-muted">
                            {{ __('All our equipment meets the highest international standards for quality and safety.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="feature-icon bg-warning bg-opacity-10 mb-3">
                            <svg width="32" height="32" class="text-warning" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="h4 fw-semibold mb-2">{{ __('Advanced Technology') }}</h3>
                        <p class="text-muted">
                            {{ __('State-of-the-art technology ensuring maximum efficiency and performance.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="feature-icon bg-success bg-opacity-10 mb-3">
                            <svg width="32" height="32" class="text-success" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 110 19.5 9.75 9.75 0 010-19.5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="h4 fw-semibold mb-2">{{ __('Global Support') }}</h3>
                        <p class="text-muted">{{ __('Comprehensive support and service network available worldwide.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-dark mb-3">
                    {{ __('Featured Products') }}
                </h2>
                <p class="lead text-muted">
                    {{ __('Explore our most popular drilling equipment and machinery') }}
                </p>
            </div>

            @if (isset($featuredProducts) && $featuredProducts->count() > 0)
                <div class="row g-4">
                    @foreach ($featuredProducts as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm product-card">
                                @if ($product->getFirstMediaUrl('images'))
                                    <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <span class="text-muted">{{ __('No Image') }}</span>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold mb-2">{{ $product->name }}</h5>
                                    <p class="card-text text-muted mb-3 flex-grow-1">
                                        {{ Str::limit($product->description, 100) }}</p>
                                    @if ($product->price)
                                        <p class="h4 fw-bold text-primary mb-3">
                                            ${{ number_format($product->price, 2) }}</p>
                                    @endif
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary mt-auto">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Placeholder for when no products are available -->
                <div class="row g-4">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                    style="height: 200px;">
                                    <span class="text-muted">{{ __('Product Image') }}</span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold mb-2">{{ __('Featured Product') }}
                                        {{ $i }}</h5>
                                    <p class="card-text text-muted mb-3 flex-grow-1">
                                        {{ __('Professional drilling equipment with advanced features and reliable performance.') }}
                                    </p>
                                    <p class="h4 fw-bold text-primary mb-3">
                                        ${{ number_format(50000 + $i * 10000, 2) }}</p>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-auto">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4 py-2 fw-semibold">
                    {{ __('View All Products') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Serial Lookup CTA -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="display-4 fw-bold mb-3">
                {{ __('Check Your Equipment Warranty') }}
            </h2>
            <p class="lead mb-4">
                {{ __('Enter your equipment serial number to check warranty status, ownership information, and service history.') }}
            </p>
            <a href="{{ route('serial-lookup.index') }}" class="btn btn-warning btn-lg px-4 py-2 fw-semibold">
                {{ __('Check Serial Number') }}
            </a>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold text-dark mb-3">
                    {{ __('Industries We Serve') }}
                </h2>
                <p class="lead text-muted">
                    {{ __('Our equipment powers projects across multiple industries worldwide') }}
                </p>
            </div>

            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px;">
                            <svg class="text-muted" width="40" height="40" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M12 2L2 7v10c0 5.55 3.84 9.71 9 11 5.16-1.29 9-5.45 9-11V7l-10-5z" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold">{{ __('Construction') }}</h5>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px;">
                            <svg class="text-muted" width="40" height="40" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold">{{ __('Mining') }}</h5>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px;">
                            <svg class="text-muted" width="40" height="40" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M9 11H7l2.8-7h4.4L17 11h-2l-1-2.5h-4L9 11zm8 2c1.1 0 2 .9 2 2v6c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2v-6c0-1.1.9-2 2-2h10z" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold">{{ __('Infrastructure') }}</h5>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="text-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px;">
                            <svg class="text-muted" width="40" height="40" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <h5 class="fw-semibold">{{ __('Energy') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
