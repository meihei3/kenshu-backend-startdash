<?php
declare(strict_types=1);

namespace App\Http;

readonly class ServerRequest
{
    public function __construct(
        public string $method,
        public string $path,
        public array $get = [],
        public array $post = [],
        public array $cookies = [],
        public array $session = [],
        public array $files = [],
        public array $server = [],
    ) {
    }
}