<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'ref_id',
        'token',
        'gateway_name',
        'status',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function Creator($request)
    {
        self::create([
            'user_id' => $request['id'] ?? Auth::id(),
            'order_id' => $request['OrderId'],
            'gateway_name' => $request['gateway_name'] ?? 'zarinpal',
            'status' => $request['status'] ?? 0,
            'ref_id' => $request['refId'] ?? null,
        ]);
    }
}
