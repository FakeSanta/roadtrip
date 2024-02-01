<?php

namespace App\Services;

use GuzzleHttp\Client;
class NominatimService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://nominatim.openstreetmap.org/';
        $this->apiKey = config('app.nominatim_api_key');
    }

    public function geocode($city)
    {
        $url = "{$this->baseUrl}search.php?q={$city}&format=json&limit=1&key={$this->apiKey}";

        $client = new Client();
        $response = $client->get($url);

        return json_decode($response->getBody()->getContents(), true);
    }
}
