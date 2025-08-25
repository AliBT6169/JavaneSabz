<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'is_best',
        'icon',
        'created_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
