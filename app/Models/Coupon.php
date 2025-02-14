<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
        'percentage',
        'max_percentage_amount',
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
