<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\PlanPricingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'plan-pricing', 'as' => 'plan-pricing.'], function () {

});
Route::resource('plan-pricing',PlanPricingController::class);
