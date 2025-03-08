<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\BuyCart\BuyCart;
use App\Models\Category;
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
        User::factory(1)->create()->unique;
        Gallery::factory(1)->create();
        Brand::factory(20)->create()->unique;
        Category::factory(20)->create()->unique();
        Product::factory(200)->create()->unique();
        Attribute::factory(2)->create()->unique();
        ProductVariation::factory(100)->create()->unique;
//        BuyCart::factory(10)->create();
        Address::factory(1)->create();
        Order::factory(10)->create();
        OrderItem::factory(100)->create();
        Transaction::factory(10)->create();
        Wishlist::factory(50)->create();

    }
}
