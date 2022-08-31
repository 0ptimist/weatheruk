<?php

namespace App\Service\Weather;

use App\Contracts\WeatherProviderInterface;
use Illuminate\Support\Facades\Http;

class WeatherApiProvider implements WeatherProviderInterface
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('weatherapi.api_key');
    }

    public function getLocationWeather($location)
    {
        $data = [
            'key'   => $this->apiKey,
            'q' => $location,
            'aqi' => 'no',
        ];

        $response = Http::withOptions(['verify' => config('app.debug') ? false : true])
            ->get(config('weatherapi.current_weather_url'), $data);

        if ($response->status() != '200') {
            return response()->json([
                "message" => trans('weather.location_not_found'),
            ], 404);
        }

        $responseJson = $response->json();

        if (! isset($responseJson['current']['condition']['text'])) {
            return response()->json([
                "message" => trans('weather.wrong_result'),
            ], 400);
        }

        return $responseJson['current']['condition']['text'];
    }
}
