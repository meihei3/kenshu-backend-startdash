<?php
declare(strict_types=1);

namespace App\Http;

readonly class Response
{
    public function __construct(
        public int    $status,
        public array  $headers = [],
        public string $body = '',
    )
    {
    }

    public function withHeader(string $key, string $value): Response
    {
        $headers = $this->headers;
        $headers[$key] = $value;

        return new Response($this->status, $headers, $this->body);
    }

    public function withBody(string $body): Response
    {
        return new Response($this->status, $this->headers, $body);
    }
}