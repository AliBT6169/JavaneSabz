<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "address" => Faker::address(),
            "postcode" => Faker::melliCode(),
            "addressable_id" => rand(2, 100),
            "city_id" => rand(1, 176),
            "addressable_type" => 'App\Models\User',
        ];
    }
}
