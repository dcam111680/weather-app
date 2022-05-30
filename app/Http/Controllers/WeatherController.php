<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    Response
};
use App\Services\WeatherService;

class WeatherController extends Controller
{
    /**
     * @var WeatherService
     */
    protected $weatherService;

    /**
     * WeatherController constructor
     * @param WeatherService $weatherService
     */
    public function __construct (WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * WeatherController getForecast
     * fetch weather forecast under on what city
     * @param  string $city
     * @return Response
     */
    public function getForecast (string $city): Response
    {
        return $this->weatherService->getForecast($city);
    }
}
