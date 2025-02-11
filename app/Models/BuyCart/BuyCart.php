<?php

namespace App\Models\BuyCart;

use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BuyCart extends Model
{
    /** @use HasFactory<\Database\Factories\BuyCart\BuyCartFactory> */
    use HasFactory;

    protected $table = 'buy_carts';
    protected $fillable = [
        'user_id',
        'product_variation_id',
        'quantity',
    ];

    public function product_variation(): HasOne
    {
        return $this->HasOne(ProductVariation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
