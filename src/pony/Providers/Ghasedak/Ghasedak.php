<?php

namespace PonyExpress\Providers\Ghasedak;

use Exception;
use PonyExpress\Providers\AbstractProvider;
use PonyExpress\Helpers\JSON;

class Ghasedak extends AbstractProvider
{
    /**
     * Ghasedak send.
     * @param string $number
     * @param string $text
     * @return void
     * @throws Exception
     */
    public static function send(string $number, string $text)
    {
        $responseObject = GhasedakApiSingleton::getInstance()->SendSimple($number, $text, $_ENV['GHASEDAK_LINE']);
        if (is_null($responseObject)) {
            throw new Exception("something is wrong with 'Ghasedak' API");
        }

        $response = JSON::decoder($responseObject);
        if ($response['result']['message'] !== 'success') {
            throw new Exception("Message did not be sent to $number with text: $text");
        }
    }
}