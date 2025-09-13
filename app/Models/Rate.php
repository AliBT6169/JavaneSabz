<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable = [
        'rate',
        'rateable_id',
        'rateable_type',
        'user_id',
    ];
}
