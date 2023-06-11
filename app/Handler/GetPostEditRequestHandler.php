<?php
declare(strict_types=1);

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;
use App\Http\Session;
use App\Model\Post;
use App\Service\PostService;
use App\Service\AuthUserService;
use JetBrains\PhpStorm\ArrayShape;

class GetPostEditRequestHandler implements RequestHandlerInterface
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
        $post = PostService::getPost($this->pathParams['post_id']);

        if ($user->id !== $post->authorId) {
            return ResponseFactory::buildForbiddenResponse()
                ->withHeader('Content-Type', 'text/html; charset=utf-8')
                ->withBody('<html lang="ja"><body><h1>403 Forbidden</h1></body></html>');
        }

        $csrfToken = \bin2hex(\random_bytes(32));
        Session::getInstance()->set('csrf_token', $csrfToken);

        $body = self::render(post: $post, csrfToken: $csrfToken);

        return ResponseFactory::buildSuccess()
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withBody($body);
    }

    private static function render(Post $post, string $csrfToken): string
    {
        $body = '<html lang="ja"><body>';
        $body .= '<form method="post" action="/posts/' . $post->id . '">';
        $body .= '<input type="text" name="title" value="' . $post->title . '" />';
        $body .= '<textarea name="content">' . $post->content . '</textarea>';
        $body .= '<input type="hidden" name="csrf_token" value="' . $csrfToken . '" />';
        $body .= '<input type="submit" value="更新" />';
        $body .= '</form>';
        $body .= "</body></html>";

        return $body;
    }
}