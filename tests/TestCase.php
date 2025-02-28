<?php

namespace Code16\Privat\Tests;

use Code16\Privat\PrivatServiceProvider;
use Illuminate\Support\Facades\Route;
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
        Route::middleware('web')->group(function () {
            Route::get('/', fn () => 'ok');
        });
    }
}