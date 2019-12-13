<?php

namespace Webbash\Kickico\Client;

use Illuminate\Support\ServiceProvider;

/**
 * Class KickicoClientServiceProvider
 * @package Webbash\Kickico\Client
 */
class KickicoClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/kickico_client.php', 'kickico_client');
    }
}
