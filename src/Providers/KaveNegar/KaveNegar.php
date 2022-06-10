<?php

namespace PonyExpress\Providers\KaveNegar;

use PonyExpress\Dispatcher\AbstractPonyExpressDispatcher;
use PonyExpress\Utilities\RabbitMq\RabbitMqProducer;
use PonyExpress\Helpers\JSON;

class KaveNegar extends AbstractPonyExpressDispatcher
{
    final const API_KEY = 'your api key';
    final const LINE_NUMBER = '10004346';

    public function send()
    {
        KaveNegarSingleton::getInstance()->Send($this->number, $this->text, self::LINE_NUMBER);
    }

    public function sendAsync()
    {
        RabbitMqProducer::sender('messages', JSON::encoder($this->number, $this->text));
        $this->notify();
    }
}