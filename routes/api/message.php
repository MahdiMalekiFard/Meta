<?php

use App\Http\Controllers\Api\V1\MessageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'message', 'as' => 'message.'], function () {
Route::get('/{ticket:uuid}', [MessageController::class, 'index'])->name('index');
Route::post('/{ticket:uuid}', [MessageController::class, 'store'])->name('store');
});
Route::apiResource('message', MessageController::class)->except(['index', 'store']);

