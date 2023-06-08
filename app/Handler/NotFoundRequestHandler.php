<?php
declare(strict_types=1);

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;

class NotFoundRequestHandler implements RequestHandlerInterface
{

    public function __construct()
    {
    }

    public function handle(ServerRequest $req): Response
    {
        $body = '<html>Not Found.</html>';

        return ResponseFactory::buildNotFound()
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withBody($body);
    }
}