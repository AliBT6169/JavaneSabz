<?php

namespace App\Models\BuyCart;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

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

    public function product_variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addToCart(int $ProductId): string
    {
        if (self::where('product_variation_id', $ProductId)->where('user_id', Auth::id())->exists()) {
            self::CartItemIncrement($ProductId);
            return 'incremented';
        } else {
            self::create([
                'user_id' => Auth::id(),
                'product_variation_id' => $ProductId,
                'quantity' => 1,
            ]);
            return 'added';
        }
    }

    public static function CartItemIncrement(int $id): void
    {
        self::whereId($id)->increment('quantity');
    }

    public static function CartItemDecrement(int $id): void
    {
        self::whereId($id)->decrement('quantity');
    }
}
