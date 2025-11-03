<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {

});
Route::resource('banner',BannerController::class);
