<?php

use App\Http\Controllers\Api\V1\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function () {

});
Route::apiResource('subscription', SubscriptionController::class);

