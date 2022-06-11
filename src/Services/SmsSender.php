<?php
require_once __DIR__."/../../vendor/autoload.php";

use PonyExpress\Utilities\MessageBrokers\RabbitMq;

RabbitMq::smsSender('messages');