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
}
