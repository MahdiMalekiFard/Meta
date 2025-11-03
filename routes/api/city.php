<?php

use App\Http\Controllers\Api\V1\CityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'city', 'as' => 'city.'], function () {

});
Route::apiResource('city', CityController::class);

