<?php

namespace PonyExpress\Storage;

abstract class AbstractPonyExpressStorage
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
     * AbstractPigeonStorage constructor.
     * @param string $number
     * @param string $text
     */
    public function __construct(string $number, string $text)
    {
        $this->number = $number;
        $this->text = $text;
    }

    abstract public function store();
}