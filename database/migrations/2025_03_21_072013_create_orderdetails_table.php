<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_price');
            $table->integer('quantity');
            $table->string('game_name', 255);
            $table->string('pgame_image', 256);
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('games_id')->constrained('games')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
