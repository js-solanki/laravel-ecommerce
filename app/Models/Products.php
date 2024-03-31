<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'quantity_available',
        'sku',
        'brand',
        'manufacturer',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array', // JSON field cast to array
    ];
}
