<?php

namespace PonyExpress\Dispatcher;

use SplSubject;
use SplObserver;
use SplObjectStorage;

abstract class AbstractPonyExpressDispatcher implements SplSubject
{
    /**
     * AbstractPonyExpressDispatcher constructor.
     * @param string $number
     * @param string $text
     * @param SplObjectStorage $observer
     */
    public function __construct(
        protected string $number,
        protected string $text,
        protected SplObjectStorage $observer = new SplObjectStorage()
    ) {}

    /**
     * AbstractPonyExpressDispatcher attach.
     * @param SplObserver $observer
     * @return void
     */
    public function attach(SplObserver $observer): void
    {
        $this->observer->attach($observer);
    }

    /**
     * AbstractPonyExpressDispatcher detach.
     * @param SplObserver $observer
     * @return void
     */
    public function detach(SplObserver $observer): void
    {
        $this->observer->detach($observer);
    }

    /**
     * AbstractPonyExpressDispatcher notify.
     * @return void
     */
    public function notify(): void
    {
        $this->observer->store($this);
    }

    abstract public function send();

    abstract public function sendAsync();
}