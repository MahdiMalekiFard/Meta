<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('confirm', [AuthController::class, 'confirm'])->name('confirm');
Route::post('set-password', [AuthController::class, 'setPassword'])->name('setPassword');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('me', [AuthController::class, 'me'])->name('me');

