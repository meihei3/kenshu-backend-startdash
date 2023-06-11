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

    public static function buildRedirectResponse(int $status = 300, string $uri = '/'): Response
    {
        return new Response($status, ['Location' => $uri]);
    }

    public static function buildForbiddenResponse(): Response
    {
        return new Response(403);
    }
}