<?php


abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('privat.restricted', true);
        $this->app['config']->set('privat.password', 'aaa');
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(\Dvlpp\Privat\PrivatServiceProvider::class);

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

}