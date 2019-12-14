<?php

namespace Webbash\Kickico\Client\DTO;

use Psr\Http\Message\ResponseInterface;
use Spatie\DataTransferObject\DataTransferObject;
use Webbash\Kickico\Client\Exceptions\IncorrectJsonFormatException;

/**
 * Class Response
 * @package Webbash\Kickico\Client\DTO
 */
class Response extends DataTransferObject
{
    /**
     * @var
     */
    public $data;

    /**
     * @var bool
     */
    public $success;

    /**
     * @param ResponseInterface $response
     * @return Response
     * @throws IncorrectJsonFormatException
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $json = (string) $response->getBody();
        $body = json_decode($json, true);

        if (! $body) {
            throw new IncorrectJsonFormatException($json);
        }

        if (! isset($body['data']) || ! isset($body['success'])) {
            throw new IncorrectJsonFormatException($json);
        }

        $success = (bool) $body['success'];

        // If does not exist message or code in response
        if (! $success && (! isset($body['data'][0]['message']) || ! isset($body['data'][0]['code']))) {
            throw new IncorrectJsonFormatException($json);
        }

        return new self([
            'data' => $success ? $body['data'] : $body['data'][0],
            'success' => $body['success'],
        ]);
    }
}
