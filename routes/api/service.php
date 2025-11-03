<?php

use App\Http\Controllers\Api\V1\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'service', 'as' => 'service.'], function () {

});
Route::apiResource('service', ServiceController::class);

