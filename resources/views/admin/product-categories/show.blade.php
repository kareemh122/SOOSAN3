@extends('layouts.admin')

@section('title', 'Category Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Category Details</h1>
    <div class="btn-group">
        <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Category
        </a>
        <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Categories
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="card-title mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="fw-bold" style="width: 150px;">Name:</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Description:</td>
                        <td>{{ $category->description ?? 'No description provided' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Created:</td>
                        <td>{{ $category->created_at ? $category->created_at->format('M d, Y H:i') : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Updated:</td>
                        <td>{{ $category->updated_at ? $category->updated_at->format('M d, Y H:i') : 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="card-title mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h3 class="text-primary">{{ $category->products->count() }}</h3>
                    <p class="text-muted">Products in this category</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if($category->products->count() > 0)
<div class="admin-card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Products in this Category</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Model Name</th>
                        <th>Line</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products as $product)
                    <tr>
                        <td>{{ $product->model_name }}</td>
                        <td>{{ $product->line ?? 'N/A' }}</td>
                        <td>{{ $product->type ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $product->created_at ? $product->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
