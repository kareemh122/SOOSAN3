@extends('layouts.admin')

@section('title', __('products.edit_product'))

@section('content')
<style>
/* Reset and prevent inheritance from global styles */
.product-edit-container * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.product-edit-container {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f8fafc;
    min-height: 100vh;
    padding: 2rem;
    color: #1f2937;
    line-height: 1.6;
}

/* Modern Header */
.product-edit-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 0 0 1.5rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.product-edit-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.product-edit-header-content {
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

.product-edit-title-section h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-edit-title-section p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.product-edit-actions {
    display: flex;
    gap: 1rem;
}

.product-edit-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 1rem 1.5rem;
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

.product-edit-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    color: white;
    border-color: rgba(255, 255, 255, 0.5);
}

.product-edit-btn.primary {
    background: rgba(16, 185, 129, 0.3);
    border-color: rgba(16, 185, 129, 0.5);
}

.product-edit-btn.primary:hover {
    background: rgba(16, 185, 129, 0.4);
}

/* Form Container */
.product-edit-form-container {
    max-width: 800px;
    margin: 0 auto;
}

.product-edit-form {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

/* Form Sections */
.product-edit-section {
    padding: 2rem;
    border-bottom: 1px solid #e5e7eb;
}

.product-edit-section:last-child {
    border-bottom: none;
}

.product-edit-section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f3f4f6;
}

.product-edit-section-icon {
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

.product-edit-section-title h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.product-edit-section-title p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Form Fields */
.product-edit-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.product-edit-form-group {
    display: flex;
    flex-direction: column;
}

.product-edit-form-group.full-width {
    grid-column: 1 / -1;
}

.product-edit-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.product-edit-label .required {
    color: #ef4444;
}

.product-edit-input,
.product-edit-textarea,
.product-edit-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background: white;
    color: #1f2937;
}

.product-edit-input:focus,
.product-edit-textarea:focus,
.product-edit-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.product-edit-textarea {
    min-height: 120px;
    resize: vertical;
}

.product-edit-error {
    color: #ef4444;
    font-size: 0.75rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* File Upload */
.product-edit-file-upload {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.product-edit-file-upload:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.product-edit-file-upload.dragover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.1);
    transform: scale(1.02);
}

.product-edit-file-input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.product-edit-file-content {
    pointer-events: none;
}

.product-edit-file-icon {
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

.product-edit-file-text h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.product-edit-file-text p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Current Images */
.product-edit-current-images {
    margin-bottom: 1.5rem;
}

.product-edit-current-images h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
}

.product-edit-current-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
}

.product-edit-current-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: #f3f4f6;
    aspect-ratio: 1;
    border: 2px solid #e5e7eb;
}

.product-edit-current-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-edit-current-remove {
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

.product-edit-current-remove:hover {
    background: #ef4444;
    transform: scale(1.1);
}

/* Preview Images */
.product-edit-preview-container {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
}

.product-edit-preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: #f3f4f6;
    aspect-ratio: 1;
}

.product-edit-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-edit-preview-remove {
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

.product-edit-preview-remove:hover {
    background: #ef4444;
    transform: scale(1.1);
}

/* Checkbox and Radio */
.product-edit-checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1rem;
}

.product-edit-checkbox {
    width: 20px;
    height: 20px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    position: relative;
    cursor: pointer;
}

.product-edit-checkbox input {
    opacity: 0;
    position: absolute;
    inset: 0;
    cursor: pointer;
}

.product-edit-checkbox input:checked + .product-edit-checkmark {
    background: #667eea;
    border-color: #667eea;
}

.product-edit-checkbox input:checked + .product-edit-checkmark::after {
    opacity: 1;
}

.product-edit-checkmark {
    position: absolute;
    inset: 0;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.product-edit-checkmark::after {
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

.product-edit-checkbox-label {
    font-weight: 500;
    color: #374151;
    cursor: pointer;
}

/* Form Actions */
.product-edit-form-actions {
    padding: 2rem;
    background: #f9fafb;
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.product-edit-form-btn {
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

.product-edit-form-btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.product-edit-form-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.product-edit-form-btn-secondary {
    background: white;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.product-edit-form-btn-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    transform: translateY(-1px);
    color: #374151;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-edit-container {
        padding: 1rem;
    }
    
    .product-edit-header {
        margin: -1rem -1rem 2rem -1rem;
        padding: 2rem 0;
    }
    
    .product-edit-header-content {
        flex-direction: column;
        text-align: center;
        padding: 0 1rem;
    }
    
    .product-edit-title-section h1 {
        font-size: 2rem;
    }
    
    .product-edit-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .product-edit-btn {
        justify-content: center;
    }
    
    .product-edit-form-grid {
        grid-template-columns: 1fr;
    }
    
    .product-edit-form-actions {
        flex-direction: column;
    }
    
    .product-edit-form-btn {
        width: 100%;
        justify-content: center;
    }
}

/* Loading State */
.product-edit-form-btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.product-edit-form-btn.loading::after {
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
.product-edit-alert {
    padding: 1rem 1.5rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.product-edit-alert.success {
    background: rgba(16, 185, 129, 0.1);
    color: #065f46;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.product-edit-alert.error {
    background: rgba(239, 68, 68, 0.1);
    color: #991b1b;
    border: 1px solid rgba(239, 68, 68, 0.3);
}
</style>

<div class="product-edit-container">
    <!-- Page Header -->
    <div class="product-edit-header">
        <div class="product-edit-header-content">
            <div class="product-edit-title-section">
                <h1><i class="fas fa-edit"></i> {{ __('products.edit_product') }}</h1>
                <p>{{ __('products.update_product_info') }}</p>
            </div>
            <div class="product-edit-actions">
                <a href="{{ route('admin.products.show', $product) }}" class="product-edit-btn primary">
                    <i class="fas fa-eye"></i>
                    {{ __('products.view_product') }}
                </a>
                <a href="{{ route('admin.products.index') }}" class="product-edit-btn">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('products.back_to_products') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="product-edit-alert success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="product-edit-alert error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Form -->
    <div class="product-edit-form-container">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="product-edit-form" id="productEditForm">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="product-edit-section">
                <div class="product-edit-section-header">
                    <div class="product-edit-section-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="product-edit-section-title">
                        <h3>{{ __('products.basic_information') }}</h3>
                        <p>{{ __('products.essential_product_details') }}</p>
                    </div>
                </div>

                <div class="product-edit-form-grid">
                    <div class="product-edit-form-group">
                        <label for="model_name" class="product-edit-label">
                            {{ __('products.model_name') }} <span class="required">{{ __('products.required') }}</span>
                        </label>
                        <input type="text" 
                               id="model_name" 
                               name="model_name" 
                               class="product-edit-input @error('model_name') error @enderror" 
                               value="{{ old('model_name', $product->model_name) }}" 
                               placeholder="{{ __('products.enter_model_name') }}"
                               required>
                        @error('model_name')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="category_id" class="product-edit-label">
                            Category <span class="required">*</span>
                        </label>
                        <select id="category_id" 
                                name="category_id" 
                                class="product-edit-select @error('category_id') error @enderror"
                                required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="line" class="product-edit-label">
                            {{ __('products.line') }}
                        </label>
                        <input type="text" 
                               id="line" 
                               name="line" 
                               class="product-edit-input @error('line') error @enderror" 
                               value="{{ old('line', $product->line) }}" 
                               placeholder="{{ __('products.enter_product_line') }}">
                        @error('line')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="type" class="product-edit-label">
                            Type
                        </label>
                        <input type="text" 
                               id="type" 
                               name="type" 
                               class="product-edit-input @error('type') error @enderror" 
                               value="{{ old('type', $product->type) }}" 
                               placeholder="Enter product type">
                        @error('type')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Specifications Section -->
            <div class="product-edit-section">
                <div class="product-edit-section-header">
                    <div class="product-edit-section-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="product-edit-section-title">
                        <h3>Technical Specifications</h3>
                        <p>Detailed technical specifications</p>
                    </div>
                </div>

                <div class="product-edit-form-grid">
                    <div class="product-edit-form-group">
                        <label for="body_weight" class="product-edit-label">
                            Body Weight
                        </label>
                        <input type="text" 
                               id="body_weight" 
                               name="body_weight" 
                               class="product-edit-input @error('body_weight') error @enderror" 
                               value="{{ old('body_weight', $product->body_weight) }}" 
                               placeholder="e.g., 500 kg">
                        @error('body_weight')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="operating_weight" class="product-edit-label">
                            Operating Weight
                        </label>
                        <input type="text" 
                               id="operating_weight" 
                               name="operating_weight" 
                               class="product-edit-input @error('operating_weight') error @enderror" 
                               value="{{ old('operating_weight', $product->operating_weight) }}" 
                               placeholder="e.g., 600 kg">
                        @error('operating_weight')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="overall_length" class="product-edit-label">
                            Overall Length
                        </label>
                        <input type="text" 
                               id="overall_length" 
                               name="overall_length" 
                               class="product-edit-input @error('overall_length') error @enderror" 
                               value="{{ old('overall_length', $product->overall_length) }}" 
                               placeholder="e.g., 2500 mm">
                        @error('overall_length')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="overall_width" class="product-edit-label">
                            Overall Width
                        </label>
                        <input type="text" 
                               id="overall_width" 
                               name="overall_width" 
                               class="product-edit-input @error('overall_width') error @enderror" 
                               value="{{ old('overall_width', $product->overall_width) }}" 
                               placeholder="e.g., 800 mm">
                        @error('overall_width')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="overall_height" class="product-edit-label">
                            Overall Height
                        </label>
                        <input type="text" 
                               id="overall_height" 
                               name="overall_height" 
                               class="product-edit-input @error('overall_height') error @enderror" 
                               value="{{ old('overall_height', $product->overall_height) }}" 
                               placeholder="e.g., 1200 mm">
                        @error('overall_height')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="required_oil_flow" class="product-edit-label">
                            Required Oil Flow
                        </label>
                        <input type="text" 
                               id="required_oil_flow" 
                               name="required_oil_flow" 
                               class="product-edit-input @error('required_oil_flow') error @enderror" 
                               value="{{ old('required_oil_flow', $product->required_oil_flow) }}" 
                               placeholder="e.g., 45-80 L/min">
                        @error('required_oil_flow')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="operating_pressure" class="product-edit-label">
                            Operating Pressure
                        </label>
                        <input type="text" 
                               id="operating_pressure" 
                               name="operating_pressure" 
                               class="product-edit-input @error('operating_pressure') error @enderror" 
                               value="{{ old('operating_pressure', $product->operating_pressure) }}" 
                               placeholder="e.g., 130-160 bar">
                        @error('operating_pressure')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="impact_rate" class="product-edit-label">
                            Impact Rate
                        </label>
                        <input type="text" 
                               id="impact_rate" 
                               name="impact_rate" 
                               class="product-edit-input @error('impact_rate') error @enderror" 
                               value="{{ old('impact_rate', $product->impact_rate) }}" 
                               placeholder="e.g., 450-1000 BPM">
                        @error('impact_rate')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="impact_rate_soft_rock" class="product-edit-label">
                            Impact Rate (Soft Rock)
                        </label>
                        <input type="text" 
                               id="impact_rate_soft_rock" 
                               name="impact_rate_soft_rock" 
                               class="product-edit-input @error('impact_rate_soft_rock') error @enderror" 
                               value="{{ old('impact_rate_soft_rock', $product->impact_rate_soft_rock) }}" 
                               placeholder="e.g., 800-1200 BPM">
                        @error('impact_rate_soft_rock')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="hose_diameter" class="product-edit-label">
                            Hose Diameter
                        </label>
                        <input type="text" 
                               id="hose_diameter" 
                               name="hose_diameter" 
                               class="product-edit-input @error('hose_diameter') error @enderror" 
                               value="{{ old('hose_diameter', $product->hose_diameter) }}" 
                               placeholder="e.g., 19 mm">
                        @error('hose_diameter')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="rod_diameter" class="product-edit-label">
                            Rod Diameter
                        </label>
                        <input type="text" 
                               id="rod_diameter" 
                               name="rod_diameter" 
                               class="product-edit-input @error('rod_diameter') error @enderror" 
                               value="{{ old('rod_diameter', $product->rod_diameter) }}" 
                               placeholder="e.g., 120 mm">
                        @error('rod_diameter')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="applicable_carrier" class="product-edit-label">
                            Applicable Carrier
                        </label>
                        <input type="text" 
                               id="applicable_carrier" 
                               name="applicable_carrier" 
                               class="product-edit-input @error('applicable_carrier') error @enderror" 
                               value="{{ old('applicable_carrier', $product->applicable_carrier) }}" 
                               placeholder="e.g., 8-15 ton excavator">
                        @error('applicable_carrier')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Current Image & Upload Section -->
            <div class="product-edit-section">
                <div class="product-edit-section-header">
                    <div class="product-edit-section-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="product-edit-section-title">
                        <h3>Product Image</h3>
                        <p>Current image and upload new image</p>
                    </div>
                </div>

                <div class="product-edit-form-grid">
                    @if($product->image_url)
                        <div class="product-edit-form-group full-width">
                            <label class="product-edit-label">Current Image</label>
                            <div class="product-edit-current-image">
                                <img src="{{ $product->image_url }}" alt="{{ $product->model_name }}" class="current-product-image">
                            </div>
                        </div>
                    @endif

                    <div class="product-edit-form-group full-width">
                        <label for="product_image" class="product-edit-label">
                            Upload New Image
                        </label>
                        <div class="product-edit-file-upload" id="fileUpload">
                            <input type="file" 
                                   id="product_image" 
                                   name="product_image" 
                                   class="product-edit-file-input @error('product_image') error @enderror"
                                   accept="image/*">
                            <div class="product-edit-file-placeholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click to upload or drag and drop</p>
                                <span>PNG, JPG, GIF up to 10MB</span>
                            </div>
                            <div class="product-edit-file-preview" id="imagePreview"></div>
                        </div>
                        @error('product_image')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Options Section -->
            <div class="product-edit-section">
                <div class="product-edit-section-header">
                    <div class="product-edit-section-icon">
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="product-edit-section-title">
                        <h3>Product Options</h3>
                        <p>Configure product visibility and features</p>
                    </div>
                </div>

                <div class="product-edit-form-grid">
                    <div class="product-edit-form-group">
                        <div class="product-edit-checkbox-group">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   class="product-edit-checkbox"
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="product-edit-checkbox-label">
                                <span class="product-edit-checkbox-custom"></span>
                                <span class="product-edit-checkbox-text">Active Product</span>
                            </label>
                        </div>
                    </div>

                    <div class="product-edit-form-group">
                        <div class="product-edit-checkbox-group">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1" 
                                   class="product-edit-checkbox"
                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label for="is_featured" class="product-edit-checkbox-label">
                                <span class="product-edit-checkbox-custom"></span>
                                <span class="product-edit-checkbox-text">Featured Product</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="product-edit-actions">
                <a href="{{ route('admin.products.show', $product) }}" class="product-edit-btn secondary">
                    <i class="fas fa-eye"></i>
                    {{ __('products.view_product') }}
                </a>
                <a href="{{ route('admin.products.index') }}" class="product-edit-btn secondary">
                    <i class="fas fa-times"></i>
                    {{ __('products.cancel') }}
                </a>
                <button type="submit" class="product-edit-btn primary">
                    <i class="fas fa-save"></i>
                    {{ __('products.update_product') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// File upload preview functionality
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('product_image');
    const preview = document.getElementById('imagePreview');
    const placeholder = document.querySelector('.product-edit-file-placeholder');

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <div class="preview-image">
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-preview" onclick="removePreview()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    placeholder.style.display = 'none';
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

function removePreview() {
    const fileInput = document.getElementById('product_image');
    const preview = document.getElementById('imagePreview');
    const placeholder = document.querySelector('.product-edit-file-placeholder');
    
    fileInput.value = '';
    preview.innerHTML = '';
    preview.style.display = 'none';
    placeholder.style.display = 'block';
}

// Auto-resize textareas
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('.product-edit-textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
});
</script>
                               class="product-edit-input @error('price') error @enderror" 
                               value="{{ old('price', $product->price) }}" 
                               step="0.01"
                               min="0"
                               placeholder="0.00"
                               required>
                        @error('price')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <label for="category_id" class="product-edit-label">
                            Category <span class="required">*</span>
                        </label>
                        <select id="category_id" 
                                name="category_id" 
                                class="product-edit-select @error('category_id') error @enderror"
                                required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Product Images Section -->
            <div class="product-edit-section">
                <div class="product-edit-section-header">
                    <div class="product-edit-section-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="product-edit-section-title">
                        <h3>Product Images</h3>
                        <p>Manage product images and add new ones</p>
                    </div>
                </div>

                <!-- Current Images -->
                @if($product->images && count($product->images) > 0)
                    <div class="product-edit-current-images">
                        <h4>Current Images</h4>
                        <div class="product-edit-current-grid" id="currentImages">
                            @foreach($product->images as $index => $image)
                                <div class="product-edit-current-item" data-image-index="{{ $index }}">
                                    <img src="{{ $image }}" alt="Product Image {{ $index + 1 }}">
                                    <button type="button" class="product-edit-current-remove" onclick="removeCurrentImage({{ $index }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="removedImages" name="removed_images" value="">
                    </div>
                @endif

                <div class="product-edit-form-group full-width">
                    <label for="images" class="product-edit-label">
                        Add New Images (Multiple files allowed)
                    </label>
                    <div class="product-edit-file-upload" id="fileUpload">
                        <input type="file" 
                               id="images" 
                               name="images[]" 
                               class="product-edit-file-input" 
                               multiple 
                               accept="image/*">
                        <div class="product-edit-file-content">
                            <div class="product-edit-file-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="product-edit-file-text">
                                <h4>Drop new images here or click to browse</h4>
                                <p>Supports: JPG, PNG, GIF. Max size: 5MB per file</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-edit-preview-container" id="imagePreview"></div>
                    @error('images')
                        <span class="product-edit-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Product Settings Section -->
            <div class="product-edit-section">
                <div class="product-edit-section-header">
                    <div class="product-edit-section-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="product-edit-section-title">
                        <h3>Product Settings</h3>
                        <p>Configure product status and visibility</p>
                    </div>
                </div>

                <div class="product-edit-form-grid">
                    <div class="product-edit-form-group">
                        <label for="status" class="product-edit-label">
                            Status <span class="required">*</span>
                        </label>
                        <select id="status" 
                                name="status" 
                                class="product-edit-select @error('status') error @enderror"
                                required>
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="product-edit-error">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="product-edit-form-group">
                        <div class="product-edit-checkbox-group">
                            <div class="product-edit-checkbox">
                                <input type="checkbox" 
                                       id="is_featured" 
                                       name="is_featured" 
                                       value="1" 
                                       {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <div class="product-edit-checkmark"></div>
                            </div>
                            <label for="is_featured" class="product-edit-checkbox-label">
                                Featured Product
                            </label>
                        </div>
                        <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;">
                            Featured products will be highlighted on the homepage
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="product-edit-form-actions">
                <a href="{{ route('admin.products.index') }}" class="product-edit-form-btn product-edit-form-btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
                <button type="submit" class="product-edit-form-btn product-edit-form-btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Keep track of removed images
    let removedImages = [];

    // File upload handling
    const fileUpload = document.getElementById('fileUpload');
    const fileInput = document.getElementById('images');
    const imagePreview = document.getElementById('imagePreview');
    let selectedFiles = [];

    // Remove current image functionality
    window.removeCurrentImage = function(index) {
        removedImages.push(index);
        document.getElementById('removedImages').value = JSON.stringify(removedImages);
        document.querySelector(`[data-image-index="${index}"]`).remove();
    };

    // Drag and drop functionality
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
        const files = Array.from(e.dataTransfer.files);
        handleFiles(files);
    });

    fileInput.addEventListener('change', function() {
        const files = Array.from(this.files);
        handleFiles(files);
    });

    function handleFiles(files) {
        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                selectedFiles.push(file);
                displayImagePreview(file);
            }
        });
        updateFileInput();
    }

    function displayImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewItem = document.createElement('div');
            previewItem.className = 'product-edit-preview-item';
            previewItem.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <button type="button" class="product-edit-preview-remove" onclick="removeNewImage(this, '${file.name}')">
                    <i class="fas fa-times"></i>
                </button>
            `;
            imagePreview.appendChild(previewItem);
        };
        reader.readAsDataURL(file);
    }

    window.removeNewImage = function(button, fileName) {
        selectedFiles = selectedFiles.filter(file => file.name !== fileName);
        button.closest('.product-edit-preview-item').remove();
        updateFileInput();
    };

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    }

    // Form submission handling
    const form = document.getElementById('productEditForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __('products.processing') }}';
    });

    // Input validation feedback
    const inputs = document.querySelectorAll('.product-edit-input, .product-edit-textarea, .product-edit-select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '#e5e7eb';
            }
        });

        input.addEventListener('input', function() {
            if (this.style.borderColor === 'rgb(239, 68, 68)' && this.value.trim()) {
                this.style.borderColor = '#e5e7eb';
            }
        });
    });
});
</script>
@endsection
