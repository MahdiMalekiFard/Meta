<?php

use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {

});
Route::apiResource('profile', ProfileController::class);

