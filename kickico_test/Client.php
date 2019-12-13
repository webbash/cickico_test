<?php

namespace Webbash\Kickico\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Client
 * @package Webbash\Kickico\Client
 */
class Client
{
    /**
     * @var array
     */
    protected $config;

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
        $this->config = $config;

        $this->client = new GuzzleClient($this->config['client_settings']);
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array $options
     */
    public function request(string $uri, string $method, array $options = [])
    {
        try {
            $request = $this->client->request($method, $uri, $options);
        } catch (RequestException $e) {
            // TODO Обработать ошибку
        }
    }
}
