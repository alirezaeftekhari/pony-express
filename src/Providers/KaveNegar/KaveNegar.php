<?php

namespace PonyExpress\Providers\KaveNegar;

use PonyExpress\Providers\AbstractProvider;

class KaveNegar extends AbstractProvider
{
    final const LINE_NUMBER = '10004346';

    public static function send(string $number, string $text)
    {
        KaveNegarApiSingleton::getInstance()->Send(self::LINE_NUMBER, $number, $text);
    }
}