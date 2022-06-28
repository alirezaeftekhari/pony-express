<?php
namespace App;

use Core\Router;

Router::addRoute('/api/sms/send', [Controllers\SmsSenderController::class, 'sendApi']);
Router::addRoute('/api/sms/report', [Controllers\ReportController::class, 'reportApi']);

Router::addRoute('/', [Controllers\ReportController::class, 'index']);
