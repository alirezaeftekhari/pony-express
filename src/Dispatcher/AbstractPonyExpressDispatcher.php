<?php

namespace PonyExpress\Dispatcher;

abstract class AbstractPonyExpressDispatcher
{
    /**
     * @var string
     */
    protected string $number;
    /**
     * @var string
     */
    protected string $text;

    /**
     * AbstractDispatcher constructor.
     * @param string $number
     * @param string $text
     */
    public function __construct(string $number, string $text)
    {
        $this->number = $number;
        $this->text = $text;
    }

    abstract public function send();
}