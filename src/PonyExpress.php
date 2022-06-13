<?php

namespace PonyExpress;

use PonyExpress\Providers\AbstractProvider;

class PonyExpress
{
    /**
     * PonyExpress sendAsync.
     * @param AbstractProvider $provider
     * @return string|bool
     */
    public function sendAsync(AbstractProvider $provider): string|bool
    {
        return $provider->sendAsync();
    }

    /**
     * PonyExpress store.
     * @param AbstractProvider $provider
     * @param string $status
     * @return string|bool
     */
    public function store(AbstractProvider $provider, string $status): string|bool
    {
        return $provider->store($status);
    }
}