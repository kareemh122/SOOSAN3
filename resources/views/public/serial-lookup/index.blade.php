@extends('layouts.public')

@section('title', 'Serial Number Lookup - Soosan Cebotics')
@section('description',
    'Check your equipment warranty status, ownership information, and service history by entering
    your serial number.')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Page Header -->
                    <div class="text-center mb-5">
                        <h1 class="display-4 fw-bold mb-3">
                            {{ __('Equipment Serial Lookup') }}
                        </h1>
                        <p class="lead text-muted">
                            {{ __('Enter your equipment serial number to check warranty status, ownership information, and service history.') }}
                        </p>
                    </div>

                    <!-- Lookup Form -->
                    <div class="card shadow-sm p-4 mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('serial-lookup.lookup') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="serial_number" class="form-label">
                                        {{ __('Serial Number') }}
                                    </label>
                                    <input type="text" id="serial_number" name="serial_number"
                                        value="{{ old('serial_number') }}"
                                        placeholder="{{ __('Enter your equipment serial number') }}"
                                        class="form-control form-control-lg" required>
                                    @error('serial_number')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    {{ __('Check Serial Number') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            @if (session('error'))
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-exclamation-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                            </svg>
                            <div>
                                <h5 class="fw-semibold">{{ __('Serial Number Not Found') }}</h5>
                                <div>{{ session('error') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Information Section -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card bg-primary bg-opacity-10 mb-4">
                        <div class="card-body">
                            <h2 class="h4 fw-semibold text-primary mb-3">
                                {{ __('What information will I get?') }}
                            </h2>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex mb-2">
                                    <div class="me-2 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>{{ __('Product details and specifications') }}</div>
                                </li>
                                <li class="d-flex mb-2">
                                    <div class="me-2 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>{{ __('Warranty status and expiration date') }}</div>
                                </li>
                                <li class="d-flex mb-2">
                                    <div class="me-2 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>{{ __('Purchase date and price information') }}</div>
                                </li>
                                <li class="d-flex">
                                    <div class="me-2 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>{{ __('Owner contact information (if available)') }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->

        </div>
    </div>
@endsection
