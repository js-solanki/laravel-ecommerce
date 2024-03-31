<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'shipping_address',
        'billing_address',
        'payment_status',
        'status',
        'shipping_method',
        'tracking_number',
        'order_notes',
    ];

    protected $dates = [
        'order_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
