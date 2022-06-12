<?php

namespace App;

use Core\Router;

Router::addRoute('/api/sms/send', [Controllers\SmsSenderController::class, 'send']);
Router::addRoute('/api/sms/report', [Controllers\ReportController::class, 'report']);
Router::addRoute('/', [Controllers\ReportController::class, 'index']);
