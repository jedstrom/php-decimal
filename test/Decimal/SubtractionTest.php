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
            'single precision, whole floats, positive + positive' => ['5.00', 2, '1.00', 2, '4.00'],
            'single precision, whole floats, positive + negative' => ['5.00', 2, '-1.00', 2, '6.00'],
            'single precision, whole floats, negative + positive' => ['-1.00', 2, '2.00', 2, '-3.00'],
            'single precision, whole floats, negative + negative' => ['-1.00', 2, '-2.00', 2, '1.00'],
            'single precision, whole floats #3'                   => ['1.00', 2, '5.00', 2, '-4.00'],
            'single precision, whole floats #4'                   => ['1.00', 2, '5.005', 3, '-4.01'],

            // mixed precision
            'mixed precision, whole floats, positive + positive' => ['5.00', 4, '1.00', 2, '4.0000'],
            'mixed precision, whole floats, positive + negative' => ['5.00', 6, '-1', 0, '6.000000'],
            'mixed precision, whole floats, negative + positive' => ['-1.00', 3, '2.00', 6, '-3.000'],
            'mixed precision, whole floats, negative + negative' => ['-1.00', 8, '-2.00', 3, '1.00000000'],
            'mixed precision, floats, positive + positive'       => ['1.0001', 4, '2.00', 2, '-0.9999'],

            ['5.00', 2, '5.005', 3, '-0.01'],
            ['5.00', 3, '5.005', 3, '-0.005'],
            ['5.005', 3, '5.00', 2, '0.005'],
        ];
    }

    /**
     * @dataProvider subtractionDataProvider
     * @param string $firstValue
     * @param int $firstPrecision
     * @param string $secondValue
     * @param int $secondPrecision
     * @param string $expectedValue
     */
    public function testSubtraction($firstValue, $firstPrecision, $secondValue, $secondPrecision, $expectedValue)
    {
        $termOne = new Decimal($firstValue, $firstPrecision);
        $termTwo = new Decimal($secondValue, $secondPrecision);

        $this->assertSame($expectedValue, $termOne->subtract($termTwo)->getValue());
    }
}
