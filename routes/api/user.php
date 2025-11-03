<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
   Route::get('block/{user}')->name('block');
});
Route::apiResource('user', UserController::class);