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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->unsignedInteger('status')->default(1);
            $table->unsignedInteger('percentage');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('max_amount');
            $table->timestamp('expired_at')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('couponable_id');
            $table->string('couponable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
