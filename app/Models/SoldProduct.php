<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'owner_id',
        'employee_id',
        'serial_number',
        'sale_date',
        'warranty_start_date',
        'warranty_end_date',
        'purchase_price',
        'notes',
    ];

    protected $casts = [
        'sale_date' => 'datetime',
        'warranty_start_date' => 'datetime',
        'warranty_end_date' => 'datetime',
        'purchase_price' => 'decimal:2',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // Helper methods
    public function isUnderWarranty()
    {
        return now()->between($this->warranty_start_date, $this->warranty_end_date);
    }
}
