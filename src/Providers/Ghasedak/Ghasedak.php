<?php

namespace PonyExpress\Providers\Ghasedak;

use PonyExpress\Dispatcher\AbstractPonyExpressDispatcher;

class Ghasedak extends AbstractPonyExpressDispatcher
{
    final const API_KEY = 'fb987e82b13dad3af68d64896f4c005a3a8f1abaa5a714e38096d62fcd862ffc';
    final const LINE_NUMBER = '10008566';

    public function send()
    {
        GhasedakApiSingleton::getInstance()->SendSimple($this->number, $this->text, self::LINE_NUMBER);
    }
}