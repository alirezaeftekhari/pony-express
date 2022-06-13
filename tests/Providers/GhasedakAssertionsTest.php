<?php

namespace Tests\Providers;

use Exception;
use PHPUnit\Framework\TestCase;
use PonyExpress\Providers\Ghasedak\Ghasedak;

class GhasedakAssertionsTest extends TestCase
{
    public function testSend()
    {
        try {
            Ghasedak::send('09120635002', 'test');
            $status = true;
        } catch (Exception) {
            $status = false;
        }
        $this->assertTrue($status);
    }
}