<?php

declare(strict_types=1);

namespace App\Handler;

use App\Http\Response;
use App\Http\ResponseFactory;
use App\Http\ServerRequest;
use App\Model\Post;
use App\Service\PostService;

class GetPostListHandler implements HandlerInterface
{
    /**
     * array なのは良くないけど
     * @param ServerRequest $req Request
     * @return Response Response
     */
    public function run(ServerRequest $req): Response
    {
        $body = self::render(PostService::getPostList());

        return ResponseFactory::buildSuccess()
            ->withHeader('Content-Type', 'text/html; charset=utf-8')
            ->withBody($body);
    }

    /**
     * @param Post[] $posts
     * @return string
     */
    private static function render(array $posts): string
    {
        $body = "<body>";
        $body .= "<h1>記事一覧</h1>";
        foreach ($posts as $post) {
            $body .= "<h2>{$post->title}</h2>";
            $body .= "<p>{$post->content}</p>";
            $body .= "<p>{$post->author}</p>";
        }
        $body .= "</body>";

        return $body;
    }
}