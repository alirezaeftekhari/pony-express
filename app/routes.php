<?php

namespace App;

use Core\Router;

Router::addRoute('/', [Controllers\SmsSenderController::class, 'index']);
