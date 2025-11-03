<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ServerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'server', 'as' => 'server.'], function () {

});
Route::resource('server',ServerController::class);
