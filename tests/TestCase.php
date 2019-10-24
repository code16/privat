<?php

namespace Code16\Privat\Tests;

use Code16\Privat\PrivatMiddleware;
use Code16\Privat\PrivatServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders( $app ) {
        return [ PrivatServiceProvider::class ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp( $app ) {
        $app['config']->set( 'app.key', Str::random( 32 ) );

        $app->make( Kernel::class )->pushMiddleware(
            PrivatMiddleware::class
        );


        $app['config']->set( 'app.key', \Str::random( 32 ) );

        return $app;
    }

}
