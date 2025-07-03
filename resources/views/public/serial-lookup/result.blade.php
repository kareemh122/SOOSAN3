@extends('layouts.public')

@section('title', 'Serial Lookup Result - Soosan Cebotics')
@section('description', 'Equipment information and warranty status for serial number ' . $soldProduct->serial_number)

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('serial-lookup.index') }}"
                    class="d-inline-flex align-items-center text-primary text-decoration-none fw-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                    {{ __('Back to Serial Lookup') }}
                </a>
            </div>

            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold mb-3">
                    {{ __('Equipment Information') }}
                </h1>
                <p class="lead">
                    {{ __('Serial Number:') }} <span
                        class="font-monospace fw-semibold">{{ $soldProduct->serial_number }}</span>
                </p>
            </div>

            <!-- Warranty Status Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 fw-semibold mb-0">{{ __('Warranty Status') }}</h2>
                        <span
                            class="badge {{ $warrantyStatus['is_valid'] ? 'bg-success text-white' : 'bg-danger text-white' }} d-inline-flex align-items-center">
                            @if ($warrantyStatus['status'] === 'active')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                                {{ __('Active') }}
                            @elseif($warrantyStatus['status'] === 'expired')
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle-fill me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                </svg>
                                {{ __('Expired') }}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-question-circle-fill me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                </svg>
                                {{ __('Unknown') }}
                            @endif
                        </span>
                    </div>

                    <p class="fs-5 mb-3">{{ $warrantyStatus['message'] }}</p>

                    @if (isset($warrantyStatus['end_date']))
                        <p class="text-secondary small">
                            {{ __('Warranty End Date:') }} <span
                                class="fw-semibold">{{ $warrantyStatus['end_date'] }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Equipment Details -->
            <div class="row g-4 mb-4">
                <!-- Product Information -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4 fw-semibold mb-4">{{ __('Product Information') }}</h2>

                            @if ($soldProduct->product->getFirstMediaUrl('images'))
                                <img src="{{ $soldProduct->product->getFirstMediaUrl('images') }}"
                                    alt="{{ $soldProduct->product->name }}" class="img-fluid rounded mb-3"
                                    style="height: 200px; object-fit: cover; width: 100%;">
                            @endif

                            <div class="mb-3">
                                <small class="text-muted d-block">{{ __('Product Name') }}</small>
                                <h5 class="fw-semibold mb-0">{{ $soldProduct->product->name }}</h5>
                            </div>

                            @if ($soldProduct->product->model_number)
                                <div class="mb-3">
                                    <small class="text-muted d-block">{{ __('Model Number') }}</small>
                                    <div>{{ $soldProduct->product->model_number }}</div>
                                </div>
                            @endif

                            @if ($soldProduct->product->category)
                                <div class="mb-3">
                                    <small class="text-muted d-block">{{ __('Category') }}</small>
                                    <div>{{ $soldProduct->product->category->name }}</div>
                                </div>
                            @endif

                            <div class="mb-4">
                                <small class="text-muted d-block">{{ __('Description') }}</small>
                                <div>{{ Str::limit($soldProduct->product->description, 200) }}</div>
                            </div>

                            <a href="{{ route('products.show', $soldProduct->product) }}" class="btn btn-primary">
                                {{ __('View Product Details') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Purchase Information -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h2 class="h4 fw-semibold mb-4">{{ __('Purchase Information') }}</h2>

                            <div class="mb-3">
                                <small class="text-muted d-block">{{ __('Sale Date') }}</small>
                                <div>{{ $soldProduct->sale_date->format('M d, Y') }}</div>
                            </div>

                            @if ($soldProduct->purchase_price)
                                <div class="mb-3">
                                    <small class="text-muted d-block">{{ __('Purchase Price') }}</small>
                                    <div>${{ number_format($soldProduct->purchase_price, 2) }}</div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <small class="text-muted d-block">{{ __('Warranty Start Date') }}</small>
                                <div>{{ $soldProduct->warranty_start_date->format('M d, Y') }}</div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">{{ __('Warranty End Date') }}</small>
                                <div>{{ $soldProduct->warranty_end_date->format('M d, Y') }}</div>
                            </div>

                            @if ($soldProduct->notes)
                                <div class="mb-3">
                                    <small class="text-muted d-block">{{ __('Notes') }}</small>
                                    <div>{{ $soldProduct->notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            @if ($soldProduct->owner)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="h4 fw-semibold mb-4">{{ __('Owner Information') }}</h2>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block">{{ __('Owner Name') }}</small>
                                <div>{{ $soldProduct->owner->name }}</div>
                            </div>

                            @if ($soldProduct->owner->company)
                                <div class="col-md-6">
                                    <small class="text-muted d-block">{{ __('Company') }}</small>
                                    <div>{{ $soldProduct->owner->company }}</div>
                                </div>
                            @endif

                            @if ($soldProduct->owner->email)
                                <div class="col-md-6">
                                    <small class="text-muted d-block">{{ __('Email') }}</small>
                                    <div>{{ $soldProduct->owner->email }}</div>
                                </div>
                            @endif

                            @if ($soldProduct->owner->phone)
                                <div class="col-md-6">
                                    <small class="text-muted d-block">{{ __('Phone') }}</small>
                                    <div>{{ $soldProduct->owner->phone }}</div>
                                </div>
                            @endif

                            @if ($soldProduct->owner->address)
                                <div class="col-12">
                                    <small class="text-muted d-block">{{ __('Address') }}</small>
                                    <div>{{ $soldProduct->owner->address }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Support Actions -->
            <div class="card bg-primary bg-opacity-10 mb-4">
                <div class="card-body">
                    <h2 class="h5 fw-semibold text-primary mb-3">{{ __('Need Support?') }}</h2>
                    <p class="text-primary mb-4">
                        {{ __('Our support team is ready to help with maintenance, parts, or technical questions.') }}</p>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <a href="{{ route('contact') }}"
                            class="btn btn-primary">
                            {{ __('Contact Support') }}
                        </a>
                        <a href="{{ route('support') }}"
                            class="btn btn-outline-primary">
                            {{ __('Service Resources') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Another Lookup -->
            <div class="text-center mt-4">
                <a href="{{ route('serial-lookup.index') }}"
                    class="d-inline-flex align-items-center text-primary text-decoration-none fw-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    {{ __('Look up another serial number') }}
                </a>
            </div>
        </div>
    </div>
@endsection
