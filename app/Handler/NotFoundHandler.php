<?php

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;

class NotFoundHandler implements HandlerInterface
{

    public function __construct()
    {
    }

    public function run(ServerRequest $req): Response
    {
        $body = '<html>Not Found.</html>';

        return ResponseFactory::buildNotFound()
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withBody($body);
    }
}