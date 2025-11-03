<?php

use App\Http\Controllers\Api\V1\ActivationCodeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'activation-code', 'as' => 'activation-code.'], function () {

});
Route::apiResource('activation-code', ActivationCodeController::class);

