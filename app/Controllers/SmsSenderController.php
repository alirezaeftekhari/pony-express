<?php

namespace App\Controllers;

use PonyExpress\Helpers\JSON;
use PonyExpress\PonyExpress;
use PonyExpress\Providers\Ghasedak\Ghasedak;
use PonyExpress\Providers\KaveNegar\KaveNegar;

class SmsSenderController
{
    public function index()
    {
        $number = filter_input(INPUT_POST, 'number');
        $text = filter_input(INPUT_POST, 'text');
        $provider = filter_input(INPUT_POST, 'provider');

        switch ($provider) {
            case 'ghasedak':
            default:
                $providerClass = new Ghasedak($number, $text);
                break;
            case 'kavenegar':
                $providerClass = new KaveNegar($number, $text);
                break;
        }
        $ponyExpress = new PonyExpress();
        $status = $ponyExpress->sendAsync($providerClass);
        echo JSON::encoder(['status' => $status]);
    }
}
