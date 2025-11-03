<?php

use App\Http\Controllers\Api\V1\PlanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {

});
Route::apiResource('plan', PlanController::class);

