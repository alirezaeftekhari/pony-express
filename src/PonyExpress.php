<?php

namespace PonyExpress;

use PonyExpress\Providers\AbstractProvider;

class PonyExpress
{
    public function sendAsync(AbstractProvider $provider)
    {
        $provider->sendAsync();
    }

    public function store(AbstractProvider $provider, string $status)
    {
        $provider->store($status);
    }
}