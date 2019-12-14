<?php

namespace Webbash\Kickico\Client;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class KickicoClientServiceProvider
 * @package Webbash\Kickico\Client
 */
class KickicoClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/config/kickico_client.php' => config_path('kickico_client.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->app->bind('kickico_client', function(Application $app) {
            return $app->make(Client::class, ['config' => $app['config']['kickico_client']]);
        });
    }
}
