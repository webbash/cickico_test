<?php

namespace Webbash\Kickico\Client;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as GuzzleClient;
use Webbash\Kickico\Client\DTO\Response;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Webbash\Kickico\Client\Exceptions\IncorrectJsonFormatException;

/**
 * Class Client
 * @package Webbash\Kickico\Client
 */
class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->client = new GuzzleClient($config);
    }

    /**
     * Send request to Kickico Client.
     *
     * @param string $uri
     * @param string $method
     * @param array $options
     * @return array|bool
     */
    public function sendRequest(string $uri, string $method, array $options = [])
    {
        try {
            $response = $this->client->request($method, $uri, $options);

            $response = Response::fromResponse($response);

            return $response->toArray();
        } catch (IncorrectJsonFormatException $e) {
            Log::error('Incorrect format JSON in kickico client', [
                'json' => $e->getJson(),
            ]);

            return false;
        } catch (ConnectException $e) {
            Log::error("Cannot connect to kickico client - {$e->getMessage()}");

            return false;
        } catch (ServerException $e) {
            $response = $e->getResponse();

            try {
                $response = Response::fromResponse($response);
            } catch (IncorrectJsonFormatException $e) {
                Log::error('Incorrect format JSON in kickico client', [
                    'json' => $e->getJson(),
                ]);

                return false;
            }

            Log::error("Error on kickico client - {$e->getMessage()}", [
                'message' => $response->data['message'],
                'code' => $response->data['code'],
            ]);

            return false;
        }
    }
}
