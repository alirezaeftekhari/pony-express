<?php

namespace PonyExpress\Providers;

use PonyExpress\Providers\Ghasedak\Ghasedak;

class ProviderFactory
{
    public static function readProviders(): array
    {
        return require_once __DIR__."/providers.php";
    }

    public static function get(string $providerName = null): string
    {
        $providers = self::readProviders();
        if (isset($providers[$providerName])) {
            return $providers[$providerName];
        }
        return Ghasedak::class;
    }
}