<?php
namespace PonyExpress\Utilities\MessageBrokers;

interface MessageBrokerInterface
{
    public static function broker(string $queueName, string $text);
    public static function smsSender(string $queueName);
    public static function successfulSmsStorage(string $queueName);
    public static function failedSmsStorage(string $queueName);
}