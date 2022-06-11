<?php

namespace PonyExpress\Providers\KaveNegar;

use Kavenegar\KavenegarApi;

class KaveNegarApiSingleton extends KavenegarApi
{
    final const API_KEY = 'your api key';
    private static KavenegarApi $kavenegarApi;

    private function __construct()
    {
        parent::__construct(self::API_KEY);
    }

    public static function getInstance(): self
    {
        if (!isset(self::$kavenegarApi)) {
            self::$kavenegarApi = new static();
        }

        return self::$kavenegarApi;
    }
}