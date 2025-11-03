<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\FaqController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {

});
Route::resource('faq',FaqController::class);
