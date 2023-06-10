<?php

declare(strict_types=1);

namespace App;

use App\Handler\GetPostListRequestHandler;
use App\Handler\GetPostRequestHandler;
use App\Handler\RequestHandlerInterface;
use App\Handler\NotFoundRequestHandler;

class Route
{
    public static function getHandler(string $method, string $path): RequestHandlerInterface
    {
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListRequestHandler();
        } elseif ($method === 'GET' && preg_match('#^/posts/([0-9]+)$#', $path, $matches)) {
            return new GetPostRequestHandler([
                'user_id' => (int)$matches[1],
            ]);
        }

        return new NotFoundRequestHandler();
    }
}