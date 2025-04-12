<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path("/data/cities.json"));
        $data = json_decode($json);
        foreach ($data as $item) {
            City::create([
                'name' => $item->name,
                'slug' => $item->slug,
                'province_id' => $item->province_id,
            ]);
        }
    }
}
