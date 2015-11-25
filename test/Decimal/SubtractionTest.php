<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class SubtractionTest extends PHPUnit_Framework_TestCase
{
    public function subtractionDataProvider()
    {
        return [
            // single precision
            'single precision, whole floats, positive + positive' => ['5.00', 2, '1.00', 2, '4.00', 2, true],
            'single precision, whole floats, positive + negative' => ['5.00', 2, '-1.00', 2, '6.00', 2, true],
            'single precision, whole floats, negative + positive' => ['-1.00', 2, '2.00', 2, '-3.00', 2, true],
            'single precision, whole floats, negative + negative' => ['-1.00', 2, '-2.00', 2, '1.00', 2, true],
            'single precision, whole floats #3'                   => ['1.00', 2, '5.00', 2, '5.99', 2, false],
            'single precision, whole floats #4'                   => ['1.00', 2, '5.00', 2, '6.01', 2, false],
            'single precision, whole floats #5'                   => ['1.00', 2, '5.00', 2, '100.00', 2, false],

            // mixed precision
            'mixed precision, whole floats, positive + positive' => ['5.00', 4, '1.00', 2, '4.00', 3, true],
            'mixed precision, whole floats, positive + negative' => ['5.00', 6, '-1', 0, '6.00', 9, true],
            'mixed precision, whole floats, negative + positive' => ['-1.00', 3, '2.00', 6, '-3.00', 5, true],
            'mixed precision, whole floats, negative + negative' => ['-1.00', 8, '-2.00', 3, '1.00', 11, true],
            'mixed precision, floats, positive + positive'       => ['1.0001', 4, '2.00', 2, '-0.9999', 4, true],

            ['5.00', 2, '5.005', 3, '0.01', 2, true],
            ['5.00', 2, '5.005', 3, '0.01', 3, true],
            ['5.005', 3, '5.00', 2, '0.005', 3, true],
            ['5.005', 3, '5.00', 2, '10.00', 2, false],
        ];
    }

    /**
     * @dataProvider subtractionDataProvider
     * @param string $firstValue
     * @param int $firstPrecision
     * @param string $secondValue
     * @param int $secondPrecision
     * @param string $expectedValue
     * @param int $expectedPrecision
     * @param bool $expectedResult
     */
    public function testSubtraction($firstValue, $firstPrecision, $secondValue, $secondPrecision, $expectedValue, $expectedPrecision, $expectedResult)
    {
        $termOne    = new Decimal($firstValue, $firstPrecision);
        $termTwo    = new Decimal($secondValue, $secondPrecision);
        $difference = new Decimal($expectedValue, $expectedPrecision);

        $this->assertEquals($expectedResult, $termOne->subtract($termTwo)->equals($difference));
    }
}
