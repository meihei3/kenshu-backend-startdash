<?php

declare(strict_types=1);

namespace App;

use App\Handler\GetPostListHandler;
use App\Handler\HandlerInterface;
use App\Handler\NotFoundHandler;

class Route
{
    public static function getHandler(string $method, string $path): HandlerInterface
    {
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListHandler();
        }

        return new NotFoundHandler();
    }
}