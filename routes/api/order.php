<?php

use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
Route::post('start-test-period',[OrderController::class, 'startTestPeriod'])->name('start-test-period');
});
Route::apiResource('order', OrderController::class);

