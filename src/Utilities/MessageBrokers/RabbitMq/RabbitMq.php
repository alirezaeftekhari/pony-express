<?php

namespace PonyExpress\Utilities\MessageBrokers\RabbitMq;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMq
{
    public static function broker(string $queueName, string $text)
    {
        $connection = new AMQPStreamConnection($_ENV['RABBITMQ_HOST'], $_ENV['RABBITMQ_PORT'], $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);

        $channel = $connection->channel();
        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $msg = new AMQPMessage($text);
        $channel->basic_publish(msg: $msg, routing_key: $queueName);

        $channel->close();
        $connection->close();
    }

    public static function smsSender(string $queueName)
    {
        $connection = new AMQPStreamConnection($_ENV['RABBITMQ_HOST'], $_ENV['RABBITMQ_PORT'], $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);

        $channel = $connection->channel();
        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: SmsCallBacks::sender());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }

    public static function successfulSmsStorage(string $queueName)
    {
        $connection = new AMQPStreamConnection($_ENV['RABBITMQ_HOST'], $_ENV['RABBITMQ_PORT'], $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);

        $channel = $connection->channel();
        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: SmsCallBacks::successfulSmsStorage());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }

    public static function failedSmsStorage(string $queueName)
    {
        $connection = new AMQPStreamConnection($_ENV['RABBITMQ_HOST'], $_ENV['RABBITMQ_PORT'], $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASS']);

        $channel = $connection->channel();
        $channel->queue_declare(queue: $queueName, auto_delete: false);

        $channel->basic_consume(queue: $queueName, no_ack: true, callback: SmsCallBacks::failedSmsStorage());

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}