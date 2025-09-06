<?php

namespace Database\Seeders;

use App\Models\NavBarSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NavBarSetting::create([
            'title' => 'خانه',
            'link' => 'index',
            'icon' => 'home',
            'queue' => 0,
        ]);
        NavBarSetting::create([
            'title' => 'محصولات',
            'link' => 'products.showAll',
            'icon' => 'strawberry',
            'queue' => 1,
        ]);
        NavBarSetting::create([
            'title' => 'برند ها',
            'icon' => 'indexBrands',
            'queue' => 2,
        ]);
        NavBarSetting::create([
            'title' => 'درباره ما',
            'link' => 'about-us',
            'icon' => 'about',
            'queue' => 3,
        ]);
        NavBarSetting::create([
            'title' => 'تماس با ما',
            'icon' => 'tell',
            'queue' => 4,
        ]);
        NavBarSetting::create([
            'title' => 'وبلاگ',
            'icon' => 'blog',
            'link' => 'blogs',
            'queue' => 5,
        ]);
    }
}
