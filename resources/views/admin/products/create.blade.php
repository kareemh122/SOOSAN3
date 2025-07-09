@extends('layouts.admin')

@section('title', __('products.create_product'))

@section('content')
<style>
/* Reset and prevent inheritance from global styles */
.product-create-container * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.product-create-container {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f8fafc;
    min-height: 100vh;
    padding: 2rem;
    color: #1f2937;
    line-height: 1.6;
}

/* Modern Header */
.product-create-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 0 0 1.5rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.product-create-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.product-create-header-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 2rem;
}

.product-create-title-section h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-create-title-section p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.product-create-back-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 1rem 2rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.product-create-back-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    color: white;
    border-color: rgba(255, 255, 255, 0.5);
}

/* Form Container */
.product-create-form-container {
    max-width: 800px;
    margin: 0 auto;
}

.product-create-form {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

/* Form Sections */
.product-create-section {
    padding: 2rem;
    border-bottom: 1px solid #e5e7eb;
}

.product-create-section:last-child {
    border-bottom: none;
}

.product-create-section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f3f4f6;
}

.product-create-section-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.product-create-section-title h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.product-create-section-title p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Form Fields */
.product-create-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.product-create-form-group {
    display: flex;
    flex-direction: column;
}

.product-create-form-group.full-width {
    grid-column: 1 / -1;
}

.product-create-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.product-create-label .required {
    color: #ef4444;
}

.product-create-input,
.product-create-textarea,
.product-create-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background: white;
    color: #1f2937;
}

.product-create-input:focus,
.product-create-textarea:focus,
.product-create-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.product-create-textarea {
    min-height: 120px;
    resize: vertical;
}

.product-create-error {
    color: #ef4444;
    font-size: 0.75rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* File Upload */
.product-create-file-upload {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.product-create-file-upload:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.product-create-file-upload.dragover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.1);
    transform: scale(1.02);
}

.product-create-file-input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.product-create-file-content {
    pointer-events: none;
}

.product-create-file-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.product-create-file-text h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.product-create-file-text p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Preview Images */
.product-create-preview-container {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
}

.product-create-preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: #f3f4f6;
    aspect-ratio: 1;
}

.product-create-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-create-preview-remove {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    transition: all 0.3s ease;
}

.product-create-preview-remove:hover {
    background: #ef4444;
    transform: scale(1.1);
}

/* Checkbox and Radio */
.product-create-checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1rem;
}

.product-create-checkbox {
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    position: relative;
    cursor: pointer;
}

.product-create-checkbox input {
    opacity: 0;
    position: absolute;
    inset: 0;
    cursor: pointer;
}

.product-create-checkbox input:checked + .product-create-checkmark {
    background: #667eea;
    border-color: #667eea;
}

.product-create-checkbox input:checked + .product-create-checkmark::after {
    opacity: 1;
}

.product-create-checkmark {
    position: absolute;
    inset: 0;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.product-create-checkmark::after {
    content: 'âœ“';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
    opacity: 0;
    transition: all 0.3s ease;
}

.product-create-checkbox-label {
    font-weight: 500;
    color: #374151;
    cursor: pointer;
}

/* Form Actions */
.product-create-actions {
    padding: 2rem;
    background: #f9fafb;
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.product-create-btn {
    padding: 0.875rem 2rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.product-create-btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.product-create-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.product-create-btn-secondary {
    background: white;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.product-create-btn-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    transform: translateY(-1px);
    color: #374151;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-create-container {
        padding: 1rem;
    }
    
    .product-create-header {
        margin: -1rem -1rem 2rem -1rem;
        padding: 2rem 0;
    }
    
    .product-create-header-content {
        flex-direction: column;
        text-align: center;
        padding: 0 1rem;
    }
    
    .product-create-title-section h1 {
        font-size: 2rem;
    }
    
    .product-create-form-grid {
        grid-template-columns: 1fr;
    }
    
    .product-create-actions {
        flex-direction: column;
    }
    
    .product-create-btn {
        width: 100%;
        justify-content: center;
    }
}

/* Loading State */
.product-create-btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.product-create-btn.loading::after {
    content: '';
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Success/Error Messages */
.product-create-alert {
    padding: 1rem 1.5rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.product-create-alert.success {
    background: rgba(16, 185, 129, 0.1);
    color: #065f46;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.product-create-alert.error {
    background: rgba(239, 68, 68, 0.1);
    color: #991b1b;
    border: 1px solid rgba(239, 68, 68, 0.3);
}
</style>

<div class="product-create-container">
    <!-- Page Header -->
    <div class="product-create-header">
        <div class="product-create-header-content">
            <div class="product-create-title-section">
                <h1><i class="fas fa-plus-circle"></i> {{ __('products.create_new_product') }}</h1>
                <p>{{ __('products.add_new_product') }}</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="product-create-back-btn">
                <i class="fas fa-arrow-left"></i>
                {{ __('products.back_to_products') }}
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="product-create-alert success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="product-create-alert error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Form -->
    <div class="product-create-form-container">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="product-create-form" id="productForm">
            @csrf

            <!-- Basic Information Section -->
            <div class="product-create-section">
                <div class="product-create-section-header">
                    <div class="product-create-section-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <h3>{{ __('products.basic_information') }}</h3>
                        <p>{{ __('products.basic_info_desc') }}</p>
                    </div>
                </div>

                <div class="product-create-form-grid">
                    <div class="product-create-form-group">
                        <label for="model_name" class="product-create-label">
                            {{ __('products.model_name') }} <span class="required">{{ __('products.required') }}</span>
                        </label>
                        <input type="text" 
                               id="model_name" 
                               name="model_name" 
                               class="product-create-input @error('model_name') error @enderror" 
                               value="{{ old('model_name') }}" 
                               placeholder="{{ __('products.model_name_placeholder') }}"
                               required>
                        @error('model_name')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="category_id" class="product-create-label">
                            {{ __('products.category') }} <span class="required">{{ __('products.required') }}</span>
                        </label>
                        <select id="category_id" 
                                name="category_id" 
                                class="product-create-select @error('category_id') error @enderror"
                                required>
                            <option value="">{{ __('products.select_category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="line" class="product-create-label">
                            {{ __('products.line') }}
                        </label>
                        <input type="text" 
                               id="line" 
                               name="line" 
                               class="product-create-input @error('line') error @enderror" 
                               value="{{ old('line') }}" 
                               placeholder="{{ __('products.line_placeholder') }}">
                        @error('line')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="type" class="product-create-label">
                            {{ __('products.type') }}
                        </label>
                        <input type="text" 
                               id="type" 
                               name="type" 
                               class="product-create-input @error('type') error @enderror" 
                               value="{{ old('type') }}" 
                               placeholder="{{ __('products.type_placeholder') }}">
                        @error('type')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Specifications Section -->
            <div class="product-create-section">
                <div class="product-create-section-header">
                    <div class="product-create-section-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>
                        <h3>{{ __('products.technical_specifications') }}</h3>
                        <p>{{ __('products.technical_specifications_desc') }}</p>
                    </div>
                </div>

                <div class="product-create-form-grid">
                    <div class="product-create-form-group">
                        <label for="body_weight" class="product-create-label">
                            {{ __('products.body_weight') }}
                        </label>
                        <input type="text" 
                               id="body_weight" 
                               name="body_weight" 
                               class="product-create-input @error('body_weight') error @enderror" 
                               value="{{ old('body_weight') }}" 
                               placeholder="e.g., 500 kg">
                        @error('body_weight')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="operating_weight" class="product-create-label">
                            {{ __('products.operating_weight') }}
                        </label>
                        <input type="text" 
                               id="operating_weight" 
                               name="operating_weight" 
                               class="product-create-input @error('operating_weight') error @enderror" 
                               value="{{ old('operating_weight') }}" 
                               placeholder="e.g., 600 kg">
                        @error('operating_weight')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="overall_length" class="product-create-label">
                            Overall Length
                        </label>
                        <input type="text" 
                               id="overall_length" 
                               name="overall_length" 
                               class="product-create-input @error('overall_length') error @enderror" 
                               value="{{ old('overall_length') }}" 
                               placeholder="e.g., 2500 mm">
                        @error('overall_length')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="overall_width" class="product-create-label">
                            {{ __('products.overall_width') }}
                        </label>
                        <input type="text" 
                               id="overall_width" 
                               name="overall_width" 
                               class="product-create-input @error('overall_width') error @enderror" 
                               value="{{ old('overall_width') }}" 
                               placeholder="{{ __('products.overall_width_placeholder') }}">
                        @error('overall_width')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="overall_height" class="product-create-label">
                            {{ __('products.overall_height') }}
                        </label>
                        <input type="text" 
                               id="overall_height" 
                               name="overall_height" 
                               class="product-create-input @error('overall_height') error @enderror" 
                               value="{{ old('overall_height') }}" 
                               placeholder="{{ __('products.overall_height_placeholder') }}">
                        @error('overall_height')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="required_oil_flow" class="product-create-label">
                            {{ __('products.required_oil_flow') }}
                        </label>
                        <input type="text" 
                               id="required_oil_flow" 
                               name="required_oil_flow" 
                               class="product-create-input @error('required_oil_flow') error @enderror" 
                               value="{{ old('required_oil_flow') }}" 
                               placeholder="{{ __('products.required_oil_flow_placeholder') }}">
                        @error('required_oil_flow')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="operating_pressure" class="product-create-label">
                            {{ __('products.operating_pressure') }}
                        </label>
                        <input type="text" 
                               id="operating_pressure" 
                               name="operating_pressure" 
                               class="product-create-input @error('operating_pressure') error @enderror" 
                               value="{{ old('operating_pressure') }}" 
                               placeholder="{{ __('products.operating_pressure_placeholder') }}">
                        @error('operating_pressure')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="impact_rate" class="product-create-label">
                            {{ __('products.impact_rate') }}
                        </label>
                        <input type="text" 
                               id="impact_rate" 
                               name="impact_rate" 
                               class="product-create-input @error('impact_rate') error @enderror" 
                               value="{{ old('impact_rate') }}" 
                               placeholder="{{ __('products.impact_rate_placeholder') }}">
                        @error('impact_rate')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="impact_rate_soft_rock" class="product-create-label">
                            {{ __('products.impact_rate_soft_rock') }}
                        </label>
                        <input type="text" 
                               id="impact_rate_soft_rock" 
                               name="impact_rate_soft_rock" 
                               class="product-create-input @error('impact_rate_soft_rock') error @enderror" 
                               value="{{ old('impact_rate_soft_rock') }}" 
                               placeholder="e.g., 800-1200 BPM">
                        @error('impact_rate_soft_rock')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="hose_diameter" class="product-create-label">
                            Hose Diameter
                        </label>
                        <input type="text" 
                               id="hose_diameter" 
                               name="hose_diameter" 
                               class="product-create-input @error('hose_diameter') error @enderror" 
                               value="{{ old('hose_diameter') }}" 
                               placeholder="e.g., 19 mm">
                        @error('hose_diameter')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="rod_diameter" class="product-create-label">
                            Rod Diameter
                        </label>
                        <input type="text" 
                               id="rod_diameter" 
                               name="rod_diameter" 
                               class="product-create-input @error('rod_diameter') error @enderror" 
                               value="{{ old('rod_diameter') }}" 
                               placeholder="e.g., 120 mm">
                        @error('rod_diameter')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-create-form-group">
                        <label for="applicable_carrier" class="product-create-label">
                            Applicable Carrier
                        </label>
                        <input type="text" 
                               id="applicable_carrier" 
                               name="applicable_carrier" 
                               class="product-create-input @error('applicable_carrier') error @enderror" 
                               value="{{ old('applicable_carrier') }}" 
                               placeholder="e.g., 8-15 ton excavator">
                        @error('applicable_carrier')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="product-create-section">
                <div class="product-create-section-header">
                    <div class="product-create-section-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div>
                        <h3>Product Image</h3>
                        <p>Upload product image</p>
                    </div>
                </div>

                <div class="product-create-form-grid">
                    <div class="product-create-form-group full-width">
                        <label for="product_image" class="product-create-label">
                            Product Image
                        </label>
                        <div class="product-create-file-upload" id="fileUpload">
                            <input type="file" 
                                   id="product_image" 
                                   name="product_image" 
                                   class="product-create-file-input @error('product_image') error @enderror"
                                   accept="image/*">
                            <div class="product-create-file-placeholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click to upload or drag and drop</p>
                                <span>PNG, JPG, GIF up to 10MB</span>
                            </div>
                            <div class="product-create-file-preview" id="imagePreview"></div>
                        </div>
                        @error('product_image')
                            <span class="product-create-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Options Section -->
            <div class="product-create-section">
                <div class="product-create-section-header">
                    <div class="product-create-section-icon">
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div>
                        <h3>{{ __('products.product_options') }}</h3>
                        <p>{{ __('products.product_options_desc') }}</p>
                    </div>
                </div>

                <div class="product-create-form-grid">
                    <div class="product-create-form-group">
                        <div class="product-create-checkbox-group">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   class="product-create-checkbox"
                                   {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label for="is_active" class="product-create-checkbox-label">
                                <span class="product-create-checkbox-custom"></span>
                                <span class="product-create-checkbox-text">{{ __('products.active_product') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="product-create-form-group">
                        <div class="product-create-checkbox-group">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1" 
                                   class="product-create-checkbox"
                                   {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured" class="product-create-checkbox-label">
                                <span class="product-create-checkbox-custom"></span>
                                <span class="product-create-checkbox-text">{{ __('products.featured_product') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="product-create-actions">
                <a href="{{ route('admin.products.index') }}" class="product-create-btn secondary">
                    <i class="fas fa-times"></i>
                    {{ __('products.cancel') }}
                </a>
                <button type="submit" class="product-create-btn primary">
                    <i class="fas fa-save"></i>
                    {{ __('products.create_product') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload functionality
    const fileInput = document.getElementById('product_image');
    const fileUpload = document.getElementById('fileUpload');
    const imagePreview = document.getElementById('imagePreview');

    if (fileInput && fileUpload && imagePreview) {
        // Click upload area to trigger file input
        fileUpload.addEventListener('click', function(e) {
            if (e.target === fileInput) return;
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', function() {
            handleFileSelect(this.files[0]);
        });

        // Handle drag and drop
        fileUpload.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUpload.classList.add('dragover');
        });

        fileUpload.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUpload.classList.remove('dragover');
        });

        fileUpload.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUpload.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileSelect(files[0]);
            }
        });

        function handleFileSelect(file) {
            if (!file) return;

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                return;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB.');
                return;
            }

            // Create preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `
                    <div class="product-create-preview">
                        <img src="${e.target.result}" alt="Preview" class="product-create-preview-image">
                        <button type="button" class="product-create-preview-remove" onclick="removeImage()">×</button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    }

    // Form validation
    const form = document.getElementById('productForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const modelName = document.getElementById('model_name');
            const categoryId = document.getElementById('category_id');

            if (!modelName.value.trim()) {
                e.preventDefault();
                modelName.focus();
                alert('Please enter a model name.');
                return;
            }

            if (!categoryId.value) {
                e.preventDefault();
                categoryId.focus();
                alert('Please select a category.');
                return;
            }

            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
    }

    // Clear error styling on input
    const inputs = document.querySelectorAll('.product-create-input, .product-create-select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.style.borderColor === 'rgb(239, 68, 68)' && this.value.trim()) {
                this.style.borderColor = '#e5e7eb';
            }
        });
    });
});

// Function to remove image preview
function removeImage() {
    document.getElementById('product_image').value = '';
    document.getElementById('imagePreview').innerHTML = '';
}
</script>
@endsection
