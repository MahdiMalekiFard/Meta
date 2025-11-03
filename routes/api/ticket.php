<?php

use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
Route::get('data', [TicketController::class, 'data'])->name('data');
});
Route::apiResource('ticket', TicketController::class)->parameter('ticket', 'ticket:uuid');

