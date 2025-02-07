<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';
    protected $fillable = [
        'id',
        'title',
        'address',
        'postcode',
        'user_id',
        'city_id',
        'longitude',
        'latitude',
        'created_at',
    ];
}
