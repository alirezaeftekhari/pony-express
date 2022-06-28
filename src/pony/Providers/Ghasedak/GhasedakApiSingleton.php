<?php

namespace PonyExpress\Providers\Ghasedak;

use Ghasedak\GhasedakApi;

class GhasedakApiSingleton extends GhasedakApi
{
    final const API_KEY = 'your api key';
    private static GhasedakApi $ghasedakApi;

    /**
     * GhasedakApiSingleton __construct.
     */
    private function __construct()
    {
        parent::__construct(self::API_KEY);
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