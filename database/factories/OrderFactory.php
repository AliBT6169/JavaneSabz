<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total_amount = rand(1000000, 100000000);
        $delivery_amount = rand(1000, 100000);
        $coupon_amount = rand(1000, 100000);
        return [
            "user_id" => 1,
            "status" => rand(0, 2),
            "total_amount" => $total_amount,
            "delivery_amount" => $delivery_amount,
            "coupon_amount" => $coupon_amount,
            "paying_amount" => $total_amount - ($coupon_amount + $delivery_amount),
            "payment_status" => rand(0, 1),
        ];
    }
}
