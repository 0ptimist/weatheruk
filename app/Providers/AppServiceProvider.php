<?php

namespace App\Providers;

use App\Contracts\WeatherProviderInterface;
use App\Service\Weather\WeatherApiProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherProviderInterface::class, WeatherApiProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
