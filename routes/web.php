<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;

Route::get('widget', fn () => view('widget'))
    ->name('widget.show');

//Route::middleware(['auth'])->group(function () {
Route::resource('tickets', Web\TicketController::class)
    ->only(['index', 'show', 'update']);

Route::get('download/{media}', [Web\MediaController::class, 'download'])->name('download.media');
//});

Route::view('/', 'welcome')->name('welcome');
