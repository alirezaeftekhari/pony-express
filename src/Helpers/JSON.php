<?php

namespace PonyExpress\Helpers;

class JSON
{
    public static function encoder(string $number, string $text): string {
        return json_encode([
            'number' => $number,
            'text' => $text
        ]);
    }
}