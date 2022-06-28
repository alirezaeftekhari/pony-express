<?php

use Core\Router;

require __DIR__.'/../../vendor/autoload.php';

//load the .env file
$dotenv = Dotenv\Dotenv::createMutable(__DIR__.'/../..');
$dotenv->load();

include __DIR__.'/../app/routes.php';

return Router::dispatch($_SERVER['REQUEST_URI']);
