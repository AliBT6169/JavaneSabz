<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(string $type = "product"): array
    {
        if ($type == "product") {
            return [
                "media" => 'https://picsum.photos/seed/' . fake()->uuid . '/480/480',
                "mediable_id" => 1,
                "mediable_type" => "App\Models\ProductVariation",
            ];
        }
        return [
            "media" => 'https://picsum.photos/seed/' . fake()->uuid . '/480/480',
            "mediable_id" => 1,
            "mediable_type" => "App\Models\User",
        ];
    }
}
