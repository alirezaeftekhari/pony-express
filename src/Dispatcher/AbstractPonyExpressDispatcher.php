<?php

namespace PonyExpress\Dispatcher;

use PonyExpress\Helpers\JSON;
use PonyExpress\Utilities\RabbitMq\RabbitMqProducer;
use SplSubject;
use SplObserver;
use SplObjectStorage;

abstract class AbstractPonyExpressDispatcher implements SplSubject
{
    /**
     * AbstractPonyExpressDispatcher constructor.
     * @param string $number
     * @param string $text
     * @param SplObjectStorage $observers
     */
    public function __construct(
        protected string $number,
        protected string $text,
        protected SplObjectStorage $observers = new SplObjectStorage()
    ) {}

    /**
     * AbstractPonyExpressDispatcher attach.
     * @param SplObserver $observer
     * @return void
     */
    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    /**
     * AbstractPonyExpressDispatcher detach.
     * @param SplObserver $observer
     * @return void
     */
    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    /**
     * AbstractPonyExpressDispatcher notify.
     * @return void
     */
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * AbstractPonyExpressDispatcher sendAsync.
     * @return void
     */
    public function sendAsync(): void
    {
        RabbitMqProducer::sender('messages', JSON::encoder($this->number, $this->text, static::class));
        $this->notify();
    }

    abstract public static function send(string $number, string $text);
}