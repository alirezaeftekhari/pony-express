<?php
require_once __DIR__."/vendor/autoload.php";
use PonyExpress\Providers\Ghasedak\Ghasedak;
use PonyExpress\PonyExpress;

$ghasedak = new Ghasedak("09120635002", "Hi Pure!");
$ponyExpress = new PonyExpress();

$ponyExpress->send($ghasedak);