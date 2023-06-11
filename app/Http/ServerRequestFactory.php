<?php
declare(strict_types=1);

namespace App\Http;

class ServerRequestFactory
{
    public static function build(): ServerRequest
    {
        $path = preg_replace("/\?.*\z/u", "", $_SERVER['REQUEST_URI']);

        return new ServerRequest(
            method: $_SERVER['REQUEST_METHOD'],
            path: $path,
            get: $_GET,
            post: $_POST,
            cookies: $_COOKIE,
            session: $_SESSION,
            files: $_FILES,
            server: $_SERVER,
        );
    }
}