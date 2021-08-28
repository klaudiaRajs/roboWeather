<?php

namespace App\Services;

use App\DTOs\WeatherDTO;
use App\Helpers\ApiHelper;

class WeatherService {

    const FEELS_LIKE = "FeelsLikeC";
    const TEMP_C = "temp_C";
    const HUMIDITY = "humidity";
    const VISIBILITY = "visibility";
    const WEATHER_DESC = "weatherDesc";

    //Names match those in field list in WeatherDTO 
    private $fields = [
        "feelsLike" => self::FEELS_LIKE,
        "temperature" => self::TEMP_C,
        "humidity" => self::HUMIDITY,
        "visibility" => self::VISIBILITY,
        "description" => self::WEATHER_DESC
    ];

    public function getCurrentWeather($location) {
        $response = ApiHelper::getWeatherForLocation($location);
        return $this->filterResponse($response["current_condition"]);
    }

    //TODO: refactor. Może rekurencja? 
    private function filterResponse(array $response) {
        $weatherDTO = new WeatherDTO(); 
        foreach ($response as $field => $value) {
            if (is_array($value)) {
                foreach ($value as $innerField => $innerValue) {
                    $weatherDTO = $this->assignToDto($weatherDTO, $innerValue, $innerField);
                    if (is_array($innerValue) && $innerField == self::WEATHER_DESC) {
                        $weatherDTO->description = $innerValue[0]["value"];
                    }
                }
            } else {
                $weatherDTO = $this->assignToDto($weatherDTO, $value, $field);
            }
        }
        return $weatherDTO;
    }
    
    private function assignToDto($weatherDTO, $value, $field) {
        foreach ($this->fields as $dtoName => $fieldName) {
            if ($field == $fieldName) {
                $weatherDTO->$dtoName = $value;
            }
        }
        return $weatherDTO;
    }

}
