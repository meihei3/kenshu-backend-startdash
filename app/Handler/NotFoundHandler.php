<?php

namespace App\Handler;

class NotFoundHandler implements HandlerInterface
{

    public function __construct()
    {
    }

    public function run(array $req): array
    {
        return [
            "status_code" => 404,
            "body" => "<html>Not Found.</html>"
        ];
    }
}