<?php

namespace Code16\Privat\Tests;

use Code16\Privat\PrivatMiddleware;
use Code16\Privat\PrivatServiceProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        config()->set('privat.middleware_groups', 'web');
    }

    protected function getPackageProviders($app)
    {
        return [PrivatServiceProvider::class];
    }

    protected function defineEnvironment($app)
    {
        Route::middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            PrivatMiddleware::class
        ])->group(function () {
            Route::get('/', fn () => 'ok');
        });
    }
}