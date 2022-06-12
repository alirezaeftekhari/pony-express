<?php
namespace App\Controllers;

use PonyExpress\Helpers\JSON;
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
}