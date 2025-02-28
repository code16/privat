<?php

use Code16\Privat\Controllers\PrivatController;
use Code16\Privat\Controllers\PrivatWaitingController;
use Code16\Privat\PrivatMiddleware;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::group(['middleware' => [
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    StartSession::class,
    ShareErrorsFromSession::class,
    VerifyCsrfToken::class,
    PrivatMiddleware::class
]], function () {
    Route::get('/privat', [PrivatController::class, 'create']);
    Route::post('/privat', [PrivatController::class, 'store']);
    Route::get('/privat_waiting', [PrivatWaitingController::class, 'index']);
});