<?php

namespace Database\Seeders;

use App\Models\DeliveryAmount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'weight' => 1,
                'price' => 25000,
            ],
            [
                'weight' => 2,
                'price' => 30000,
            ],
            [
                'weight' => 3,
                'price' => 35000,
            ],
            [
                'weight' => 5,
                'price' => 40000,
            ],
            [
                'weight' => 10,
                'price' => 50000,
            ],
            [
                'weight' => 15,
                'price' => 60000,
            ],
            [
                'weight' => 20,
                'price' => 70000,
            ],
            [
                'weight' => 30,
                'price' => 80000,
            ],
        ];
        foreach ($data as $item) {
            DeliveryAmount::create([
                'weight' => $item['weight'],
                'price' => $item['price'],
            ]);
        }
    }
}
