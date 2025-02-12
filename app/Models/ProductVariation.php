<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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


    public function buy_cart(): BelongsToMany
    {
        return $this->belongsToMany(BuyCart::class);
    }

    public function Product(): BelongsToMany
    {
        return $this->belongsToMany(BuyCart::class);
    }

    public function attribute(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }
}
