<?php
require_once __DIR__."/../../vendor/autoload.php";

use PonyExpress\Providers\Ghasedak\Ghasedak;
use PonyExpress\PonyExpress;

$ponyExpress = new PonyExpress();
$ponyExpress->sendAsync(new Ghasedak("09120635002", "This is a test"));
$ponyExpress->sendAsync(new Ghasedak("09120635009", "This is a fail"));
