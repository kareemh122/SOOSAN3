<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'product_id',
        'owner_id',
        'user_id',
        'serial_number',
        'sale_date',
        'warranty_start_date',
        'warranty_end_date',
        'purchase_price',
        'notes',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'warranty_start_date' => 'date',
        'warranty_end_date' => 'date',
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper methods
    public function isUnderWarranty()
    {
        return now()->between($this->warranty_start_date, $this->warranty_end_date);
    }
}
