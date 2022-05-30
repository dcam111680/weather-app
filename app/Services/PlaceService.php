<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PlaceService
{
    /**
     * PlaceService getPlace
     * fetch places/venues under on what city
     * @param  string $city
     * @return Response
     */
    public function getPlace (string $city): Response
    {
        $geoKey = config('app.geoapify_key');

        $response = Http::get('https://api.geoapify.com/v1/geocode/search', [
            'city' => "{$city}",
            'country' => 'Japan',
            'apiKey' => $geoKey
        ]);

        $result = json_decode($response->getBody()->getContents());

        return response([
            'record' => $result
        ]);
    }
}
