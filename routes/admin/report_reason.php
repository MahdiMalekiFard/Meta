<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\ReportReasonController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'report-reason', 'as' => 'report-reason.'], function () {

});
Route::resource('report-reason',ReportReasonController::class);
