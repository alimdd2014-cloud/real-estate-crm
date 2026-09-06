<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_visited',
        'last_activity'
    ];

    // حساب عدد الزوار المتصلين حالياً (خلال آخر 5 دقائق)
    public static function getOnlineCount()
    {
        return self::where('last_activity', '>=', now()->subMinutes(5))->count();
    }

    // حساب إجمالي الزوار
    public static function getTotalCount()
    {
        return self::count();
    }

    // حساب زوار اليوم
    public static function getTodayCount()
    {
        return self::whereDate('created_at', today())->count();
    }

    // حساب زوار هذا الشهر
    public static function getMonthCount()
    {
        return self::whereMonth('created_at', now()->month)->count();
    }
}
