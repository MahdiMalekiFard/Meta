<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//auth()->loginUsingId(1);
//User::find(1)->createToken('tst')->plainTextToken;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'api/v1', 'as' => 'api.v1.'], function () {
    $path = __DIR__ . '/api';
    $files = array_diff(scandir($path, SCANDIR_SORT_NONE), ['.', '..']);
    foreach ($files as $file) {
        require "api/{$file}";
    }
});


