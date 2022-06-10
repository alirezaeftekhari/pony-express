<?php

namespace PonyExpress\Utilities\RabbitMq;
use PhpAmqpLib\Connection\AMQPStreamConnection as AMQP;

class AMQPStreamConnection extends AMQP
{
    private static AMQP $amqp;

    public static function getInstance(): AMQP
    {
        if (!isset(self::$amqp)) {
            self::$amqp = new AMQP('localhost', 5672, 'guest', 'guest');
        }

        return self::$amqp;
    }
}