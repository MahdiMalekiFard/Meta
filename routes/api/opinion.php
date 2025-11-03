<?php

use App\Http\Controllers\Api\V1\OpinionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'opinion', 'as' => 'opinion.'], function () {

});
Route::apiResource('opinion', OpinionController::class);

