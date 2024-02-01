<?php

namespace App\Http\Controllers;
use App\Services\NominatimService;

use Illuminate\Http\Request;

class NominatimController extends Controller
{
    protected $nominatimService;

    public function __construct(NominatimService $nominatimService)
    {
        $this->nominatimService = $nominatimService;
    }

    public function geocodeCity($city)
    {
        $result = $this->nominatimService->geocode($city);
        $data = json_decode($result, true);

        // Extraire la latitude et la longitude
        $latitude = $data['lat'];
        $longitude = $data['lon'];

        // Faire quelque chose avec les coordonnées (par exemple, les afficher)
        return $latitude .','. $longitude;
    }
}
