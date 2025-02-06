<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeCategory extends Model
{
    use HasFactory;

    protected $table = 'attribute_categories';
    protected $fillable = [
        'attribute_id',
        'category_id',
        'is_filter',
        'is_variation',
        'created_at',
    ];
}
