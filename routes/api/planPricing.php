<?php

use App\Http\Controllers\Api\V1\PlanPricingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'plan-pricing', 'as' => 'plan-pricing.'], function () {

});
Route::apiResource('plan-pricing', PlanPricingController::class);

