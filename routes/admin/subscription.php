<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function () {

});
Route::resource('subscription',SubscriptionController::class);
