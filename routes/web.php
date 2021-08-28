<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/weather', [HomeController::class, 'index']);
Route::get('/weather/{location}', [HomeController::class, 'getDataForLocation']);
Route::get('/weatherAction', [HomeController::class, 'getData']);
Route::get('/clearBookmarks', [HomeController::class, 'clearBookmarks']);
