<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'favorite', 'as' => 'favorite.'], function () {

});
Route::resource('favorite',FavoriteController::class);
