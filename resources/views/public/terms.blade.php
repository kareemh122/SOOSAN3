@extends('layouts.public')

@section('title', 'Terms of Service - Soosan Cebotics')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ __('Terms of Service') }}</h1>

            <div class="bg-white rounded-lg shadow-md p-8 prose max-w-none">
                <p class="text-sm text-gray-500 mb-6">{{ __('Last updated: :date', ['date' => date('F j, Y')]) }}</p>

                <h2>{{ __('Acceptance of Terms') }}</h2>
                <p>{{ __('By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement.') }}
                </p>

                <h2>{{ __('Use License') }}</h2>
                <p>{{ __('Permission is granted to temporarily download one copy of the materials on this website for personal, non-commercial transitory viewing only.') }}
                </p>

                <h2>{{ __('Disclaimer') }}</h2>
                <p>{{ __('The materials on this website are provided on an \'as is\' basis. Soosan Cebotics makes no warranties, expressed or implied.') }}
                </p>

                <h2>{{ __('Contact Information') }}</h2>
                <p>{{ __('If you have any questions about these Terms of Service, please contact us at legal@soosancebotics.com.') }}
                </p>
            </div>
        </div>
    </div>
@endsection
