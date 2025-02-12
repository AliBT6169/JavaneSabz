<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeFactory> */
    use HasFactory;

    protected $table = 'attributes';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'created_at',
    ];

    public function product_variation(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }
}
