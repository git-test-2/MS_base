<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Добавляем созданный нами файл с правилами маршрутизации для админПанели
            // и в отличии от роута на сайт нам нужно добавить префикс ->prefix('admin'), чтобы все url`ы админПанели начинались с admin
            // начинатся будут с ->name('admin.') , а далее будут идти неймы с роутов
            // все роуты переписываются в одном месте (роуты сайта и роуты админа), потом проверяются через - php artisan route:list
            Route::middleware('admin') // основная группа мидлваров добавляем только что созданную 'admin' из app\Http\Kernel.php
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php')); //назвали admin.php
            // !!! важно добавить  ->prefix, в отличии от других url`ов на сайте

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
