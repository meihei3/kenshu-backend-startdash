<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Post;
use App\Service\PostService;

class GetPostListHandler implements HandlerInterface
{
    /**
     * array なのは良くないけど
     * @param array $req Request
     * @return array Response
     */
    public function run(array $req): array
    {
        $result = self::render(PostService::getPostList());

        return [
            "status_code" => 200,
            "body" => "<html>{$result}</html>"
        ];
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