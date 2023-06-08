<?php

declare(strict_types=1);

namespace App;

use App\Handler\GetPostListRequestHandler;
use App\Handler\RequestHandlerInterface;
use App\Handler\NotFoundRequestHandler;

class Route
{
    public static function getHandler(string $method, string $path): RequestHandlerInterface
    {
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListRequestHandler();
        }

        return new NotFoundRequestHandler();
    }
}