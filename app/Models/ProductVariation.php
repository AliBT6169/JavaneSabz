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
        'attribute_id',
        'value',
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
    public static function getSomeProduct(int $count = 10)
    {
        $products = self::latest()->take($count)->get();
        $product = [];
        foreach ($products as $item) {
            $product[] = [
                "id" => $item->id,
                "product_id" => $item->product_id,
                "name" => $item->product->name,
                "quantity" => $item->quantity,
                "price" => $item->sale_price,
                "image" => $item->product->primary_image,
                "is_liked" => Wishlist::is_exist(Auth::user()->id ?? null, $item->id),
            ];
        }
        return $product;
    }
}
