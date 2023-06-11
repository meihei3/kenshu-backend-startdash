<?php
declare(strict_types=1);

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;
use App\Service\AuthUserService;
use App\Service\PostService;
use JetBrains\PhpStorm\ArrayShape;

class PostPostRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        #[ArrayShape(['post_id' => 'int'])]
        private readonly array $pathParams = []
    )
    {
    }

    public function handle(ServerRequest $req): Response
    {
        if (is_null($user = AuthUserService::getLoggedInUser())) {
            return ResponseFactory::buildRedirectResponse(uri: '/login');
        }
        if (AuthUserService::verifyCsrfToken($req->post['csrf_token'] ?? '') === false) {
            return ResponseFactory::buildForbiddenResponse()
                ->withHeader('Content-Type', 'text/html; charset=utf-8')
                ->withBody('<html lang="ja"><body><h1>403 Forbidden</h1></body></html>');
        }

        $post = PostService::getPost($this->pathParams['post_id']);

        if ($user->id !== $post->authorId) {
            return ResponseFactory::buildForbiddenResponse()
                ->withHeader('Content-Type', 'text/html; charset=utf-8')
                ->withBody('<html lang="ja"><body><h1>403 Forbidden</h1></body></html>');
        }

        PostService::updatePost(
            title: $req->post['title'] ?? '',
            content: $req->post['content'] ?? '',
            prev: $post
        );

        return ResponseFactory::buildRedirectResponse(uri: '/posts/' . $post->id . '/edit');
    }
}