<?php

namespace PonyExpress\Providers;

use Exception;
use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\MessageBrokers\MessageBrokerInterface;

abstract class AbstractProvider
{
    /**
     * AbstractProvider constructor.
     * @param string $number
     * @param string $text
     */
    public function __construct(
        protected string $number,
        protected string $text,
    ) {}

    /**
     * AbstractProvider sendAsync.
     * @param MessageBrokerInterface $messageBroker
     * @return string|bool
     */
    public function sendAsync(MessageBrokerInterface $messageBroker): string|bool
    {
        try {
            $messageBroker::broker('messages', JSON::encoder([
                "number" => $this->number,
                "text" => $this->text,
                "provider" => static::class
            ]));
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
        return true;
    }

    /**
     * AbstractProvider store.
     * @param MessageBrokerInterface $messageBroker
     * @param string $status
     * @return string|bool
     */
    public function store(MessageBrokerInterface $messageBroker, string $status): string|bool
    {
        $queueName = $status === 'sent' ? 'sent-messages' : 'failed-messages' ;

        try {
            $messageBroker::broker($queueName, JSON::encoder([
                "number" => $this->number,
                "text" => $this->text,
                "provider" => static::class
            ]));
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
        return true;
    }

    /**
     * AbstractProvider send.
     */
    abstract public static function send(string $number, string $text);
}