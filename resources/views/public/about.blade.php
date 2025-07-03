@extends('layouts.public')

@section('title', 'About Soosan Cebotics - Leading Drilling Equipment Solutions')
@section('description', 'Learn about Soosan Cebotics - a leading provider of drilling equipment and machinery solutions
    for construction, mining, and industrial applications worldwide.')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('About Soosan Cebotics') }}
                </h1>
                <p class="text-xl text-gray-600">
                    {{ __('Leading the drilling industry with innovative solutions and exceptional quality') }}
                </p>
            </div>

            <div class="prose prose-lg max-w-none">
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Our Story') }}</h2>
                    <p class="text-gray-700 mb-4">
                        {{ __('For over two decades, Soosan Cebotics has been at the forefront of drilling equipment innovation. Founded with a vision to provide reliable, efficient, and technologically advanced drilling solutions, we have grown to become a trusted partner for construction, mining, and industrial companies worldwide.') }}
                    </p>
                    <p class="text-gray-700">
                        {{ __('Our commitment to quality, innovation, and customer satisfaction has made us a leader in the drilling equipment industry. We continue to push the boundaries of what\'s possible in drilling technology while maintaining the highest standards of safety and reliability.') }}
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Our Mission') }}</h2>
                    <p class="text-gray-700">
                        {{ __('To provide innovative, reliable, and efficient drilling equipment solutions that enable our customers to achieve their project goals safely and successfully. We are committed to advancing drilling technology while maintaining the highest standards of quality and environmental responsibility.') }}
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Why Choose Us') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('Quality Assurance') }}</h3>
                            <p class="text-gray-700">
                                {{ __('All our equipment undergoes rigorous testing and quality control to ensure peak performance and reliability.') }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('Innovation') }}</h3>
                            <p class="text-gray-700">
                                {{ __('We continuously invest in research and development to bring cutting-edge technology to our customers.') }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('Global Support') }}</h3>
                            <p class="text-gray-700">
                                {{ __('Our worldwide network ensures comprehensive support and service wherever your projects take you.') }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('Environmental Responsibility') }}
                            </h3>
                            <p class="text-gray-700">
                                {{ __('We design our equipment with environmental considerations, promoting sustainable drilling practices.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Contact Us') }}</h2>
                    <p class="text-gray-700 mb-4">
                        {{ __('Ready to learn more about our drilling solutions? Our team is here to help you find the perfect equipment for your project needs.') }}
                    </p>
                    <a href="{{ route('contact') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium inline-block transition-colors">
                        {{ __('Get in Touch') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
