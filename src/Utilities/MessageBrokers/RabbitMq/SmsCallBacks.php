<?php
namespace PonyExpress\Utilities\MessageBrokers\RabbitMq;

use Exception;
use PonyExpress\Helpers\JSON;
use PonyExpress\PonyExpress;
use PonyExpress\Utilities\DataBase\MessagesActions;

class SmsCallBacks
{
    /**
     * SmsCallBacks sender.
     * @return callable
     */
    public static function sender(): callable
    {
        return function ($message) {
            $messageBody = $message->body;
            $decodedMessage = JSON::decoder($messageBody);

            $number = $decodedMessage['number'];
            $text = $decodedMessage['text'];
            $provider = $decodedMessage['provider'];

            $ponyExpress = new PonyExpress();

            try {
                //send the sms
                $provider::send($number, $text);

                //send to the sent-messages queue
                $ponyExpress->store(new $provider($number, $text), new RabbitMq(), 'sent');

                //show log
                echo "\e[32m Message successfully sent!".PHP_EOL;
                echo "\e[32m provider: $provider".PHP_EOL;
                echo "\e[32m number: $number | text: $text".PHP_EOL;
                echo PHP_EOL;

            } catch (Exception $exception) {
                //send to the failed-messages queue
                $ponyExpress->store(new $provider($number, $text), new RabbitMq(), 'failed');

                //show log
                echo "\e[31m ****************** Attention: ******************".PHP_EOL;
                echo "\e[31m Message didn't sent successfully!".PHP_EOL;
                echo "\e[31m provider: $provider".PHP_EOL;
                echo "\e[31m number: $number | text: $text".PHP_EOL;
                echo "\e[31m ".$exception->getMessage().PHP_EOL;
                echo PHP_EOL;
            }
        };
    }

    /**
     * SmsCallBacks successfulSmsStorage.
     * @return callable
     */
    public static function successfulSmsStorage(): callable
    {
        return function ($message) {
            $messageBody = $message->body;
            $decodedMessage = JSON::decoder($messageBody);

            $number = $decodedMessage['number'];
            $text = $decodedMessage['text'];
            $provider = $decodedMessage['provider'];

            $messagesActions = new MessagesActions();
            try {
                $messagesActions->store($number, $text, $provider, 'sent');

                //show log
                echo "\e[32m The message that sent has stored in the database!".PHP_EOL;
                echo "\e[32m provider: $provider".PHP_EOL;
                echo "\e[32m number: $number | text: $text".PHP_EOL;
                echo PHP_EOL;
            } catch (Exception $exception) {
                //show log
                echo "\e[31m ****************** Attention: ******************".PHP_EOL;
                echo "\e[31m The message that sent has not stored in the database!".PHP_EOL;
                echo "\e[31m provider: $provider".PHP_EOL;
                echo "\e[31m number: $number | text: $text".PHP_EOL;
                echo "\e[31m ".$exception->getMessage().PHP_EOL;
                echo PHP_EOL;
            }
        };
    }

    /**
     * SmsCallBacks failedSmsStorage.
     * @return callable
     */
    public static function failedSmsStorage(): callable
    {
        return function ($message) {
            $messageBody = $message->body;
            $decodedMessage = JSON::decoder($messageBody);

            $number = $decodedMessage['number'];
            $text = $decodedMessage['text'];
            $provider = $decodedMessage['provider'];

            $messagesActions = new MessagesActions();
            try {
                $messagesActions->store($number, $text, $provider, 'failed');

                //show log
                echo "\e[32m The message that failed to send has stored in the database!".PHP_EOL;
                echo "\e[32m provider: $provider".PHP_EOL;
                echo "\e[32m number: $number | text: $text".PHP_EOL;
                echo PHP_EOL;
            } catch (Exception $exception) {
                //show log
                echo "\e[31m ****************** Attention: ******************".PHP_EOL;
                echo "\e[31m The message that failed to send has not stored in the database!".PHP_EOL;
                echo "\e[31m provider: $provider".PHP_EOL;
                echo "\e[31m number: $number | text: $text".PHP_EOL;
                echo "\e[31m ".$exception->getMessage().PHP_EOL;
                echo PHP_EOL;
            }
        };
    }
}