<?php

namespace Webbash\Kickico\Client\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class IncorrectJsonFormatException
 * @package Webbash\Kickico\Client\Exceptions
 */
class IncorrectJsonFormatException extends Exception
{
    public function report()
    {
        Log::error('Incorrect format JSON in kickico client');
    }
}
