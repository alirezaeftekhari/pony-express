<?php

namespace PonyExpress;

use PonyExpress\Dispatcher\AbstractPonyExpressDispatcher;
use PonyExpress\Storage\AbstractPonyExpressStorage;

class PonyExpress
{
    public function send(AbstractPonyExpressDispatcher $dispatcher)
    {
        $dispatcher->send();
    }

    public function sendAsync(AbstractPonyExpressDispatcher $dispatcher)
    {
        $dispatcher->sendAsync();
    }

    public function store(AbstractPonyExpressStorage $storage)
    {
        $storage->store();
    }
}