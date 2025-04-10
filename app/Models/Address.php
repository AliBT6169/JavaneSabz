<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Shimadotdev\IranRegions\Models\City;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $fillable = [
        'id',
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public static function addressStore(int $id, string $address, int $city_id, string $postcode, $type)
    {

        if (self::where('addressable_id', $id)->where('addressable_type', $type)->exists())
            self::where('addressable_id', $id)->where('addressable_type', $type)->update([
                'address' => $address,
                'city_id' => $city_id,
                'postcode' => $postcode,
            ]);
        else
            self::create([
                'addressable_id' => $id,
                'addressable_type' => $type,
                'address' => $address,
                'city_id' => $city_id,
                'postcode' => $postcode,
            ]);
    }
}
