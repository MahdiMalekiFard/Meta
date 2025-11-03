<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notice', 'as' => 'notice.'], function () {

});
Route::resource('notice',NoticeController::class);
