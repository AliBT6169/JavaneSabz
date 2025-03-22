<?php

namespace App\Models;

use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'id',
        'user_id',
        'status',
        'total_amount',
        'delivery_amount',
        'coupon_amount',
        'paying_amount',
        'payment_status',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function Creator($cartItems, $status = 0, $payment_status = 0, $coupon_amount = 0, $paying_amount = 0, $delivery_amount = 0)
    {
        $total_amount = 0;
        foreach ($cartItems as $cartItem) {
            $total_amount += $cartItem->price * $cartItem->quantity;
        }
        $Order = self::create([
            'user_id' => Auth::id(),
            'status' => $status,
            'total_amount' => $total_amount,
            'delivery_amount' => $delivery_amount,
            'coupon_amount' => $coupon_amount,
            'paying_amount' => $paying_amount,
            'payment_status' => $payment_status,
        ]);
        OrderItem::Creator($cartItems, $Order->id);
        Transaction::Creator($Order->id);
        return 'OK';
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
