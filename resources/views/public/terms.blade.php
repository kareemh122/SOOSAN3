@extends('layouts.public')

@section('title', 'Terms of Service - Soosan Cebotics')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-5">{{ __('Terms of Service') }}</h1>

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <p class="text-muted small mb-5">{{ __('Last updated: :date', ['date' => date('F j, Y')]) }}</p>

                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-3">{{ __('Acceptance of Terms') }}</h2>
                        <p>{{ __('By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement.') }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-3">{{ __('Use License') }}</h2>
                        <p>{{ __('Permission is granted to temporarily download one copy of the materials on this website for personal, non-commercial transitory viewing only.') }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-3">{{ __('Disclaimer') }}</h2>
                        <p>{{ __('The materials on this website are provided on an \'as is\' basis. Soosan Cebotics makes no warranties, expressed or implied.') }}
                        </p>
                    </div>

                    <div>
                        <h2 class="h3 fw-bold mb-3">{{ __('Contact Information') }}</h2>
                        <p>{{ __('If you have any questions about these Terms of Service, please contact us at legal@soosancebotics.com.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
