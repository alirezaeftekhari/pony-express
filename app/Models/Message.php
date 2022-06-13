<?php

namespace App\Models;

use PonyExpress\Utilities\DataBase\MessagesActions;

class Message
{
    /**
     * Message read.
     * @param mixed $number
     * @param mixed $text
     * @param mixed $provider
     * @param mixed $status
     * @return array
     */
    public static function read(mixed $number, mixed $text, mixed $provider, mixed $status): array
    {
        $sql = "select * from Messages where 1 ";

        (isset($number) and $number     !== 'undefined' and !empty($number))    ? $sql .= " and number like :number" : $sql .= '';
        (isset($text) and $text         !== 'undefined' and !empty($text))      ? $sql .= " and text like :text" : $sql .= '';
        (isset($provider) and $provider !== 'undefined' and !empty($provider))  ? $sql .= " and provider = :provider" : $sql .= '';
        (isset($status) and $status     !== 'undefined' and !empty($status))    ? $sql .= " and status = :status" : $sql .= '';

        $messageActions = new MessagesActions();
        return $messageActions->read($sql, $number, $text, $provider, $status);
    }
}