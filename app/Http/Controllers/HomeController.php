<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\BookmarkFileHelper;

class HomeController extends Controller {

    private $service;
    private $bookmarks;
    private $file;

    const FILE_NAME = 'bookmarks.csv';

    public function __construct(WeatherService $service) {
        $this->service = $service;
        $this->file = Storage::get(self::FILE_NAME);
        $this->getBookmarks();
    }

    public function index() {
        return view('home', [
            'bookmarks' => $this->bookmarks, 
            'error' => false 
        ]);
    }

    public function getData(Request $request) {
        $location = $request->location;
        if (isset($request->saveLocation) && !$this->containInvalidCharacters($location)) {
            BookmarkFileHelper::saveBookmark($location, $this->file);
            $this->getBookmarks();
        }
        $weatherDto = $this->service->getCurrentWeather($location);

        return view('weather', [
            'weatherDto' => $weatherDto,
            'location' => $location,
            'bookmarks' => $this->bookmarks,
            'error' => $this->containInvalidCharacters($location)
        ]);
    }

    public function getDataForLocation(string $location) {
        $weatherDto = $this->service->getCurrentWeather($location);

        return view('weather', [
            'weatherDto' => $weatherDto,
            'location' => $location,
            'bookmarks' => $this->bookmarks, 
            'error' => $this->containInvalidCharacters($location)
        ]);
    }

    public function clearBookmarks() {
        Storage::disk('local')->put(self::FILE_NAME, "");
        return redirect('/weather');
    }
    
    private function containInvalidCharacters($input){
        return !ctype_alpha($input); 
    }

    private function getBookmarks() {
        $cities = array_filter(explode(",", $this->file));
        $this->bookmarks = $cities;
    }    
}
