<?php

namespace PonyExpress\Providers\KaveNegar;

use PonyExpress\Dispatcher\AbstractPonyExpressDispatcher;

class KaveNegar extends AbstractPonyExpressDispatcher
{
    final const API_KEY = 'your api key';
    final const LINE_NUMBER = '10004346';

    public static function send(string $number, string $text)
    {
        KaveNegarSingleton::getInstance()->Send(self::LINE_NUMBER, $number, $text);
    }
}