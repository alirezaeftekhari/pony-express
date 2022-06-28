<?php

namespace App\Controllers;

use PonyExpress\Helpers\JSON;
use PonyExpress\PonyExpress;
use PonyExpress\Utilities\MessageBrokers\RabbitMq\RabbitMq;
use PonyExpress\Providers\ProviderFactory;

class SmsSenderController
{
    /**
     * SmsSenderController sendApi.
     * @return void
     */
    public function sendApi()
    {
        $number = filter_input(INPUT_POST, 'number');
        $text = filter_input(INPUT_POST, 'text');
        $provider = filter_input(INPUT_POST, 'provider');

        $providerClassName = ProviderFactory::get($provider);
        $providerClass = new $providerClassName($number, $text);

        $ponyExpress = new PonyExpress();
        $status = $ponyExpress->sendAsync($providerClass, new RabbitMq());
        echo JSON::encoder(['status' => $status]);
    }
}
