<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class RoundingTest extends PHPUnit_Framework_TestCase
{
    public function roundingProvider()
    {
        return [
            'positive float, round up'    => ['0.00035', 5, '0.0004', 4],
            'positive float, round up #2' => ['0.035', 3, '0.04', 2],
            'positive float, round up #3' => ['0.5', 1, '1', 0],
            'positive float, round down'  => ['0.00034', 5, '0.0003', 4],
            'negative float, round up'    => ['-0.00034', 5, '-0.0003', 4],
            'negative float, round down'  => ['-0.00035', 5, '-0.0004', 4],
            'positive no-op'              => ['0.0035', 4, '0.0035', 4],
            'negative no-op'              => ['-0.0035', 4, '-0.0035', 4],
        ];
    }

    /**
     * @dataProvider roundingProvider
     * @param string $value
     * @param int $precision
     * @param string $roundedValue
     * @param int $roundedPrecision
     */
    public function testRounding($value, $precision, $roundedValue, $roundedPrecision)
    {
        $decimal         = new Decimal($value, $precision);
        $roundedDecimal  = $decimal->round($roundedPrecision);
        $expectedDecimal = new Decimal($roundedValue, $roundedPrecision);

        $this->assertTrue($roundedDecimal->equals($expectedDecimal));
    }
}
