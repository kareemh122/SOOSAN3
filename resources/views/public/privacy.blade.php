@extends('layouts.public')

@section('title', 'Privacy Policy - Soosan Cebotics')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ __('Privacy Policy') }}</h1>

            <div class="bg-white rounded-lg shadow-md p-8 prose max-w-none">
                <p class="text-sm text-gray-500 mb-6">{{ __('Last updated: :date', ['date' => date('F j, Y')]) }}</p>

                <h2>{{ __('Information We Collect') }}</h2>
                <p>{{ __('We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.') }}
                </p>

                <h2>{{ __('How We Use Your Information') }}</h2>
                <p>{{ __('We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.') }}
                </p>

                <h2>{{ __('Information Sharing') }}</h2>
                <p>{{ __('We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.') }}
                </p>

                <h2>{{ __('Contact Us') }}</h2>
                <p>{{ __('If you have any questions about this Privacy Policy, please contact us at privacy@soosancebotics.com.') }}
                </p>
            </div>
        </div>
    </div>
@endsection
