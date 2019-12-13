<?php

namespace Webbash\Kickico\Client\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class JsonErrorException
 * @package Webbash\Kickico\Client\Exceptions
 */
class JsonErrorException extends Exception
{
    public function report()
    {
        Log::error(
            "Failing when try to get json content from kickico client - {$this->getMessage()}",
            $this->getTrace()
        );
    }
}
