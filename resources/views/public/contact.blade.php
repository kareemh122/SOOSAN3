@extends('layouts.public')

@section('title', 'Contact Soosan Cebotics - Get in Touch')
@section('description',
    'Contact Soosan Cebotics for drilling equipment inquiries, technical support, sales information,
    and customer service.')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">
                    {{ __('common.contact') }}
                </h1>
                <p class="fs-5 text-secondary">
                    {{ __('common.contact_subtitle') }}
                </p>
            </div>

            <div class="row g-4 mb-5">
                <!-- Contact Information -->
                <div class="col-lg-6">
                    <h2 class="h3 fw-bold mb-4">{{ __('Get in Touch') }}</h2>

                    <!-- Contact Methods -->
                    <div class="mb-4">
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-geo-alt-fill text-primary" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h3 class="h5 fw-semibold">{{ __('Head Office') }}</h3>
                                <p class="text-secondary">
                                    123 Industrial Avenue<br>
                                    Industrial City, Country 12345
                                </p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-telephone-fill text-primary" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h3 class="h5 fw-semibold">{{ __('Phone') }}</h3>
                                <p class="text-secondary mb-1">+1 (555) 123-4567</p>
                                <p class="small text-muted">{{ __('Monday - Friday, 8:00 AM - 6:00 PM') }}</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-envelope-fill text-primary" viewBox="0 0 16 16">
                                    <path
                                        d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h3 class="h5 fw-semibold">{{ __('Email') }}</h3>
                                <p class="text-secondary mb-1">info@soosancebotics.com</p>
                                <p class="small text-muted">{{ __('We typically respond within 24 hours') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Department Contacts -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="h5 fw-semibold mb-3">{{ __('Department Contacts') }}</h3>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-secondary">{{ __('Sales') }}</span>
                                    <span class="fw-medium">sales@soosancebotics.com</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-secondary">{{ __('Technical Support') }}</span>
                                    <span class="fw-medium">support@soosancebotics.com</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-secondary">{{ __('Parts & Service') }}</span>
                                    <span class="fw-medium">parts@soosancebotics.com</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-secondary">{{ __('Customer Service') }}</span>
                                    <span class="fw-medium">service@soosancebotics.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h3 fw-bold mb-4">{{ __('common.contact_title') }}</h2>

                            @if (session('success'))
                                <div class="alert alert-success mb-4" role="alert">
                                    {{ __('common.contact_success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">
                                            {{ __('First Name') }} <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="first_name" name="first_name" required
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">
                                            {{ __('Last Name') }} <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="last_name" name="last_name" required
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        {{ __('common.email') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="company" class="form-label">
                                        {{ __('Company') }}
                                    </label>
                                    <input type="text" id="company" name="company"
                                        class="form-control @error('company') is-invalid @enderror"
                                        value="{{ old('company') }}">
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        {{ __('common.phone') }}
                                    </label>
                                    <input type="tel" id="phone" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">
                                        {{ __('common.subject') }} <span class="text-danger">*</span>
                                    </label>
                                    <select id="subject" name="subject" required
                                        class="form-select @error('subject') is-invalid @enderror">
                                        <option value="">{{ __('Select a subject') }}</option>
                                        <option value="sales" {{ old('subject') == 'sales' ? 'selected' : '' }}>
                                            {{ __('Sales Inquiry') }}</option>
                                        <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>
                                            {{ __('Technical Support') }}</option>
                                        <option value="parts" {{ old('subject') == 'parts' ? 'selected' : '' }}>
                                            {{ __('Parts & Service') }}</option>
                                        <option value="warranty" {{ old('subject') == 'warranty' ? 'selected' : '' }}>
                                            {{ __('Warranty Claim') }}</option>
                                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>
                                            {{ __('Other') }}</option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">
                                        {{ __('common.message') }} <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="message" name="message" rows="5" required
                                        placeholder="{{ __('Please provide details about your inquiry...') }}"
                                        class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('common.submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
