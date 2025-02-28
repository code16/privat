<?php

namespace Code16\Privat;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PrivatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/privat.php' => config_path('privat.php')
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'privat');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'privat');

        include __DIR__ . '/../routes/privat-routes.php';

        $this->app->booted(function () {
            $router = app(Router::class);

            $groups = is_array(config('privat.middleware_groups'))
                ? config('privat.middleware_groups')
                : explode(',', config('privat.middleware_groups'));

            collect($groups)
                ->each(fn (string $middlewareGroup) => $router
                    ->pushMiddlewareToGroup(
                        $middlewareGroup,
                        PrivatMiddleware::class
                    )
                );
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/privat.php',
            'privat'
        );
    }
}
