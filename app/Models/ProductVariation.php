<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductVariation extends Model
{
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

    public function buy_carts():BelongsToMany
    {
        return $this->belongsToMany(BuyCart::class);
    }
}
