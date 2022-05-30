<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * WeatherService getForecast
     * fetch weather forecast under on what city
     * @param  string $city
     * @return Response
     */
    public function getForecast ($city): Response
    {
        $openWeatherKey = config('app.open_weather_key');

        $response = Http::get('api.openweathermap.org/data/2.5/forecast', [
            'q' => "{$city},JP",
            'appid' => $openWeatherKey
        ]);

        $result = json_decode($response->getBody()->getContents());

        return response([
            'record' => $result
        ]);
    }
}