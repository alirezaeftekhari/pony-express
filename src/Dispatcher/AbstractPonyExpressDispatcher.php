<?php

namespace PonyExpress\Dispatcher;

use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\RabbitMq\RabbitMqProducer;


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
        RabbitMqProducer::sender('messages', JSON::encoder($this->number, $this->text, static::class));
    }

    abstract public static function send(string $number, string $text);
}