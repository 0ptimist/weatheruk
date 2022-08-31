<?php

namespace App\Contracts;

interface WeatherProviderInterface
{
    public function getLocationWeather($location);
}
