<?php

declare(strict_types=1);

use App\Enums\CategoryTypeEnum;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

Route::group(['prefix' => 'category/{type}', 'as' => 'category.'], function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/', [CategoryController::class, 'index'])->name('index');
});

