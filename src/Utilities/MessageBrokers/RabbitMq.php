<?php

namespace PonyExpress\Utilities\MessageBrokers\RabbitMq;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMq
{
    public static function sender(string $queueName, string $text)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        $channel = $connection->channel();
        $channel->queue_declare($queueName, false, false, false, false);

        $msg = new AMQPMessage($text);
        $channel->basic_publish($msg, '', $queueName);

        $channel->close();
        $connection->close();
    }

    public static function receiver(string $queueName)
    {

    }
}