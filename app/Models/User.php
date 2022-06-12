<?php
namespace App\Models;
use PonyExpress\Utilities\DataBase\UserActions;

class User
{
    public static function getUser(string $username): array|bool
    {
        $userActions = new UserActions();
        return $userActions->getUserByUserName($username);
    }
}