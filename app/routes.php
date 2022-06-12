<?php

namespace App;

use Core\Router;

Router::addRoute('/api/sms/send', [Controllers\SmsSenderController::class, 'sendApi']);
Router::addRoute('/api/sms/report', [Controllers\ReportController::class, 'reportApi']);

Router::addRoute('/report', [Controllers\ReportController::class, 'report']);

Router::addRoute('/', [Controllers\LoginController::class, 'index']);
