<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PlaceController,
    WeatherController
  };
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'weather', 'controller' => 'WeatherController'], function () {
        Route::get('forecast/{city}', 'App\Http\Controllers\WeatherController@getForecast');
    });
    Route::group(['prefix' => 'place', 'controller' => 'PlaceController'], function () {
        Route::get('/{city}', 'App\Http\Controllers\PlaceController@getPlace');
    });
});
