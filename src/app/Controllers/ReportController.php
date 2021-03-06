<?php
namespace App\Controllers;

use App\Models\User;
use Core\View;
use Exception;
use PonyExpress\Helpers\JSON;
use App\Models\Message;

class ReportController
{
    /**
     * ReportController reportApi.
     * @return void
     */
    public function reportApi()
    {
        $number = filter_input(INPUT_POST, 'number');
        $text = filter_input(INPUT_POST, 'text');
        $provider = filter_input(INPUT_POST, 'provider');
        $status = filter_input(INPUT_POST, 'status');

        echo JSON::encoder(Message::read($number, $text, $provider, $status));
    }

    /**
     * ReportController index.
     * @return void
     */
    public function index()
    {
        try {
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
        } catch (Exception $exception) {
            echo $exception->getMessage().PHP_EOL;
        }
    }
}