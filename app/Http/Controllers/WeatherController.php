<?php

namespace App\Http\Controllers;

use App\Contracts\WeatherProviderInterface;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /** @var \App\Contracts\WeatherProviderInterface */
    protected $weatherProvider;

    public function __construct(WeatherProviderInterface $weatherProvider)
    {
        $this->weatherProvider = $weatherProvider;

        $this->middleware('auth:api');
    }

    public function showCityWeather(Request $request)
    {
        try {
            $requestData = $request->all();

            $weatherText = $this->weatherProvider->getLocationWeather($requestData['city']);

            return response()->json(
                [
                    "weather"  => $weatherText,
                ],
                200
            );
        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response()->json(
                [
                    "error"  => 'Internal system error.',
                ],
                500
            );
        }
    }
}
