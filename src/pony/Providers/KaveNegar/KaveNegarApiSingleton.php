<?php

namespace PonyExpress\Providers\KaveNegar;

use Kavenegar\KavenegarApi;

class KaveNegarApiSingleton extends KavenegarApi
{
    private static KavenegarApi $kavenegarApi;

    /**
     * KaveNegarApiSingleton __construct.
     */
    private function __construct()
    {
        parent::__construct($_ENV['KAVENEGAR_API_KEY']);
    }

    /**
     * KaveNegarApiSingleton getInstance.
     * @return self
     */
    public static function getInstance(): self
    {
        if (!isset(self::$kavenegarApi)) {
            self::$kavenegarApi = new static();
        }

        return self::$kavenegarApi;
    }
}