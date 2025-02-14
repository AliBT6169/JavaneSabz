<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\BuyCart\BuyCart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory(100)->create()->unique;
//        Brand::factory(20)->create()->unique;
//        Category::factory(20)->create()->unique();
//        Product::factory(100)->create()->unique();
//        Attribute::factory(2)->create()->unique();
//        ProductVariation::factory(100)->create()->unique;
//        BuyCart::factory(100)->create();
//        Address::factory(100)->create();
//        Order::factory(100)->create();
        OrderItem::factory(100)->create();
    }
}
