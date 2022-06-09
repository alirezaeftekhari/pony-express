<?php

namespace PonyExpress\Providers\Ghasedak;

use Ghasedak\GhasedakApi;

class GhasedakApiSingleton extends GhasedakApi
{
    private static GhasedakApi $ghasedakApi;

    private function __construct()
    {
        parent::__construct(Ghasedak::API_KEY);
    }

    public static function getInstance(): self
    {
        if (!isset(self::$ghasedakApi)) {
            self::$ghasedakApi = new static();
        }

        return self::$ghasedakApi;
    }
}