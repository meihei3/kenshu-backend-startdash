<?php
declare(strict_types=1);

namespace App\Handler;

use App\Http\ResponseFactory;
use App\Http\ServerRequest;
use App\Http\Response;
use App\Http\Session;

class GetLoginRequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequest $req): Response
    {
        $csrfToken = \bin2hex(\random_bytes(32));
        Session::getInstance()->set('csrf_token', $csrfToken);

        $body = self::render($csrfToken);

        return ResponseFactory::buildSuccess()
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withBody($body);
    }

    private static function render(string $csrfToken): string
    {
        $body = '<html lang="ja"><body>';
        $body .= '<form method="post" action="/login">';
        $body .= '<input type="text" name="username" placeholder="username" />';
        $body .= '<input type="password" name="password" placeholder="password" />';
        $body .= '<input type="hidden" name="csrf_token" value="' . $csrfToken . '" />';
        $body .= '<input type="submit" value="ログイン" />';
        $body .= '</form>';
        $body .= '</body></html>';

        return $body;
    }
}