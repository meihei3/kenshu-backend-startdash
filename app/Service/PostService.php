<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Post;
use App\Repository\PostRepository;

class PostService
{
    public static function getPostList(): array
    {
        // 記事一覧のデータを返す
        return PostRepository::getList();
    }

    public static function getPost(int $id): Post
    {
        // 記事のデータを返す
        return PostRepository::getById($id);
    }
}
