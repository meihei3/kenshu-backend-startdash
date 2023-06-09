<?php

declare(strict_types=1);

namespace App;

use App\Handler\GetLoginRequestHandler;
use App\Handler\GetPostEditRequestHandler;
use App\Handler\GetPostListRequestHandler;
use App\Handler\GetPostRequestHandler;
use App\Handler\NotFoundRequestHandler;
use App\Handler\PostLoginRequestHandler;
use App\Handler\PostPostRequestHandler;
use App\Handler\RequestHandlerInterface;

class Route
{
    public static function resolve(string $method, string $path): RequestHandlerInterface
    {
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListRequestHandler();

        } elseif ($method === 'GET' && preg_match('#^/posts/([0-9]+)$#', $path, $matches)) {
            return new GetPostRequestHandler([
                'post_id' => (int)$matches[1],
            ]);

        } elseif ($method === 'POST' && preg_match('#^/posts/([0-9]+)$#', $path, $matches)) {
            return new PostPostRequestHandler([
                'post_id' => (int)$matches[1],
            ]);

        } elseif ($method === 'GET' && preg_match('#^/posts/([0-9]+)/edit$#', $path, $matches)) {
            return new GetPostEditRequestHandler([
                'post_id' => (int)$matches[1],
            ]);

        } elseif ($method === 'GET' && $path === "/login") {
            return new GetLoginRequestHandler();

        } elseif ($method === 'POST' && $path === "/login") {
            return new PostLoginRequestHandler();
        }

        return new NotFoundRequestHandler();
    }
}