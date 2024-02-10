<?php

namespace Ant\Http;

class Request
{
    private Method $method;
    private string $uri;
    private string | null $body;
    /**
     * todo change on something like headerCollection mb
     * @var string[][]
     */
    private array $headers;

    public function __construct(Method $method = Method::GET, string $uri = '', array $headers = [], string | null $body = null)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function setMethod(Method $method): Request
    {
        $this->method = $method;
        return $this;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): Request
    {
        $this->uri = $uri;
        return $this;
    }

    public function getBody(): string | null
    {
        return $this->body;
    }

    public function setBody(string | null $body): Request
    {
        $this->body = $body;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): Request
    {
        $this->headers = $headers;
        return $this;
    }
}
