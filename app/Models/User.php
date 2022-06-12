<?php

namespace App\Models;
use PonyExpress\Utilities\DataBase\Mysql;

class User
{
    public static function getUser(string $username): array|bool
    {
        $mysql = new Mysql();
        return $mysql->getUserByUserName($username);
    }
}