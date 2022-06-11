<?php

namespace PonyExpress\Helpers;

class JSON
{
    public static function encoder(array $params): string {
        return json_encode($params);
    }

    public static function decoder(mixed $object): mixed
    {
        return is_object($object)
            ? json_decode(json_encode($object), true)
            : json_decode($object, true);
    }
}