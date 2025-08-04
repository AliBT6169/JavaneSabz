<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'icon',
        'description',
        'is_active',
        'created_at',
    ];

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'attributable');
    }

    public function brands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'attributable');
    }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'attributable');
    }

    public function product_variations(): MorphToMany
    {
        return $this->morphedByMany(ProductVariation::class, 'attributable');
    }

    public function navItemSettingAttributes(): HasMany
    {
        return $this->hasMany(NavItemSettingAttribute::class);

    }
}
