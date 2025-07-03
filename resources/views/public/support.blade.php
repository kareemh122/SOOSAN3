@extends('layouts.public')

@section('title', 'Support - Soosan Cebotics')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-5">{{ __('Support & Service') }}</h1>

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <p class="mb-4">
                        {{ __('Our comprehensive support network ensures your equipment operates at peak performance. We provide technical assistance, maintenance services, and genuine parts worldwide.') }}
                    </p>

                    <h2 class="h3 fw-bold mb-3">{{ __('Support Services') }}</h2>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item bg-transparent">{{ __('24/7 Technical Support Hotline') }}</li>
                        <li class="list-group-item bg-transparent">{{ __('On-site Service and Maintenance') }}</li>
                        <li class="list-group-item bg-transparent">{{ __('Genuine Parts and Components') }}</li>
                        <li class="list-group-item bg-transparent">{{ __('Training and Certification Programs') }}</li>
                        <li class="list-group-item bg-transparent">{{ __('Remote Diagnostics and Troubleshooting') }}</li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                            {{ __('Contact Support') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
