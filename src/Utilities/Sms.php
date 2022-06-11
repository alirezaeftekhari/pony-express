<?php

namespace PonyExpress\Utilities;

use Exception;
use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\Mysql\Mysql;

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

            $mysql = new Mysql();

            try {
                //send the sms
                $provider::send($number, $text);

                //save to db by sent status
                $mysql->store($number, $text, $provider, 'sent');

                //show log
                echo "\e[32m Message successfully sent!".PHP_EOL;
                echo "\e[32m provider: $provider".PHP_EOL;
                echo "\e[32m number: $number | text: $text".PHP_EOL;

            } catch (Exception $exception) {
                //save to db by failed status
                $mysql->store($number, $text, $provider, 'failed');

                //show log
                echo "\e[31m ****************** Attention: ******************".PHP_EOL;
                echo "\e[31m ".$exception->getMessage().PHP_EOL;
            }

        };
    }
}