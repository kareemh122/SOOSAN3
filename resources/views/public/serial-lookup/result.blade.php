@extends('layouts.public')

@section('title', 'Serial Lookup Result - Soosan Cebotics')
@section('description', 'Equipment information and warranty status for serial number ' . $soldProduct->serial_number)

@section('content')
    <div class="bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('serial-lookup.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    {{ __('Back to Serial Lookup') }}
                </a>
            </div>

            <!-- Page Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('Equipment Information') }}
                </h1>
                <p class="text-lg text-gray-600">
                    {{ __('Serial Number:') }} <span
                        class="font-mono font-semibold text-gray-900">{{ $soldProduct->serial_number }}</span>
                </p>
            </div>

            <!-- Warranty Status Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('Warranty Status') }}</h2>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $warrantyStatus['is_valid'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        @if ($warrantyStatus['status'] === 'active')
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Active') }}
                        @elseif($warrantyStatus['status'] === 'expired')
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Expired') }}
                        @else
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Unknown') }}
                        @endif
                    </span>
                </div>

                <p class="text-lg text-gray-700 mb-4">{{ $warrantyStatus['message'] }}</p>

                @if (isset($warrantyStatus['end_date']))
                    <p class="text-sm text-gray-600">
                        {{ __('Warranty End Date:') }} <span
                            class="font-semibold">{{ $warrantyStatus['end_date'] }}</span>
                    </p>
                @endif
            </div>

            <!-- Equipment Details -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Product Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Product Information') }}</h2>

                    @if ($soldProduct->product->getFirstMediaUrl('images'))
                        <img src="{{ $soldProduct->product->getFirstMediaUrl('images') }}"
                            alt="{{ $soldProduct->product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @endif

                    <div class="space-y-3">
                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ __('Product Name') }}</span>
                            <p class="text-lg font-semibold text-gray-900">{{ $soldProduct->product->name }}</p>
                        </div>

                        @if ($soldProduct->product->model_number)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Model Number') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->product->model_number }}</p>
                            </div>
                        @endif

                        @if ($soldProduct->product->category)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Category') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->product->category->name }}</p>
                            </div>
                        @endif

                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ __('Description') }}</span>
                            <p class="text-gray-900">{{ Str::limit($soldProduct->product->description, 200) }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('products.show', $soldProduct->product) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-block transition-colors">
                            {{ __('View Product Details') }}
                        </a>
                    </div>
                </div>

                <!-- Purchase Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Purchase Information') }}</h2>

                    <div class="space-y-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ __('Sale Date') }}</span>
                            <p class="text-gray-900">{{ $soldProduct->sale_date->format('M d, Y') }}</p>
                        </div>

                        @if ($soldProduct->purchase_price)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Purchase Price') }}</span>
                                <p class="text-gray-900">${{ number_format($soldProduct->purchase_price, 2) }}</p>
                            </div>
                        @endif

                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ __('Warranty Start Date') }}</span>
                            <p class="text-gray-900">{{ $soldProduct->warranty_start_date->format('M d, Y') }}</p>
                        </div>

                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ __('Warranty End Date') }}</span>
                            <p class="text-gray-900">{{ $soldProduct->warranty_end_date->format('M d, Y') }}</p>
                        </div>

                        @if ($soldProduct->notes)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Notes') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            @if ($soldProduct->owner)
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Owner Information') }}</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="text-sm font-medium text-gray-500">{{ __('Owner Name') }}</span>
                            <p class="text-gray-900">{{ $soldProduct->owner->name }}</p>
                        </div>

                        @if ($soldProduct->owner->company)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Company') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->owner->company }}</p>
                            </div>
                        @endif

                        @if ($soldProduct->owner->email)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Email') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->owner->email }}</p>
                            </div>
                        @endif

                        @if ($soldProduct->owner->phone)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Phone') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->owner->phone }}</p>
                            </div>
                        @endif

                        @if ($soldProduct->owner->address)
                            <div class="md:col-span-2">
                                <span class="text-sm font-medium text-gray-500">{{ __('Address') }}</span>
                                <p class="text-gray-900">{{ $soldProduct->owner->address }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Support Actions -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-blue-900 mb-3">{{ __('Need Support?') }}</h2>
                <p class="text-blue-800 mb-4">
                    {{ __('Our support team is ready to help with maintenance, parts, or technical questions.') }}</p>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('contact') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-block text-center transition-colors">
                        {{ __('Contact Support') }}
                    </a>
                    <a href="{{ route('support') }}"
                        class="bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 px-6 py-2 rounded-lg font-medium inline-block text-center transition-colors">
                        {{ __('Service Resources') }}
                    </a>
                </div>
            </div>

            <!-- Another Lookup -->
            <div class="text-center mt-8">
                <a href="{{ route('serial-lookup.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    {{ __('Look up another serial number') }}
                </a>
            </div>
        </div>
    </div>
@endsection
