<?php

namespace PonyExpress\Providers\Ghasedak;

use PonyExpress\Dispatcher\AbstractPonyExpressDispatcher;
use PonyExpress\Utilities\RabbitMq\RabbitMqProducer;
use PonyExpress\Helpers\JSON;

class Ghasedak extends AbstractPonyExpressDispatcher
{
    final const API_KEY = 'fb987e82b13dad3af68d64896f4c005a3a8f1abaa5a714e38096d62fcd862ffc';
    final const LINE_NUMBER = '10008566';

    public function send()
    {
        GhasedakApiSingleton::getInstance()->SendSimple($this->number, $this->text, self::LINE_NUMBER);
    }

    public function sendAsync()
    {
        RabbitMqProducer::sender('messages', JSON::encoder($this->number, $this->text));
        $this->notify();
    }
}