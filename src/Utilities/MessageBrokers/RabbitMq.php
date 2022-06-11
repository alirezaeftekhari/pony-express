<?php

namespace PonyExpress\Utilities\MessageBrokers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PonyExpress\Helpers\Sms;

class RabbitMq
{
    public static function sender(string $queueName, string $text)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        $channel = $connection->channel();
        $channel->queue_declare(queue: 'messages', auto_delete: false);

        $msg = new AMQPMessage($text);
        $channel->basic_publish($msg, '', $queueName);

        $channel->close();
        $connection->close();
    }

    public static function receiver(string $queueName)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare(queue: 'messages', auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: Sms::sender());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}