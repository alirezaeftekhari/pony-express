<?php

namespace PonyExpress\Utilities;

use Exception;
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

            try {
                $provider::send($number, $text);
                echo "Message successfully sent!".PHP_EOL;
                echo "provider: $provider".PHP_EOL;
                echo "number: $number | text: $text".PHP_EOL;
            } catch (Exception $exception) {
                echo "****************** Attention: ******************".PHP_EOL;
                echo $exception->getMessage();
            }

        };
    }
}