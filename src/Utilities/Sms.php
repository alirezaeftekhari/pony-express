<?php

namespace PonyExpress\Utilities;

use PonyExpress\Helpers\JSON;

class Sms
{
    public static function sender(): callable
    {
        return function ($message) {
            $messageBody = $message->body;
            $decodedMessage = JSON::decoder($messageBody);
            $number = $decodedMessage['number'];
            $text = $decodedMessage['text'];
            $provider = $decodedMessage['provider'];

            echo "$number $text $provider".PHP_EOL;
        };
    }
}