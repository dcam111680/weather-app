<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    Response
};
use App\Services\PlaceService;

class PlaceController extends Controller
{
    /**
     * @var PlaceService
     */
    protected $placeService;

    /**
     * PlaceController constructor
     * @param PlaceService $placeService
     */
    public function __construct (PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    /**
     * PlaceController getPlace
     * fetch places/venues under on what city
     * @param  string $city
     * @return Response
     */
    public function getPlace (string $city): Response
    {
        return $this->placeService->getPlace($city);
    }
}
