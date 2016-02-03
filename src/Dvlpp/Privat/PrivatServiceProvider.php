<?php

namespace Dvlpp\Privat;

use Dvlpp\Merx\Console\MigrateDb;
use Illuminate\Support\ServiceProvider;

class PrivatServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../../../resources/privat.php' => config_path('privat.php')
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../../../resources/views', 'privat');
        $this->loadTranslationsFrom(__DIR__ . '/../../../resources/lang', 'privat');

        // Include Privat's routes.php file
        include __DIR__ . '/../../privat-routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
