<?php

use Jedstrom\Decimal;

class DecimalTest extends PHPUnit_Framework_TestCase
{
    public function testEquality()
    {
        $decimal = new Decimal('7.99', 2);
        $this->assertTrue($decimal->equals(new Decimal('7.99', 2)));
    }

    public function testInequality()
    {
        $decimal = new Decimal('1.50', 2);
        $this->assertFalse($decimal->equals(new Decimal('4.00', 3)));
    }

    public function testGreaterThanComparison()
    {
        $decimal = new Decimal('5.00', 2);
        $this->assertTrue($decimal->greaterThan(new Decimal('2.50', 2)));
        $this->assertFalse($decimal->greaterThan(new Decimal('7.00', 2)));
        $this->assertFalse($decimal->greaterThan(new Decimal('5.00', 2)));
    }

    public function testLessThanComparison()
    {
        $decimal = new Decimal('5.00', 2);
        $this->assertTrue($decimal->lessThan(new Decimal('7.50', 2)));
        $this->assertFalse($decimal->lessThan(new Decimal('2.50', 2)));
        $this->assertFalse($decimal->lessThan(new Decimal('5.00', 2)));
    }
}
