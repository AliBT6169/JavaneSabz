<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductEquipment extends Model
{
    protected $table = 'product_equipments';

    protected $fillable = [
        'equipment_id',
        'product_id',
    ];
}
