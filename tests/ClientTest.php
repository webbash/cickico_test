<?php

namespace Webbash\Kickico\Client\Test;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use Webbash\Kickico\Client\Client;
use GuzzleHttp\Handler\MockHandler;

/**
 * Class ClientTest
 * @package Webbash\Kickico\Client\tests
 */
class ClientTest extends TestCase
{
    /**
     * Test success request
     *
     * @test
     */
    public function testRequest()
    {
        // Get Client with already defined response in queue for test this response
        $client = $this->getClientWithResponse($this->getSuccessResponse());

        $this->assertIsArray($client->sendRequest('suggestions', 'GET'));
    }

    /**
     * Test failure request (server error)
     *
     * @test
     */
    public function testErrorRequest()
    {
        // Get Client with already defined response in queue for test this response
        $client = $this->getClientWithResponse($this->getErrorResponse());

        $this->assertIsBool($client->sendRequest('suggestions', 'GET'));
    }

    /**
     * @test
     */
    public function testIncorrectFormatRequest()
    {
        $client = $this->getClientWithResponse($this->getIncorrectFormatResponse());

        $this->assertIsBool($client->sendRequest('suggestions', 'GET'));
    }

    /**
     * Get client with mock guzzle with defined response
     *
     * @param Response $response Already defined response
     * @return mixed
     */
    private function getClientWithResponse(Response $response)
    {
        // Create mock response
        $mock = new MockHandler([$response]);
        // Create handler for response
        $handler = HandlerStack::create($mock);

        return $this->app->makeWith(Client::class, ['config' => compact('handler')]);
    }

    /**
     * @return Response
     */
    private function getSuccessResponse()
    {
        return new Response(200, ['Content-Type' => 'application/json'], $this->getSuccessResponseJson());
    }

    /**
     * @return Response
     */
    private function getErrorResponse()
    {
        return new Response(500, ['Content-Type' => 'application/json'], $this->getErrorResponseJson());
    }

    /**
     * @return Response
     */
    private function getIncorrectFormatResponse()
    {
        return new Response(200, ['Content-Type' => 'application/json'], $this->getIncorrectFormatResponseJson());
    }

    /**
     * @return false|string
     */
    private function getSuccessResponseJson()
    {
        return json_encode([
            'data' => [
                'suggestions' => [],
            ],
            'success' => true,
        ]);
    }

    /**
     * @return false|string
     */
    private function getErrorResponseJson()
    {
        return json_encode([
            'data' => [
                [
                    'code' => 1020,
                    'message' => 'Access forbidden',
                ],
            ],
            'success' => false,
        ]);
    }

    /**
     * @return false|string
     */
    private function getIncorrectFormatResponseJson()
    {
        return json_encode([
            'suggestions' => [],
            'success' => true,
        ]);
    }
}
