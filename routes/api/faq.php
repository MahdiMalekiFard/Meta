<?php

use App\Http\Controllers\Api\V1\FaqController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {

});
Route::apiResource('faq', FaqController::class);

