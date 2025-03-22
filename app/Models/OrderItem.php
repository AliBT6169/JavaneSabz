<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'id',
        'order_id',
        'product_variation_id',
        'quantity',
        'coupon_amount',
        'created_at',
    ];

    public static function Creator($cartItems, $OrderId, $coupon_amount = 0)
    {
        foreach ($cartItems as $item) {
            $cartItem = BuyCart::whereId($item->id)->first();
            self::create([
                'order_id' => $OrderId,
                'product_variation_id' => $cartItem->product_variation->id,
                'quantity' => $cartItem->quantity,
                'coupon_amount' => $coupon_amount,
            ]);
        }
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function productVariation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
