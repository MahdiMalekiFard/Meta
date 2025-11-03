<?php

use App\Http\Controllers\Api\V1\ReportReasonController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'report-reason', 'as' => 'report-reason.'], function () {

});
Route::apiResource('report-reason', ReportReasonController::class);

