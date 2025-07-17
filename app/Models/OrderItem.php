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
        'price',
        'created_at',
    ];

    public static function Creator($cartItems, $OrderId)
    {
        foreach ($cartItems as $item) {
            $cartItem = BuyCart::whereId($item->id)->first();
            self::create([
                'order_id' => $OrderId,
                'product_variation_id' => $cartItem->product_variation->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product_variation->sale_price * $cartItem->quantity,
            ]);
        }
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product_variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
