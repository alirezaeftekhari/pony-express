<?php
require_once __DIR__ . "/../vendor/autoload.php";
use PonyExpress\Utilities\MessageBrokers\RabbitMq;

//load the .env file
$dotenv = Dotenv\Dotenv::createMutable(__DIR__.'/..');
$dotenv->load();

RabbitMq::successfulSmsStorage('sent-messages');