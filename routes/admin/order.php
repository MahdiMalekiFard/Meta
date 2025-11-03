<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {

});
Route::resource('order',OrderController::class);
