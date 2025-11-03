<?php

use App\Http\Controllers\Api\V1\CountryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'country', 'as' => 'country.'], function () {

});
Route::apiResource('country', CountryController::class);

