<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $table = 'Categories';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'is_active',
        'icon',
        'created_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
