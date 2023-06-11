<?php
declare(strict_types=1);

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;
use App\Service\AuthUserService;

class PostLoginRequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequest $req): Response
    {
        if (!AuthUserService::verifyCsrfToken($req->post['csrf_token'] ?? '')) {
            return ResponseFactory::buildForbiddenResponse();
        }
        if (!AuthUserService::tryLogin($req->post['username'] ?? '', $req->post['password'] ?? '')) {
            return ResponseFactory::buildRedirectResponse(uri: '/login');
        }

        return ResponseFactory::buildRedirectResponse();
    }
}