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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'id',
        'code',
        'user_id',
        'status',
        'total_amount',
        'delivery_amount',
        'VAT',
        'coupon_amount',
        'paying_amount',
        'payment_status',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function Creator($request)
    {
        $paying_amount = $request['total_amount'] - ($request['coupon_amount'] ?? 0) + $request['delivery_amount'];
        $Order = self::create([
            'user_id' => Auth::id(),
            'status' => $request['status'] ?? 0,
            'code' => DB::select('SHOW TABLE STATUS LIKE "orders"')[0]->Auto_increment * 25,
            'total_amount' => $request['total_amount'],
            'VAT' => $request['VAT'] ?? 0,
            'delivery_amount' => $request['delivery_amount'] ?? 0,
            'coupon_amount' => $request['coupon_amount'] ?? 0,
            'paying_amount' => $request['paying_amount'] ?? $paying_amount,
            'payment_status' => $request['payment_status'] ?? 0,
        ]);
        OrderItem::Creator(Auth::user()->buy_carts, $Order->id);
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
