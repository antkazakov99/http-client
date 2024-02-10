<?php

namespace Ant\Http;

class Response
{
    private int $statusCode;
    private string | null $body;
    private array $headers;

    public function __construct(int $statusCode = 200, array $headers = [], string | null $body = null)
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string | null
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}
