<?php

namespace PonyExpress\Providers;

use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\MessageBrokers\RabbitMq;

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
     * @return void
     */
    public function sendAsync(): void
    {
        RabbitMq::broker('messages', JSON::encoder([
            "number" => $this->number,
            "text" => $this->text,
            "provider" => static::class
        ]));
    }

    public function store(string $status): void
    {
        $queueName = $status === 'sent' ? 'sent-messages' : 'failed-messages' ;

        RabbitMq::broker($queueName, JSON::encoder([
            "number" => $this->number,
            "text" => $this->text,
            "provider" => static::class
        ]));
    }

    abstract public static function send(string $number, string $text);
}