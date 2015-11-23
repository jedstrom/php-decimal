<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class ComparisonTest extends PHPUnit_Framework_TestCase
{
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

    public function testGreaterThanOrEqual()
    {
        $decimal = new Decimal('5.00', 2);
        $this->assertTrue($decimal->greaterThanOrEqual(new Decimal('2.00', 2)));
        $this->assertTrue($decimal->greaterThanOrEqual(new Decimal('5.00', 2)));
        $this->assertFalse($decimal->greaterThanOrEqual(new Decimal('5.01', 2)));
        $this->assertFalse($decimal->greaterThanOrEqual(new Decimal('100.00', 2)));
    }

    public function testLessThanOrEqual()
    {
        $decimal = new Decimal('5.00', 2);
        $this->assertTrue($decimal->lessThanOrEqual(new Decimal('5.00', 2)));
        $this->assertTrue($decimal->lessThanOrEqual(new Decimal('5.00', 2)));
        $this->assertFalse($decimal->lessThanOrEqual(new Decimal('4.99', 2)));
        $this->assertFalse($decimal->lessThanOrEqual(new Decimal('1.00', 2)));
    }
}
