<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class ToStringTest extends PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $decimal = new Decimal('3.14159');

        $this->assertSame('3.14159', (string) $decimal);
    }
}
