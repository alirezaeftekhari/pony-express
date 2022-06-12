<?php
require_once __DIR__ . "/../vendor/autoload.php";

use PonyExpress\Utilities\MessageBrokers\RabbitMq\RabbitMq;

//load the .env file
$dotenv = Dotenv\Dotenv::createMutable(__DIR__.'/..');
$dotenv->load();

RabbitMq::failedSmsStorage('failed-messages');