<?php

namespace PonyExpress\Utilities\RabbitMq;

use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqProducer
{
    public static function sender(string $queueName, string $text)
    {
        $channel = AMQPStreamConnection::getInstance()->channel();

        $channel->queue_declare($queueName, false, false, false, false);

        $msg = new AMQPMessage($text);
        $channel->basic_publish($msg, '', $queueName);

        $channel->close();
        AMQPStreamConnection::getInstance()->close();
    }
}