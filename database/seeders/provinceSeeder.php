<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class provinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path() . '/data/provinces.json');
        $data = json_decode($json);
        foreach ($data as $item) {
            Province::create([
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'tel_prefix' => $item->tel_prefix
            ]);
        }
    }
}
