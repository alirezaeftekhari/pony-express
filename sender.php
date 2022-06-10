<?php
require_once __DIR__."/vendor/autoload.php";

use PonyExpress\Providers\Ghasedak\Ghasedak;
use PonyExpress\Services\SmsSender;
use PonyExpress\PonyExpress;

$ghasedak = new Ghasedak("09120635002", "Hi Pure!");
$smsSender = new SmsSender();

$ghasedak->attach($smsSender);
$ponyExpress = new PonyExpress();

$ponyExpress->sendAsync($ghasedak);


