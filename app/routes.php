<?php

namespace App;

use Core\Router;

Router::addRoute('/api/sms/send', [Controllers\SmsSenderController::class, 'index']);
Router::addRoute('/api/sms/report', [Controllers\ReportController::class, 'index']);
