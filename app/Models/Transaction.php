<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'amount',
        'ref_id',
        'token',
        'description',
        'gateway_name',
        'status',
        'created_at',
    ];
}
