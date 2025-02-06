<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'is_active',
        'icon',
        'created_at',
    ];
}
