<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'id',
        'name',
        'code',
        'type',
        'amount',
        'percentage',
        'max_percentage_amount',
        'expired_at',
        'description',
        'created_at',
    ];
}
