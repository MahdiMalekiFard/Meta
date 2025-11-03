<?php

use App\Http\Controllers\Api\V1\ServerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'server', 'as' => 'server.'], function () {

});
Route::apiResource('server', ServerController::class)->parameter('server', 'server:uuid');

