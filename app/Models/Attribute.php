<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Attribute extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeFactory> */
    use HasFactory;

    protected $table = 'attributes';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'is_active',
        'created_at',
    ];

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'attributable');
    }

    public function productVariations(): MorphToMany
    {
        return $this->morphedByMany(ProductVariation::class, 'attributable');
    }

}
