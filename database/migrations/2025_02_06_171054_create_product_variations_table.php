<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('value');
            $table->string('weight');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('off_sale')->default(0);
            $table->unsignedInteger('sailed_quantity')->default(0);
            $table->string('sku')->nullable();
            $table->unsignedInteger('sale_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
