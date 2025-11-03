<?php

use App\Http\Controllers\Api\V1\LocalityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'locality', 'as' => 'locality.'], function () {

});
Route::apiResource('locality', LocalityController::class);

