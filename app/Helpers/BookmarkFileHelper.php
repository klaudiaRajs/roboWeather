<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class BookmarkFileHelper {
    
    const FILE_NAME = 'bookmarks.csv';
    
    public static function saveBookmark($location, $file) {
        if (!self::alreadySaved($file, $location)) {
            $toSave = $file . "," . $location;
            Storage::disk('local')->put(self::FILE_NAME, $toSave);
        }
    }  
    
    public static function getBookmarksArray($bookmarks){
        return $cities = explode(",", $bookmarks);
    }

    private static function alreadySaved($bookmarks, $location) {
        $cities = self::getBookmarksArray($bookmarks);
        foreach ($cities as $city) {
            if ($city == $location) {
                return true;
            }
        }
        return false;
    }

}
