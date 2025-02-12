<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductVariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => rand(1, 100),
            "attribute_id" => rand(1, 2),
            "value" => Faker::firstName(),
            "price" => rand(10000,1000000),
            "quantity" => rand(0, 100),
            "sale_price" => rand(50000,5000000),

        ];
    }
}
