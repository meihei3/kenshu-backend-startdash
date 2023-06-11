<?php

namespace App\Model;

class Post
{
    public function __construct(
        public int    $id,
        public string $title,
        public string $content,
        public string $author,
        public int    $authorId,
    )
    {
    }
}