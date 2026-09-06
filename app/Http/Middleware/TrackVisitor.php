<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // تسجيل الزوار الذين يزورون صفحات الموقع (ما عدا لوحة التحكم)
        if (!str_contains($request->path(), 'admin') && !str_contains($request->path(), 'login')) {
            $ip = $request->ip();
            $userAgent = $request->userAgent();
            $page = $request->path();

            // التحقق من وجود زائر بنفس IP في آخر 5 دقائق
            $visitor = Visitor::where('ip_address', $ip)
                ->where('last_activity', '>=', now()->subMinutes(5))
                ->first();

            if ($visitor) {
                // تحديث آخر نشاط والصفحة التي زارها
                $visitor->update([
                    'last_activity' => now(),
                    'page_visited' => $page
                ]);
            } else {
                // إنشاء زائر جديد
                Visitor::create([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'page_visited' => $page,
                    'last_activity' => now()
                ]);
            }
        }

        return $next($request);
    }
}
