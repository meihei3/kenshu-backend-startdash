<?php

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;
use App\Model\Post;
use App\Service\PostService;
use JetBrains\PhpStorm\ArrayShape;

class GetPostRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        #[ArrayShape(['post_id' => 'int'])]
        private readonly array $pathParams = []
    )
    {
    }

    public function handle(ServerRequest $req): Response
    {
        $id = $this->pathParams['post_id'];
        $post = PostService::getPost($id);

        $body = self::render($post);

        return ResponseFactory::buildSuccess()
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withBody($body);
    }

    private static function render(Post $post): string
    {
        $body = '<html lang="ja"><body>';
        $body .= "<h1>{$post->title}</h1>";
        $body .= "<p>{$post->content}</p>";
        $body .= "<p>{$post->author}</p>";
        $body .= "</body></html>";

        return $body;
    }
}