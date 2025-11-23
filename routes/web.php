<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;

Route::view('/', 'welcome')->name('welcome');

Route::get('widget', fn () => view('widget'))
    ->name('widget.show');

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [Web\AuthController::class, 'login'])->name('login.post');
});

Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::resource('tickets', Web\TicketController::class)
        ->only(['index', 'show', 'update']);

    Route::get('download/{media}', [Web\MediaController::class, 'download'])->name('download.media');
});

