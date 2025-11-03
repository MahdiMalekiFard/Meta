<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\OrderItemController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order-item', 'as' => 'order-item.'], function () {

});
Route::resource('order-item',OrderItemController::class);
