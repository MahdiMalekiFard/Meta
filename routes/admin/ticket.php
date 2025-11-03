<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
Route::get('toggle/{ticket}', [TicketController::class, 'toggle'])->name('toggle');
});
Route::resource('ticket',TicketController::class);
