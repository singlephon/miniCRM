<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;

Route::get('/', function () {
    return view('welcome');
});

Route::get('widget', function (Request $request) {});

//Route::middleware(['auth'])->group(function () {
Route::resource('tickets', Web\TicketController::class)->only(['index', 'show', 'update']);
//});
