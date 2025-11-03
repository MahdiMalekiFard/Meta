<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'message', 'as' => 'message.'], function () {

});
Route::resource('message',MessageController::class);
