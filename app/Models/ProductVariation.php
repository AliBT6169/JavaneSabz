<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class ProductVariation extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariationFactory> */
    use HasFactory;

    protected $table = 'product_variations';
    protected $fillable = [
        'id',
        'product_id',
        'attribute_id',
        'value',
        'price',
        'quantity',
        'sku',
        'sale_price',
        'created_at',
    ];


    public function buy_cart(): HasOne
    {
        return $this->hasOne(BuyCart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function coupons(): MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
