<?php

namespace PonyExpress\Helpers;

class JSON
{
    /**
     * JSON encoder.
     * @param array $params
     * @return string
     */
    public static function encoder(array $params): string {
        return json_encode($params);
    }

    /**
     * JSON decoder.
     * @param mixed $object
     * @return bool
     */
    public static function decoder(mixed $object): mixed
    {
        return is_object($object)
            ? json_decode(json_encode($object), true)
            : json_decode($object, true);
    }
}