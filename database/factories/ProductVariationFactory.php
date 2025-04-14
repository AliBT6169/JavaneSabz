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
        $off_sale = rand(0, 50);
        $price = rand(10000, 10000000);
        $sale_price = $price - $off_sale * ($price / 100);
        return [
            "product_id" => rand(1, 100),
            "value" => Faker::firstName(),
            "weight" => rand(1, 25),
            "price" => $price,
            "quantity" => rand(0, 100),
            "off_sale" => $off_sale,
            "sale_price" => $sale_price,

        ];
    }
}
