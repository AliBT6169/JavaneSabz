<?php

namespace App\Models\BuyCart;

use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

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

    public static function addToCart(int $ProductId)
    {
        $self = self::where('product_variation_id', $ProductId)->where('user_id', Auth::id())->first() ?? '';
        if ($self != '') {
            self::CartItemIncrement($self->id);
            return response([
                'data' => $self->id,
                'method' => 'increment'
            ]);
        } else {
            $newCartItem[] = self::create([
                'user_id' => Auth::id(),
                'product_variation_id' => $ProductId,
                'quantity' => 1,
            ]);
            return response()->json([
                'data' => DashboardResource::getBuyCartItems($newCartItem),
                'method' => 'create',
            ]);
        }
    }

    public static function CartItemIncrement(int $id): void
    {
        self::whereId($id)->increment('quantity');
    }

    public static function CartItemDecrement(int $id): void
    {
        if (self::whereId($id)->decrement('quantity') > 1)
            self::whereId($id)->decrement('quantity');
        else self::whereId($id)->delete();
    }
}
