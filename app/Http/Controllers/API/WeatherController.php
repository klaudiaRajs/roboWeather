<?php

namespace App\Http\Controllers\API;
use App\Services\WeatherService;
use App\Http\Controllers\Controller;

class WeatherController extends Controller {

    private $service;

    public function __construct(WeatherService $service) {
        $this->service = $service;
    }

    public function weatherForLocation(string $location) {
        if( !ctype_alpha($location) ){
            return response()->json(['error' => 'Please, use only letters without special characters.']); 
        }
        $response = $this->service->getCurrentWeather($location);

        return response()->json($response);
    }

}
