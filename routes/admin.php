<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\Admin\CoreController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SharedDataController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

//auth()->loginUsingId(1);
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['locale.admin','admin']], function () {
    Route::get('change-locale/{lang}',[CoreController::class,'changeLocale'])->name('change-locale');
    
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    Route::group(['prefix' => 'select', 'as' => 'select.'], function () {
        Route::get('user', [SharedDataController::class, 'dropdownUsers'])->name('user');
        Route::get('category/{type}', [SharedDataController::class, 'dropdownCategory'])->name('category');
        Route::get('country', [SharedDataController::class, 'dropdownCountry'])->name('country');
        Route::get('province', [SharedDataController::class, 'dropdownProvince'])->name('province');
        Route::get('tag', [SharedDataController::class, 'dropdownTag'])->name('tag');
        Route::get('module', [SharedDataController::class, 'dropdownModule'])->name('module');
    });
    
    $files = array_diff(scandir(__DIR__ . '/admin', SCANDIR_SORT_ASCENDING), ['.', '..']);
    foreach ($files as $file_name) {
        require_once sprintf('admin/%s', $file_name);
    }
});