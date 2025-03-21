<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('price');
            $table->integer('sale')->nullable();
            $table->string('image', 800);
            $table->string('video', 1000)->nullable();
            $table->string('short_description', 500)->nullable();
            $table->text('detailed_description')->nullable();
            $table->tinyInteger('rating')->default(0);
            $table->string('views', 100)->default(0);
            $table->string('tags', 100);
            $table->integer('sold')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
