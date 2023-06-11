<?php
declare(strict_types=1);

namespace App\Service;

use App\Http\Session;
use App\Model\User;
use App\Repository\UserRepository;

class AuthUserService
{
    public static function getLoggedInUser(): User
    {
        $userId = Session::getInstance()->get('user_id');

        return UserRepository::getById($userId);
    }

    public static function tryLogin(string $username, string $password): bool
    {
        $user = UserRepository::getByUsername($username);

        if (is_null($user)) {
            return false;
        }

//        if (!password_verify($password, $user->password)) {
//            return false;
//        }

        $session = Session::getInstance();
        $session->refresh();
        $session->set('user_id', $user->id);

        return true;
    }

    public static function verifyCsrfToken(string $param): bool
    {
        $session = Session::getInstance();
        $token = $session->get('csrf_token');

        if (is_null($token)) {
            return false;
        }

        return hash_equals($token, $param);
    }
}