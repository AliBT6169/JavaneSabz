<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\BuyCart\BuyCart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariation;
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
        $this->call(provinceSeeder::class);
        $this->call(citySeeder::class);
        $this->call(DeliveryAmountSeeder::class);
        User::factory(100)->create()->unique;
//        User Gallery
//        Gallery::factory(1)->create();
//        Product Gallery
//        Gallery::factory(100)->create();
        Brand::factory(50)->create()->unique;
        Category::factory(50)->create()->unique();
//        Product::factory(200)->create()->unique();
        Attribute::factory(50)->create()->unique();
//        ProductVariation::factory(200)->create()->unique;
        Address::factory(100)->create();
        Coupon::factory(1)->create();
//        Order::factory(10)->create();
//        OrderItem::factory(100)->create();
//        Transaction::factory(10)->create();
    }
}
