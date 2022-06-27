<?php

namespace PonyExpress\Utilities\MessageBrokers;

use Exception;

class MessageBrokerListeners
{
    /**
     * MessageBrokerListeners smsSender.
     * @param MessageBrokerInterface $messageBroker
     * @param string $queueName
     */
    public static function smsSender(MessageBrokerInterface $messageBroker, string $queueName)
    {
        try {
            $messageBroker::smsSender($queueName);
        } catch (Exception $exception) {
            echo $exception->getMessage().PHP_EOL;
        }
    }

    /**
     * MessageBrokerListeners successfulSmsStorage.
     * @param MessageBrokerInterface $messageBroker
     * @param string $queueName
     */
    public static function successfulSmsStorage(MessageBrokerInterface $messageBroker, string $queueName)
    {
        try {
            $messageBroker::successfulSmsStorage($queueName);
        } catch (Exception $exception) {
            echo $exception->getMessage().PHP_EOL;
        }
    }

    /**
     * MessageBrokerListeners failedSmsStorage.
     * @param MessageBrokerInterface $messageBroker
     * @param string $queueName
     */
    public static function failedSmsStorage(MessageBrokerInterface $messageBroker, string $queueName)
    {
        try {
            $messageBroker::failedSmsStorage($queueName);
        } catch (Exception $exception) {
            echo $exception->getMessage().PHP_EOL;
        }
    }
}