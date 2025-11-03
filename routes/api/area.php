<?php

use App\Http\Controllers\Api\V1\AreaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'area', 'as' => 'area.'], function () {

});
Route::apiResource('area', AreaController::class);

