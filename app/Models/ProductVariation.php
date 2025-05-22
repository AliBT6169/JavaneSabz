<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
        'created_at',
    ];

    public function gallery(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'gallery');
    }

    public function buy_cart(): HasOne
    {
        return $this->hasOne(BuyCart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
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
    public static function getSomeProduct(int $count = 10, int $categoryId = null)
    {
        $productVariations = [];
        $productData = [];
        if ($categoryId != null) {
            $products = Product::where('category_id', $categoryId)->get();
            foreach ($products as $product) {
                foreach ($product->product_variations as $variation) {
                    $productVariations[] = $variation;
                }
            }
        } else {
            $productVariations = self::latest()->take($count)->get();
        }
        foreach ($productVariations as $item) {
            $productData[] = [
                "id" => $item->id,
                "product_id" => $item->product_id,
                "category_id" => $item->product->category_id,
                "brand_id" => $item->product->brand_id,
                "name" => $item->product->name,
                "value" => $item->value,
                "quantity" => $item->quantity,
                "price" => $item->sale_price,
                "image" => $item->product->primary_image,
                "is_liked" => Auth::check() ? Wishlist::is_exist(Auth::user()->id, $item->id) : false,
            ];
        }
        return $productData;
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
                if ($item->quantity > $item->productVariation->quantity)
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
}
