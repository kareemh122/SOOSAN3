@extends('layouts.public')

@section('title', 'Support - Soosan Cebotics')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ __('Support & Service') }}</h1>

            <div class="bg-white rounded-lg shadow-md p-8">
                <p class="text-gray-700 mb-4">
                    {{ __('Our comprehensive support network ensures your equipment operates at peak performance. We provide technical assistance, maintenance services, and genuine parts worldwide.') }}
                </p>

                <h2 class="text-xl font-semibold mb-4">{{ __('Support Services') }}</h2>
                <ul class="list-disc pl-6 text-gray-700 space-y-2">
                    <li>{{ __('24/7 Technical Support Hotline') }}</li>
                    <li>{{ __('On-site Service and Maintenance') }}</li>
                    <li>{{ __('Genuine Parts and Components') }}</li>
                    <li>{{ __('Training and Certification Programs') }}</li>
                    <li>{{ __('Remote Diagnostics and Troubleshooting') }}</li>
                </ul>

                <div class="mt-8">
                    <a href="{{ route('contact') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium inline-block transition-colors">
                        {{ __('Contact Support') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
