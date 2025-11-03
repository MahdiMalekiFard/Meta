<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {

});
Route::resource('blog',BlogController::class);
