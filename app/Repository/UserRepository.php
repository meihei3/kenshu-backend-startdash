<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\User;

class UserRepository
{
    public static function getById(int $id): User
    {
        return new User(
            id: 2,
            name: 'John Doe',
            email: 'john.doe@example.com',
            password: '$2y$10$',
        );
    }

    public static function getByUsername(string $username): User
    {
        return new User(
            id: 2,
            name: 'John Doe',
            email: 'john.doe@example.com',
            password: '$2y$10$',
        );
    }
}
