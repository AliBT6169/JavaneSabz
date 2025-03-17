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
        $attributes = [
            Brand::class,
            Category::class,
            Product::class,
            ProductVariation::class,
        ];
        $attributeType = $attributes[rand(0, count($attributes) - 1)];
        $attributeId = 1;
        if ($attributeType == 'App\Models\Brand' || $attributeType == 'App\Models\Category')
            $attributeId = rand(1, 50);
        else if ($attributeType == 'App\Models\Product' || $attributeType == 'App\Models\ProductVariation')
            $attributeId = rand(1, 200);
        return [
            "name" => Faker::jobTitle(),
            "slug" => fake()->slug,
            "attributable_id" => $attributeId,
            "attributable_type" => $attributeType,
        ];
    }
}
