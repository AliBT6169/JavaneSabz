<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'کپن ادمین',
            'code' => 'admin-coupon',
            'percentage' => 20,
            'quantity' => 100,
            'max_amount' => 2000000,
            'expired_at' => Carbon::now()->addMonth(6),
            'description' => 'این کپن واسه ادمینه',
            'couponable_id' => 1,
            'couponable_type' => User::class,
        ];
    }
}
