<?php

use App\Http\Controllers\API;
use Illuminate\Support\Facades\Route;

Route::get('tickets/statistics', [API\TicketController::class, 'statistics']);
Route::post('tickets', [API\TicketController::class, 'store']);
