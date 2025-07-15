@extends('layouts.admin')

@section('title', __('product_categories.add_category'))
@section('page-title', __('product_categories.categories'))
@section('page-subtitle', __('product_categories.add_category'))

@push('styles')
<style>
    .modern-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        margin: -1rem -1rem 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .modern-page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,197.3C960,213,1056,203,1152,170.7C1248,139,1344,85,1392,58.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        z-index: 0;
    }
    .modern-page-header .container-fluid {
        position: relative;
        z-index: 1;
    }
    
    .modern-page-header h1 {
        font-weight: 700;
        font-size: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .modern-page-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .modern-card {
        background: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        border: 1px solid #E9ECEF;
        margin-bottom: 2rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }
    
    .modern-card-header {
        background: linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 100%);
        border-bottom: 1px solid #E9ECEF;
        padding: 1.5rem;
    }
    
    .modern-card-title {
        font-weight: 700;
        font-size: clamp(1.1rem, 3vw, 1.3rem);
        color: #2C3E50;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .modern-form-group {
        margin-bottom: 1.75rem;
    }
    
    .modern-label {
        font-weight: 600;
        color: #2C3E50;
        margin-bottom: 0.75rem;
        display: block;
        font-size: 0.95rem;
    }
    
    .form-control, .form-select {
        border: 2px solid #E9ECEF;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #FFFFFF;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #0077C8;
        box-shadow: 0 0 0 0.2rem rgba(0, 119, 200, 0.15);
        background: #FFFFFF;
    }
    
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #DC3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }
    
    .invalid-feedback {
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    
    .modern-btn {
        background: var(--primary-gradient);
        border: none;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .modern-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .modern-btn:hover::before {
        left: 100%;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: #ffffff;
        text-decoration: none;
    }

    .modern-btn:active {
        transform: translateY(-1px);
    }

    .modern-btn-secondary {
        background: var(--secondary-gradient);
    }

    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px rgba(113, 128, 150, 0.4);
    }
    .image-preview {
        border: 2px dashed #E9ECEF;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        background: #F8F9FA;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .image-preview:hover {
        border-color: #0077C8;
        background: #F0F8FF;
    }
    
    .image-preview img {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        max-width: 100%;
        max-height: 150px;
        object-fit: cover;
    }
    
    .image-preview img:hover {
        transform: scale(1.05);
    }
    
    .preview-placeholder {
        color: #6C757D;
        font-size: 0.9rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }
    
    .preview-placeholder i {
        font-size: 2rem;
        opacity: 0.5;
    }
    
    .breadcrumb-nav {
        background: transparent;
        padding: 0;
        margin-bottom: 1rem;
    }
    
    .breadcrumb-nav .breadcrumb-item a {
        color: #F0F0F0;
        text-decoration: none;
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }
    
    .breadcrumb-nav .breadcrumb-item a:hover {
        opacity: 1;
    }
    
    .breadcrumb-nav .breadcrumb-item.active {
        color: #F0F0F0;
        font-weight: 500;
    }

    .form-actions {
        justify-content: flex-end;
    }
    .form-actions a {
        padding-top: 8px;
    }
    
    .form-help-text {
        font-size: 0.8rem;
        color: #6C757D;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .success-animation {
        animation: successPulse 0.6s ease-out;
    }
    
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .modern-page-header {
            padding: 1.5rem 0;
            margin: -1rem -1rem 1.5rem;
        }
        
        .modern-page-header .d-flex {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch !important;
        }
        
        .modern-card-header {
            padding: 1rem;
        }
        
        .modern-btn {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            justify-content: center;
        }
        
        .modern-form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-control, .form-select {
            padding: 0.6rem 0.9rem;
            font-size: 0.9rem;
        }
        
        .image-preview {
            padding: 0.75rem;
            min-height: 150px;
        }
        
        .image-preview img {
            max-height: 120px;
        }
        
        .row .col-md-8, .row .col-md-4 {
            margin-bottom: 1rem;
        }
        
        .form-actions {
            text-align: center !important;
        }
        
        .form-actions .btn {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .modern-page-header h1 {
            font-size: 1.3rem;
            line-height: 1.3;
        }
        
        .modern-card {
            margin-bottom: 1.5rem;
        }
        
        .modern-card-header {
            padding: 0.75rem;
        }
        
        .card-body {
            padding: 1rem !important;
        }
        
        .modern-btn {
            width: 100%;
            padding: 0.75rem;
        }
        
        .image-preview {
            min-height: 120px;
        }
        
        .image-preview img {
            max-height: 100px;
        }
        
        .preview-placeholder i {
            font-size: 1.5rem;
        }
    }
    
    /* Tablet Responsiveness */
    @media (min-width: 768px) and (max-width: 1024px) {
        .modern-page-header h1 {
            font-size: 1.6rem;
        }
        
        .form-control, .form-select {
            padding: 0.7rem 0.95rem;
        }
        
        .image-preview {
            min-height: 180px;
        }
        
        .image-preview img {
            max-height: 140px;
        }
    }
    
    /* Animation */
    .modern-card {
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Loading states */
    .form-control:disabled, .form-select:disabled {
        background-color: #F8F9FA;
        opacity: 0.7;
    }
    
    .btn-loading {
        position: relative;
        pointer-events: none;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')
    <div class="modern-page-header">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div class="flex-grow-1">
                    <h1>
                        <i class="fas fa-plus me-2"></i>
                        <span class="d-none d-md-inline">{{ __('product_categories.add_category') }}</span>
                        <span class="d-md-none">{{ __('product_categories.add_category') }}</span>
                    </h1>
                </div>
                <a href="{{ route('admin.product-categories.index') }}" class="modern-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span class="d-none d-sm-inline">{{ __('product_categories.categories') }}</span>
                    <span class="d-sm-none">{{ __('product_categories.back') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="modern-card">
        <div class="modern-card-header">
            <span class="modern-card-title">
                <i class="fas fa-plus"></i>
                {{ __('product_categories.add_category') }}
            </span>
        </div>
        <div class="card-body p-3 p-md-4">
            <form action="{{ route('admin.product-categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="modern-form-group">
                            <label for="name" class="modern-label">
                                <i class="fas fa-tag me-1"></i>
                                {{ __('product_categories.name') }} *
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required
                                   placeholder="{{ __('product_categories.enter_category_name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modern-form-group">
                            <label for="slug" class="modern-label">
                                <i class="fas fa-link me-1"></i>
                                {{ __('product_categories.slug') }}
                            </label>
                            <input type="text" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" 
                                   name="slug" 
                                   value="{{ old('slug') }}"
                                   placeholder="{{ __('product_categories.enter_category_slug') }}">
                            <div class="form-help-text">
                                <i class="fas fa-info-circle"></i>
                                {{ __('product_categories.leave_empty_to_auto_generate_from_name') }}
                            </div>
                            @error('slug')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modern-form-group">
                            <label for="description" class="modern-label">
                                <i class="fas fa-align-left me-1"></i>
                                {{ __('product_categories.description') }}
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="{{ __('product_categories.enter_category_description') }}">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="modern-form-group">
                            <label for="parent_id" class="modern-label">
                                <i class="fas fa-sitemap me-1"></i>
                                {{ __('product_categories.parent_category') }}
                            </label>
                            <select class="form-select @error('parent_id') is-invalid @enderror" 
                                    id="parent_id" 
                                    name="parent_id">
                                <option value="">{{ __('product_categories.none') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modern-form-group">
                            <label for="icon" class="modern-label">
                                <i class="fas fa-image me-1"></i>
                                {{ __('product_categories.icon') }}
                            </label>
                            
                            <div class="image-preview mb-3" id="preview-container">
                                <div class="preview-placeholder" id="placeholder">
                                    <i class="fas fa-image"></i>
                                    <span>{{ __('product_categories.no_image_selected') }}</span>
                                    <small class="text-muted">{{ __('product_categories.click_below_to_upload') }}</small>
                                </div>
                                <img id="icon-preview" 
                                     style="display: none; max-width: 150px; max-height: 150px; object-fit: cover;">
                            </div>
                            
                            <input type="file" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" 
                                   name="icon" 
                                   accept="image/*">
                            <div class="form-help-text">
                                <i class="fas fa-info-circle"></i>
                                {{ __('product_categories.supported_formats') }}
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-3 border-top form-actions">
                    <a href="{{ route('admin.product-categories.index') }}" 
                       class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-1"></i>
                        {{ __('product_categories.cancel') }}
                    </a>
                    <button type="submit" class="modern-btn" id="submitBtn">
                        <i class="fas fa-plus me-1"></i>
                        <span class="d-none d-sm-inline">{{ __('product_categories.create_category') }}</span>
                        <span class="d-sm-none">{{ __('product_categories.create_category') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        const placeholder = document.getElementById('placeholder');
        const form = document.getElementById('categoryForm');
        const submitBtn = document.getElementById('submitBtn');

        let slugManuallyEdited = slugInput.value.trim() !== '';

        // Auto-generate slug from name
        nameInput.addEventListener('input', function() {
            if (!slugManuallyEdited) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
                slugInput.value = slug;
            }
        });

        // Track manual slug editing
        slugInput.addEventListener('input', function() {
            slugManuallyEdited = true;
        });

        // Image preview functionality
        iconInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('{{ __("File size must be less than 2MB") }}');
                    this.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('{{ __("Please select a valid image file") }}');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    iconPreview.src = e.target.result;
                    iconPreview.style.display = 'block';
                    placeholder.style.display = 'none';
                    
                    // Add success animation
                    iconPreview.classList.add('success-animation');
                    setTimeout(() => {
                        iconPreview.classList.remove('success-animation');
                    }, 600);
                }
                reader.readAsDataURL(file);
            } else {
                // Reset preview
                iconPreview.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        });

        // Form validation
        form.addEventListener('submit', function(e) {
            const nameValue = nameInput.value.trim();
            if (!nameValue) {
                e.preventDefault();
                nameInput.focus();
                alert('{{ __("Category name is required") }}');
                return false;
            }

            // Add loading state to submit button
            submitBtn.disabled = true;
            submitBtn.classList.add('btn-loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> {{ __("Creating...") }}';
        });

        // Add smooth focus transitions
        const inputs = document.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add character counter for description
        const descriptionInput = document.getElementById('description');
        if (descriptionInput) {
            const maxLength = 500;
            const counter = document.createElement('div');
            counter.className = 'form-help-text mt-1';
            counter.innerHTML = `<i class="fas fa-keyboard me-1"></i><span id="char-count">0</span>/${maxLength} characters`;
            descriptionInput.parentElement.appendChild(counter);

            const charCount = document.getElementById('char-count');
            descriptionInput.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;
                
                if (length > maxLength * 0.8) {
                    counter.style.color = '#FFC107';
                } else if (length > maxLength * 0.9) {
                    counter.style.color = '#DC3545';
                } else {
                    counter.style.color = '#6C757D';
                }
            });
        }
    });
</script>
@endpush