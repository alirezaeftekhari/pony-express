<?php

namespace PonyExpress\Providers\KaveNegar;

use PonyExpress\Dispatcher\AbstractPonyExpressDispatcher;

class KaveNegar extends AbstractPonyExpressDispatcher
{
    final const LINE_NUMBER = '10004346';

    public static function send(string $number, string $text)
    {
        KaveNegarApiSingleton::getInstance()->Send(self::LINE_NUMBER, $number, $text);
    }
}