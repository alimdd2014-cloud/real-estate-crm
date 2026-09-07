<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // تحويل type من ENUM إلى نص
        Schema::table('properties', function (Blueprint $table) {
            $table->string('type')->change();
        });

        // تحويل status من ENUM إلى نص مع القيمة الافتراضية
        Schema::table('properties', function (Blueprint $table) {
            $table->string('status')->default('available')->change();
        });
    }

    public function down(): void
    {
        // إعادة type إلى ENUM
        Schema::table('properties', function (Blueprint $table) {
            $table->enum('type', ['land', 'house', 'apartment'])->change();
        });

        // إعادة status إلى ENUM
        Schema::table('properties', function (Blueprint $table) {
            $table->enum('status', ['available', 'reserved', 'sold'])
                  ->default('available')
                  ->change();
        });
    }
};
