<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['land', 'house', 'apartment']);
            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('price_optional')->default(true);
            $table->decimal('area', 10, 2);
            $table->string('city');
            $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->string('owner_name');
            $table->string('owner_phone');
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
