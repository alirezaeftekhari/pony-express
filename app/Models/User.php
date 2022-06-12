<?php

namespace App\Models;
use PonyExpress\Utilities\DataBase\UserActions;

class User
{
    public static function getUser(string $username): array|bool
    {
        $mysql = new UserActions();
        return $mysql->getUserByUserName($username);
    }
}