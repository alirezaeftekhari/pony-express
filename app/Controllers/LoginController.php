<?php

namespace App\Controllers;

use App\Models\User;
use Core\View;

class LoginController
{
    public function index()
    {
        if (isset($_POST['username']) and isset($_POST['password']) and
            !empty($_POST['username']) and !empty($_POST['password'])
        ) {
            $username = trim(filter_input(INPUT_POST, 'username'));
            $password = trim(filter_input(INPUT_POST, 'password'));

            $user = User::getUser($username);

            if ($user and $user['password'] === md5($password)) {
                echo View::render('report');
                exit();
            }
        }
        echo View::render('index');
    }
}