<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Post;

class PostRepository
{
    /**
     * @return Post[]
     */
    public static function getList(): array
    {
        return [
            new Post(
                title: 'Hello World',
                content: 'This is my first post',
                author: 'John Doe',
            ),
            new Post(
                title: 'Hello World 2',
                content: 'This is my second post',
                author: 'John Doe',
            ),
        ];
    }
}