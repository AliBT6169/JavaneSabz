<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ybazli\Faker\Facades\Faker;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'aliBt',
            'full_name' => 'علیرضا باباتبار',
            'is_admin' => 1,
            'email' => 'alibt@gmail.com',
            'gender' => 1,
            'cellphone' => '09012553051',
            'status' => rand(0, 1),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            "address" => Faker::address(),
            "postcode" => Faker::melliCode(),
            "city_id" => 126,
            "addressable_id" => 1,
            "addressable_type" => User::class,
        ]);
        User::create([
            'name' => 'Mojtaba-ghorbani',
            'full_name' => 'سید مجتبی قربانی',
            'is_admin' => 1,
            'email' => 'javanehsabzshop@gmail.com',
            'gender' => 1,
            'cellphone' => '09394001870',
            'status' => rand(0, 1),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            "address" => Faker::address(),
            "postcode" => Faker::melliCode(),
            "city_id" => 126,
            "addressable_id" => 2,
            "addressable_type" => User::class,
        ]);
    }
}
