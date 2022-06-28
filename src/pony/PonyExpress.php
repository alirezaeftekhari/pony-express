<?php

namespace PonyExpress;

use PonyExpress\Providers\AbstractProvider;
use PonyExpress\Utilities\MessageBrokers\MessageBrokerInterface;

class PonyExpress
{
    /**
     * PonyExpress sendAsync.
     * @param AbstractProvider $provider
     * @param MessageBrokerInterface $messageBroker
     * @return string|bool
     */
    public function sendAsync(AbstractProvider $provider, MessageBrokerInterface $messageBroker): string|bool
    {
        return $provider->sendAsync($messageBroker);
    }

    /**
     * PonyExpress store.
     * @param AbstractProvider $provider
     * @param MessageBrokerInterface $messageBroker
     * @param string $status
     * @return string|bool
     */
    public function store(AbstractProvider $provider, MessageBrokerInterface $messageBroker, string $status): string|bool
    {
        return $provider->store($messageBroker, $status);
    }
}