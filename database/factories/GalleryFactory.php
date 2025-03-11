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
//        for product
        return [
            "media" => 'https://picsum.photos/seed/' . fake()->uuid . '/480/480',
            "gallery_id" => rand(1, 200),
            "gallery_type" => "App\Models\ProductVariation",
        ];

//        for user
//        return [
//            "media" => 'https://picsum.photos/seed/' . fake()->uuid . '/480/480',
//            "gallery_id" => 1,
//            "gallery_type" => "App\Models\User",
//        ];
    }
}
