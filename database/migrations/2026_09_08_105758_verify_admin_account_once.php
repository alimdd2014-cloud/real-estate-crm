<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up(): void
    {
        $count = DB::table('users')
            ->where('email', 'admin@admin.com')
            ->count();

        Log::info('ADMIN CHECK', [
            'email' => 'admin@admin.com',
            'count' => $count,
        ]);
    }

    public function down(): void
    {
        //
    }
};
