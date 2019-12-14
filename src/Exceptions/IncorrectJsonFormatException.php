<?php

namespace Webbash\Kickico\Client\Exceptions;

use Throwable;
use Exception;

/**
 * Class IncorrectJsonFormatException
 * @package Webbash\Kickico\Client\Exceptions
 */
class IncorrectJsonFormatException extends Exception
{
    /**
     * @var string
     */
    private $response;

    /**
     * IncorrectJsonFormatException constructor.
     * @param string $response
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $response = "", $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
}
