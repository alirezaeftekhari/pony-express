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

    public static function decoder(mixed $object): mixed
    {
        return is_object($object)
            ? json_decode(json_encode($object), true)
            : json_decode($object, true);
    }
}