@extends('layouts.public')

@section('title', 'Contact Soosan Cebotics - Get in Touch')
@section('description', 'Contact Soosan Cebotics for drilling equipment inquiries, technical support, sales information,
    and customer service.')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('Contact Us') }}
                </h1>
                <p class="text-xl text-gray-600">
                    {{ __('Get in touch with our team for equipment inquiries, support, or sales information') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Get in Touch') }}</h2>

                    <!-- Contact Methods -->
                    <div class="space-y-6 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('Head Office') }}</h3>
                                <p class="text-gray-600">
                                    123 Industrial Avenue<br>
                                    Industrial City, Country 12345
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('Phone') }}</h3>
                                <p class="text-gray-600">+1 (555) 123-4567</p>
                                <p class="text-sm text-gray-500">{{ __('Monday - Friday, 8:00 AM - 6:00 PM') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('Email') }}</h3>
                                <p class="text-gray-600">info@soosancebotics.com</p>
                                <p class="text-sm text-gray-500">{{ __('We typically respond within 24 hours') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Department Contacts -->
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Department Contacts') }}</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Sales') }}</span>
                                <span class="text-gray-900">sales@soosancebotics.com</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Technical Support') }}</span>
                                <span class="text-gray-900">support@soosancebotics.com</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Parts & Service') }}</span>
                                <span class="text-gray-900">parts@soosancebotics.com</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Customer Service') }}</span>
                                <span class="text-gray-900">service@soosancebotics.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Send us a Message') }}</h2>

                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('First Name') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="first_name" name="first_name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('Last Name') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="last_name" name="last_name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Email Address') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="company" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Company') }}
                                </label>
                                <input type="text" id="company" name="company"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Phone Number') }}
                                </label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Subject') }} <span class="text-red-500">*</span>
                                </label>
                                <select id="subject" name="subject" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">{{ __('Select a subject') }}</option>
                                    <option value="sales">{{ __('Sales Inquiry') }}</option>
                                    <option value="support">{{ __('Technical Support') }}</option>
                                    <option value="parts">{{ __('Parts & Service') }}</option>
                                    <option value="warranty">{{ __('Warranty Claim') }}</option>
                                    <option value="other">{{ __('Other') }}</option>
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Message') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                    placeholder="{{ __('Please provide details about your inquiry...') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="newsletter" name="newsletter"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                                    {{ __('I would like to receive updates about new products and services') }}
                                </label>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                                    {{ __('Send Message') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
