<?php

namespace PonyExpress;

use PonyExpress\Providers\AbstractProvider;

class PonyExpress
{
    public function sendAsync(AbstractProvider $provider): string|bool
    {
        return $provider->sendAsync();
    }

    public function store(AbstractProvider $provider, string $status): string|bool
    {
        return $provider->store($status);
    }
}