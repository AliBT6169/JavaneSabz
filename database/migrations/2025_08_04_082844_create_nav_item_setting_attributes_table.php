<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nav_item_setting_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bav_bar_setting_id')->references('id')->on('nav_bar_settings')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_id')->references('id')->on('attributes')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nav_item_setting_attributes');
    }
};
