<?php

namespace PonyExpress\Providers;

use Exception;
use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\MessageBrokers\RabbitMq\RabbitMq;

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
     * @return string|bool
     */
    public function sendAsync(): string|bool
    {
        try {
            RabbitMq::broker('messages', JSON::encoder([
                "number" => $this->number,
                "text" => $this->text,
                "provider" => static::class
            ]));
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
        return true;
    }

    public function store(string $status): string|bool
    {
        $queueName = $status === 'sent' ? 'sent-messages' : 'failed-messages' ;

        try {
            RabbitMq::broker($queueName, JSON::encoder([
                "number" => $this->number,
                "text" => $this->text,
                "provider" => static::class
            ]));
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
        return true;
    }

    abstract public static function send(string $number, string $text);
}