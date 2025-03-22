<?php

namespace App\Models;

use App\Models\BuyCart\BuyCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'gender',
        'full_name',
        'email',
        'cellphone',
        'status',
        'email_verified_at',
        'password',
        'provider',
        'is_admin',
        'created_at',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function gallery(): MorphOne
    {
        return $this->morphOne(Gallery::class, 'gallery');
    }

    public function buy_carts(): HasMany
    {
        return $this->hasMany(BuyCart::class)->latest();
    }

    public function coupons(): MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable')->latest();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->latest();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->latest();
    }

    public function wish_lists(): HasMany
    {
        return $this->hasMany(WishList::class)->latest();
    }

    public static function updateUser($data)
    {
        self::whereId(Auth::id())->update([
            'name' => $data['username'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'cellphone' => $data['mobile'],
            'gender' => $data['gender'],
        ]);

    }
}
