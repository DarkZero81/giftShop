<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. استخدام تنسيقات Tailwind للتنقل بين الصفحات بدلاً من Bootstrap
        Paginator::useTailwind();

        // 2. إجبار السيرفر على استخدام روابط https الآمنة لملفات الـ CSS والـ JS في الاستضافة
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
