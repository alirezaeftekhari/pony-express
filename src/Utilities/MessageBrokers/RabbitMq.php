<?php

namespace PonyExpress\Utilities\MessageBrokers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PonyExpress\Utilities\Sms;

class RabbitMq
{
    public static function broker(string $queueName, string $text)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        $channel = $connection->channel();
        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $msg = new AMQPMessage($text);
        $channel->basic_publish(msg: $msg, routing_key: $queueName);

        $channel->close();
        $connection->close();
    }

    public static function smsSender(string $queueName)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: Sms::sender());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }

    public static function successfulSmsStorage(string $queueName)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: Sms::successfulSmsStorage());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }

    public static function failedSmsStorage(string $queueName)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: Sms::failedSmsStorage());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}