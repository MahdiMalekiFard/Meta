<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {

});
Route::resource('profile',ProfileController::class)->except(['index','create','store','destroy','show']);
