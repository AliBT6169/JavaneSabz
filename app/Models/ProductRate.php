<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    protected $table = 'product_rates';
    protected $fillable = [
        'product_id',
        'user_id',
        'rate',
        'created_at',
    ];
}
