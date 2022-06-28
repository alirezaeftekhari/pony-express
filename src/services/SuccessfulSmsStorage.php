<?php
require __DIR__.'/../../vendor/autoload.php';

use PonyExpress\Utilities\MessageBrokers\RabbitMq\RabbitMq;
use PonyExpress\Utilities\MessageBrokers\MessageBrokerListeners;

//load the .env file
$dotenv = Dotenv\Dotenv::createMutable(__DIR__.'/../..');
$dotenv->load();

MessageBrokerListeners::successfulSmsStorage(new RabbitMq(), 'sent-messages');