<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\LikeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'like', 'as' => 'like.'], function () {

});
Route::resource('like',LikeController::class);
