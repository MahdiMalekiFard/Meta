<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {

});
Route::resource('plan',PlanController::class);
