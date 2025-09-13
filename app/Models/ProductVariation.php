<?php

namespace App\Models;

use App\Http\Resources\Home\Product\IndexProductVariationsResource;
use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class ProductVariation extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariationFactory> */
    use HasFactory;

    protected $table = 'product_variations';
    protected $fillable = [
        'id',
        'product_id',
        'value',
        'weight',
        'price',
        'quantity',
        'off_sale',
        'sku',
        'sale_price',
        'is_active',
        'is_special',
        'sailed_quantity',
        'created_at',
    ];

    public function gallery(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'gallery');
    }

    public function rates(): MorphMany
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    public function buy_carts(): HasMany
    {
        return $this->hasMany(BuyCart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes(): MorphToMany
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }

    public function coupons(): MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wish_lists(): HasMany
    {
        return $this->hasMany(WishList::class, 'product_variation_id');
    }


    //دریافت تعدادی اختیاری از محصولات
    public static function getSomeProduct(int $count = 10, $filters = [])
    {
        $products = [];
        $query = Product::query()->where('is_active', 1);
        foreach ($filters as $column => $value) {
            if ($value !== 0)
                $query->where($column, $value);
        }
        $products = $query->latest()->take($count)->get();
        $productVariations = [];
        foreach ($products as $product) {
            foreach ($product->product_variations as $productVariation) {
                $productVariations[] = $productVariation;
            }
        }
        return IndexProductVariationsResource::collection($productVariations);
    }

    public static function productQuantityDecrement($order_id)
    {
        $order = Order::whereId($order_id)->first();
        $orderItems = $order->orderItems;
        foreach ($orderItems as $item) {
            self::whereId($item->product_variation_id)->decrement('quantity', $item->quantity);
        }
    }

    public static function productQuantityControl($order_id = -1)
    {
        if ($order_id != -1) {
            $order = Order::whereId($order_id)->first();
            $orderItems = $order->orderItems;
            foreach ($orderItems as $item) {
                if ($item->quantity > $item->product_variation->quantity)
                    return [
                        'status' => 400,
                        'message' => 'تعداد محصول (' . $item->productVariation->product->name . ' : ' .
                            $item->productVariation->value . ')کافی نیست!'
                    ];
            }
        } else {
            $items = Auth::user()->buy_carts;
            foreach ($items as $item) {
                if ($item->product_variation->quantity - $item->quantity < 0)
                    return [
                        'status' => 400,
                        'message' => 'موجودی محصول' . ' ( ' . $item->product_variation->product->name . ':' . $item->product_variation->value . ' ) ' . 'کمتر از سفارش شماست !'
                    ];
            }
        }
        return [
            'status' => 200,
            'message' => 'ok'
        ];
    }

    public static function sailedQuantityIncrement($order_id = -1)
    {
        $order = Order::whereId($order_id)->first();
        $order_items = $order->orderItems;
        foreach ($order_items as $item) {
            $variation = $item->product_variation;
            $variation->update([
                'sailed_quantity' => $variation->sailed_quantity + $item->quantity
            ]);
        }
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
