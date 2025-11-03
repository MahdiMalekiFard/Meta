<?php

use App\Http\Controllers\Api\V1\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {

});
Route::apiResource('banner', BannerController::class);

