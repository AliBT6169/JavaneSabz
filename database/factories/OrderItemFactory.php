<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "order_id" => rand(101, 110),
            "product_variation_id" => rand(1, 100),
            "quantity" => rand(1, 100),
            "coupon_amount" => rand(1000, 100000),
        ];
    }
}
