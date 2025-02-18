<?php

namespace Database\Factories\BuyCart;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BuyCart\BuyCart>
 */
class BuyCartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => 1,
            "product_variation_id" => rand(1, 100),
            "quantity" => rand(1, 100),
        ];
    }
}
