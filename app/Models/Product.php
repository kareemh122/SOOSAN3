<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'serial_number',
        'category_id',
        'image_urls',
        'specs_si',
        'specs_imperial',
        'description_en',
        'description_ar',
        'features',
        'applications',
        'brochure_url',
        'manual_url',
        'is_featured',
        'status',
        'created_by',
    ];

    protected $casts = [
        'image_urls' => 'array',
        'specs_si' => 'array',
        'specs_imperial' => 'array',
        'features' => 'array',
        'applications' => 'array',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function soldProducts()
    {
        return $this->hasMany(SoldProduct::class);
    }
}
