<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
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
            'slug' => Faker::firstName() . ' ' . Faker::firstName() . ' ' . Faker::firstName(),
            'icon' => '/images/default/default.jpg',
            'description' => Faker::paragraph(),
        ];

    }
}
