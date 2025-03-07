<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

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

    public static function addressStore(int $id, string $address, string $postcode)
    {

        if (self::where('addressable_id', $id)->exists())
            self::where('addressable_id', $id)->update([
                'address' => $address,
                'postcode' => $postcode,
            ]);
        else
            self::create([
                'addressable_id' => $id,
                'addressable_type' => User::class,
                'address' => $address,
                'postcode' => $postcode,
            ]);
    }
}
