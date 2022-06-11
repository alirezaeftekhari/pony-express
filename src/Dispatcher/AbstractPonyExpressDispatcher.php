<?php

namespace PonyExpress\Dispatcher;

use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\MessageBrokers\RabbitMq;


abstract class AbstractPonyExpressDispatcher
{
    /**
     * AbstractPonyExpressDispatcher constructor.
     * @param string $number
     * @param string $text
     */
    public function __construct(
        protected string $number,
        protected string $text,
    ) {}

    /**
     * AbstractPonyExpressDispatcher sendAsync.
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

    abstract public static function send(string $number, string $text);
}