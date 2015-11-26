<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class PrecisionTest extends PHPUnit_Framework_TestCase
{
    public function precisionProvider()
    {
        return [
            ['0.00', 0, '0'],
            ['0', 3, '0.000'],
            ['1.1115', 3, '1.112'],
        ];
    }

    public function automaticPrecisionProvider()
    {
        return [
            ['3.14159', 5],
            ['1', 0],
            ['-1.2345', 4],
        ];
    }

    /**
     * @dataProvider precisionProvider
     * @param string $value
     * @param int $precision
     * @param string $expectedValue
     */
    public function testPrecision($value, $precision, $expectedValue)
    {
        $decimal = new Decimal($value, $precision);

        $this->assertSame($expectedValue, $decimal->getValue());
    }

    /**
     * @dataProvider automaticPrecisionProvider
     * @param string $value
     * @param int $expectedPrecision
     */
    public function testSetPrecisionAutomaticallyBasedOnInputValue($value, $expectedPrecision)
    {
        $decimal = new Decimal($value);

        $this->assertEquals($expectedPrecision, $decimal->getPrecision());
    }
}
