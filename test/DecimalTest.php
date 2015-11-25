<?php

use Jedstrom\Decimal;

class DecimalTest extends PHPUnit_Framework_TestCase
{
    public function testInequality()
    {
        $decimal = new Decimal('1.50', 2);
        $this->assertFalse($decimal->equals(new Decimal('4.00', 3)));
    }
}
