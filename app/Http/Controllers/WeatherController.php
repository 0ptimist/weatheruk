<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function showCityWeather(Request $request)
    {
        return response()->json(
            [
                "weather"  => 'Good',
            ],
            200
        );
    }
}
