<?php

namespace PonyExpress\Providers\Ghasedak;

use Ghasedak\GhasedakApi;

class GhasedakApiSingleton extends GhasedakApi
{
    private static GhasedakApi $ghasedakApi;

    /**
     * GhasedakApiSingleton __construct.
     */
    private function __construct()
    {
        parent::__construct($_ENV['GHASEDAK_API_KEY']);
    }

    /**
     * GhasedakApiSingleton getInstance.
     * @return self
     */
    public static function getInstance(): self
    {
        if (!isset(self::$ghasedakApi)) {
            self::$ghasedakApi = new static();
        }

        return self::$ghasedakApi;
    }
}