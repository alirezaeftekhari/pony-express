<?php

namespace PonyExpress\Helpers;

class JSON
{
    public static function encoder(string $number, string $text, string $provider): string {
        return json_encode([
            'number' => $number,
            'text' => $text,
            'provider' => $provider
        ]);
    }

    public static function decoder(string $json): array
    {
        return json_decode($json, true);
    }
}