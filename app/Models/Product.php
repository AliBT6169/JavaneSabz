<?php

namespace App\Models;

use App\Http\Resources\Home\Product\ProductResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    protected $with = ['Equipments'];

    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'brand_id',
        'category_id',
        'slug',
        'primary_image',
        'description',
        'status',
        'is_active',
        'delivery_amount',
        'delivery_amount_per_product',
        'created_at',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function product_variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }

    public function coupons(): MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable');
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }

    public function Equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'product_equipments', 'product_id', 'equipment_id');
    }
}
