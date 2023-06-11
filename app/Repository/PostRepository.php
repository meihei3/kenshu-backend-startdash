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
                id: 1,
                title: 'Hello World',
                content: 'This is my first post',
                author: 'John Doe',
                authorId: 2,
            ),
            new Post(
                id: 2,
                title: 'Hello World 2',
                content: 'This is my second post',
                author: 'John Doe',
                authorId: 2,
            ),
        ];
    }

    /**
     * @param int $id
     * @return Post
     */
    public static function getById(int $id): Post
    {
        return new Post(
            id: 2,
            title: 'Hello World 2',
            content: 'This is my second post',
            author: 'John Doe',
            authorId: 2,
        );
    }
}