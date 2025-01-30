<?php

namespace App\Providers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

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
        // Date::use(CarbonImmutable::class);
        // Date::macro('toLocal', function ($value) {
        //     return Carbon::parse($value)->setTimezone(config('app.timezone'));
        // });

        // Configura la zona horaria por defecto
        date_default_timezone_set('America/Lima');

        // Configura Carbon
        Carbon::setLocale('es');
        CarbonImmutable::setLocale('es');

        // Tu macro existente
        Date::use(CarbonImmutable::class);
        Date::macro('toLocal', function ($value) {
            return Carbon::parse($value)->setTimezone(config('app.timezone'));
        });
    }
}
