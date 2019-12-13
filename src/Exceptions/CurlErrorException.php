<?php

namespace Webbash\Kickico\Client\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class CurlErrorException
 * @package Webbash\Kickico\Client\Exceptions
 */
class CurlErrorException extends Exception
{
    public function report()
    {
        Log::error("An CURL error occurred when try to send request to kickico client - {$this->getMessage()}");
    }
}
