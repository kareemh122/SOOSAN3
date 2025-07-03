@extends('layouts.public')

@section('title', 'About Soosan Cebotics - Leading Drilling Equipment Solutions')
@section('description',
    'Learn about Soosan Cebotics - a leading provider of drilling equipment and machinery solutions
    for construction, mining, and industrial applications worldwide.')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">
                    {{ __('common.about_title') }}
                </h1>
                <p class="fs-4 text-secondary">
                    {{ __('common.about_subtitle') }}
                </p>
            </div>

            <div>
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h2 fw-bold mb-4">{{ __('Our Story') }}</h2>
                        <p class="mb-4">
                            {{ __('For over two decades, Soosan Cebotics has been at the forefront of drilling equipment innovation. Founded with a vision to provide reliable, efficient, and technologically advanced drilling solutions, we have grown to become a trusted partner for construction, mining, and industrial companies worldwide.') }}
                        </p>
                        <p>
                            {{ __('Our commitment to quality, innovation, and customer satisfaction has made us a leader in the drilling equipment industry. We continue to push the boundaries of what\'s possible in drilling technology while maintaining the highest standards of safety and reliability.') }}
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h2 fw-bold mb-4">{{ __('Our Mission') }}</h2>
                        <p>
                            {{ __('To provide innovative, reliable, and efficient drilling equipment solutions that enable our customers to achieve their project goals safely and successfully. We are committed to advancing drilling technology while maintaining the highest standards of quality and environmental responsibility.') }}
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h2 fw-bold mb-4">{{ __('Why Choose Us') }}</h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h3 class="h4 fw-semibold mb-3">{{ __('Quality Assurance') }}</h3>
                                <p>
                                    {{ __('All our equipment undergoes rigorous testing and quality control to ensure peak performance and reliability.') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h4 fw-semibold mb-3">{{ __('Innovation') }}</h3>
                                <p>
                                    {{ __('We continuously invest in research and development to bring cutting-edge technology to our customers.') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h4 fw-semibold mb-3">{{ __('Global Support') }}</h3>
                                <p>
                                    {{ __('Our worldwide network ensures comprehensive support and service wherever your projects take you.') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h4 fw-semibold mb-3">{{ __('Environmental Responsibility') }}</h3>
                                <p>
                                    {{ __('We design our equipment with environmental considerations, promoting sustainable drilling practices.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h2 fw-bold mb-4">{{ __('Contact Us') }}</h2>
                        <p class="mb-4">
                            {{ __('Ready to learn more about our drilling solutions? Our team is here to help you find the perfect equipment for your project needs.') }}
                        </p>
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                            {{ __('Get in Touch') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
