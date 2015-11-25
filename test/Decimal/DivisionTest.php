<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class DivisionTest extends PHPUnit_Framework_TestCase
{
    public function divisionProvider()
    {
        return [
            ['6', 0, '3', 0, '2'],
            ['6', 0, '-3', 0, '-2'],
            ['2', 0, '-1', 0, '-2'],
            ['2', 1, '-1', 1, '-2.0'],
            ['-2', 0, '-5', 0, '0'],
            ['-2', 1, '-5', 1, '0.4'],
            ['-2', 1, '5', 1, '-0.4'],
            ['0.25', 2, '0.25', 5, '1.00'],
            ['0.25', 2, '-0.25', 5, '-1.00'],
            ['100', 5, '3', 0, '33.33333'],
            ['3', 5, '7', 0, '0.42857'],
            ['3', 3, '7', 0, '0.429'],
        ];
    }

    /**
     * @dataProvider divisionProvider
     * @param string $firstValue
     * @param int $firstPrecision
     * @param string $secondValue
     * @param int $secondPrecision
     * @param string $quotientValue
     */
    public function testDivision($firstValue, $firstPrecision, $secondValue, $secondPrecision, $quotientValue)
    {
        $termOne = new Decimal($firstValue, $firstPrecision);
        $termTwo = new Decimal($secondValue, $secondPrecision);

        $this->assertEquals($quotientValue, $termOne->divide($termTwo)->getValue());
    }
}
