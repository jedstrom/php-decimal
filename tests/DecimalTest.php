<?php

use Jedstrom\Decimal;

class DecimalTest extends PHPUnit_Framework_TestCase
{
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

    public function testMultiplication()
    {
        $termOne = new Decimal('2', 0);
        $termTwo = new Decimal('3', 0);
        $product = new Decimal('6', 0);

        $this->assertTrue($termOne->multiply($termTwo)->equals($product));

        $termTwo = new Decimal('-1');
        $product = new Decimal('-2');

        $this->assertTrue($termOne->multiply($termTwo)->equals($product));
    }
}
