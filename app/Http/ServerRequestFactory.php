<?php
declare(strict_types=1);

namespace App\Http;

class ServerRequestFactory
{
    public static function build(): ServerRequest
    {
        return new ServerRequest(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES,
            $_SERVER,
        );
    }
}