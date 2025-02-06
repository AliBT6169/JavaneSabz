<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\Category\CategoryFactory> */
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'is_active',
        'icon',
        'created_at',
    ];
}
