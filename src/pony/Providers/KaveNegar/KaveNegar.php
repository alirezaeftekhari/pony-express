<?php

namespace PonyExpress\Providers\KaveNegar;

use PonyExpress\Providers\AbstractProvider;

class KaveNegar extends AbstractProvider
{
    /**
     * KaveNegar send.
     * @param string $number
     * @param string $text
     */
    public static function send(string $number, string $text)
    {
        KaveNegarApiSingleton::getInstance()->Send($_ENV['KAVENEGAR_LINE'], $number, $text);
    }
}