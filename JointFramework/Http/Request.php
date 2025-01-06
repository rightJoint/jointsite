<?php

namespace JointFramework\Http;

use JointFramework\Http\Implementation\JointSiteRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;


class Request extends Message implements RequestInterface
{
    private $method;
    private string $protocol;
    private Uri $uri;

    /**
     * @param string                               $method  HTTP method
     * @param string|UriInterface                  $uri     URI
     * @param (string|string[])[]                  $headers Request headers
     * @param string|resource|StreamInterface|null $body    Request body
     * @param string                               $version Protocol version
     */
    public function __construct(
        string $method,
        string $uri,
        array $headers = [],
        $body = null,
        string $version = '1.1'
    ) {
        $this->method = strtoupper($method);

        $this->uri = new Uri($uri);
        $this->protocol = $version;
    }

    public function getRequestTarget(): string
    {

    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {

    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function withMethod(string $method): RequestInterface
    {
        $this->method = $method;
        return $this;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        $this->uri = $uri;
        return $this;
    }
}