<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';
    protected $fillable = [
        'id',
        'title',
        'address',
        'postcode',
        'addressable_id',
        'addressable_type',
        'city_id',
        'longitude',
        'latitude',
        'created_at',
    ];

    public function addressable(): morphTo
    {
        return $this->morphTo();
    }
}
