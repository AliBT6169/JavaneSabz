<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'slug' => fake()->unique()->slug(),
            'description' => Faker::sentence(),
            'is_active' => rand(0, 1),
            'icon' => fake()->imageUrl(),
        ];
    }
}
