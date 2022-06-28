<?php
require __DIR__.'/../../vendor/autoload.php';

use PonyExpress\Utilities\MessageBrokers\MessageBrokerListeners;
use PonyExpress\Utilities\MessageBrokers\RabbitMq\RabbitMq;

//load the .env file
$dotenv = Dotenv\Dotenv::createMutable(__DIR__.'/../..');
$dotenv->load();

MessageBrokerListeners::smsSender(new RabbitMq(), 'messages');