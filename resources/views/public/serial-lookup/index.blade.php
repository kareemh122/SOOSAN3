@extends('layouts.public')

@section('title', 'Serial Number Lookup - Soosan Cebotics')
@section('description', 'Check your equipment warranty status, ownership information, and service history by entering
    your serial number.')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('Equipment Serial Lookup') }}
                </h1>
                <p class="text-xl text-gray-600">
                    {{ __('Enter your equipment serial number to check warranty status, ownership information, and service history.') }}
                </p>
            </div>

            <!-- Lookup Form -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <form method="POST" action="{{ route('serial-lookup.lookup') }}">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="serial_number" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Serial Number') }}
                            </label>
                            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}"
                                placeholder="{{ __('Enter your equipment serial number') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                                required>
                            @error('serial_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-lg">
                            {{ __('Check Serial Number') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Error Message -->
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-8">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">{{ __('Serial Number Not Found') }}</h3>
                            <p class="mt-1 text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Information Section -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold text-blue-900 mb-3">
                    {{ __('What information will I get?') }}
                </h2>
                <ul class="space-y-2 text-blue-800">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Product details and specifications') }}
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Warranty status and expiration date') }}
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Purchase date and price information') }}
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Owner contact information (if available)') }}
                    </li>
                </ul>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    {{ __('Frequently Asked Questions') }}
                </h2>

                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">{{ __('Where can I find my serial number?') }}</h3>
                        <p class="text-gray-600">
                            {{ __('The serial number is typically located on a metal plate or sticker on your equipment. Check the main body, engine compartment, or operator manual for the exact location.') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">{{ __('What if my serial number is not found?') }}</h3>
                        <p class="text-gray-600">
                            {{ __('If your serial number is not in our database, it may be an older unit or purchased through a different distributor. Please contact our support team for assistance.') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">{{ __('Is my information secure?') }}</h3>
                        <p class="text-gray-600">
                            {{ __('Yes, we take privacy seriously. Your serial number lookup is secure and no personal information is stored or shared.') }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        {{ __('Need help?') }}
                        <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            {{ __('Contact our support team') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
