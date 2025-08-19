<?php

use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\LastFmController;
use App\Http\Controllers\ReleasesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["middleware" => ["api"]], function () {
    // Artists
    Route::get('/Artists/search', [ArtistsController::class, 'search']);
    Route::get('/Artists/get', [ArtistsController::class, 'get']);

    // Releases
    Route::get('/Releases/searchReleaseGroup', [ReleasesController::class, 'searchReleaseGroup']);
    Route::get('/Releases/getReleaseGroup', [ReleasesController::class, 'getReleaseGroup']);

    // LastFM
    Route::get('/LastFm/test', [LastFmController::class, 'test']);
});
