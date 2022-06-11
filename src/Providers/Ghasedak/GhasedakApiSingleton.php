<?php

namespace PonyExpress\Providers\Ghasedak;

use Ghasedak\GhasedakApi;

class GhasedakApiSingleton extends GhasedakApi
{
    final const API_KEY = 'fb987e82b13dad3af68d64896f4c005a3a8f1abaa5a714e38096d62fcd862ffc';
    private static GhasedakApi $ghasedakApi;

    private function __construct()
    {
        parent::__construct(self::API_KEY);
    }

    public static function getInstance(): self
    {
        if (!isset(self::$ghasedakApi)) {
            self::$ghasedakApi = new static();
        }

        return self::$ghasedakApi;
    }
}