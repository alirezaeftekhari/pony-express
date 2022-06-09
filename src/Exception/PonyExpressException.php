<?php
namespace PonyExpress\Exception;

use Ghasedak\Exceptions\HttpException;

class PonyExpressException extends HttpException
{
    public function errorMessage(): string
    {
        return 'Error on line ' . $this->getLine() . ' in ' . $this->getFile() . ': \n' . $this->getMessage();
    }
}