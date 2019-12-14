<?php

namespace Webbash\Kickico\Client\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Client
 * @package Webbash\Kickico\Client\Facades
 */
class Client extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kickico_client';
    }
}
