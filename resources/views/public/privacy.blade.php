@extends('layouts.public')

@section('title', 'Privacy Policy - Soosan Cebotics')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-5">{{ __('Privacy Policy') }}</h1>

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <p class="text-muted small mb-5">{{ __('Last updated: :date', ['date' => date('F j, Y')]) }}</p>

                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-3">{{ __('Information We Collect') }}</h2>
                        <p>{{ __('We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.') }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-3">{{ __('How We Use Your Information') }}</h2>
                        <p>{{ __('We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.') }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h2 class="h3 fw-bold mb-3">{{ __('Information Sharing') }}</h2>
                        <p>{{ __('We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.') }}
                        </p>
                    </div>

                    <div>
                        <h2 class="h3 fw-bold mb-3">{{ __('Contact Us') }}</h2>
                        <p>{{ __('If you have any questions about this Privacy Policy, please contact us at privacy@soosancebotics.com.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
