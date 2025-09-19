<?php

namespace Database\Seeders;

use App\Models\AboutUsSetting;
use App\Models\Address;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\BuyCart\BuyCart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(adminSeeder::class);
        User::factory(100)->create()->unique;
        Setting::factory(1)->create();
        AboutUsSetting::factory(1)->create();
        Banner::factory(3)->create();
        Address::factory(100)->create();
        Coupon::factory(1)->create();
        $this->call(NavigationSettingSeeder::class);
        $this->call(DeliveryAmountSeeder::class);
        $this->call(citySeeder::class);
        $this->call(provinceSeeder::class);
    }
}
