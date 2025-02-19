<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Faker::firstName(),
            'brand_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'slug' => fake()->unique()->slug(),
            'primary_image' => 'https://picsum.photos/480/480',
            'description' => Faker::sentence(),
            'status' => rand(0, 1),
            'is_active' => rand(0, 1),
            'delivery_amount' => rand(1000, 100000),
            'delivery_amount_per_product' => rand(500, 50000),

        ];
    }
}
