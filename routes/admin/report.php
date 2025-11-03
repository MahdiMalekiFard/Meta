<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'report', 'as' => 'report.'], function () {

});
Route::resource('report',ReportController::class);
