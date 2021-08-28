<?php

namespace App\Helpers; 

use Illuminate\Support\Facades\Http;

class ApiHelper {
    const WEATHER_API_LINK = "wttr.in/%s?format=j1";

    public static function getWeatherForLocation(string $location){
        //TODO dodać obsługę wyjątków. 
        return Http::get(sprintf(self::WEATHER_API_LINK, $location));
    }
}
