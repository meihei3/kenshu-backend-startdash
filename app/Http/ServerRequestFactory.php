<?php
declare(strict_types=1);

namespace App\Http;

class ServerRequestFactory
{
    public static function build(): ServerRequest
    {
        $path = preg_replace("/\?.*\z/u", "", $_SERVER['REQUEST_URI']);

        return new ServerRequest(
            $_SERVER['REQUEST_METHOD'],
            $path,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES,
            $_SERVER,
        );
    }
}