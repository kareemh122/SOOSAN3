<?php

namespace App\Http\Controllers;

use App\Models\SoldProduct;
use Illuminate\Http\Request;

class SerialLookupController extends Controller
{
    public function index()
    {
        return view('public.serial-lookup.index');
    }

    public function lookup(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string|max:255',
        ]);

        $serialNumber = $request->serial_number;

        // Search for the product by serial number
        $soldProduct = SoldProduct::with(['product', 'owner'])
            ->where('serial_number', $serialNumber)
            ->first();

        if (!$soldProduct) {
            return back()->with('error', 'Serial number not found in our database.');
        }

        // Check warranty status
        $warrantyStatus = $this->checkWarrantyStatus($soldProduct);

        return view('public.serial-lookup.result', compact('soldProduct', 'warrantyStatus'));
    }

    private function checkWarrantyStatus(SoldProduct $soldProduct)
    {
        if (!$soldProduct->warranty_end_date) {
            return [
                'status' => 'unknown',
                'message' => 'Warranty information not available',
                'is_valid' => false
            ];
        }

        $isUnderWarranty = $soldProduct->isUnderWarranty();
        $warrantyEndDate = $soldProduct->warranty_end_date;

        if ($isUnderWarranty) {
            $daysRemaining = now()->diffInDays($warrantyEndDate, false);
            return [
                'status' => 'active',
                'message' => "Warranty valid for {$daysRemaining} more days",
                'end_date' => $warrantyEndDate->format('M d, Y'),
                'is_valid' => true
            ];
        } else {
            $daysExpired = now()->diffInDays($warrantyEndDate, false);
            return [
                'status' => 'expired',
                'message' => "Warranty expired {$daysExpired} days ago",
                'end_date' => $warrantyEndDate->format('M d, Y'),
                'is_valid' => false
            ];
        }
    }
}
