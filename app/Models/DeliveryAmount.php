<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAmount extends Model
{
    protected $fillable = [
        'weight',
        'price',
    ];

}
