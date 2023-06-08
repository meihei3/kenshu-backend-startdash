<?php
declare(strict_types=1);

namespace App\Http;

class ResponseFactory
{
    public static function buildSuccess(): Response
    {
        return new Response(200);
    }

    public static function buildNotFound(): Response
    {
        return new Response(404);
    }
}