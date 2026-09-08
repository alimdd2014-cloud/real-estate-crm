<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        if (env('ADMIN_NEW_PASSWORD')) {
            DB::table('users')
                ->where('email', 'admin@admin.com')
                ->update([
                    'password' => Hash::make(env('ADMIN_NEW_PASSWORD')),
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        //
    }
};
