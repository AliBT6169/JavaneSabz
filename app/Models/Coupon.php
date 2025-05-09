<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'name',
        'code',
        'status',
        'percentage',
        'quantity',
        'max_amount',
        'expired_at',
        'description',
        'couponable_id',
        'couponable_type',
        'created_at',
    ];

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'couponable');
    }

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'couponable');
    }

    public function product_variations(): MorphToMany
    {
        return $this->morphedByMany(ProductVariation::class, 'couponable');
    }
}
