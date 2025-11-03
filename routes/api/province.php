<?php

use App\Http\Controllers\Api\V1\ProvinceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'province', 'as' => 'province.'], function () {

});
Route::apiResource('province', ProvinceController::class);

