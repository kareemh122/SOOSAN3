@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<style>
    .modern-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 0;
        margin: -2rem -2rem 2rem;
        border-radius: 0 0 1rem 1rem;
        position: relative;
        overflow: hidden;
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
    }
    .modern-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 2rem;
        overflow: hidden;
    }
    .modern-form-group {
        margin-bottom: 1.5rem;
    }
    .modern-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }
    .modern-input {
        width: 100%;
        padding: 0.875rem 1.125rem;
        border: 2px solid #e9ecef;
        border-radius: 0.75rem;
        background: #fff;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    .modern-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: translateY(-1px);
    }
    .modern-textarea {
        width: 100%;
        padding: 0.875rem 1.125rem;
        border: 2px solid #e9ecef;
        border-radius: 0.75rem;
        background: #fff;
        transition: all 0.3s ease;
        font-size: 1rem;
        resize: vertical;
        min-height: 120px;
    }
    .modern-textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .modern-input.is-invalid, .modern-textarea.is-invalid {
        border-color: #dc3545;
    }
    .modern-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .modern-btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    .modern-btn-secondary:hover {
        box-shadow: 0 10px 25px rgba(108, 117, 125, 0.4);
    }
    .modern-btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }
    .modern-btn-info:hover {
        box-shadow: 0 10px 25px rgba(23, 162, 184, 0.4);
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .category-icon-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
</style>

<!-- Page Header -->
<div class="modern-page-header">
    <div class="container-fluid position-relative">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-2">Edit Category</h1>
                <p class="mb-0 opacity-75">Update category information and settings</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group">
                    <a href="{{ route('admin.product-categories.show', $category) }}" class="modern-btn modern-btn-info">
                        <i class="fas fa-eye"></i>
                        View Category
                    </a>
                    <a href="{{ route('admin.product-categories.index') }}" class="modern-btn modern-btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="modern-card">
            <div class="card-body p-4">
                <!-- Category Icon -->
                <div class="text-center mb-4">
                    <div class="category-icon-large">
                        <i class="fas fa-folder"></i>
                    </div>
                    <h4 class="mb-1">{{ $category->name }}</h4>
                    <p class="text-muted">
                        {{ $category->products_count ?? 0 }} 
                        {{ ($category->products_count ?? 0) === 1 ? 'Product' : 'Products' }}
                    </p>
                </div>

                <form action="{{ route('admin.product-categories.update', $category) }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="modern-form-group">
                        <label for="name" class="modern-label">
                            Category Name <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="modern-input @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $category->name) }}" 
                            required
                            placeholder="Enter category name"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="description" class="modern-label">
                            Description
                        </label>
                        <textarea 
                            class="modern-textarea @error('description') is-invalid @enderror" 
                            id="description" 
                            name="description" 
                            rows="4"
                            placeholder="Enter category description (optional)"
                        >{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Provide a brief description to help users understand this category</small>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.product-categories.show', $category) }}" class="modern-btn modern-btn-secondary">
                                    <i class="fas fa-times"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="modern-btn">
                                    <i class="fas fa-save"></i>
                                    Update Category
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('editCategoryForm');
    const nameField = document.getElementById('name');
    
    form.addEventListener('submit', function(e) {
        if (nameField.value.trim().length < 2) {
            e.preventDefault();
            alert('Category name must be at least 2 characters long!');
            nameField.focus();
        }
    });
    
    // Enhanced focus effects
    const inputs = document.querySelectorAll('.modern-input, .modern-textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // Character counter for description
    const descriptionField = document.getElementById('description');
    const maxLength = 500;
    
    // Create character counter
    const counterDiv = document.createElement('div');
    counterDiv.className = 'text-muted text-end mt-1';
    counterDiv.style.fontSize = '0.8rem';
    descriptionField.parentElement.appendChild(counterDiv);
    
    function updateCounter() {
        const remaining = maxLength - descriptionField.value.length;
        counterDiv.textContent = `${descriptionField.value.length}/${maxLength} characters`;
        counterDiv.style.color = remaining < 50 ? '#dc3545' : '#6c757d';
    }
    
    descriptionField.addEventListener('input', updateCounter);
    updateCounter(); // Initial call
});
</script>
@endsection
