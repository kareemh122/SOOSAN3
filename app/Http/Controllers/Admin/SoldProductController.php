<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoldProduct;
use App\Models\Product;
use App\Models\Owner;
use App\Models\PendingChange;
use Illuminate\Http\Request;

class SoldProductController extends Controller
{
    public function index()
    {
        $soldProducts = SoldProduct::with(['product', 'owner', 'employee'])->latest()->paginate(15);
        return view('admin.sold-products.index', compact('soldProducts'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->orderBy('model_name')->get();
        $owners = Owner::orderBy('name')->get();
        return view('admin.sold-products.create', compact('products', 'owners'));
    }

    // ✅ Keep only this store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'owner_id' => 'required|exists:owners,id',
            'serial_number' => 'required|string|unique:sold_products,serial_number',
            'sale_date' => 'required|date',
            'warranty_start_date' => 'required|date',
            'warranty_end_date' => 'required|date|after_or_equal:warranty_start_date',
            'purchase_price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        // 🔐 Automatically assign the logged-in user
        $validated['user_id'] = auth()->id();

        SoldProduct::create($validated);

        return redirect()->route('admin.sold-products.index')
            ->with('success', 'Sold product added successfully.');
    }

    public function show(SoldProduct $soldProduct)
    {
        $soldProduct->load('product', 'owner', 'employee');
        return view('admin.sold-products.show', compact('soldProduct'));
    }

    public function edit(SoldProduct $soldProduct)
    {
        $products = Product::where('is_active', true)->orderBy('model_name')->get();
        $owners = Owner::orderBy('name')->get();
        
        // Only include employees field for admins
        $employees = auth()->user()->isAdmin() 
            ? \App\Models\User::whereIn('role', ['admin', 'employee'])->orderBy('name')->get()
            : collect();
            
        return view('admin.sold-products.edit', compact('soldProduct', 'products', 'owners', 'employees'));
    }

    public function update(Request $request, SoldProduct $soldProduct)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'owner_id' => 'required|exists:owners,id',
            'serial_number' => 'required|string|unique:sold_products,serial_number,' . $soldProduct->id,
            'sale_date' => 'required|date',
            'warranty_start_date' => 'required|date',
            'warranty_end_date' => 'required|date|after_or_equal:warranty_start_date',
            'purchase_price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // If user is an employee, create a pending change instead of directly updating
        if (auth()->user()->isEmployee()) {
            PendingChange::create([
                'model_type' => SoldProduct::class,
                'model_id' => $soldProduct->id,
                'action' => 'update',
                'original_data' => $soldProduct->toArray(),
                'new_data' => $validated,
                'requested_by' => auth()->id(),
            ]);

            return redirect()->route('admin.sold-products.index')
                ->with('info', __('admin.changes_submitted_for_approval'));
        }

        // If user is admin, apply changes directly
        $soldProduct->update($validated);

        return redirect()->route('admin.sold-products.index')
            ->with('success', 'Sold product updated successfully.');
    }

    public function destroy(SoldProduct $soldProduct)
    {
        // If user is an employee, create a pending change instead of directly deleting
        if (auth()->user()->isEmployee()) {
            PendingChange::create([
                'model_type' => SoldProduct::class,
                'model_id' => $soldProduct->id,
                'action' => 'delete',
                'original_data' => $soldProduct->toArray(),
                'new_data' => [], // No new data for deletion
                'requested_by' => auth()->id(),
            ]);

            return redirect()->route('admin.sold-products.index')
                ->with('info', __('admin.deletion_submitted_for_approval'));
        }

        // If user is admin, delete directly
        $soldProduct->delete();
        return redirect()->route('admin.sold-products.index')
            ->with('success', 'Sale record deleted successfully.');
    }
}
