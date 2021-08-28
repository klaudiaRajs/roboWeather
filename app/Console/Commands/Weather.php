<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WeatherService;

class Weather extends Command
{
    protected $signature = 'weather {location}';

    protected $description = 'Display weather for location';
    private $service; 

    
    public function __construct(WeatherService $service)
    {
        parent::__construct();
        $this->service = $service; 
    }

    public function handle()
    {
        $location = $this->argument('location'); 
        if( !ctype_alpha($location) ){
            $this->error("Please enter only letters!"); 
            return 0; 
        }
        
        $weatherDto = $this->service->getCurrentWeather($location);

        $this->line("Feels like: " . $weatherDto->feelsLike ); 
        $this->line("Temperature: " . $weatherDto->temperature ); 
        $this->line("Humidity: " . $weatherDto->humidity ); 
        $this->line("Visibility: " . $weatherDto->visibility ); 
        $this->line("Description: " . $weatherDto->description ); 
               
        return 0; 
    }
}
