<?php

namespace PonyExpress\Utilities\RabbitMq;

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMqProducer
{
    private static AMQPStreamConnection $connection;

    public static function sender(string $queueName, string $text)
    {
        self::$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        $channel = self::$connection->channel();

        $channel->queue_declare($queueName, false, false, false, false);

        $msg = new AMQPMessage($text);
        $channel->basic_publish($msg, '', $queueName);

        $channel->close();
        self::$connection->close();
    }
}