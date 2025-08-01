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
        Schema::create('call_to_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->text('text');
            $table->boolean('seen')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_to_admins');
    }
};
