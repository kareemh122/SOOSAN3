@extends('layouts.admin')

@section('title', 'Owner Product Details')

@section('content')
    <style>
        .product-details-hero {
            background: linear-gradient(90deg, #6366f1 0%, #3b82f6 100%);
            color: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.12);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .product-details-hero .icon {
            font-size: 2.5rem;
            margin-right: 1rem;
            vertical-align: middle;
        }

        .product-details-hero h2 {
            font-weight: 700;
            font-size: 2.1rem;
            margin-bottom: 0.5rem;
        }

        .product-details-hero .meta {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .product-details-card {
            border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(59, 130, 246, 0.08);
            border: none;
            margin-bottom: 2rem;
        }

        .product-details-table th,
        .product-details-table td {
            vertical-align: middle;
        }

        .product-details-table th {
            background: #f3f4f6;
            color: #374151;
            font-weight: 600;
            border-top: none;
        }

        .product-details-table tr {
            transition: background 0.2s;
        }

        .product-details-table tr:hover {
            background: #f1f5f9;
        }

        .product-details-back {
            margin-top: 2.5rem;
        }

        .product-details-back .btn {
            border-radius: 0.75rem;
            font-weight: 600;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            background: linear-gradient(90deg, #6366f1 0%, #3b82f6 100%);
            color: #fff;
            border: none;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.08);
            transition: background 0.2s, box-shadow 0.2s;
        }

        .product-details-back .btn:hover {
            background: linear-gradient(90deg, #3b82f6 0%, #6366f1 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(59, 130, 246, 0.15);
        }
    </style>

    <div class="container py-4">
        <div class="product-details-hero mb-4 d-flex align-items-center">
            <span class="icon"><i class="fas fa-user-tie"></i></span>
            <div>
                <h2 class="mb-1">{{ $owner->name }}</h2>
                <div class="meta">
                    <span><i class="fas fa-coins me-1"></i> Total Spent: <b>${{ number_format($totalSpent, 2) }}</b></span>
                    <span class="mx-3">|</span>
                    <span><i class="fas fa-cube me-1"></i> Product: <b>{{ $product }}</b></span>
                </div>
            </div>
        </div>

        <div class="card product-details-card">
            <div class="card-header bg-white border-0 pb-0">
                <h5 class="mb-0"><i class="fas fa-shopping-bag text-primary me-2"></i> Purchases of <span
                        class="text-primary">{{ $product }}</span></h5>
            </div>
            <div class="card-body p-0">
                <table class="table product-details-table mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-cube"></i> Product Name</th>
                            <th><i class="fas fa-dollar-sign"></i> Purchase Price</th>
                            <th><i class="fas fa-calendar-alt"></i> Purchase Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soldProducts as $sp)
                            <tr>
                                <td>{{ $sp->product->model_name ?? 'N/A' }}</td>
                                <td class="text-success fw-bold">${{ number_format($sp->purchase_price, 2) }}</td>
                                <td>{{ $sp->sale_date ? $sp->sale_date->format('Y-m-d') : 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No purchases found for this product.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="product-details-back">
            <a href="{{ route('admin.owners.index') }}" class="btn"><i class="fas fa-arrow-left me-2"></i>Back to
                Owners</a>
        </div>
    </div>
@endsection
