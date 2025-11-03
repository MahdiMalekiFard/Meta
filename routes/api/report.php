<?php

use App\Http\Controllers\Api\V1\ReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'report', 'as' => 'report.'], function () {

});
Route::apiResource('report', ReportController::class);

