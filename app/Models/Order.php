<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'id',
        'user_id',
        'address_id',
        'coupon_id',
        'status',
        'total_amount',
        'delivery_amount',
        'coupon_amount',
        'paying_amount',
        'payment_type',
        'payment_status',
        'description',
        'created_at',
    ];


    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
