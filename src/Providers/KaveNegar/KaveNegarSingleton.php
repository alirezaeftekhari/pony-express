<?php

namespace PonyExpress\Providers\KaveNegar;

use Kavenegar\KavenegarApi;

class KaveNegarSingleton extends KavenegarApi
{
    private static KavenegarApi $kavenegarApi;

    private function __construct()
    {
        parent::__construct(KaveNegar::API_KEY);
    }

    public static function getInstance(): self
    {
        if (!isset(self::$kavenegarApi)) {
            self::$kavenegarApi = new static();
        }

        return self::$kavenegarApi;
    }
}