<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. إنشاء جدول جديد بدون قيود ENUM
        Schema::create('properties_new', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type'); // أصبح نصياً (بدون ENUM)
            $table->string('purpose')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('price_optional')->default(true);
            $table->decimal('area', 10, 2);
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->string('city');
            $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('status')->default('available');
            $table->string('owner_name');
            $table->string('owner_phone');
            $table->json('images')->nullable();
            $table->timestamps();
        });

        // 2. نسخ البيانات مع تعيين قيمة افتراضية لـ status إذا كانت NULL
        DB::statement('INSERT INTO properties_new (
            id, title, description, type, purpose, price, price_optional,
            area, length, width, city, neighborhood, latitude, longitude,
            status, owner_name, owner_phone, images, created_at, updated_at
        )
        SELECT
            id, title, description, type, purpose, price, price_optional,
            area, length, width, city, neighborhood, latitude, longitude,
            COALESCE(status, "available"), owner_name, owner_phone, images,
            created_at, updated_at
        FROM properties');

        // 3. حذف الجدول القديم
        Schema::drop('properties');

        // 4. إعادة تسمية الجدول الجديد
        Schema::rename('properties_new', 'properties');
    }

    public function down(): void
    {
        // التراجع: حذف الجدول الجديد وإنشاء القديم
        Schema::dropIfExists('properties');
        // لا يمكن استرجاع الـ ENUM بسهولة، لذا نكتفي بالحذف
    }
};
