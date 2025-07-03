<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'company',
        'address',
        'city',
        'country',
        'preferred_language',
    ];

    // Relationships
    public function soldProducts()
    {
        return $this->hasMany(SoldProduct::class);
    }
}
