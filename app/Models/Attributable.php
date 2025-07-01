<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributable extends Model
{
    protected $fillable = [
        'id',
        'attribute_id',
        'attributable_id',
        'attributable_type',
    ];
}
