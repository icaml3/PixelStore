<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rating')->default(1);
            $table->string('images', 1000);
            $table->string('comment', 750);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('orderdetail_id')->constrained('orderdetails')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
