<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ModuleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'module', 'as' => 'module.'], function () {

});
Route::resource('module',ModuleController::class);
