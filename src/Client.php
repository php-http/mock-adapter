<?php

namespace Http\Mock;

use Http\Client\Common\HttpAsyncClientEmulator;
use Http\Client\Common\VersionBridgeClient;
use Http\Client\Exception;
use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\ResponseFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * An implementation of the HTTP client that is useful for automated tests.
 *
 * This mock does not send requests but stores them for later retrieval.
 * You can configure the mock with responses to return and/or exceptions to throw.
 *
 * @author David de Boer <david@ddeboer.nl>
 */
class Client implements HttpClient, HttpAsyncClient
{
    use HttpAsyncClientEmulator;
    use VersionBridgeClient;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var RequestInterface[]
     */
    private $requests = [];

    /**
     * @var ResponseInterface[]
     */
    private $responses = [];

    /**
     * @var ResponseInterface|null
     */
    private $defaultResponse;

    /**
     * @var Exception[]
     */
    private $exceptions = [];

    /**
     * @var Exception|null
     */
    private $defaultException;

    public function __construct(ResponseFactory $responseFactory = null)
    {
        $this->responseFactory = $responseFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * {@inheritdoc}
     */
    public function doSendRequest(RequestInterface $request)
    {
        $this->requests[] = $request;

        if (count($this->exceptions) > 0) {
            throw array_shift($this->exceptions);
        }

        if (count($this->responses) > 0) {
            return array_shift($this->responses);
        }

        if ($this->defaultException) {
            throw $this->defaultException;
        }

        if ($this->defaultResponse) {
            return $this->defaultResponse;
        }

        // Return success response by default
        return $this->responseFactory->createResponse();
    }

    /**
     * Adds an exception that will be thrown.
     */
    public function addException(\Exception $exception)
    {
        $this->exceptions[] = $exception;
    }

    /**
     * Sets the default exception to throw when the list of added exceptions and responses is exhausted.
     *
     * If both a default exception and a default response are set, the exception will be thrown.
     */
    public function setDefaultException(\Exception $defaultException = null)
    {
        $this->defaultException = $defaultException;
    }

    /**
     * Adds a response that will be returned in first in first out order.
     */
    public function addResponse(ResponseInterface $response)
    {
        $this->responses[] = $response;
    }

    /**
     * Sets the default response to be returned when the list of added exceptions and responses is exhausted.
     */
    public function setDefaultResponse(ResponseInterface $defaultResponse = null)
    {
        $this->defaultResponse = $defaultResponse;
    }

    /**
     * Returns requests that were sent.
     *
     * @return RequestInterface[]
     */
    public function getRequests()
    {
        return $this->requests;
    }

    public function getLastRequest()
    {
        return end($this->requests);
    }
}
