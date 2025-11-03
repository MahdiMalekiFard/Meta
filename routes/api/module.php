<?php

use App\Http\Controllers\Api\V1\ModuleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'module', 'as' => 'module.'], function () {

});
Route::apiResource('module', ModuleController::class);

