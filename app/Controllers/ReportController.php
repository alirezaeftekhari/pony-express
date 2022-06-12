<?php

namespace App\Controllers;

use Exception;
use PonyExpress\Helpers\JSON;
use Core\View;
use App\Models\Message;

class ReportController
{
    public function reportApi()
    {
        $number = filter_input(INPUT_POST, 'number');
        $text = filter_input(INPUT_POST, 'text');
        $provider = filter_input(INPUT_POST, 'provider');
        $status = filter_input(INPUT_POST, 'status');

        echo JSON::encoder(Message::read($number, $text, $provider, $status));
    }

    public function report()
    {
        try {
            echo View::render('report');
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}