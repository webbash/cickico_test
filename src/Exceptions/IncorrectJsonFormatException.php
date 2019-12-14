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
    private $json;

    /**
     * IncorrectJsonFormatException constructor.
     * @param string $json
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $json = "", $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->json = $json;
    }

    /**
     * @return string
     */
    public function getJson()
    {
        return $this->json;
    }
}
