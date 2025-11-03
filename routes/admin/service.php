<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'service', 'as' => 'service.'], function () {

});
Route::resource('service',ServiceController::class);
